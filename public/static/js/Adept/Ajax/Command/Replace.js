
Adept.Core.namespace('Adept.Ajax.Command');

Adept.Ajax.Command.Replace = Class.create(Adept.Ajax.Command,
{
    execute: function(params)
    {
        Adept.Assert.isset(params['id']);
        Adept.Assert.isset(params['content']);
        Adept.Assert.elementExists(params['id']);
        
        Element.replace($(params['id']), params['content']);
        Adept.Observer.notify(params['id'], 'replace');
    },

    undo: function()
    { }
    
});
