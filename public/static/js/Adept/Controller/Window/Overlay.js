Adept.Core.namespace("Adept.Controller.Window");
Adept.Controller.Window.Overlay = 
{
	
	show: function(container)
    {
        if(!$('overlay')){
          var overlay = document.createElement('div');
          overlay.className= 'a-overlay';
          overlay.id = 'overlay';
          document.body.appendChild(overlay);
        }
        $('overlay').style.display = 'block';
        this.calcSize();
//      fucking IE bug with tag Select
        container = $(container);
         if(Prototype.Browser.IE && container){
            this.hideSelects(container);
         }
        
    },  
    
    calcSize: function()
    {
    	var pageSize = Adept.Controller.Window.Utils.getPageSize();
        $('overlay').style.height = pageSize.pageHeight + 'px';
        $('overlay').style.width = pageSize.pageWidth + 'px'; 
    },
    hide: function(container)
    {
        
        if($('overlay')){
          $('overlay').style.display = 'none';
        }
        //        fucking IE bug with tag Select
        container = $(container);
        if(Prototype.Browser.IE && container){
            this.showSelects(container );
        }        
        
    },
    
    showSelects: function(container)
    {
        var selects = document.getElementsByTagName('select');
        var windowSelects = container.getElementsByTagName('select');
        var saveSelects = new Array();
        $A(windowSelects).each(
          function(item){
            if(item.style.display == 'none' || item.style.visibility == 'hidden'){
                saveSelects.push(item);
            }
          }
        );
        
        $A(selects).each(
          function(item){
            item.style.visibility = 'visible';
            
          }
        );
        $A(saveSelects).each(
          function(item){
            item.style.visibility = 'hidden';
            
          }
        );
        
        
    },
    
    hideSelects: function(container)
    {
        var selects = document.getElementsByTagName('select');
        var windowSelects = container.getElementsByTagName('select');
        var saveSelects = new Array();
        

        $A(windowSelects).each(
          function(item){
            if(!Adept.Core.isset(item)){
                return;
            }
            if(item.style.display != 'none' && item.style.visibility != 'hidden'){
                saveSelects.push(item);
            }
          }
        );
        $A(selects).each(
          function(item){
            if(!Adept.Core.isset(item)){
                return;
            }
            item.style.visibility = 'hidden';
            
          }
        );
        $A(saveSelects).each(
          function(item){
            if(!Adept.Core.isset(item)){
                return;
            }
            item.style.visibility = 'visible';
            
          }
        );
        
    }
	
};