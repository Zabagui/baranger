<?php
//Original code by Ben Wagner

@set_time_limit(0);
$textpart = "pedigree"; //Needed for tabs!!
include("tng_begin.php");
include("fan_config.php");

if(!$personID && !isset($needperson)) die("no args");

$fan_url = getURL( "fan", 1 );

/*
echo "<pre>";
print_r(get_defined_vars());
echo "</pre>";
die();
*/
 
// how many generations to show?
$generations = intval($generations);
if( !$generations ) {
	if($sitever != "mobile")
		$generations = $fan_gen_default;
	else
		$generations = 3;
}
if( $generations > $fan_gen_max )
	$generations = $fan_gen_max;
if( $generations < $fan_gen_min )
	$generations = $fan_gen_min;

$result = getPersonFullPlusDates($tree, $personID);
if( !tng_num_rows($result) ) {
	tng_free_result($result);
	header( "Location: thispagedoesnotexist.html" );
	exit;
}
$row = tng_fetch_assoc( $result );
tng_free_result($result);
$righttree = checktree($tree);
$rightbranch = $righttree ? checkbranch($row['branch']) : false;
$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
$row['allow_living'] = $rights['living'];
$row['allow_private'] = $rights['private'];
$namestr = getName( $row );

$logname = $tngconfig['nnpriv'] && $row['private'] ? $admtext['text_private'] : ($nonames && $row['living'] ? $text['living'] : $namestr);

$treeResult = getTreeSimple($tree);
$treerow = tng_fetch_assoc($treeResult);
$disallowgedcreate = $treerow['disallowgedcreate'];
$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
tng_free_result($treeResult);

writelog( "<a href=\"$fan_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\">{$text['fanchart']}: $logname ($personID)</a>" );
preparebookmark( "<a href=\"$fan_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\">{$text['fanchart']}: $namestr ($personID)</a>" );

tng_header( "{$text['fanchart']}: {$namestr}  Generations: {$generations}",$flags);

$photostr = showSmallPhoto( $personID, $namestr, $rights['both'], 0, false, $row['sex'] );
echo tng_DrawHeading( $photostr, $namestr, getYears( $row ) );

/*
echo "<pre>";
print_r($row);
echo "</pre>";
die();
*/

$perID=array();
$perID[0]=$personID;
$pNames=null;
$pIDs=null;
$tData=null;
$years=null;
$marriages = array();

$righttree = checktree($tree);

