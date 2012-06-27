/**
 * RememberIt Javascript Framework
 * This file contains all the functions that handles 
 * the application CRUD processes through AJAX requests
 * while rendering the outpout in JSON
 * 
 * @author Eng. Mohammed Yehia Abdul Mottalib
 * @license Free
 * @company Dahab TEchnology 2011 - Copyrights reserved
 */


/******************
 * -Popup Script- *
 ******************/

$(function() {
	
	/**
	 * Setting the Following Variables:
	 *    + windowWidth 		: The browser's window width
	 *    + windowHeight 		: The browser's window height
	 *    + initialWidth 		: The .window div initial width
	 *    + initialHeight 		: The .window div initial height
	 *    + initialPositionTop 	: The .window div initial top position
	 *    + initialPositionLeft : The .window div initial left position
	 *    + finalWidth 			: The .window div final width
	 *    + finalHeight 		: The .window div final height
	 *    + finalPositionTop 	: The .window div final top position
	 *    + finalPositionLeft 	: The .window div final left position
	 */
	
	var windowWidth 			= $(window).width();
	var windowHeight 			= $(window).height();
	
	var initialWidth			= 50;
	var initialHeight			= 50;
	var initialPositionTop		= (windowHeight / 2) - initialHeight;
	var initialPositionLeft		= (windowWidth / 2) - initialWidth;
	
	var finalWidth				= windowWidth * 0.9 - 40;
	var finalHeight				= windowHeight * 0.9 - 40;
	var finalPositionTop		= initialPositionTop - ((finalHeight-50)/2);
	var finalPositionLeft		= initialPositionLeft - ((finalWidth-50)/2);
	
	var overlayStatus			= false;
	var divToOpen				= null;
	
	$(".rItem").click(function(e) {
		divToOpen = $(this).attr("id");
		if(!overlayStatus) {
			openOverlay();
		}
		e.preventDefault();
    });
	
	function openOverlay() {
		overlayStatus = true;
		$("#overlay").show();
		$("#overlay").fadeTo("normal", 0.6,openWindow);
	}
	
	function hideOverlay() {
		$(".window").hide();
		$("#overlay").fadeTo("normal", 0.0, function(){
			$("#overlay").hide();
			overlayStatus = false;	
		});
	}
	
	function openWindow() {
		$(".window").show();
		$(".window").css("top", initialPositionTop);
		$(".window").css("left", initialPositionLeft);
		$(".window").css("width", initialWidth);
		$(".window").css("height", initialHeight);
		$(".window").animate({width:finalWidth, left:finalPositionLeft}, "normal");
		$(".window").animate({height:finalHeight, top:finalPositionTop}, "normal", "linear", getContent);
	}
	
	function getContent() {
		$("#r" + divToOpen).show();
		$(".closepopup").show();
		$(".closepopup").css("left", windowWidth * 0.94);
		$(".closepopup").click(function(e) {
			$("#r" + divToOpen).hide();
			$(".closepopup").hide();
			$(".window").animate({height:initialHeight, top:initialPositionTop}, "normal");
			$(".window").animate({width:initialWidth, left:initialPositionLeft}, "normal", "linear", hideOverlay);
			e.preventDefault();
		});
	}
});

