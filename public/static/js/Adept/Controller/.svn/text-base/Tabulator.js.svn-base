Adept.Core.namespace("Adept.Controller");

Adept.Controller.Tabulator = Class.create(Adept.Controller,
{
    
    items: null,
    classPrefix: 'a',
    active: null,
    
    
    initialize: function($super,id, classPrefix){
    	$super(id);
        
        this.items = new Array();
        if (Adept.Core.isset(classPrefix)) {
            this.classPrefix = classPrefix;
        }
    },
    
    toggle:function(item){
        this.active.hide();
        item.show();
        this.active = item;
    },
    
    addItem: function(id, loaded, forceUpdate) {
        var item = new Adept.Controller.TabItem(id, this, loaded, forceUpdate);
        this.items.push(item);
        
        item.hide();
        if (this.active == null) {
            this.active = item;
        }
    },
    
    onMouseOver: function(e, item) {
        var classes = item.className.split(' ');
        classes.push(this.classPrefix + '-tabselector-hov');
        item.className = classes.join(' ');
    },
    
    onMouseOut: function(e, item) {
    },
    
    activate: function(currentItemIndex) {
        if (currentItemIndex && currentItemIndex != '') {
            this.items[currentItemIndex].show();
            this.active = this.items[currentItemIndex];
        } else {
            this.active.show();
        }
    },

    getActiveItem: function()
    {
        return this.active;
    },
    
    getCssPrefix: function()
    {
    	return this.classPrefix;
    	
    }
}); 

