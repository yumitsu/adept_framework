Adept.Core.namespace('Adept.Ajax');
/**
 * Execute server command 
 * For internal use
 */
Adept.Ajax.Processor = {

    processResponse: function(response)
    {
        var commands = this.extractCommands(response);
        for(var i = 0; i < commands.length; i++) {
            var commandClass = commands[i]['commandType'];
            eval('command = new ' +  commandClass + '()');
            command.execute(commands[i]['params']);
        }
    },
    
    extractCommands: function(response)
    { 
        var start = '\<\<COMMANDS\>\>';
        var end = '\<\<END_OF_COMMANDS\>\>';
        var result = [];
        response.scan(new RegExp(start + '(.*?)' + end, 'im'), 
            function(item) { 
                var commands = item[1].evalJSON();
                commands.each(function(command) { result.push(command); } ); 
            });
        return result;
    }
    
};

