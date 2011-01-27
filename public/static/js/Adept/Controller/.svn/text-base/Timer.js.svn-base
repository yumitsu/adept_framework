Adept.Core.namespace("Adept.Controller");

Adept.Controller.Timer = Class.create(Adept.Controller,
{
    executer: null,
    partition: null,
    initialize: function($super, id, interval, partition) 
    {
        this.id = id;
        this.partition = partition;  
        this.executer = new PeriodicalExecuter(this.onTimer.bind(this), interval);       
    },
    
    onTimer: function()
    {
        params = {};
        if(Adept.Core.isset(this.partition)){
            params['_partition'] = this.partition;
        }
        var request = Adept.Ajax.Backend.createRequest(params);
        request.addEvent(this.id, 'timer');
        request.setBusyState(request.IDLE);
        request.send();
    }

});