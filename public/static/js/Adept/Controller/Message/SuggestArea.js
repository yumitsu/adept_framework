Adept.Core.namespace('Adept.Controller.Message');
/**
 * @event itemSelect
 * @event itemClick
 * @event show
 * @event hide
 */
Adept.Controller.Message.SuggestArea = Class.create(Adept.Controller,
{
	positioned: false,
	suggestedId:null,
	minSize:3,
	delay:500,
	timeoutId:null,
	EVENT_SUGGEST: 'suggest',
	EVENT_ITEM_SELECT: 'itemSelect',
	EVENT_ITEM_CLICK: 'itemClick',
	hidden: true,
	suggestItems: null,
	currentItem:0,
	selectedClass: 'suggest-selected',
	url: null,
	partition: null,
	
	initialize: function($super, id, suggestedId, positioned)
	{
		$super(id);
		this.positioned = positioned;
		this.suggestedId = suggestedId;
		
		this.getSuggested().setAttribute('autocomplete','off');
		
		Adept.Observer.addListener(this.getSuggested(), 'keyup', this.onKeyUp.bindAsEventListener(this));
		Adept.Observer.addListener(this.getSuggested(), 'keydown', this.onKeyDown.bindAsEventListener(this));
		Adept.Observer.addListener(this.getElement(), 'click', this.onMouseClick.bindAsEventListener(this));
		Adept.Observer.addListener(document, 'click', this.hide.bindAsEventListener(this));
		Adept.Observer.addListener(window, 'resize', this.position.bindAsEventListener(this));
		
	},
	
	show: function()
	{
		if(this.hidden){
			this.getElement().show();
			Adept.Observer.notify(this.getElement(), 'show')
		}
	},
	
	
	
	hide: function()
	{
		if(this.hidden){
	        this.getElement().hide();
			Adept.Observer.notify(this.getElement(), 'hide');
		}
	},
	
	position: function()
	{
	   if(this.positioned){
		   var width = this.getElement().style.width;
		   var height = this.getElement().style.height;
		   this.getElement().absolutize();
		   this.getElement().style.width = width;
		   this.getElement().style.height = height;
		   this.getElement().style.zindex = 100;
		   var position = this.getSuggested().cumulativeOffset();
		   this.getElement().style.left = position[0] + 'px';
		   this.getElement().style.top = (position[1] +  this.getSuggested().offsetHeight) +  'px';
	   }
		
	},
	
	onMouseOver: function(event)
	{
		
		var suggestItems = this.getSuggestItems();
        
        if(suggestItems.indexOf(event.element()) >= 0){
            this.goToSuggestion(suggestItems.indexOf(event.element()));  
        }
        
      
	},
	
	onMouseClick: function(event)
	{
		this.selectSuggestion(this.currentItem);
		
	},
	
	goToSuggestion: function(index)
	{
		
		var suggestItems = this.getSuggestItems();
		suggestItems[this.currentItem].removeClassName(this.selectedClass);
		if(index < 0){
			this.currentItem = 0;
		}else {
			if(index > suggestItems.length - 1){
			     this.currentItem = suggestItems.length - 1;
			}else{
				  this.currentItem = index;
			}
		}
		suggestItems[this.currentItem].addClassName(this.selectedClass);
		Adept.Observer.notify(this.getElement(), this.EVENT_ITEM_SELECT, {item:suggestItems[this.currentItem]});
		
		
	},
	
	selectSuggestion: function(index)
	{
		var suggestItems = this.getSuggestItems();
		Adept.Observer.notify(this.getElement(), this.EVENT_ITEM_CLICK, {item:suggestItems[this.currentItem]});
		
		if(!Adept.Core.isset(this.getElement().propListeners) || !Adept.Core.isset(this.getElement().propListeners[this.EVENT_ITEM_CLICK])){
		  this.getSuggested().value = suggestItems[this.currentItem].getAttribute('suggest');
		  this.hide();
		}
		  
		
		
	},
	
	
	onKeyDown: function(event)
	{
		switch(event.keyCode){
			case 38:
				this.goToSuggestion(this.currentItem - 1);
				event.stop();
			break;
			case 40:
				this.goToSuggestion(this.currentItem + 1);
				event.stop();
			break;
			case 13:
				this.selectSuggestion(this.currentItem);
				event.stop();
			break;
			case 27:
			     this.hide();
			     event.stop();
			break;
		    
		}
	
		
	},
	
	
	onKeyUp: function(event)
	{
		var keyCode = event.keyCode;
		var text = this.getSuggested().value;
		clearTimeout(this.timeoutId);
		if(text.length >= this.minSize){
			if((keyCode== 8 || keyCode == 46)){
                this.suggest(text);
            }else{
    
                if( keyCode <32  || (keyCode >= 33 && keyCode <= 46) || ( keyCode >=112 && keyCode <= 123)){
    
                }else{
                   this.suggest(text);
                }
            }
		}
	},
	
	onComplite: function()
	{
		this.suggestItems = null;
        var suggestItems = this.getSuggestItems();
        if(suggestItems.length > 0){
	        this.position();
			this.show();
			oThis = this;
			suggestItems.each(
			  function(item){
			  	Adept.Observer.addListener(item, 'mouseover', oThis.onMouseOver.bindAsEventListener(oThis));
			  	item.removeClassName(oThis.selectedClass);
			  	
			  }
			);
			this.currentItem = 0;
	        this.goToSuggestion(this.currentItem);
        }else{
        	this.hide();
        }

			
	},
	
	
	
	
	suggest:function(text)
	{
		var params = new Object();
		params[this.getSuggestedId()] = text;
		if(Adept.Core.isset(this.getPartition())){
			params['_partition'] = this.getPartition();
		}
		
		
		var oThis = this; 
		this.timeoutId = setTimeout(
		function(){
			var request = Adept.Ajax.Backend.createRequest(params, oThis.getUrl());
			request.addEvent(oThis.getElementId(),oThis.EVENT_SUGGEST);
			request.send();
			request.addCompliteListener(oThis.onComplite.bindAsEventListener(oThis));  
		},
		this.delay);
		
	},
	
	
	getSuggestItems: function()
	{
		if(this.suggestItems == null){
			this.suggestItems = $A(this.getElement().getElementsByClassName('_suggest-item'));
		}
		return this.suggestItems;
	},
	
	
	
	getSuggested: function() 
	{
		 return $(this.suggestedId);
	},
	
	
	getSuggestedId: function() 
	{
		 return this.suggestedId;
	},

	setSuggestedId: function (suggestedId) 
	{
		 this.suggestedId =  suggestedId;
	},
	
	getSelectedClass: function() 
	{
		 return this.selectedClass;
	},

	setSelectedClass: function (selectedClass) 
	{
		 this.selectedClass =  selectedClass;
	},
	
	isHidden: function() 
	{
		 return this.hidden;
	},

	setHidden: function (hidden) 
	{
		 this.hidden =  hidden;
	},
	
	getMinSize: function() 
	{
		 return this.minSize;
	},

	setMinSize: function (minSize) 
	{
		 this.minSize =  minSize;
	},
	
	getDelay: function() 
	{
		 return this.delay;
	},

	setDelay: function (delay) 
	{
		 this.delay =  delay;
	},
	
	getUrl: function() 
	{
    	 return this.url;
	},

	setUrl: function (url) 
	{
		 this.url =  url;
	},
	
	getPartition: function() 
	{
		 return this.partition;
	},

	setPartition: function (partition) 
	{
		 this.partition =  partition;
	}
	
	
});