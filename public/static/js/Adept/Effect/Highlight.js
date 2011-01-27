Adept.Core.namespace("Adept.Effect");
Adept.Effect.Highlight = Class.create(Adept.Effect.Base,
{
	startColor: function(color)
	{
	   this.setOption('startcolor', color);
	   return this;	
	},
	
	endColor: function(color)
	{
	   this.setOption('endcolor', color);
       return this;
		
	},
	restoreColor: function(color)
	{
	   this.setOption('restorecolor', color);
       return this;
		
	},
	
	go: function()
	{
		return new Effect.Highlight(this.element, this.options);
	}
	
});