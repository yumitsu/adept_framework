
Adept.Core.namespace('Adept.Ajax.Command');

Adept.Ajax.Command.Append = Class.create( Adept.Ajax.Command,
{
	execute: function(params)
    {
       var  id = Adept.Core.generateId();
       var container = new Element('div', {'id':id}).update(params['content']);      	
       $(params['parentId']).appendChild(container);
       Adept.Observer.notify(params['parentId'], 'append');
    },

    undo: function()
    { }
});