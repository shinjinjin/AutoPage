/**
 * @author Yen Chia Wei
 */
;(function($) {
	jQuery.fn.closebutton = function(settings) {
		var _defaultSettings = {
			show : "X",
			close : function() {},
			lrc:"right"
		};
		var _settings = $.extend(_defaultSettings, settings);

		$(this).css({ "position" : "relative" });

		$(this).append("<span class=\"closebutton\"><a href=\"javascript:void(0);\">"+_settings.show+"</a></span>");
		
		$(".closebutton").css({ "position" : "absolute"	});
		$(".closebutton a").css({"color" : "red"});
		$(".closebutton a").css({"text-decoration" : "none"	});
		$(".closebutton").css({	"top" : "-3px"	});
		
		
		if(_defaultSettings.lrc=="left"){
			$(".closebutton").css({	"left" : "0px"	});
		}
		else{
			$(".closebutton").css({	"right" : "0px"	});
		}
		$(".closebutton").hide();
		$(this).mouseover(function() {
			$(this).children(".closebutton").show();
		});
		$(this).mouseout(function() {
			$(this).children(".closebutton").hide();
		});

		$(this).children(".closebutton").click(function() {
			_settings.close($(this).parent());
		});

	}
})(jQuery); 