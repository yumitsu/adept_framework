Adept.Core.namespace('Adept.Controller');

Adept.Controller.ColorPicker = Class.create(Adept.Controller,
{
    
    _map: null,
    _bar: null,
    colorMode: 'h',
    
    valueControl: null,

    initialize: function($super, id) 
    {
        $super(id);
     
        Event.observe(window, 'load', this.onLoad.bind(this));
        
        // attach color slider
        
    },
    
    onLoad: function()
    {
        //this.getMapL2().setOpacity(0.5);
        
        this.valueControl = new Adept.Controller.ColorPicker.ValueControl(this.getElementId());
        this.valueControl.onValuesChanged = this.valueChanged.bind(this);
        
        // attach map slider
        this._map = new Adept.Controller.ColorPicker.Marker(this.getElementId() + ':colorMap:l2', '/static/img/Adept/ColorPicker/mappoint.gif');
        this._map.xMaxValue = 100;
        this._map.yMaxValue = 100;
        
        this._map.onValuesChanged = this.mapValueChanged.bind(this);
        
        this._bar = new Adept.Controller.ColorPicker.Marker(this.getElementId() + ':colorBar', '/static/img/Adept/ColorPicker/rangearrows.gif');
        this._bar.xMinValue = 10;
        this._bar.xMaxValue = 10;
        this._bar.yMaxValue = 360;
        
        this._bar.onValuesChanged = this.barValueChanged.bind(this);
        
        Event.observe(this.getElementId() + ':chooseBtn', 'click', this.select.bind(this));
        
        Event.observe(this.getElementId() + ':button', 'click', this.show.bind(this));
        
        this.updateControls();        
    },
    
    show: function(event) 
    {
        
        var pos = this.getElement().cumulativeOffset();
        //
        this.getContainer().style.top = pos.top + this.getElement().getHeight() + 'px';
        this.getContainer().style.left = pos.left + 'px';
        this.getContainer().show();

        this._map.getMarker().show();
        this._bar.getMarker().show();
        
        this._map.setPositioningVariables();
        
        this.valueControl.color.setHex(this.getElement().value);
        this.updateMarkers();
        this.updateControls();
        Adept.Observer.notify(this.getElement(), 'show');
    },
    
    select: function(event)
    {
    	var previousValue = this.getElement().value; 
        this.getElement().value = this.valueControl.color.getHex();
        this.getContainer().hide();
        

        this._map.getMarker().hide();
        this._bar.getMarker().hide();
        if(previousValue != this.getElement().value){
            Adept.Observer.notifyDomListeners(this.getElement(), 'change');
        }
          Adept.Observer.notifyDomListeners(this.getElement(), 'select');
        
        
    },
    
    valueChanged: function(event) 
    {
        this.updateMarkers();
        this.updateControls();
    },
    
    mapValueChanged: function(event) 
    {
        switch(this.colorMode) {
            case 'h':
		        var h = this.valueControl.color.h;
		        var s = this._map.xValue;
		        var v = 100 - this._map.yValue;
		        
		        this.valueControl.updateFromHsv(h, s, v);
                break;
        }
        this.updateControls();
    },
    
    barValueChanged: function() {
        switch(this.colorMode) {
            case 'h':
                var h = 360 - this._bar.yValue;
                var s = this.valueControl.color.s;
                var v = this.valueControl.color.v;
                this.valueControl.updateFromHsv(h, s, v);
                break;
        }
        this.updateControls();
    },
    
    updateMarkers: function() {
    
        var color = this.valueControl.color;
        
        // Slider
        var barValue = 0;
        
        switch(this.colorMode) {
            case 'h':
                barValue = 360 - color.h;
                break;
        }   
        
        this._bar.yValue = barValue;
        this._bar.setArrowPositionFromValues();

        // color map
        var mapXValue = 0;
        var mapYValue = 0;
        
        switch(this.colorMode) {
            case 'h':
                mapXValue = color.s;
                mapYValue = 100 - color.v;
                break;
        }
        this._map.xValue = mapXValue;
        this._map.yValue = mapYValue;
        this._map.setArrowPositionFromValues();
    },
    
    updateControls: function()
    {
        this.updatePreview();
        this.updateMap();
        this.updateBar();
    },
    
    updatePreview: function() 
    {
        try {
            this.getPreview().style.backgroundColor = '#' + this.valueControl.color.hex;
        } catch (e) {
        }
    },
    
    updateMap: function() 
    {
        var color = this.valueControl.color;
        
        switch(this.colorMode) {
            case 'h':
                // fake color with only hue
                var newColor = new Adept.Color();
                newColor.setHsv(color.h, 100, 100);          
                this.getMapL1().style.backgroundColor = '#' + newColor.getHex();
                break;
        }
    },
        
    updateBar: function()
    {
    },      

    getContainer: function()
    {
        return $(this.id + ':container');
    },
    
    getPreview: function()
    {
        return $(this.id + ':preview');
    },

    getBar: function()
    {
        return $(this.id +':bar');
    },

    getMapL1: function() 
    {
        return $(this.id + ':colorMap:l1');
    },
    
    getMapL2: function() 
    {
        return $(this.id + ':colorMap:l2');
    }

});

