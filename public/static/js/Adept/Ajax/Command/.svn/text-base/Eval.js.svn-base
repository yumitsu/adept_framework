Adept.Core.namespace('Adept.Ajax.Command');

Adept.Ajax.Command.Eval = Class.create(Adept.Ajax.Command,
{
    execute: function(params)
    {
        Adept.Assert.isset(params['expression']);
        eval(params['expression']);
    },

    undo: function()
    { }
    
});