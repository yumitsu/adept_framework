Adept.Core.namespace("Adept.Effect");
Adept.Effect.Fade = Class.create(Adept.Effect.Base,
{
    go: function()
    {
        return new Effect.Fade(this.element, this.options);
    }
    
});