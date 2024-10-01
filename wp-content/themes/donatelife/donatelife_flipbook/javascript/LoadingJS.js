var styleCss = "<style>"+
	"@keyframes loadingAnimate{from {-webkit-transform: rotateY(0deg);-o-transform: rotateY(0deg);-ms-transform: rotateY(0deg);-moz-transform: rotateY(0deg);transform: rotateY(0deg);}to {-webkit-transform: rotateY(-180deg);-o-transform: rotateY(-180deg);-ms-transform: rotateY(-180deg);-moz-transform: rotateY(-180deg);transform: rotateY(-180deg);}}"+
	"@-webkit-keyframes loadingAnimate{from {-webkit-transform: rotateY(0deg);-o-transform: rotateY(0deg);-ms-transform: rotateY(0deg);-moz-transform: rotateY(0deg);transform: rotateY(0deg);}to {-webkit-transform: rotateY(-180deg);-o-transform: rotateY(-180deg);-ms-transform: rotateY(-180deg);-moz-transform: rotateY(-180deg);transform: rotateY(-180deg);}}"+
	".loadimgRun{-webkit-animation : loadingAnimate 1.2s infinite;animation : loadingAnimate 1.2s infinite;}</style>";
$("body").append(styleCss);

window.waitForLoading = true;
var LoadingJS = function(){
	this.initConfig();
	this.initHtml();
	this.initCss();
	this.startLoading();
	
	this.onResize();
	var self = this;
	$(window).resize(function(){
		self.onResize();
	});
	
	window.setTimeout(function(){window.waitForLoading = false;},250);
}

