Adept.Core.namespace('Adept.Ajax.Command');

Adept.Ajax.Command.Alert = Class.create( Adept.Ajax.Command,
{
    execute: function(params)
    {
        Adept.Assert.isset(params['message']);
        
        alert(params['message']);
    },

    undo: function()
    { }
    
});
