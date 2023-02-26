<?php
function includeZoomIcons($path) {
    global $text, $tngprint;

    return !$tngprint ? "<div id=\"mag-icons-div\" class=\"mag-icons\" alt=\"\"><img src=\"img/zoomin.png\" id=\"zoom-in{$path}\" alt=\"{$text['zoomin']}\"/><img src=\"img/zoomreset.png\" id=\"zoom-reset{$path}\" alt=\"{$text['tng_reset']}\"/><img src=\"img/zoomout.png\" id=\"zoom-out{$path}\" alt=\"{$text['zoomout']}\"/></div>\n" : "";
}

function includeZoomScript($path) {
    global $tngprint;

    if(!$tngprint) {
        $output = "const elem{$path} = document.getElementById('vcontainer{$path}');\n";
        $output .= "const zoomIn{$path} = document.getElementById('zoom-in{$path}');\n";
        $output .= "const zoomOut{$path} = document.getElementById('zoom-out{$path}');\n";
        $output .= "const zoomReset{$path} = document.getElementById('zoom-reset{$path}');\n";
        $output .= "const panzoom{$path} = Panzoom(elem{$path}, {step: zoomstep});\n";
        $output .= "zoomIn{$path}.addEventListener('click', panzoom{$path}.zoomIn);\n";
        $output .= "zoomOut{$path}.addEventListener('click', panzoom{$path}.zoomOut);\n";
        $output .= "zoomReset{$path}.addEventListener('click', panzoom{$path}.reset);\n";
    }
    else
        $output = "";

    return $output;
}
?>