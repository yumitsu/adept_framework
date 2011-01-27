Adept.Core.namespace("Adept.Effect");
Adept.Effect.Move = Class.create(Adept.Effect.Base,
{
    x: function(x)
    {
    	this.setOption('x', x);
    	return this;
    },
    
    y: function(y)
    {
    	this.setOption('y', y);
    	return this;
    },
    
    mode: function(mode)
    {
    	this.setOption('mode', mode);
    	return this;
    },
    
    
    go: function()
    {
        return new Effect.Move(this.element, this.options);
    }
    
});