for ($a=0; $a < $generations; $a++)
{
	for($b=0; $b < pow(2,$a); $b++)
	{
		if(!empty($perID[pow(2,$a)+$b-1]))
		{
			$tID = pow(2,$a)+$b-1;
			$result = getPersonFullPlusDates($tree, $perID[$tID]);
			$row = tng_fetch_assoc( $result );

			$rightbranch = $righttree ? checkbranch($row['branch']) : false;
			$rights = determineLivingPrivateRights($row, $righttree, $rightbranch);
			$row['display'] = $rights['both'];

			$row['allow_living'] = $rights['living'];
			$row['allow_private'] = $rights['private'];
			$row['suffix'] = "";

			$perName[$tID]= getName($row);
			$pNames.= "pNames[$tID] = \"" . addslashes($perName[$tID]) . "\";\n";
			$pIDs  .= "pIDs[$tID] = '{$perID[$tID]}';\n";
			$tData .= "tData[$tID] = ";
			$years .= "years[$tID] = ";
			$bio = $perName[$tID] . "<br>";

			$result = getFamilyData($tree,$row['famc']);
			$rowM = tng_fetch_assoc( $result );
			$h = 2*($tID)+1;
			$w = 2*($tID)+2;
			if(!empty($rowM)) {
				$perID[$h] = $rowM['husband'];
				$perID[$w] = $rowM['wife'];

				$rightsM = determineLivingPrivateRights($rowM, $righttree, $rightbranch);
				$rowM['allow_living'] = $rightsM['living'];
				$rowM['allow_private'] = $rightsM['private'];

				if($rightsM['both'] && ($rowM['marrdate'] || $rowM['marrplace'])) {
					$marr = trim($text['married'] . ": " .  displayDate($rowM['marrdate']));
					if($rowM['marrdate'] && $rowM['marrplace']) $marr .= ", ";
					$marr .= $rowM['marrplace'];
					$marriages[$h] = $marriages[$w] = $marr;
				}
			}

			if($rights['both']) {

				if ($row['birthdate'] || $row['birthplace']) {
					$bio .= trim($text['born'] . ": " .  displayDate($row['birthdate']));
					if($row['birthdate'] && $row['birthplace']) $bio .= ", ";
					$bio .= $row['birthplace'];
				} elseif ($row['altbirthdate'] || $row['altbirthplace']) {
					$bio .= trim($text['christened'] . ": " . displayDate($row['altbirthdate']));
					if($row['altbirthdate'] && $row['altbirthplace']) $bio .= ", ";
					$bio .= $row['altbirthplace'];
				}
				if(isset($marriages[$tID]))
					$bio .= trim($bio ? '<br>' : '') . $marriages[$tID];
				if($row['deathdate'] || $row['deathplace']) {
					$bio .=  trim(($bio ? '<br>' : '').$text['died'] . ": " . displayDate($row['deathdate']));
					if($row['deathdate'] && $row['deathplace']) $bio .= ", ";
					$bio .= $row['deathplace'];
				} elseif ($row['burialdate'] || $row['burialplace']) {
					$bio .= trim(($bio ? '<br>' : '').$text['buried'] . ": " . displayDate($row['burialdate']));
					if($row['burialdate'] && $row['burialplace']) $bio .= ", ";
					$bio .= $row['burialplace'];
				}
				$years .= "\"" . strip_tags(justYears($row)) . "\";\n";
			} else {
				$years .= "\"\";\n";
			}
			$tData.= "\"" . addslashes($bio) . "\";\n";
		}
	}
}

$textStyles=null;
foreach ($fan_text_style AS $k => $v)
{
	$textStyles.="fan_text_style[$k]='$v';\n";
}

$lineHeight=null;
foreach ($fan_line_height AS $k => $v)
{
	$lineHeight.="fan_line_height[$k]=$v;\n";
}


/*
echo "<pre>";
print_r($perName);
echo "<hr>";
print_r($perID);
echo "</pre>";
*/

$getperson_url = getURL( "getperson", 1 );
$ahnentafel_url = getURL( "ahnentafel", 1 );
$pedigree_url = getURL( "pedigree", 1 );
$pedigreetext_url = getURL( "pedigreetext", 1 );
$extrastree_url = getURL( "extrastree", 1 );
$pdfform_url = getURL( "rpt_pdfform", 1 );
$vertical_url = getURL( "verticalchart", 1 );
$fan_url = getURL( "fan", 1 );

$innermenu = $text['generations'] . ": &nbsp;";
$innermenu .= "<select name=\"generations\" class=\"verysmall\" onchange=\"window.location.href='$fan_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=' + this.options[this.selectedIndex].value\">\n";
   for( $i = $fan_gen_min; $i <= $fan_gen_max; $i++ ) {
       $innermenu .= "<option value=\"$i\"";
       if( $i == $generations ) $innermenu .= " selected=\"selected\"";
       $innermenu .= ">$i</option>\n";
   }
