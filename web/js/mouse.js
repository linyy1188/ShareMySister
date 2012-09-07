function QuestImgDown()
{
	document.getElementById("sub1").style.backgroundImage="url(images/quest2.png)";
}
function QuestImgUp()
{
	document.getElementById("sub1").style.backgroundImage="url(images/quest.png)";
}
function  rad(y)
{
		var r,x,a;
		r=document.getElementsByName('zt');
		a="lab";
		for (x=0; x<r.length ;x++)
		{
			document.getElementById(a+x).className="unsel";			
			r.item(x).checked= false;
			if (y==x)
			{
			document.getElementById(a+x).className="sel";	
			r.item(x).checked= true;
			}	
		}
}
