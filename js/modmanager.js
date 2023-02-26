document.addEventListener('keydown', checkKeyDown);
document.addEventListener('keyup', checkKeyUp);

var ctrlPressed;

function checkKeyDown(e){
  if (e.code == 114 /* F3 */
   || (e.ctrlKey && e.keyCode === 66 /* Ctrl+B - History*/)
   || (e.ctrlKey && e.keyCode === 67 /* Ctrl+C - Copy*/)
   || (e.ctrlKey && e.keyCode === 68 /* Ctrl+D - Mark page*/)
   || (e.ctrlKey && e.keyCode === 69 /* Ctrl+E - Address bar*/)
   || (e.ctrlKey && e.keyCode === 70 /* Ctrl+F - Find*/)
   || (e.ctrlKey && e.keyCode === 72 /* Ctrl+H - History*/)
   || (e.ctrlKey && e.keyCode === 73 /* Ctrl+I - Page Infos*/)
   || (e.ctrlKey && e.keyCode === 74 /* Ctrl+J - Downloads - Doesn't works
=> F5*/)
   || (e.ctrlKey && e.keyCode === 75 /* Ctrl+K - Address bar - Doesn't
works*/)
   || (e.ctrlKey && e.keyCode === 76 /* Ctrl+L - Address bar*/)
   || (e.ctrlKey && e.keyCode === 78 /* Ctrl+N - New window - Doesn't works
=> F5*/)
   || (e.ctrlKey && e.keyCode === 79 /* Ctrl+O - Open*/)
   || (e.ctrlKey && e.keyCode === 80 /* Ctrl+P - Print*/)
   || (e.ctrlKey && e.keyCode === 83 /* Ctrl+S - Save*/)
   || (e.ctrlKey && e.keyCode === 84 /* Ctrl+T - New Tab - Doesn't works =>
F5*/)
   || (e.ctrlKey && e.keyCode === 85 /* Ctrl+U - View source*/) )
  {
    ctrlPressed = false;
    return;
  }
  if ( e.code == "ControlLeft" || e.code == "ControlRight")
    ctrlPressed = true;
}

function checkKeyUp (e) {

  if ( e.code == "ControlLeft" || e.code == "ControlRight")
    ctrlPressed = false;
}

function scrollto(e){
  if (ctrlPressed)
    return;
  var keyname = String.fromCharCode(e.keyCode);
  var elm = document.getElementsByClassName('clink_'+ keyname)[0];
  if(typeof(elm) != 'undefined' && elm != null) {
    elm.scrollIntoView({behavior: "smooth", block: "center"});
    var mycell = elm.getElementsByTagName('td')[0];
    var mycolor = mycell.style.backgroundColor;
    jQuery($(mycell)).effect('highlight',{color:mycolor}, 1500);
  }
}