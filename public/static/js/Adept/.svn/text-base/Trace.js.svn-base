Adept.Core.namespace("Adept");
// Not complited
Adept.Trace = 
{
    getStackTrace: function(startingPoint)
    {
        var nextCaller;
        if(Adept.Core.isset(startingPoint)){
            nextCaller = startingPoint;    
        }else{
            nextCaller = this.getStackTrace;
        }
         
        var stackTrace = new Array();
        
        while(nextCaller) { 
                stackTrace.push(this.getSignature(nextCaller)); 
                nextCaller = nextCaller.caller; 
        }
        return stackTrace;
    },

    getSignature: function(func)
    {
        var signature = this.getFunctionName(func);
        signature += "(";
        for(var x=0; x<func.arguments.length; x++)
        {
            // trim long arguments
            var nextArgument = func.arguments[x];
            if(nextArgument.length > 30)
                nextArgument = nextArgument.substring(0, 30) + "...";
            
            // apend the next argument to the signature
            signature += "'" + nextArgument + "'"; 
            
            // comma seperator
            if(x < func.arguments.length - 1)
                signature += ", ";
        }
        signature += ")";
        return signature;
    },
    
    getFunctionName: function(func)
    {
        // mozilla makes it easy. I love mozilla.
        if(func.name)
        {
            return func.name;
        }
        
        // try to parse the function name from the defintion
        var definition = func.toString();
        var name = definition.substring(definition.indexOf('function') + 8,definition.indexOf('('));
        if(name)
            return name;

        // sometimes there won't be a function name 
        // like for dynamic functions
        return "anonymous";
    }
        
}
