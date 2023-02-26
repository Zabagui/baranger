<?php
//Original code by Ben Wagner
//change the parameters below according to your needs 

//Colors
$fan_color_text = "black";     //Text color
$fan_color_line = "gray";      //The lines
$fan_color_center = "white";   //The color of the center half circle
$fan_color_fff = "#C2C2FF";    //Blue - father of father of father (grandfather)
$fan_color_ffm = "#DBDBFF";    //Light Blue
$fan_color_fmf = "#80FF80";    //Green
$fan_color_fmm = "#CCFFCC";    //Light Green
$fan_color_mff = "#FF8080";    //Red
$fan_color_mfm = "#FFCCCC";    //Light Red
$fan_color_mmf = "#FFFF80";     //Yellow
$fan_color_mmm = "#FFFFB2";    //Light Yellow

//I've done a fan chart with 11 generations.  That seems to be the best
//my development system will do, but it gets REAL slow.  Depends a lot
//on the web-browser/computer rendering the chart.  8 seems to be the
//balance of speed a readability.
$fan_gen_max = 8; 
$fan_gen_min = 3;
$fan_gen_default = 6;

$fan_width = 85;

//Define the text CSS style for each generation
//up until fan_gen_max-1
$fan_text_style[0]= "14px Arial";  //Center
$fan_text_style[1]= "14px Arial";  //Parents
$fan_text_style[2]= "14px Arial";  //GrandParents
$fan_text_style[3]= "12px Arial";
$fan_text_style[4]= "12px Arial";
$fan_text_style[5]= "12px Arial";
$fan_text_style[6]= "12px Arial";
$fan_text_style[7]= "12px Arial";
$fan_text_style[8]= "10px Arial";
$fan_text_style[9]=  "8px Arial";
$fan_text_style[10]= "7px Arial";
$fan_text_style[11]= "6px Arial";
$fan_text_style[12]= "6px Arial";

//Line height (in pixels) if names need to wrap
$fan_line_height[0]=16;
$fan_line_height[1]=16;
$fan_line_height[2]=16;
$fan_line_height[3]=16;
$fan_line_height[4]=14;
$fan_line_height[5]=14;
$fan_line_height[6]=10;
$fan_line_height[7]=8;
$fan_line_height[8]=8;
$fan_line_height[9]=8;
$fan_line_height[10]=8;
$fan_line_height[11]=8;
$fan_line_height[12]=8;


$fan_use_info_box = true; //Show the information (B/M/D) box over the person
$fan_info_width = 250;
$fan_info_height = 85;
$fan_info_style = "10pt Arial";
$fan_info_header = "14pt Arial";
?>
