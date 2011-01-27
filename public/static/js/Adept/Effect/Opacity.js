Adept.Core.namespace("Adept.Effect");
Adept.Effect.Opacity = Class.create(Adept.Effect.Base,
{
    go: function()
    {
        return new Effect.Opacity(this.element, this.options);
    }
    
});