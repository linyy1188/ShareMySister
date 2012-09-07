//////////////////////show//////////////////
$(document).ready(function(){
	$(".search-selected").mouseover(function(){
		$(".search-select").slideDown(10);
		$(".search-select").mouseover(function(){
			$(".search-select").stop();
			})
		
		})
		//////////消失/////////
			
	$("li.search-select-item").click(function(){
		$(".search-select").slideUp(10);
		})
		
	$(".search-selected").mouseout(function(){
		$(".search-select").slideUp(10);
		})
		
	$(".search-select").mouseout(function(){
		$(".search-select").slideUp(10);
			})		
})


/////////////////鼠标滑过选项////////////////
function changecolor(x)
{
		$("li.search-select-item:eq(" + x + ")").css("color","#1b73b7");
}
function changecolorback()
{
		var i;
		for (i=0;i<6;i++)
		$("li.search-select-item:eq(" + i + ")").css("color","#000");
}

////////////////选择///////////////////
function searchselectchoose(i)
{
	var x;
	x=$("li.search-select-item:eq(" + i + ")").html();
					$(".search-selected").html(x);
	}
