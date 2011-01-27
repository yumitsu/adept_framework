Adept.Core.namespace("Adept.Effect");

Adept.Effect.Parallel = Class.create(Adept.Effect.Base,
{
	effects : null,
	
	initialize: function($super)
	{
		$super(null);
		this.effects = new Array();
	},
    add: function(effect)
    {
    	this.effects.push(effect);
    	return this;
    },
	
    go: function()
    {
        return new Effect.Parallel(this.effects, this.options);
    }
    
});

    