Adept.Core.namespace('Adept.Controller.Form');

Adept.Controller.Form.MultiFileUpload = Class.create(Adept.Controller,
{
    maxFilesCount: 5,
    immediateUpload: false,
    filesCount: 1,
    fileId:1,
    deleteLinkText: 'delete',
    deleteLinkStyle: null,
    deleteLinkClass: null,
    
    
    
    initialize: function($super, componentId)
	{
		$super(componentId);
		
		Event.observe(this.getElementId() + ":1:add", 'click', this.addNewFile.bindAsEventListener(this));
		
		
//		if(Adept.Core.isset(formId)){
//			this.formId = formId;
//		}
//		Adept.Observer.addListener(this.getElementId(), this.CLICK_EVENT, this.submit.bindAsEventListener(this));
	},
	
	getFirstFileId: function()
	{
	   return   this.getElementId() + ":1";
	},
	
	
	addNewFile: function(event)
	{
	    if(this.filesCount >= this.maxFilesCount){
	        return;
	    }
	    var newFile = $(this.getFirstFileId()).cloneNode(false);
	    var container = $(this.getFirstFileId() + ":container").cloneNode(false);
	    var addLink =  $(this.getFirstFileId() + ":add").cloneNode(true);
	    
	    
	    this.filesCount++;
	    this.fileId++;
	    
	    
	    container.id = this.getElementId() + ':' + this.fileId + ':container';
	    newFile.id = this.getElementId() + ':' + this.fileId;
	    newFile.value = '';
	    addLink.id = this.getElementId() + ':' + this.fileId + ':add';
	    
	    
	    
	    Event.observe(addLink, 'click', this.addNewFile.bindAsEventListener(this));
	  
	    container.appendChild(newFile);
	    container.appendChild(addLink);
	    container.appendChild(this.createDeleteLink());
	    this.getElement().appendChild(container);
	    event.stop();
	},
	
	createDeleteLink: function()
	{
	    var deleteLink = document.createElement('span');
	    deleteLink.innerHTML = this.getDeleteLinkText();
	    deleteLink.id = this.getElementId() + ':' + this.fileId + ':delete';
	    Event.observe(deleteLink, 'click', this.deleteFile.bindAsEventListener(this));
	    if(Adept.Core.isset(this.getDeleteLinkClass())){
	        deleteLink.className = this.getDeleteLinkClass();
	    }else{
	       deleteLink.className = $(this.getFirstFileId() + ":add").className;    
	    }
	    
	    if(Adept.Core.isset(this.getDeleteLinkStyle())){
	        deleteLink.setStyle(this.getDeleteLinkStyle());
	    }else{
	        deleteLink.setStyle($(this.getFirstFileId() + ":add").style) 
	    }
	    
	    return deleteLink;
	},
	
	deleteFile: function(event)
	{  
	    Element.remove(event.element().parentNode);
	    this.filesCount--;
	    event.stop();
	},
	
	
	
	
	getMaxFilesCount:  function () 
	{
	   return this.maxFilesCount;
	},

	setMaxFilesCount: function(maxFilesCount) 
	{
	   this.maxFilesCount =  maxFilesCount;
	},
	
	getImmediateUpload:  function () 
	{
	   return this.immediateUpload;
	},

	setImmediateUpload: function(immediateUpload) 
	{
	   this.immediateUpload =  immediateUpload;
	},
	
	
	getFilesCount:  function () 
	{
	   return this.filesCount;
	},

	setFilesCount: function(filesCount) 
	{
	   this.filesCount =  filesCount;
	},
	
	getDeleteLinkText:  function () 
	{
	   return this.deleteLinkText;
	},

	setDeleteLinkText: function(deleteLinkText) 
	{
	   this.deleteLinkText =  deleteLinkText;
	},
	
	getDeleteLinkClass:  function () 
	{
	   return this.deleteLinkClass;
	},

	setDeleteLinkClass: function(deleteLinkClass) 
	{
	   this.deleteLinkClass =  deleteLinkClass;
	},
	
	getDeleteLinkStyle:  function () 
	{
	   return this.deleteLinkStyle;
	},

	setDeleteLinkStyle: function(deleteLinkStyle) 
	{
	   this.deleteLinkStyle =  deleteLinkStyle;
	}


	






	
	

});