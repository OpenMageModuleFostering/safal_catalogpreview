var SafalCatalogPreview = Class.create();
SafalCatalogPreview.prototype = {
  initialize: function(target,options) {
    this.target = target;
    this.top = 0;
    this.left = 0;
    this.xOffset = 20;
    this.yOffset = 20;
    this.init=0;
    this.options = options.evalJSON();
    this.wHeight = document.viewport.getHeight();
	this.wWidth = document.viewport.getWidth();
    this.preview = null;
    this.loader = this.options.animation;
    $$(this.target).each(function(element){
    	Event.observe(element,'mouseover',this.show.bindAsEventListener(this));
    	Event.observe(element,'mouseout',this.hide.bindAsEventListener(this));
    	Event.observe(element,'mousemove',this.move.bindAsEventListener(this));
    }.bind(this));
  },
  show: function(event) {
	  var parentElem = $(Event.element(event)).up('a');
	  if(parentElem){
		  this.rel = parentElem.rel;
		  this.preview = this.prepareHtml(this.rel,parentElem.title,'first');
		  document.body.appendChild(this.preview);
		  this.preview.setStyle({display: 'block'});
	  }
  },
  hide: function(event){
	  if(this.preview != null){
		  this.preview.hide();
	  }
  },
  move: function(event){
	  if(this.preview != null){
		  var viewport = document.viewport.getDimensions();
		  var window_height = viewport.height+20;
		  var window_width = viewport.width+100;
	      var element_height = $(this.preview).getHeight();
	      var element_width = $(this.preview).getWidth();
	      var y_middle = (window_height - element_height + this.yOffset)/2;
	      var x_middle = (window_width - element_width + this.xOffset)/2;
	      var mouse_x = this.mouseX(event);
	      var mouse_y = this.mouseY(event);
	      var rel_mouse_position=Object.extend(document.viewport.getDimensions(),document.viewport.getScrollOffsets());
	      mouse_x-=rel_mouse_position.left;
	      mouse_y-=rel_mouse_position.top;
	      if ( (element_height + mouse_y) >= ( window_height - this.yOffset) ){
            if (element_height+this.yOffset > mouse_y ){                
                mouse_y = y_middle;
                mouse_y = mouse_y - this.yOffset;
            }else{
                mouse_y = mouse_y - element_height;
                mouse_y = mouse_y - this.yOffset;
            }

        } else {
            mouse_y = mouse_y + this.yOffset;
        }

        if ( (element_width + mouse_x) >= ( window_width - this.xOffset) ){ 

            if (element_width +this.xOffset > mouse_x){
                mouse_x = x_middle;
                mouse_x = mouse_x - this.xOffset;
            }else{
                mouse_x = mouse_x - element_width;               
                mouse_x = mouse_x - this.xOffset;
            }
        } else {
            mouse_x = mouse_x + this.xOffset;
        }
		  this.preview.setStyle({
			  top: mouse_y + rel_mouse_position.top + 'px',
			  left: mouse_x + rel_mouse_position.left + 'px'
		  });
	  }
  },
  prepareHtml: function(rel,title,order){
	  if($("preview")){
		  var div = $("preview");
		  div.innerHTML = "";
	  }
	  else{
		  var div = document.createElement('div');
		  div.id = "preview";  
	  }
	  
	  this.loaderImg = document.createElement('div');
	  this.loaderImg.id = "loader";
	  this.loaderImg.className = "loaderclass";
	  
	  var img = document.createElement('img');
	  img.src = rel;
	  img.alt = "loading";
	  Event.observe(img,'load',this.displayAnimation.bindAsEventListener(this));
	  
	  var titlediv = document.createElement('div');
	  if(this.options.show == 1){
		  titlediv.innerHTML = title;
	  }
	  div.appendChild(this.loaderImg);
	  if(this.options.position == 1){
		  div.appendChild(titlediv);
		  div.appendChild(img);
	  }
	  else{
		  div.appendChild(img);
		  div.appendChild(titlediv);
	  }
	  return div;
  },
  mouseX: function(evt) {
      if (!evt) evt = window.event;
      if (evt.pageX) return evt.pageX;
      else if (evt.clientX)
          return evt.clientX + (document.documentElement.scrollLeft ?  document.documentElement.scrollLeft : document.body.scrollLeft);
      else return 0;
  },
  mouseY: function(evt) {
      if (!evt) evt = window.event;
      if (evt.pageY) return evt.pageY;
      else if (evt.clientY)
          return evt.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);
      else return 0;
  },
  displayAnimation: function(event)
  {
	  this.loaderImg.hide();
  }
};