$innermenu .= "</select>&nbsp;&nbsp;&nbsp;\n";
$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=standard&amp;generations=$generations\" class=\"lightlink\" id=\"stdpedlnk\">{$text['pedstandard']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$vertical_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=vertical&amp;generations=$generations\" class=\"lightlink\" id=\"pedchartlnk\">{$text['pedvertical']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=compact&amp;generations=$generations\" class=\"lightlink\" id=\"compedlnk\">{$text['pedcompact']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$pedigree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;display=box&amp;generations=$generations\" class=\"lightlink\" id=\"boxpedlnk\">{$text['pedbox']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$pedigreetext_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['pedtextonly']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$ahnentafel_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink\">{$text['ahnentafel']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$fan_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;generations=$generations\" class=\"lightlink3\">{$text['fanchart']}</a> &nbsp;&nbsp; | &nbsp;&nbsp; \n";
$innermenu .= "<a href=\"$extrastree_url" . "personID=$personID&amp;tree=$tree&amp;parentset=$parentset&amp;showall=1&amp;generations=$generations\" class=\"lightlink\">{$text['media']}</a>\n";
$allowpdf = !$treerow['disallowpdf'] || ($allow_pdf && $rightbranch);
if($generations <= 6 && $allowpdf)
	$innermenu .= " &nbsp;&nbsp; | &nbsp;&nbsp; <a href=\"#\" class=\"lightlink\" onclick=\"tnglitbox = new LITBox('$pdfform_url" . "pdftype=ped&amp;personID=$personID&amp;tree=$tree&amp;generations=$generations',{width:350,height:350});return false;\">PDF</a>\n";

echo getFORM( "pedigree", "", "form1", "form1" );
echo tng_menu( "I", "pedigree", $personID, $innermenu );
echo "</form>\n";
$width_str = $generations >= 5 && $tngprint ? "width:100%;" : "";

echo <<< FAN_DOC
<div id="fanWrapper" style="position:relative;">
<canvas id="myCanvas" width="100" height="100" style="border-bottom:1px solid {$fan_color_line}; z-index: 0;$width_str"></canvas>
<canvas id="infoCanvas" width="{$fan_info_width}" height="{$fan_info_height}" style="border: 1px solid black; background-color:white; border-radius: 6px; position: absolute; left:-1000px; top:100px; z-index: 1;"></canvas>
</div>

