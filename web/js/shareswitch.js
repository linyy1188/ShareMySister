////3waysÇÐ»»////
$(document).ready(function(){
	     $(".share-4-top > div").eq(0).mouseover(function(){
			 for (i=0;i<3;i++)
			 {
					$(".share-4-top > div").eq(i).attr("class","shareuncheck");
			 		$(".share-4-down > div").eq(i).attr("class","shareuncheckdisplay");
			 }
			 $(".share-4-top > div").eq(0).attr("class","sharecheck");
			 $(".share-4-down > div").eq(0).attr("class","sharecheckdisplay");
		})
		 $(".share-4-top > div").eq(1).mouseover(function(){
			 for (i=0;i<3;i++)
			 {
					$(".share-4-top > div").eq(i).attr("class","shareuncheck");
			 		$(".share-4-down > div").eq(i).attr("class","shareuncheckdisplay");
			 }
			 $(".share-4-top > div").eq(1).attr("class","sharecheck");
			 $(".share-4-down > div").eq(1).attr("class","sharecheckdisplay");
		})
		 $(".share-4-top > div").eq(2).mouseover(function(){
			 for (i=0;i<3;i++)
			 {
					$(".share-4-top > div").eq(i).attr("class","shareuncheck");
			 		$(".share-4-down > div").eq(i).attr("class","shareuncheckdisplay");
			 }
			 $(".share-4-top > div").eq(2).attr("class","sharecheck");
			 $(".share-4-down > div").eq(2).attr("class","sharecheckdisplay");
		})
	})