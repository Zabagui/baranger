<?php
/*******************************************************************************
* This is the TNG PDF class, which extends the tFPDF class (which in turn      *
* extends the FDPF class.                                                      *
* Author:   Bret Rumsey                                                        *
*                                                                              *
* TNGPDF is TNGs own PDF class.                                                *
* tFPDF is a modification of FPDF to support Unicode through UTF-8.            *
*                                                                              *
* Modifications                                                                *
* - Removed font name mapping.                                                 *
* - Fonts are now loaded in font "packages", meaning there is a directory      *
*   under the FPDF_FONTPATH for each font family, which contains all of the    *
*   variations for that font (italics, bold, etc).  This required adding the   *
*   'family' key to the font info hash.                                        *
*******************************************************************************/

if(!class_exists('TNGPDF'))
{
define('TNGPDF_VERSION','0.1');

include_once 'tfpdf.php';
include_once 'version.php';

class TNGPDF extends tFPDF
{

// Private properties
var $charset;	    // character set being used
var $bold;	    	// character weight being used

/*******************************************************************************
*                                                                              *
*                               Public methods                                 *
*                                                                              *
*******************************************************************************/
function __construct($orientation='P',$unit='mm',$format='A4') 
{
  global $session_charset;

  $this->charset = $session_charset;
  $this->bold = $session_charset == "UTF-8" ? "B" : "";
  tFPDF::__construct($orientation, $unit, $format);
}


function _escapetext($s)
{
    if ($this->charset == 'UTF-8')
	$s = $this->utf8_to_utf16be($s, false);
    return '('. strtr($s, array(')' => '\\)', '(' => '\\(', '\\' => '\\\\')) .')';
}

function Image($file, $x=null, $y=null, $w=0, $h=0, $type='', $link='')
{
	//Put an image on the page
	if(!isset($this->images[$file]))
	{
		//First use of image, get info
		if($type=='')
		{
			$pos=strrpos($file,'.');
			if(!$pos)
				$this->Error('Image file has no extension and no type was specified: '.$file);
			$type=substr($file,$pos+1);
		}
		$type=strtolower($type);
		//$mqr=get_magic_quotes_runtime();
        //if(version_compare(PHP_VERSION, '5.3.0', '<')){
            //set_magic_quotes_runtime(0);
        //}
		if($type=='jpg' || $type=='jpeg')
			$info=$this->_parsejpg($file);
		elseif($type=='png')
			$info=$this->_parsepng($file);
		else
		{
			//Allow for additional formats
			$mtd='_parse'.$type;
			if(!method_exists($this,$mtd))
				$this->Error('Unsupported image type: '.$type);
			$info=$this->$mtd($file);
		}
        //if(version_compare(PHP_VERSION, '5.3.0', '<')){
            //set_magic_quotes_runtime($mqr);
        //}
		$info['i']=count($this->images)+1;
		$this->images[$file]=$info;
	}
	else
		$info=$this->images[$file];
	//Automatic width and height calculation if needed
	if($w==0 && $h==0)
	{
		//Put image at 72 dpi
		$w=$info['w']/$this->k;
		$h=$info['h']/$this->k;
	}
	if($w==0)
		$w=$h*$info['w']/$info['h'];
	if($h==0)
		$h=$w*$info['h']/$info['w'];
	//if ($just == 'C') {
	//    $x = $this->lMargin + (($this->w - $this->lMargin - $this->rMargin) / 2) - ($w / 2);
	//}
	$this->_out(sprintf('q %.2f 0 0 %.2f %.2f %.2f cm /I%d Do Q',$w*$this->k,$h*$this->k,$x*$this->k,($this->h-($y+$h))*$this->k,$info['i']));
	if($link)
		$this->Link($x,$y,$w,$h,$link);
}

function WriteLongIndent($h,$txt,$link='',$indent=0,$rows=0,$textheight=0)
{
	if ($textheight == 0)
	    $textheight = $h;

	//Output text in flowing mode
	$cw=&$this->CurrentFont['cw'];
	$w=$this->w-$this->rMargin-$this->x-$indent;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		//Get next character
		$c=$s[$i];
		if($c=="\n")
		{
			//Explicit line break
			$this->Cell($w,$h,substr($s,$j,$i-$j),0,2,'',0,$link);
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			if($nl==1)
			{
				$this->indentRowCount++;
				if ($this->indentRowCount >= $rows) 
				    $indent = 0;
				$this->x=$this->lMargin+$indent;
				$w=$this->w-$this->rMargin-$this->x-$startx-$indent;
				$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			}
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			//Automatic line break
			if($sep==-1)
			{
				if($this->x>$this->lMargin)
				{
					$this->indentRowCount++;
					if ($this->indentRowCount >= $rows) 
					    $indent = 0;
					//Move to next line
					$this->x=$this->lMargin+$indent;
					$this->y+=$h;
					$w=$this->w-$this->rMargin-$this->x-$indent;
					$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
					$i++;
					$nl++;
					continue;
				}
				if($i==$j)
					$i++;
				if ($textheight != $h) {
				    $this->Cell($w,$textheight,substr($s,$j,$i-$j),0,0,'',0,$link);
				    $this->Cell($w,$h,'',0,2,'',0,$link);
				}
				else
				    $this->Cell($w,$h,substr($s,$j,$i-$j),0,2,'',0,$link);
			}
			else
			{
				if ($textheight != $h) {
				    $this->Cell($w,$textheight,substr($s,$j,$sep-$j),0,0,'',0,$link);
				    $this->Cell($w,$h,'',0,2,'',0,$link);
				}
				else 
				    $this->Cell($w,$h,substr($s,$j,$sep-$j),0,2,'',0,$link);
				$i=$sep+1;
			}
			$sep=-1;
			$j=$i;
			$l=0;
			if($nl==1)
			{
				$this->indentRowCount++;
				if ($this->indentRowCount >= $rows) 
				    $indent = 0;
				$this->x=$this->lMargin+$indent;
				$w=$this->w-$this->rMargin-$this->x-$indent;
				$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			}
			$nl++;
		}
		else
			$i++;
	}
	//Last chunk
	if($i!=$j)
		$this->Cell($l/1000*$this->FontSize,$textheight,substr($s,$j),0,0,'',0,$link);
}

function WriteHTML($html, $indent=0, $rows=0) {
    $this->indentRowCount = 0;
    if ($indent > 0)
	$this->SetX($this->GetX() + $indent);
    $html = str_replace("\n", '', $html);
    $a = preg_split('/<(.*)\/?>/U', $html, -1, PREG_SPLIT_DELIM_CAPTURE);
    $height = $this->FontSize + 0.03;
    $textheight = 0;
    foreach ($a as $i => $e) {
	if ($i % 2 == 0) {
	    $this->WriteLongIndent($height, $e, '', $indent, $rows, $textheight);
	}
	else {
	    if ($e[0] == '/') {
		$tag = strtoupper(substr($e, 1));
		$this->CloseTag($tag);
		if ($tag == 'SUP') 
		    $textheight = 0;
	    }
	    else {
		$a2 = explode(' ', $e);
		$tag = strtoupper(array_shift($a2));
		$attr = array();
		foreach($a2 as $v) {
		    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                }
                $this->OpenTag($tag,$attr);
		if ($tag == 'SUP') 
		    $textheight = $height / 2;
	    }
	}
    }
}

function OpenTag($tag, $attr) {
    //Opening tag
    if($tag=='B' or $tag=='I' or $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF=$attr['HREF'];
    if($tag=='SUP')
        $this->SetFontSize($this->FontSizePt-4);
    if($tag=='BR') {
        $this->Ln($this->FontSize + 0.03);
    }
}

function CloseTag($tag) {
    //Closing tag
    if($tag=='B' or $tag=='I' or $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='SUP')
        $this->SetFontSize($this->FontSizePt+4);
    if($tag=='A')
        $this->HREF='';
    if($tag=='P')
	$this->Ln($this->FontSize + 0.03);
}

function SetStyle($tag,$enable) {
	//echo "setting style";
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s)
        if($this->$s>0)
            $style.=$s;
    $this->SetFont('',$style);
}

/*
function AddFont($family,$style='',$file='')
{ 
  //Add a TrueType or Type1 font
  $family=strtolower($family);
  $style=strtoupper($style);
  if($style=='IB')
    $style='BI';
  $subdir='';
  if($this->charset=='UTF-8')
    $subdir='/unifont';
  // don't fail here, just return
  if(isset($this->fonts[$family.$style]))
    return;
  if($file=='')
    $file=str_replace(' ','',$family).strtolower($style).'.php';
  // if a style is available, revert to the regular font
  if(!is_file($this->_getfontpath().$family.$subdir.'/'.$file))
    $file=str_replace(' ','',$family).'.php';
  include($this->_getfontpath().$family.$subdir.'/'.$file);
  if(!isset($name))
    $this->Error('Could not include font definition file: '.$file);
  $i=count($this->fonts)+1;
  if ($type == 'core') 
      $this->fonts[$family.$style]=array('i'=>$i,'type'=>$type,'family'=>$family,'name'=>$name,'up'=>$up,'ut'=>$ut,'cw'=>$cw);
  else
      $this->fonts[$family.$style]=array('i'=>$i,'type'=>$type,'family'=>$family,'name'=>$name,'desc'=>$desc,'up'=>$up,'ut'=>$ut,'cw'=>$cw,'file'=>$file,'ctg'=>$ctg);
  if($file)
  {
    if($type=='TrueTypeUnicode')
      $this->FontFiles[$file]=array('family'=>$family,'length1'=>$originalsize);
    elseif ($type!='core')
      $this->FontFiles[$file]=array('family'=>$family,'length1'=>$size1,'length2'=>$size2);
  }
}
*/

function GetPageSize()
{
    $dim = array();
    $dim['w'] = $this->w;
    $dim['h'] = $this->h;
    return $dim;
}

function GetFontSize($font = '', $fontsize = '')
{
    if ($font != '') {
	$origfamily = $this->FontFamily;
	$this->SetFont($font);
    }
    if ($fontsize != '') {
	$origsize = $this->FontSizePt;
	$this->SetFont('', '', $fontsize);
    }
    $size = $this->FontSize;
    if ($font != '') 
	$this->SetFont($origfamily);
    if ($fontsize != '') 
	$this->SetFont('', '', $origsize);
    
    return $size;
}

function Header() 
{
    global $titleConfig, $rootpath;

    if ($this->page == 1 && $titleConfig['skipFirst'] == 'true')
	return;
	//echo "bold=" . $this->bold;
	if(!isset($titleConfig['image'])) $titleConfig['image'] = "";
	if(!isset($titleConfig['outline'])) $titleConfig['outline'] = "";
    $this->SetFont($titleConfig['font'], $this->bold, $titleConfig['fontSize']);
    $origlMargin = $this->lMargin;
    $this->lMargin = $titleConfig['lMargin'];
    $this->SetX($titleConfig['lMargin']);

	if($titleConfig['image'] && $this->page == 1) {
		$thumbHeight = 0.9;
		$this->Image($rootpath . urldecode($titleConfig['image']),$titleConfig['lMargin'],$this->y,0,$thumbHeight);
		$photoinfo = @GetImageSize( $rootpath . $titleConfig['image'] );
		if($photoinfo) {
			$h = $photoinfo[1];
			$w = $photoinfo[0];
			$ratio = $w/$h;
		
			$wtouse = $ratio * $thumbHeight + 0.1;

			$this->SetX($titleConfig['lMargin'] + $wtouse);
		}
		else
			$this->SetX($titleConfig['lMargin'] + $thumbHeight);
	}

    $this->Cell($this->w - $titleConfig['lMargin'] - $this->rMargin, $this->FontSize, $titleConfig['title'], 0, 0, $titleConfig['justification']);

	if($titleConfig['image'] && $this->page == 1) {
		$this->SetY($this->tMargin + $thumbHeight + 0.15);
	    if ($titleConfig['line']) {
			$this->Line($titleConfig['lMargin'], $this->y, $this->w-$this->rMargin, $this->y);
	    		$this->Ln(0.5 * $this->FontSize);
		}
	}
	else {
	    if ($titleConfig['line']) 
			$this->Line($titleConfig['lMargin'], $this->y + $this->FontSize, $this->w-$this->rMargin, $this->y + $this->FontSize);
    		$this->Ln(2 * $this->FontSize);
	}

    if ($titleConfig['outline'] == true) {
	$this->Rect($this->lMargin, $this->y, $this->w - $this->lMargin - $this->rMargin, $this->h-$this->bMargin-$this->y);
    }
    // draw a title row at the start of the next page
    if ($titleConfig['header'] != false) {
	$this->SetFont($titleConfig['headerFont'], $this->bold, $titleConfig['headerFontSize']);
	$this->Cell(0, $this->FontSize + 0.1, $titleConfig['header'], 1, 1, 'L', 1);	
	$this->Ln(0.05);
    }

    // reset our left margin
    $this->SetLeftMargin($origlMargin);
}

function Footer() 
{
    global $footerConfig;
    global $tngdomain, $sitename, $dbowner, $text;
    global $rptFont, $lftmrg;

    if ($this->page == 1 && $footerConfig['skipFirst'] == 'true')
	return;

    $origlMargin = $this->lMargin;
    $this->SetLeftMargin($footerConfig['lMargin']);
    $this->SetFont($footerConfig['font'], '', $footerConfig['fontSizeSmall']);
    $h1 = $this->FontSize;
    $this->SetFont($footerConfig['font'], '', $footerConfig['fontSizeLarge']);
    $h2 = $this->FontSize;

    //build up our footer text
    $txt = "{$text['maintby']} $dbowner";
    if ($sitename != '') 
	$txt = "$sitename - $txt";

    $this->SetY((-1 * $footerConfig['bMargin']) - $h1 - $h2);
    $this->Cell(0, $h2, $txt, 0, 0, 'L');
    $this->Cell(0, $h2, Date('d M Y'), 0, 0, 'R');

    $this->SetFont('', '', 6);
    $this->SetY((-1 * $footerConfig['bMargin']) - $h1);
    $this->Cell(0, $h1, $tngdomain, 0, 0, 'L');
    if ($footerConfig['printWordPage'] == true)
	$pagetext = $text['page'].' ';
    $pagetext .= $this->page;
    $this->Cell(0, $h1, $pagetext, 0, 0, 'R');
    if ($footerConfig['line']) 
	$this->Line($footerConfig['lMargin'], $this->y - $h1 - $h2, $this->w-$this->rMargin, $this->y - $h1 - $h2);
    $this->SetLeftMargin($origlMargin);
}

function GetFooterHeight()
{
    global $footerConfig;

    $this->SetFont($footerConfig['font'], '', $footerConfig['fontSizeSmall']);
    $h = $this->FontSize;
    $this->SetFont($footerConfig['font'], '', $footerConfig['fontSizeLarge']);
    $h += $this->FontSize;
    return $h;
}


function CellFit($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='',$scale=0,$force=1) {

    // CellFit adjusts text with horizontal scaling if text is too wide for cell
    // CellFit developed by Patrick Benny (www.fpdf.org)

    //Get string width
    $str_width=$this->GetStringWidth($txt);

    //Calculate ratio to fit cell
    if($w==0)
	$w=$this->w-$this->rMargin-$this->x;
    $ratio = 0;
    if ($str_width != 0)
	$ratio=($w-$this->cMargin*2)/$str_width;

    $fit=($ratio < 1 || ($ratio > 1 && $force == 1));
    if ($fit) {
	switch ($scale) {
	    //Character spacing
	    case 0:
		//Calculate character spacing in points
		$char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
		//Set character spacing
		$this->_out(sprintf('BT %.2f Tc ET',$char_space));
		break;

	    //Horizontal scaling
	    case 1:
		//Calculate horizontal scaling
		$horiz_scale=$ratio*100.0;
		//Set horizontal scaling
		$this->_out(sprintf('BT %.2f Tz ET',$horiz_scale));
		break;
	}
	//Override user alignment (since text will fill up cell)
	$align='';
    }

    //Pass on to Cell method
    $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

    //Reset character spacing/horizontal scaling
    if ($fit)
	$this->_out('BT '.($scale==0 ? '0 Tc' : '100 Tz').' ET');
}

function MBGetStringLength($s) {
    //MBGetStringLength is a patch that allows CJK double-byte text, by Patrick Benny (www.fpdf.org)
    if($this->CurrentFont['type']=='Type0') {
	$len = 0;
	$nbbytes = strlen($s);
	for ($i = 0; $i < $nbbytes; $i++) {
	    if (ord($s[$i])<128) {
		$len++;
	    } else {
		$len++;
		$i++;
	    }
	}
	return $len;
    } else {
	return strlen($s);
    }
}

function RoundedRect($x, $y, $w, $h, $r, $corners = '1234', $style = '') {
    $k = $this->k;
    $hp = $this->h;
    if($style=='F')
        $op='f';
    elseif($style=='FD' || $style=='DF')
        $op='B';
    else
        $op='S';
    $MyArc = 4/3 * (sqrt(2) - 1);
    $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));

    $xc = $x+$w-$r;
    $yc = $y+$r;
    $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));
    if (strpos($corners, '2')===false)
        $this->_out(sprintf('%.2F %.2F l', ($x+$w)*$k,($hp-$y)*$k ));
    else
        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);

    $xc = $x+$w-$r;
    $yc = $y+$h-$r;
    $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
    if (strpos($corners, '3')===false)
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-($y+$h))*$k));
    else
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);

    $xc = $x+$r;
    $yc = $y+$h-$r;
    $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
    if (strpos($corners, '4')===false)
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-($y+$h))*$k));
    else
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);

    $xc = $x+$r ;
    $yc = $y+$r;
    $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
    if (strpos($corners, '1')===false)
    {
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$y)*$k ));
        $this->_out(sprintf('%.2F %.2F l',($x+$r)*$k,($hp-$y)*$k ));
    }
    else
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
    $this->_out($op);
}

function _Arc($x1, $y1, $x2, $y2, $x3, $y3) {
    $h = $this->h;
    $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
        $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}

} // end of class

}
?>
