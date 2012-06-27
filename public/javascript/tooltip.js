// Faded Tooltip
// Coded by Eng. Mohammed Yehia Abdul Mottalib
// Developed for free use | feel free to use it any where in your site
// Developed in 3rd June 2010
// Copyrights 2010 | Dahab TEchnology | http://www.dahabtech.com
// Happy use, Mohammed

menuTib = {
	
	init: function(){
		
		menuTib.wrraper = document.getElementsByTagName("body")[0];
		menuTib.links = Core.getElementsByClass('dttooltip');
		menuTib._tip = null;
		menuTib._position = null;
		
		for( var i = 0, ii = menuTib.links.length; i<ii; i++ ) {
			var title = menuTib.links[i].getAttribute('title');
			if(title && title.length > 0) {
				menuTib.links[i]._title = menuTib.links[i].getAttribute('title');
				menuTib.links[i].removeAttribute('title');
				//tip.links[i].style.cursor = 'help';
				Core.addEventListener(menuTib.links[i], 'mouseover', menuTib.show);
				Core.addEventListener(menuTib.links[i], 'mouseout', menuTib.hide);
			}
		}
		
		menuTib.hide();
		Core.addEventListener(document, 'mousemove', menuTib.getMouse);		
	},
	
	show: function(event) {
		
		var color = null;
		
		if(Core.hasClass(this, "menuItem")) {
			color = Core.getComputedStyle(this, "backgroundColor");
		} else {
			color = Core.getComputedStyle(this, "color");
		}
		 
		var text = document.createTextNode(this._title);
		var theTip = document.createElement('div');
		
		theTip.appendChild(text);
		theTip.className = 'tooltipcss';
		theTip.style.backgroundColor = color;
		
		menuTib.wrraper.appendChild(theTip);
		
		menuTib._tip = theTip;
		menuTib._position = this.offsetTop;
		
	},
	
	hide: function() {
		
		if(menuTib._tip != null) {
			menuTib.wrraper.removeChild(menuTib._tip);
			menuTib._tip = null;
			menuTib._position = null;
		}
	},
	
	getMouse: function(event) {
		
		var x,y,mx,my;
	
		if(menuTib._tip != null) {

			y = window.scrollY;
			x = window.scrollX;
			
			if (document.all) {
				y = document.documentElement.scrollTop || 0;
				x = document.documentElement.scrollLeft || 0;
			}
			
			mx = event.clientX;
			my = event.clientY;
			
			menuTib.x = x + mx + 20;
			menuTib.y = y + my + 20;
			
			var t = y + Core.getHeight(window);
			
			if((t - menuTib._position) <= 80) {
				menuTib.y = y + my - 20;
			}
			
			menuTib._tip.style.top = menuTib.y + 'px';
			menuTib._tip.style.left = menuTib.x + 'px';
		}
	}
};

Core.start(menuTib);