$(function(){
	$(".li-rank").mouseover(function(){
		$(".li-rank-bd").hide();
		$(".li-rank-bd", this).show();
	});

	$(".yui3-imagelist-arrow-left").click(function(){
            var width=206;
            var left = parseInt($("#shot-list").css("left").replace("px", ""));
            var index = left/width;
            if(index < 0)
            {
                left = left + width;
                $("#shot-list").animate({left: left + "px"});
                $(".yui3-imagelist-arrow-right").removeClass("yui3-imagelist-arrow-right-disabled");    
            }
            else
            {
                $(".yui3-imagelist-arrow-left").addClass("yui3-imagelist-arrow-left-disabled");
            }
        });
        $(".yui3-imagelist-arrow-right").click(function(){
            var width=206;
            var left = $("#shot-list").css("left").replace("px", "");
            var index = left/width;
            if(index*-1 + 3 < $("#shot-list li").length)
            {
                $("#shot-list").animate({left: (left - width) + "px"});    
                $(".yui3-imagelist-arrow-left").removeClass("yui3-imagelist-arrow-left-disabled");    
            }
            else
            {
                $(".yui3-imagelist-arrow-right").addClass("yui3-imagelist-arrow-right-disabled");
            }
        });
})