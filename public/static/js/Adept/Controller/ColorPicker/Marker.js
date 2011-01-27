Adept.Core.namespace('Adept.Controller.ColorPicker');

Adept.Controller.ColorPicker.Marker = Class.create(Adept.Controller,
{
    xValue: 0,
    yValue: 0,
    
    xMinValue: 0,
    xMaxValue: 100,
    yMinValue: 0,
    yMaxValue: 100,
    markerSrc: null,

    // Events
    onValuesChanged: null,

    // Private
    eventMouseMove: null,
    eventMouseUp: null,
    marker: null,

    initialize: function($super, id, markerSrc) 
    {
        $super(id);
        
        this.markerSrc = markerSrc;
        
        this.setPositioningVariables();
        
        this.eventMouseMove = this.onMouseMove.bindAsEventListener(this);
        this.eventMouseUp = this.onMouseUp.bindAsEventListener(this);

        Event.observe(this.getBar(), 'mousedown', this.onMouseDown.bindAsEventListener(this));
        Event.observe(this.getMarker(), 'mousedown', this.onMouseDown.bindAsEventListener(this));
        
        this.setArrowPositionFromValues();
        
        if(this.onValuesChanged) {
            this.onValuesChanged(this);
        }
    },

    setPositioningVariables: function() {
        // calculate sizes and ranges
        // BAR
        var bar = this.getBar();
        
        this._barWidth = bar.getWidth();
        this._barHeight = bar.getHeight();
        
        var pos = bar.cumulativeOffset();
        
        this._barTop = pos.top;
        this._barLeft = pos.left;
        
        this._barBottom = this._barTop + this._barHeight;
        this._barRight = this._barLeft + this._barWidth;

        // ARROW
        this._arrowWidth = this.getMarker().getWidth();
        this._arrowHeight = this.getMarker().getHeight();

        // MIN & MAX
        this.MinX = this._barLeft;
        this.MinY = this._barTop;

        this.MaxX = this._barRight;   
        this.MinY = this._barBottom;
    },  
    
    setArrowPositionFromValues: function(e) {
        this.setPositioningVariables();
        
        // sets the arrow position from XValue and YValue properties

        var arrowOffsetX = 0;
        var arrowOffsetY = 0;
        
        // X Value/Position
        if (this.xMinValue != this.xMaxValue) {

            if (this.xValue == this.xMinValue) {
                arrowOffsetX = 0;
            } else if (this.xValue == this.xMaxValue) {
                arrowOffsetX = this._barWidth - 1;
            } else {

                var xMax = this.xMaxValue;
                if (this.xMinValue < 1)  {
                    xMax = xMax + Math.abs(this.xMinValue) + 1;
                }
                var xValue = this.xValue;

                if (this.xValue < 1) xValue = xValue + 1;

                arrowOffsetX = xValue / xMax * this._barWidth;

                if (parseInt(arrowOffsetX) == (xMax-1)) { 
                    arrowOffsetX = xMax;
                } else { 
                    arrowOffsetX = parseInt(arrowOffsetX);
                }

                // shift back to normal values
                if (this.xMinValue < 1) {
                    arrowOffsetX = arrowOffsetX - Math.abs(this.xMinValue) - 1;
                }
            }
        }
        
        // Y Value/Position
        if (this.yMinValue != this.yMaxValue) {   
            
            if (this.yValue == this.yMinValue) {
                arrowOffsetY = 0;
            } else if (this.yValue == this.yMaxValue) {
                arrowOffsetY = this._barHeight - 1;
            } else {
                var yMax = this.yMaxValue;
                if (this.yMinValue < 1)  {
                    yMax = yMax + Math.abs(this.yMinValue) + 1;
                }

                var yValue = this.yValue;

                if (this.yValue < 1) yValue = yValue + 1;

                var arrowOffsetY = yValue / yMax * this._barHeight;

                if (parseInt(arrowOffsetY) == (yMax-1)) { 
                    arrowOffsetY=yMax;
                } else {
                    arrowOffsetY=parseInt(arrowOffsetY);
                }

                if (this.yMinValue < 1)  {
                    arrowOffsetY = arrowOffsetY - Math.abs(this.yMinValue) - 1;
                }
            }
        }

        this.moveMarker(arrowOffsetX, arrowOffsetY);
    },
    
    moveMarker: function(offsetX, offsetY) 
    {
        // validate
        if (offsetX < 0) {
            offsetX = 0;
        }
        if (offsetX >= this._barWidth) {
            offsetX = this._barWidth - 1;
        }
        if (offsetY < 0) {
            offsetY = 0;
        }
        if (offsetY >= this._barHeight) {
            offsetY = this._barHeight - 1;
        }   

        var posX = this._barLeft + offsetX;
        var posY = this._barTop + offsetY;
        
        // check if the arrow is bigger than the bar area
        if (this._arrowWidth > this._barWidth) {
            posX = posX - (this._arrowWidth / 2 - this._barWidth/2);
        } else {
            posX = posX - parseInt(this._arrowWidth/2);
        }
        
        if (this._arrowHeight > this._barHeight) {
            posY = posY - (this._arrowHeight/2 - this._barHeight/2);
        } else {
            posY = posY - parseInt(this._arrowHeight / 2);
        }

        this.getMarker().style.left = posX + 'px';
        this.getMarker().style.top = posY + 'px';    
    },
     
    setValuesFromMousePosition: function(e) 
    {
        var mouse = Event.pointer(e);
        
        var relativeX = 0;
        var relativeY = 0;
        
        // mouse relative to object's top left
        if (mouse.x < this._barLeft) {
            relativeX = 0;
        } else if (mouse.x > this._barRight) {
            relativeX = this._barWidth;
        } else {
            relativeX = mouse.x - this._barLeft + 1;
        }

        if (mouse.y < this._barTop) {
            relativeY = 0;
        } else if (mouse.y > this._barBottom) {
            relativeY = this._barHeight;
        } else {    
            relativeY = mouse.y - this._barTop + 1;
        }
            
        var newXValue = parseInt(relativeX / this._barWidth * this.xMaxValue);
        var newYValue = parseInt(relativeY / this._barHeight * this.yMaxValue);
        
        // set values
        this.xValue = newXValue;
        this.yValue = newYValue;    

        // position arrow
        if (this.xMaxValue == this.xMinValue) {
            relativeX = 0;
        }
        if (this.yMaxValue == this.yMinValue) {
            relativeY = 0;      
        }
        this.moveMarker(relativeX, relativeY);
        // fire events
        if (this.onValuesChanged) {
            this.onValuesChanged(this);
        }
    },   
    
    
    // Event handlers ---------------------------------------------------------
    
    onMouseDown: function(e) {
       
        //Refresh.Web.ActiveSlider = this;
        
        this.setValuesFromMousePosition(e);
        
        Event.observe(document, 'mousemove', this.eventMouseMove);
        Event.observe(document, 'mouseup', this.eventMouseUp);     

        Event.stop(e);
    },    
    
    onMouseMove: function(e) {
        this.setValuesFromMousePosition(e);
        Event.stop(e);
    },
    
    onMouseUp: function(e) {
        Event.stopObserving(document, 'mouseup', this.eventMouseUp);
        Event.stopObserving(document, 'mousemove', this.eventMouseMove);
        Event.stop(e);
    },
    
    getBar: function()
    {
        return this.getElement();
    },
        
    getMarker: function()
    {
        return $(this.getElementId() + ':marker');
    },
    
    getMarkerSrc: function()
    {
        return this.markerSrc;
    },
    
    setMarkerSrc: function(markerSrc) 
    {
        this.markerSrc = markerSrc;
    }

});