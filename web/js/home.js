////homeÇÐ»»////
$(document).ready(function(){
	     $(".home-top > div").eq(0).click(function(){
			 for (i=0;i<3;i++)
			 {
					$(".home-top > div").eq(i).attr("class","homeuncheck");
			 		$(".home-down > div").eq(i).attr("class","homeuncheckdisplay");
			 }
			 $(".home-top > div").eq(0).attr("class","homecheck");
			 $(".home-down > div").eq(0).attr("class","homecheckdisplay");
		})
		 $(".home-top > div").eq(1).click(function(){
			 for (i=0;i<3;i++)
			 {
					$(".home-top > div").eq(i).attr("class","homeuncheck");
			 		$(".home-down > div").eq(i).attr("class","homeuncheckdisplay");
			 }
			 $(".home-top > div").eq(1).attr("class","homecheck");
			 $(".home-down > div").eq(1).attr("class","homecheckdisplay");
		})
		 $(".home-top > div").eq(2).click(function(){
			 for (i=0;i<3;i++)
			 {
					$(".home-top > div").eq(i).attr("class","homeuncheck");
			 		$(".home-down > div").eq(i).attr("class","homeuncheckdisplay");
			 }
			 $(".home-top > div").eq(2).attr("class","homecheck");
			 $(".home-down > div").eq(2).attr("class","homecheckdisplay");
		})
	})