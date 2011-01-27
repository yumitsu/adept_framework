Adept.Core.namespace('Adept');

/**
 * Adept JS Logger object
 */
Adept.Logger = {
    
    writers:[],
    
    addWriter: function(writer)
    {
        this.writers.push(writer);
    },
    
    getWriters: function()
    {
        return this.writers;
    },
    
    log: function(message)
    {
        for (var i = 0; i < this.writers.length; i++) {
            this.writers[i].log(message);
        }
    },
    
    error: function(message)
    {
        for (var i = 0; i < this.writers.length; i++) {
            this.writers[i].error(message);
        }
    },
    
    debug: function(message)
    {
        for (var i = 0; i < this.writers.length; i++) {
            this.writers[i].debug(message);
        }
    },
    
    warn: function(message)
    {
        for (var i = 0; i < this.writers.length; i++) {
            this.writers[i].warn(message);
        }
    },
    
    info: function(message)
    {
        for (var i = 0; i < this.writers.length; i++) {
            this.writers[i].info(message);
        }
    },
    
    fine: function(message)
    {
        for (var i = 0; i < this.writers.length; i++) {
            this.writers[i].fine(message);
        }
    }
    
};