<script type="text/javascript">
// <![CDATA[
	var generations={$generations};
	width={$fan_width};
	
	var pNames=[];
	{$pNames}

	var tData=[];
	{$tData}

	var years=[];
	{$years}

	var pIDs=[];
	{$pIDs}

	var fan_text_style=[];
	{$textStyles}

	var fan_line_height=[];
	{$lineHeight}

	function generationDistance(gens)
	{
		distance=gens*width;
		if (gens > 2)
			distance=(gens-2)*.25*width+distance;
		if (gens > 4)
			distance=(gens-4)*.75*width+distance;
		return distance;
	}

	var decodeHTML=(function()
	{
		var element = document.createElement('div');
		
		function decodeHTMLEntities (str) {
			if(str && typeof str === 'string')
			{
				// strip script/html tags
				str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
				str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
				element.innerHTML = str;
				str = element.textContent;
				element.textContent = '';
			}
			return str;
		}
		return decodeHTMLEntities;
	})();

	function placeWrappedText(ctx,pText,years,originX,originY,gens)
	{
		pText=decodeHTML(pText);
		//console.log("placeWrappedText: %s",pText);
		if (gens==0)
			w=width*2;
		else if (gens==1)
			w=width*1.5;
		else if (gens==2)
			w=width*1.25;
		else
			w=generationDistance(gens)-generationDistance(gens-1);
		w=w*.90; //some white space on the side
		
		if (ctx.measureText(pText).width < w)
		{
			if(gens > 0 && gens < 4)
			{
				originY=originY+(fan_line_height[gens]*1.1);
				ctx.fillText(pText, originX, originY);
			}
			else
			{
				if(years && gens > 4 && gens < 8)
					originY=originY-(fan_line_height[gens]*0.2);
				ctx.fillText(pText, originX, originY);
			}
			if(years && gens < 8) {
				if(gens > 5)
					originY=originY+fan_line_height[gens]*1.3;
				else
					originY=originY+fan_line_height[gens];
				ctx.fillText(years, originX, originY);
			}
			return;
		}

		parts=pText.split(' ');
		start=0;

//		console.log("%s has %d parts",pText,parts.length);
		
		numDisplayLines=0;
		var newparts = new Array(parts[0]);
		for (var a=1; a <= parts.length; a++)
		{
			if(parts.length < 5 || a == 1 || a == parts.length) {
				if(parts.slice(start,a-1).join(' ') == '')
				{
					continue;
				}
				start=a-1;
				numDisplayLines=numDisplayLines+1;
				newparts.push(parts[start]);
			}
		}
		parts = newparts;
		//if(numDisplayLines <=2)
		//	numDisplayLines=numDisplayLines+1;
		if(years)
			numDisplayLines=numDisplayLines+1;

		start=0;

		if(gens < 7)
		{
			if(gens == 0)
			{
				//4 lines max.  set for 3
				if(numDisplayLines > 3)
				{
					originY=originY-fan_line_height[gens];
				}
			}
			if(gens == 1)
			{
				//4 lines max.  set for 4
				if(numDisplayLines > 4)
				{
					originY=originY-(fan_line_height[gens]*(4/numDisplayLines));
				}
				if(numDisplayLines < 4)
				{
					originY=originY+(fan_line_height[gens]*((4-numDisplayLines)/numDisplayLines));
				}
			}
			else if(gens == 2)
			{
				//5 lines max.  set for 5
				if(numDisplayLines < 5)
				{
					originY=originY+(fan_line_height[gens]*((5-numDisplayLines)/numDisplayLines));
				}
			}
			else if(gens == 3)
			{
				//5 lines max.  set for 4
				if(numDisplayLines > 4)
				{
					originY=originY-(fan_line_height[gens]);
				}
				if(numDisplayLines == 4)
				{
					//originY=originY-(fan_line_height[gens]/2);
				}
				if(numDisplayLines < 4)
				{
					originY=originY+(fan_line_height[gens]*((4-numDisplayLines)/numDisplayLines));
				}
			}
			else if(gens == 4)
			{
				//5 lines max.  set for 2
				if(numDisplayLines > 2)
				{
					originY=originY-(fan_line_height[gens]*((numDisplayLines-1)*0.5));
				}
			}
			else if(gens == 5)
			{
				//4 lines max.  set for 2
				if(numDisplayLines > 2)
				{
					originY=originY-(fan_line_height[gens]*((numDisplayLines-1)*0.5));
				}
			}
			else if(gens == 6)
			{
				//3 lines max.  set for 2
				if(numDisplayLines > 2)
				{
					originY=originY-(fan_line_height[gens]*((numDisplayLines-2)*0.5));
				}
			}
			else
			{
				//To get here would be an error
			}
		}

		for (var a=1; a <= parts.length; a++)
		{
			if(ctx.measureText(parts.slice(start,a).join(' ')).width < w)
			{
				continue;
			}
			if(parts.slice(start,a-1).join(' ') === '')
			{
				continue;
			}
			ctx.fillText(parts.slice(start,a-1).join(' '),originX,originY);
			originY=originY+fan_line_height[gens];
			start=a-1;
		}
		ctx.fillText(parts.slice(start,parts.length).join(' '),originX,originY);
		if(years && gens < 8) {
			originY=originY+fan_line_height[gens];
			ctx.fillText(years, originX, originY);
		}
		return;
	}

	var c = document.getElementById("myCanvas");
	var ctx = c.getContext("2d");

	ctx.canvas.width=2*(generationDistance(generations));
	ctx.canvas.height=generationDistance(generations);
	originX=ctx.canvas.width/2;
	originY=ctx.canvas.height;
	
	//Color fill
	ctx.moveTo(originX-generationDistance(1),originY);
	ctx.beginPath();
	ctx.arc(originX,originY,generationDistance(1),-Math.PI,0);
	ctx.closePath();
	ctx.fillStyle="{$fan_color_center}";
	ctx.fill();


	if (generations > 1)
	{
		for (var b=0; b < 2; b++)
		{
			var angle1=-Math.PI/2 * b;
			var angle2=-Math.PI/2 * (b+1);
			var x1 = originX + generationDistance(1) * Math.cos(angle1);
			var y1 = originY + generationDistance(1) * Math.sin(angle1);
			var x2 = originX + generationDistance(generations) * Math.cos(angle2);
			var y2 = originY + generationDistance(generations) * Math.sin(angle2);
			var x3 = originX + generationDistance(generations) * Math.cos(angle1);
			var y3 = originY + generationDistance(generations) * Math.sin(angle1);

			ctx.moveTo(x1,y1);
			ctx.beginPath();
			ctx.arc(originX,originY,generationDistance(generations),angle2,angle1);
			ctx.lineTo(x2,y2);
			ctx.arc(originX,originY,generationDistance(1),angle2,angle1);
			ctx.lineTo(x3,y3);
			ctx.closePath();

			if (b==1)
				ctx.fillStyle="{$fan_color_fff}";
			else
				ctx.fillStyle="{$fan_color_mff}";
			ctx.fill();
		}
	}


	if (generations > 2)
	{
		for (var b=0; b < 4; b++)
		{
			var angle1=-Math.PI/4 * b;
			var angle2=-Math.PI/4 * (b+1);
			var x1 = originX + generationDistance(2) * Math.cos(angle1);
			var y1 = originY + generationDistance(2) * Math.sin(angle1);
			var x2 = originX + generationDistance(generations) * Math.cos(angle2);
			var y2 = originY + generationDistance(generations) * Math.sin(angle2);
			var x3 = originX + generationDistance(generations) * Math.cos(angle1);
			var y3 = originY + generationDistance(generations) * Math.sin(angle1);

			ctx.moveTo(x1,y1);
			ctx.beginPath();
			ctx.arc(originX,originY,generationDistance(generations),angle2,angle1);
			ctx.lineTo(x2,y2);
			ctx.arc(originX,originY,generationDistance(2),angle2,angle1);
			ctx.lineTo(x3,y3);
			ctx.closePath();

			if (b==3)
				ctx.fillStyle="{$fan_color_fff}";
			else if (b==2)
				ctx.fillStyle="{$fan_color_fmf}";
			else if (b==1)
				ctx.fillStyle="{$fan_color_mff}";
			else
				ctx.fillStyle="{$fan_color_mmf}";
			ctx.fill();
		}
	}

	if (generations > 3)
	{
		for (var b=0; b < 8; b=b+2)
		{
			var angle1=-Math.PI/8 * b;
			var angle2=-Math.PI/8 * (b+1);
			var x1 = originX + generationDistance(3) * Math.cos(angle1);
			var y1 = originY + generationDistance(3) * Math.sin(angle1);
			var x2 = originX + generationDistance(generations) * Math.cos(angle2);
			var y2 = originY + generationDistance(generations) * Math.sin(angle2);
			var x3 = originX + generationDistance(generations) * Math.cos(angle1);
			var y3 = originY + generationDistance(generations) * Math.sin(angle1);

			ctx.moveTo(x1,y1);
			ctx.beginPath();
			ctx.arc(originX,originY,generationDistance(generations),angle2,angle1);
			ctx.lineTo(x2,y2);
			ctx.arc(originX,originY,generationDistance(3),angle2,angle1);
			ctx.lineTo(x3,y3);
			ctx.closePath();

			if (b==6)
				ctx.fillStyle="{$fan_color_ffm}";
			else if (b==4)
				ctx.fillStyle="{$fan_color_fmm}";
			else if (b==2)
				ctx.fillStyle="{$fan_color_mfm}";
			else
				ctx.fillStyle="{$fan_color_mmm}";
			ctx.fill();
		}
	}

	ctx.fillStyle="{$fan_color_text}";
	ctx.strokeStyle="{$fan_color_line}";

	for (var a=0; a<generations; a++)
	{
//		console.log("Generation: %d",a);
		ctx.beginPath();
		ctx.arc(originX,originY,generationDistance(a+1),Math.PI,2*Math.PI); //left,down,radius,start,stop
		ctx.stroke();

		for (var b=1; b<Math.pow(2,a); b++)
		{
			var angle=-Math.PI/Math.pow(2,a) * b;
			var x = originX + generationDistance(a+1) * Math.cos(angle);
			var y = originY + generationDistance(a+1) * Math.sin(angle);
			ctx.moveTo(x,y);
			x = originX + generationDistance(a) * Math.cos(angle);
			y = originY + generationDistance(a) * Math.sin(angle);
			ctx.lineTo(x,y);
			ctx.stroke();
			
		}

		ctx.font = fan_text_style[a];
		ctx.textAlign = 'center';
		ctx.textBaseline='center';
		
		for (var b=0; b<Math.pow(2,a); b++)
		{
			var pID = Math.pow(2,a)+b -1;
			//var pText="Person: "+pID ;
			if (typeof pNames[pID] == 'undefined')
				var pText="";
			else
				var pText=pNames[pID];

			if (a==0)
			{
				placeWrappedText(ctx,pText,years[pID],originX,originY-width/3,a);
				//ctx.fillText(pText,originX,originY-width/3);
			}
			else if(a<4)
			{
				ctx.save();
				ctx.translate(originX, originY);
				ctx.rotate((Math.PI/Math.pow(2,a+1) * (b*2+1))-Math.PI/2);
				var div=2;
				if (a==3)
					div=1.9;
				else if (a==2)
					div=1.75;
				else if (a==1)
					div=1.75;
				placeWrappedText(ctx,pText,years[pID], 0, -1*(generationDistance(a+1)+generationDistance(a))/div,a);
				//ctx.fillText(pText, 0, -1*(generationDistance(a+1)+generationDistance(a))/2);
				ctx.restore();
			}
			else
			{
				ctx.save();
				ctx.translate(originX, originY);
				ctx.rotate((Math.PI/Math.pow(2,a+1) * (b*2+1)));
				ctx.translate(-1*(generationDistance(a+1)+generationDistance(a))/2,0);
				if (b >= Math.pow(2,a)/2)
				{
					ctx.rotate(1*Math.PI);
				}
				ctx.textAlign = 'center';
				// var thisyear = a < 7 ? years[pID] : '';
				// placeWrappedText(ctx,pText,thisyear,0,0,a);
				placeWrappedText(ctx,pText,years[pID],0,0,a);
				//ctx.fillText(pText, 0, 0);
				ctx.restore();
			}
		}
	}

	stylePaddingLeft = 0;
	stylePaddingTop  = 1;
	styleBorderLeft  = 0;
	styleBorderTop   = 1;
