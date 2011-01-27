Adept.Core.namespace("Adept.Effect");

Adept.Effect.Base = Class.create(
{
	element:null,
	options: null,
	
	initialize: function(element)
	{
		this.element = element;
		this.options = new Object();
	},
	
	setOption: function(name, value)
	{
		this.options[name] = value;
	},
	
	getOption: function(name)
	{
		return Adept.Core.isset(this.options[name]) ? this.options[name] : null; 
	},
	
	go: function()
	{
		
	},
	
	// Base options------------------------------------------------------------
	duration: function(duration)
	{
		this.setOption('duration', duration);
		return this;
	},
	
	fps: function(fps)
	{
		this.setOption('fps', fps);
		return this;
	},
	/**
	 * supported
	 * Effect.Transitions.sinoidal (default)
	 *  Effect.Transitions.linear
	 *  Effect.Transitions.reverse
	 *  Effect.Transitions.wobble 
	 *  Effect.Transitions.flicker.
	 * 
	 */
	transition: function(transition)
    {
        this.setOption('transition', transition);
        return this;
    },
    
    from: function(from)
    {
        this.setOption('from', from);
        return this;
    },
    
    to: function(to)
    {
        this.setOption('to', to);
        return this;
    },
    
    sync: function(sync)
    {
        this.setOption('sync', sync);
        return this;
    },
    
    queue: function(queue)
    {
        this.setOption('queue', queue);
        return this;
    },
    
    delay: function(delay)
    {
        this.setOption('delay', delay);
        return this;
    },
    
    direction: function(direction)
    {
        this.setOption('direction', direction);
        return this;
    },
    
    
    // Events-------------------------------------------------------------------
    
    beforeStart: function(listener)
    {
    	this.setOption('beforeStart', listener);
    	return this;
    },
    
    beforeUpdate: function(listener)
    {
        this.setOption('beforeUpdate', listener);
        return this;
    },
    
    afterUpdate: function(listener)
    {
        this.setOption('afterUpdate', listener);
        return this;
    },
    
    afterFinish: function(listener)
    {
        this.setOption('afterFinish', listener);
        return this;
    }     

});