LoadingJS.prototype = {
	
	initHtml : function(){
		this.stop = false;
		this.loadImageUrl = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACIAAAA5CAYAAABTVvmaAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTM4IDc5LjE1OTgyNCwgMjAxNi8wOS8xNC0wMTowOTowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NkYyNTY2MEE0RjYxMTFFODkwQkI4RERENUE1RDI2MjkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NkYyNTY2MDk0RjYxMTFFODkwQkI4RERENUE1RDI2MjkiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTcgKFdpbmRvd3MpIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6RDNGQTI1RDc0MjBDMTFFODkxMDFCODA3MjMxREU3M0EiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6RDNGQTI1RDg0MjBDMTFFODkxMDFCODA3MjMxREU3M0EiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz64VA29AAAAe0lEQVR42uyWsQrAIBBDjXTy///1RutYOlk4JW1fQHDzcRdD1IeKgWoxESC2IMflHuO0Te92VgPIJ37NI5dPSqzmNx4RqwEEEDcQ3Vq8NkU8xYiIZzWALAUJyjMeIVkTa0C23lEDArM6d1YmAoh1xIuJAAIIIIAk6hRgADJhGV+Quc5CAAAAAElFTkSuQmCC";
		this.instance = $("<div></div>");
		this.image = $("<img src='" + this.loadingPicture + "'/>");
		this.title = $("<p></p>");
		
		if(this.loadingPicture) this.instance.append(this.image);

		this.initAnimationHtml();

		this.instance.append(this.title);
		$("body").append(this.instance);
	},

	initAnimationHtml : function(){

		this.loadBox = $("<div></div>");
		var img1 = $("<img src='"+this.loadImageUrl+"' />");
		var img2 = $("<img src='"+this.loadImageUrl+"' />");	
		this.img3 = $("<img class='loadimgRun' src='"+this.loadImageUrl+"' />");

		this.img3.on("load" , function(){
			this.changeButtonColor(img1 , this.loadingCaptionColor);
			this.changeButtonColor(img2 , this.loadingCaptionColor);
			this.changeButtonColor(this.img3 , this.loadingCaptionColor);
		}.bind(this));
		 
		this.loadBox.css({
			"position":"relative",
			"perspective":"200px",
			"-webkit-transform-style":"preserve-3d",
			"-o-transform-style":"preserve-3d",
			"-ms-transform-style":"preserve-3d",
			"-moz-transform-style":"preserve-3d",
			"transform-style":"preserve-3d"
		});

		this.img3.css({
			"position" : "absolute" ,
			"right" : "0" ,
			"z-index" : "-1" ,
			"-webkit-transform-origin" : "0 50%",
			"-o-transform-origin" : "0 50%",
			"-ms-transform-origin" : "0 50%",
			"-moz-transform-origin" : "0 50%",
			"transform-origin" : "0 50%"
		});

		img1.css({
			"-webkit-transform":"rotateY(180deg)",
			"-o-transform":"rotateY(180deg)",
			"-ms-transform":"rotateY(180deg)",
			"-moz-transform":"rotateY(180deg)",
			"transform":"rotateY(180deg)"
		});

		this.loadBox.append(img1).append(img2).append(this.img3);
		this.instance.append(this.loadBox);
	},

	initConfig : function(){
		  this.loadingCaption, this.loadingCaptionColor, this.loadingPicture;
		  try{
		  	this.loadingCaption = bookConfig.loadingCaption ? bookConfig.loadingCaption : "Loading";
		  	this.loadingCaptionColor = bookConfig.loadingCaptionColor ? bookConfig.loadingCaptionColor : "#DDDDDD";
		  	this.loadingBackground = bookConfig.loadingBackground ? bookConfig.loadingBackground : "#1F2232";
		  	this.loadingPicture = bookConfig.loadingPicture ? bookConfig.loadingPicture : "";
		  }catch(err){
		  	this.loadingCaption = "Loading";
		  	this.loadingCaptionColor = "#BDBDBD";
		  	this.loadingBackground = "#1F2233";
		  	this.loadingPicture = "";
		  }
	},
	
	startLoading : function(){
		this.title.text($(document).attr("title"));
	},
	
	destroy : function(){
		this.img3.removeClass("loadimgRun");
		$("body>style").html("");
		this.instance.remove();
		this.image.attr("src", "");
		$("body").css({"background-color" : ""});
	},
	
	initCss : function(){

		$("html").css({
			"margin" : 0,
			"padding" : 0,
			"width" : "100%",
			"height" : "100%"
		});
		$("body").css({
			"margin" : 0,
			"padding" : 0,
			"width" : "100%",
			"height" : "100%",
			"position" : "fixed",
			"background-color" : this.loadingBackground
		});
		this.instance.css({
			"width" : "100%",
			"height" : "100%",
			"color" : this.loadingCaptionColor,
			"text-align" : "center",
			"vertical-align" : "middle",
			"font-family" : "Tahoma",
		    "position" : "relative",

		});

		this.image.css({
			"position" : "absolute",
			"top" : "25%",
			"left" : "50%",
			"-webkit-transform" : "translate(-50% , -50%)",
		    "-moz-transform" : "translate(-50% , -50%)",
		    "-ms-transform" : "translate(-50% , -50%)",
		    "-o-transform" : "translate(-50% , -50%)",
			"transform" : "translate(-50% , -50%)",
			"max-width" : "40%",
			"max-height" : "40%"
		});

		this.title.css({
			"font-family":"Arial",
		  	"font-size" : "24px",
		  	"position" : "absolute",
		  	"bottom" : "30%",
		  	"left" : "50%",
		  	"-webkit-transform" : "translateX(-50%)" ,
		    "-moz-transform" : "translateX(-50%)" ,
		    "-ms-transform" : "translateX(-50%)" ,
		    "-o-transform" : "translateX(-50%)" ,
			"transform" : "translateX(-50%)" ,
		  	"margin" : 0,
		  	"padding" : 0
		});

		this.loadBox.css({
			"position" : "absolute",
			"width" : "68px",
			"height" : "57px",
			"left" : "50%",
			"top" : "50%",
			"-webkit-transform" : "translate(-50% , -50%)",
		    "-moz-transform" : "translate(-50% , -50%)",
		    "-ms-transform" : "translate(-50% , -50%)",
		    "-o-transform" : "translate(-50% , -50%)",
			"transform" : "translate(-50% , -50%)",
		  	"padding" : 0
		});

	},
	
	onResize : function(){
		// var windowWidth = $("body").width();
		// var windowHeight = $("body").height();
		// this.initCss();
	},

	changeButtonColor : function(obj , color, isOnLoad, onChangedColor){

		var self = obj;

		if(obj.css("display")=="none")return;
		
		var img = obj;
		if(obj.children().length >0) img = obj.find("img:first");
		
		if(!!window.ActiveXObject){
	        // IE
	        if(img[0].readyState != 'complete'){
	        	$(img).on("load" , function(){
					 try{
						 self.changeButtonColor(color,isOnLoad,onChangedColor);
					 }catch(err){
					 }
				 });
				 return;
	        };
	        
	    }else{
	    	if(!img[0].complete){
	    		$(img).on("load" , function(){
					 try{
						 self.changeButtonColor(color,isOnLoad,onChangedColor);
					 }catch(err){
					 }
				 });
				 return;
	    	};
	    	
	    }
	    
		if(img[0] == undefined) return;
		
		var canvas, ctx;
		try{
			canvas = $("<canvas></canvas>")[0];
			ctx = canvas.getContext("2d");
		}catch(err){
			return;
		}

		var imgWidth = img.width();
		var imgHeight = img.height();
		
		img = img[0];
		
		if(isOnLoad == undefined) isOnLoad = false;
		
		//check src 
		var srcHost = this.getHost(img.src);
		var localHost = this.getHost();
		
		if((!!srcHost) && (localHost !== srcHost)){
			
			var newSrc = img.src.replace(srcHost, localHost);
			
			img.src = newSrc;
			
			if(isOnLoad == false){
				 $(img).on("load" , function(){
					 try{
						 self.changeButtonColor(color,true,onChangedColor);
					 }catch(err){
					 }
				 });
			}
			
			return;
		}

	  canvas.width = imgWidth;
	  canvas.height = imgHeight;

		try{

		  ctx.drawImage(img, 0, 0, img.naturalWidth, img.naturalHeight, 0, 0, imgWidth, imgHeight);
		  
		  var originalPixels = ctx.getImageData(0, 0, imgWidth, imgHeight);
		  
		  var currentPixels = ctx.getImageData(0, 0, imgWidth, imgHeight);
		  
		  //Reset all params to false, then change "image.src"
		  if (img.colorChanged == true) return;
		  
		  if(!originalPixels) return; // Check if image has loaded
		  var newColor = Color(color).split();

		  for(var I = 0, L = originalPixels.data.length; I < L; I += 4){

		  // If it's not a transparent pixel
		  if(currentPixels.data[I + 3] > 0){
		      if(originalPixels.data[I]!=newColor.r) currentPixels.data[I] = originalPixels.data[I] / 255 * newColor.r;
		      if(originalPixels.data[I+1]!=newColor.g) currentPixels.data[I + 1] = originalPixels.data[I + 1] / 255 * newColor.g;
		      if(originalPixels.data[I+2]!=newColor.b) currentPixels.data[I + 2] = originalPixels.data[I + 2] / 255 * newColor.b;
		    }
		  }
		  
		  ctx.putImageData(currentPixels, 0, 0);
		  img.src = canvas.toDataURL("image/png");
		  
		  if(onChangedColor != undefined) onChangedColor(self);
		  img.colorChanged = true;
		}catch(err){
			//if(console.error) console.error(err);
			if(isOnLoad == false){
				 $(img).on("load" , function(){
					 try{
						self.changeButtonColor(color,true,onChangedColor);
					 }catch(err){
					 }
				 });
			}
		}

	},

	getHost : function(url) {
	
	  var host;
	  if(!url){
	    url = window.location.href;
	  }
	  var regex = /(.*\:\/\/)([^\/]*)\/([^\/]*).*/;
	  var match = url.match(regex);
	 
	  if(!!match){
	  	  if(match[2] === "s3.amazonaws.com"){
		
			 host = match[1] + match[2] + "/" + match[3];
		  }else{
		  	 host = match[1] + match[2];
		  }
	  }
	  
	  // Log.print(url + match + "," + host);
	  
	  return host;
	}

}

var jsLoadingBar = new LoadingJS();