Adept.Core.namespace('Adept.Controller.DateTime');

Adept.Controller.DateTime.DatePicker = Class.create(Adept.Controller,
{

    calendar: null,

    initialize: function($super, id, dateFormat) 
    {
        $super(id);
        
        this.calendar = new Calendar(1, null, this.onSelect.bind(this), this.onClose.bind(this));
        this.calendar.setDateFormat(dateFormat);
        Adept.Observer.addListener(window, 'load', this.onLoad.bind(this));
          
    },
    onLoad: function()
    {
        this.calendar.create(); 
        
        Adept.Observer.addListener($(this.getElementId() + ':button'), 'click', this.onShow.bind(this));
    
    }, 
    
    onShow: function()
    {
        this.calendar.showAtElement(this.getElement(), 'Bl');
        //this.calendar.show(); 
    },
    
    onSelect: function(calendar, date)
    {
        this.getElement().value = date;
    },
    
    onClose: function(calendar) {
        calendar.hide();
        // or calendar.destroy();
    }
    
});