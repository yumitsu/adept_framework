Adept.Core.namespace("Adept.Effect");
Adept.Effect.Appear = Class.create(Adept.Effect.Base,
{
    go: function()
    {
        return new Effect.Appear(this.element, this.options);
    }
    
});