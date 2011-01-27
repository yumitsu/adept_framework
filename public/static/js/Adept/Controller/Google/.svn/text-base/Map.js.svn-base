Adept.Core.namespace('Adept.Controller.Google');
/**
 * Google map Controller
 
 */
 
Adept.Controller.Google.Map = Class.create(Adept.Controller,
{
	mapProvider: null,
	typeControl:null,
	markers: null,
	
	hiddenInput: null,
	
	
	initialize:function($super, id,latitude,longitude, zoom)
	{
		$super(id);
		this.markers = new Hash();
		this.mapProvider = new GMap2(this.getElement());
        this.mapProvider.setCenter(new GLatLng(latitude, longitude), zoom);
	},
	
	synchronizeWithServer: function()
	{
		this.serialize();
		var params = {};
		params[this.getElementId() + '_data'] = this.getHiddenInput().value
		var request = Adept.Ajax.Backend.createRequest(params);
		request.send();
	},
	
	fillFromServer: function(data)
	{
		var markerIndex = this.markers.keys();
		$H(data).each(
            function(item){
            	if(Adept.Core.isset(this.markers.get(item[0]))){
            		this.markers.get(item[0]).fillFromServer(item[1]);
            	}else{
            		var marker = new Adept.Controller.Map.GoogleMarker(item[0], this,item[1].latitude, item[1].longitude);
            		marker.setDraggable(item[1].draggable);
            	}
            	markerIndex = markerIndex.without(item[0]);
                
            }.bind(this)
        );
        
        markerIndex.each(
            function(item){
            	this.mapProvider.removeOverlay(this.markers.get(item).markerProvider);
            }.bind(this)
        );
		
	},
	
	serialize: function()
	{
		markersArray = new Hash();
        this.markers.each(
            function(item){
            	markersArray.set(item[0], item[1].toHash());
            }
        );
        
        this.getHiddenInput().value = markersArray.toJSON();
         
          
	},
	
	getHiddenInput: function()
	{
		if(this.hiddenInput == null){
			
			this.hiddenInput = document.createElement('INPUT');
			this.hiddenInput.type = 'hidden';
			this.hiddenInput.id =  this.getElementId() + '_data';
			this.getElement().appendChild(this.hiddenInput);
			
		}
		
		return this.hiddenInput;
	},
	
	
	
	
	addMarker: function(marker)
	{
		this.markers.set(marker.id, marker);
		this.mapProvider.addOverlay(marker.markerProvider);
	},
	
	getMarkers: function()
	{
		return this.markers;
	},
	
	isScrollingZoom: function() 
	{
		 return this.mapProvider.scrollWheelZoomEnabled();
	},

	setScrollingZoom: function (scrolling) 
	{
		if(scrolling){
			this.mapProvider.enableScrollWheelZoom();
		}else{
			this.mapProvider.disableScrollWheelZoom();
		}
		
	},
	
	setPoint:function(latitude,longitude)
	{
		this.mapProvider.panTo(new GLatLng(latitude,longitude));
	},
	
	getZoom: function() 
	{
		 return this.name2;
	},

	setZoom: function (name2) 
	{
		 this.name2 =  name2;
	},
	
	isDraggable: function() 
	{
		 return this.mapProvider.draggingEnabled();
	},

	setDraggable: function (draggable) 
	{
		if(draggable){
			this.mapProvider.enableDragging();
		}else{
			this.mapProvider.disableDragging();
		}
	},
	
	getType: function() 
	{
		 return this.mapProvider.getCurrentMapType();
	},

	setType: function (type) 
	{
	    this.mapProvider.setMapType(type);
	},
	
	getMapControl: function() 
	{
		 return this.name2;
	},

	setMapControl: function (control) 
	{
		 switch (control) {
		 	case 'small':
		 		this.mapProvider.addControl(new GSmallMapControl());
		 		break;
	 		case 'large':
                this.mapProvider.addControl(new GLargeMapControl());
            break;

		 	default:
		 	    throw 'Unsupported map control type';
		 		break;
		 }

	},
	
	isTypeControl: function() 
	{
		 return this.typeControl;
	},

	setTypeControl: function (typeControl) 
	{
		
		 this.typeControl =  typeControl;
		 if (typeControl) {
		 	 this.mapProvider.addControl(new GMapTypeControl());
		 } else {
//		 	this.mapProvider.removeControl(control)
         }

		 
	}
	
	
	
	
	
	

});
