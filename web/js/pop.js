var popup_dragging = false;
var popup_target;
var popup_mouseX;
var popup_mouseY;
var popup_mouseposX;
var popup_mouseposY;
var popup_oldfunction;
function popup_mousedown(e)
{
  var ie = navigator.appName == "Microsoft Internet Explorer";
  if ( ie  &&  window.event.button != 1) return;
  if (!ie  &&  e.button            != 0) return;
  popup_dragging = true;
  popup_target   = this['target'];
  popup_mouseX   = ie ? window.event.clientX : e.clientX;
  popup_mouseY   = ie ? window.event.clientY : e.clientY;
  if (ie)
       popup_oldfunction = document.onselectstart;
  else popup_oldfunction  = document.onmousedown;
  if (ie)
       document.onselectstart = new Function("return false;");
  else document.onmousedown   = new Function("return false;");
}
function popup_mousemove(e)
{
  if (!popup_dragging) return;
  var ie      = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_target);
  var mouseX = ie ? window.event.clientX : e.clientX;
  var mouseY = ie ? window.event.clientY : e.clientY;
  element.style.left = (element.offsetLeft+mouseX-popup_mouseX)+'px';
  element.style.top  = (element.offsetTop +mouseY-popup_mouseY)+'px';
  popup_mouseX = ie ? window.event.clientX : e.clientX;
  popup_mouseY = ie ? window.event.clientY : e.clientY;
}

function popup_mouseup(e)
{
  if (!popup_dragging) return;
  popup_dragging = false;
  var ie = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_target);
  if (ie)
       document.onselectstart = popup_oldfunction;
  else document.onmousedown   = popup_oldfunction;
}
function popup_exit(e)
{
  var ie = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_target);
  popup_mouseup(e);
  element.style.visibility = 'hidden';
  element.style.display    = 'none';
  elementBack.style.visibility="hidden	";
  elementBack.style.display="none";
}
function popup_show()
{
  element      = document.getElementById('popup');
  drag_element = document.getElementById('popup_drag');
  exit_element = document.getElementById('popup_exit');
  elementBack= document.getElementById("popup_back");
  elementBack.style.visibility="visible";
  elementBack.style.display="block";
  elementBack.style.height= document.body.scrollHeight+"px";
  elementBack.style.width= document.body.scrollWidth+"px";
  element.style.position   = "absolute";
  element.style.visibility = "visible";
  element.style.display    = "block";
    element.style.left = document.body.scrollLeft +400+"px";
    element.style.top  = document.body.scrollTop+100+"px";
  drag_element['target']   = 'popup';
  drag_element.onmousedown = popup_mousedown;
  exit_element.onclick     = popup_exit;
}
function popup_mousepos(e)
{
  var ie = navigator.appName == "Microsoft Internet Explorer";
  popup_mouseposX = ie ? window.event.clientX : e.clientX;
  popup_mouseposY = ie ? window.event.clientY : e.clientY;
}
if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent('onmousedown', popup_mousepos);
else document.addEventListener('mousedown', popup_mousepos, false);
if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent('onmousemove', popup_mousemove);
else document.addEventListener('mousemove', popup_mousemove, false);
if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent('onmouseup', popup_mouseup);
else document.addEventListener('mouseup', popup_mouseup, false);