//	// Some pages have fixed-position bars (like the stumbleupon bar) at the top or left of the page
//	// They will mess up mouse coordinates and this fixes that
//  // Code here is used to remove the vague issues right at the edges of the fan chart
	var html = document.body.parentNode;
	htmlTop = html.offsetTop;
	htmlLeft = html.offsetLeft;

	document.getElementById('myCanvas').addEventListener('click', function(event) {
		var rect = document.getElementById("myCanvas").getContext("2d").canvas.getBoundingClientRect();
		var X = event.clientX - rect.left - styleBorderLeft - stylePaddingLeft - htmlLeft;
		var Y = event.clientY - rect.top - styleBorderTop - stylePaddingTop - htmlTop;
		var originX = document.getElementById("myCanvas").getContext("2d").canvas.width/2;
		var originY = document.getElementById("myCanvas").getContext("2d").canvas.height;

		X=X-originX;
		Y=originY-Y; //Yes this is swaped from X;
		var distance = Math.sqrt(Math.pow(X,2) + Math.pow(Y,2));
		var angle=Math.atan2(Y, X);

		var generation=0;
		for (generation=0; generation < {$generations}; generation++)
		{
			if (distance < generationDistance(generation+1))
				break;
		}
		if (generation=={$generations})
			return;

		var perID=2*Math.pow(2,generation)-Math.ceil(angle/(Math.PI/Math.pow(2,generation)))-1;

		if (typeof pIDs[perID] == 'undefined')
			return;

		window.location.href = "getperson.php?personID="+pIDs[perID]+"&tree={$tree}";

		}, false);
