

Adept.DataBag = {

    defaultNamespace: 'default',
    
    getCookieName:function(namespace, name)
    {
        if (!namespace) {
            namespace = this.defaultNamespace;
        }
        return namespace + "" + name;
    },

    getOptions: function(options)
    {
        options = options || {};
        
        var expires = '';
        
        if (options.expires) {
            if (typeof(options.expires) == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
                options.expires = date.toGMTString();
             } else {
                options.expires = options.expires.toGMTString();
             }
        } else {
            options.expires = -1;
        }
        expires = '; expires= ' + options.expires;
        var path = options.path ? '; path=' + options.path : '; path=/';
        var domain = options.domain ? '; domain=' + options.domain : '';
        var secure = options.secure ? '; secure' : '';
        return [expires, path, domain, secure].join(' ');
    },
    
    // User Api

    save: function(namespace, name, value, options)
    {
        document.cookie = this.getCookieName(namespace, name) + '=' + encodeURIComponent(value) + this.getOptions(options);
    },

    load: function(namespace, name)
    {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i].strip();
                var cookieName = this.getCookieName(namespace, name);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, cookieName.length + 1) == (cookieName + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(cookieName.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    },

    remove: function(namespace, name, options)
    {
        this.save(namespace, name, '', options);
    }

};
