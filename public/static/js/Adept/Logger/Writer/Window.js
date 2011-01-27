Adept.Core.namespace('Adept.Logger.Writer');

Adept.Logger.Writer.Window = Class.create(Adept.Logger.Writer,
{
    window: null,

    getWindow: function()
    {
        if (!this.window || this.window.closed) {
            this.window = window.open("Log", null, "width=400,height=200,"
                + "scrollbars=yes,resizable=yes,status=no,"
                + "location=no,menubar=no,toolbar=no");
               this.window.document.write("<html><head><title>Debug Log</title></head><body></body></html>");
        }
        return this.window;
    },
    
    write: function(message, type)
    {
        var document = this.getWindow().document;
        var container = document.createElement('div');
        container.innerHTML = type + ": " + message;
        document.body.appendChild(container);
    },
    
    log: function(message)
    {
        this.write(message, "LOG");
    },
    
    error: function(message)
    {
       this.write(message, "ERROR");
    },
    
    debug: function(message)
    {
        this.write(message, "DEBUG");
    },
    
    warn: function(message)
    {
        this.write(message, "WARNING");
    },
    
    info: function(message)
    {
        this.write(message, "INFO");
    },
    
    fine: function(message)
    {
        this.write(message, "FINE");
    }
    
});