FAN_DOC;

if ($fan_use_info_box && !$tngprint)
{
echo <<< INFO_BOX
	var tooltipPrevID=null;
	var tooltipCurID=null;

	document.getElementById('myCanvas').addEventListener('mousemove', function(event) {
		var fanCanvas = document.getElementById("myCanvas");
		var fanRect = fanCanvas.getContext("2d").canvas.getBoundingClientRect();
		var canvas = document.getElementById("infoCanvas");
		var ctx = canvas.getContext("2d");

		var X = event.clientX - fanRect.left - styleBorderLeft - stylePaddingLeft - htmlLeft;
		var Y = event.clientY - fanRect.top - styleBorderTop - stylePaddingTop - htmlTop;
		var originX = fanCanvas.getContext("2d").canvas.width/2;
		var originY = fanCanvas.getContext("2d").canvas.height;

		X=X-originX;
		Y=originY-Y; //Yes this is swaped from X;
		var distance = Math.sqrt(Math.pow(X,2) + Math.pow(Y,2));
		var angle=Math.atan2(Y, X);

		var generation=0;
		for (generation=0; generation < {$generations}; generation++)
		{
			if (distance < generationDistance(generation+1))
				break;
		}
		if (generation=={$generations})
		{
			canvas.style.left = "-1000px";
			return;
		}

		var perID=2*Math.pow(2,generation)-Math.ceil(angle/(Math.PI/Math.pow(2,generation)))-1;
		tooltipCurID=perID;

		if (typeof tData[perID] == 'undefined')
		{
			canvas.style.left = "-1000px";
			return;
		}

		var left=event.clientX - fanRect.left - styleBorderLeft - stylePaddingLeft - htmlLeft;
		var top=event.clientY - fanRect.top - styleBorderTop - stylePaddingTop - htmlTop;

		//Pre-determine canvas size
		var infocanvaswidth = {$fan_info_width};
		var parts=tData[perID].split('<br>');
		ctx.font = '{$fan_info_header}';
		for (var p = 0; p < parts.length; p++)
		{
			parts[p]=decodeHTML(parts[p]);
			if (ctx.measureText(parts[p]).width+14 > infocanvaswidth)
				infocanvaswidth=ctx.measureText(parts[p]).width+14;
				ctx.font = '{$fan_info_style}';
		}
		
		if (left > fanCanvas.getContext("2d").canvas.width/2)
		{
			if ( (fanCanvas.getContext("2d").canvas.width-infocanvaswidth-15) < 0 )
				left = 15;
			else {
				if ( (left-infocanvaswidth-15) < 0)
					left = 15;
				else
					left = left-infocanvaswidth-15;
			}
		}
		else
		{
			if ( (left+infocanvaswidth+15) > fanCanvas.getContext("2d").canvas.width )
			{
				if ((infocanvaswidth) > fanCanvas.getContext("2d").canvas.width)
					left = 15;
				else {
					left = fanCanvas.getContext("2d").canvas.width-infocanvaswidth;
				}
			}
			else
				left += 15;
		}

		if (top > fanCanvas.getContext("2d").canvas.height/2)
			top=top-{$fan_info_height}-15;
		else
			top += 15;

		if (tooltipPrevID!=perID)
		{
			canvas.width=infocanvaswidth;
		}
		tooltipPrevID=perID;


		canvas.style.left=left+"px";
		canvas.style.top=top+"px";
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		//var parts=tData[perID].split('<br>');
		//Pre-check canvas size
		//for (var p = 0; p < parts.length; p++)
		//{
		//	if (ctx.measureText(parts[p]).width+10 > canvas.width)
		//		canvas.width=ctx.measureText(parts[p]).width+10;
		//}
		//write text
		ctx.font = '{$fan_info_header}';
		var q = 0;
		for (var p = 0; p < parts.length; p++)
		{
			ctx.fillText(parts[p], 5, 5+(q+1)*14);
			if(q == 0) {
				q = q + 1
				ctx.fillText(' ', 5, 5+(q+1)*14);
			}
			q = q + 1;
			ctx.font = '{$fan_info_style}';
		}

		}, false);

	document.getElementById('infoCanvas').addEventListener('click', function(event) {
		window.location.href = "getperson.php?personID="+pIDs[tooltipCurID]+"&tree={$tree}";
	}, false);

INFO_BOX;
}

echo("//]]>\n");
echo("</script>\n");
?>
<script type="text/javascript" src="<?php echo $cms['tngpath']; ?>js/rpt_utils.js"></script>
<?php
tng_footer( $flags );
?>
