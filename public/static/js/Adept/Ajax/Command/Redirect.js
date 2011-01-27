Adept.Core.namespace('Adept.Ajax.Command');

Adept.Ajax.Command.Redirect = Class.create(Adept.Ajax.Command,
{
    execute: function(params)
    {
        Adept.Assert.isset(params['url']);
        
        window.location.href = params['url'];
    },

    undo: function()
    { }
    
});
