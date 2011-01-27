Adept.Core.namespace("Adept.Effect");
Adept.Effect.Scale = Class.create(Adept.Effect.Base,
{
	_percent:null,
	
	percent: function(percent)
	{
		this._percent = percent;
		return this;
	},
	
	
    scaleX :function(scaleX)
    {
    	this.setOption('scaleX', scaleX);
    	return this;
    },
    
    scaleY :function(scaleY)
    {
        this.setOption('scaleY', scaleY);
        return this;
    },
    
    scaleContent :function(scaleContent)
    {
        this.setOption('scaleContent', scaleContent);
        return this;
    },
    
    scaleFromCenter :function(scaleFromCenter)
    {
        this.setOption('scaleFromCenter', scaleFromCenter);
        return this;
    },
    
    scaleMode :function(scaleMode)
    {
        this.setOption('scaleMode', scaleMode);
        return this;
    },
      
    go: function()
    {
        return new Effect.Scale(this.element, this._percent, this.options);
    }
    
});