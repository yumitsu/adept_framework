var Adept = { }; 

Adept.Core = {

    /**
     * Creates namespace variable in global scope. 
     * Used for ensure that namespace available. 
     */
    namespace: function(name)
    {
        var parts = name.split('.');
        var parent = window;
        for (var i = 0; i < parts.length; i++) {
            if (!parts[i]) {
                continue;    
            }
            if (!parent[parts[i]]) {
                parent[parts[i]] = {};
            }
            parent = parent[parts[i]];
        }
    },
    
    /**
     * @return bool True if value is not 'undefined' and not null.
     */
    isset: function(value)
    {
        return typeof(value) != 'undefined' && value != null;
    },
    
    /**
     * Returns value if value isset or defaultValue otherwise.
     * 
     * @param mixed value 
     * @param mixed defaultValue
     * @return mixed
     */
    defaultValue: function(value, defaultValue) 
    {
        return (this.isset(value)) ? value : defaultValue;
    },
    
    /**
     * Generated unique identifier for object. 
     * Used uniqueID in IE or generates it in other browsers.
     * 
     * @param Object object
     * @return String Result ID.  
     */
    getUniqueId: function(object)
    {
        if(!this.isset(object)){
            throw new Adept.Exception.IllegalArgument('object not defined' + object);
        }
        
        if (!object.uniqueID) {
            object.uniqueID = this.generateId();
        }
        
        return object.uniqueID;
    },
    
    /**
     * @private Internal method. 
     */
    generateId: function()
    {
        return 'uid' + ((new Date()).getTime() + Math.round(Math.random() * 10000));
    },
    
    getPageId: function()
    {
    	var url = window.location.pathname;
    	if(url[url.length -1] != "/"){
    		url += "/";
    	}
    	var pattern = /[^\w]/g;
    	url = url.replace(pattern, '_');
    	return "viewId" + url; 
    },
    
    serialize: function(containerId)
    {
        var result = '';
        
        var inputs = $(containerId).getElementsByTagName('input');
        $A(inputs).each(
            function(input) {
                result += Form.Element.serialize(input) + "&";
            }
        );
        
        var selects = $(containerId).getElementsByTagName('select');
        $A(selects).each(
            function(select) {
                result += Form.Element.serialize(select) + "&";
            }
        );
        
        var textareas = $(containerId).getElementsByTagName('textarea');
        $A(textareas).each(
            function(textarea) {
                result += Form.Element.serialize(textarea) + "&";
            }
        );
        
        return result;
    },
    
    disableSelection: function(element) 
    {
        element = $(element);
        element.style.MozUserSelect = 'none';
        element.style.KhtmlUserSelect = 'none';
        element.unselectable='on';  
        element.onselectstart = function() {
            return false;
        }
    }
    
};

