Adept.Core.namespace('Adept.Ajax.Command');

Adept.Ajax.Command.Update = Class.create(Adept.Ajax.Command,
{

    execute: function(params)
    {
        Element.update($(params['id']), params['content']);
        
        Adept.Observer.notify(params['id'], 'update');
    },

    undo: function()
    {
    
    }
    
});