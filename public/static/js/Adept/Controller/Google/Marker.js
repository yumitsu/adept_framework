Adept.Core.namespace('Adept.Controller.Google');
/**
 * Google map Controller
 
 */
 
Adept.Controller.Google.Marker = Class.create(Adept.Controller,
{
    markerProvider: null,
    map:null,
    options : {
         latitude: 52,
         longitude: 52,
         draggable: true, 
         iconImage: null,
         transparentImage: null, 
         windowContent: null,
         removable: true
         
    },
    initialize:function($super, id, map, options)
    {
//        $super(id);
        this.id = id;
        this.map = map;
        Object.extend(this.options, options);
        //@todo fix draggable option
        var params = {draggable: this.options.draggable};
        if(Adept.Core.isset(this.options.iconImage)) {
	        var icon = new GIcon();
	        icon.image = this.options.iconImage;
	        icon.iconSize = new GSize(20, 20);
	        icon.iconAnchor = new GPoint(10,20);
	        icon.infoWindowAnchor = new GPoint(10, 2);
	        icon.transparent = this.options.transparentImage;
	        icon.imageMap = [0,0, 19,0, 19,19, 0,19];
	        params['icon'] = icon;
        }
        this.markerProvider =  new GMarker(new GLatLng(this.options.latitude, this.options.longitude),
            params);
        
        if(this.options.windowContent) {
            this.markerProvider.bindInfoWindowHtml(this.options.windowContent);
        }
        if (this.options.removable) {
            GEvent.addListener(this.markerProvider, "dblclick", this.remove.bindAsEventListener(this));
        }

        this.map.addMarker(this);
         GEvent.addListener(this.markerProvider, "dragend", function() {
            this.map.mapProvider.panTo(this.markerProvider.getPoint());
            
          }.bind(this));
        
        
    },
    
    remove: function() 
    {
        if (confirm('Удалить?')) {
            this.map.mapProvider.removeOverlay(this.markerProvider);
        }
        
        
    },
    fillFromServer: function(data)
    {
        this.markerProvider.setLatLng(new GLatLng(data.latitude, data.longitude));
        this.setDraggable(data.draggable);
        
    },
    
    toHash: function()
    {
        var hash = new Object();
        var point = this.markerProvider.getPoint();
        hash['latitude'] = point.lat();
        hash['longitude'] = point.lng();
        hash['id'] = this.id;
        hash['draggable'] = this.isDraggable();
        return hash; 
    },
    
    isDraggable: function() 
    {
         return this.markerProvider.draggingEnabled();
    },

    setDraggable: function (draggable) 
    {
         if (draggable) {
            this.markerProvider.enableDragging();
         } else {
            this.markerProvider.disableDragging();
         }

    },
    
    hide: function()
    {
       this.markerProvider.hide();
    },
    
    show: function()
    {
       this.markerProvider.show();
    },
      
    isHidden: function()
    {
       this.markerProvider.isHidden();  
    }
        
    
});
