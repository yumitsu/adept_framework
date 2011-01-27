Adept.Core.namespace('Adept.Controller.Form');
Adept.Controller.Form.TextBB = Class.create(Adept.Controller,
{
    initialize: function($super, id)
    {
        $super(id);
        
    },
    
    onQuote: function(nickName)
    {
        
        var txt = '';
        if (document.getSelection) {
            txt=document.getSelection()
         }else if (document.selection) {
                txt=document.selection.createRange().text;
          }
          
        if(txt.strip() == ''){
            alert("Выделите текст для цитирования");
            return;
        }
        this.getElement().value = this.getElement().value + '[quote=' + nickName + ']' + txt + '[/quote]';  
        
    },
    
    onBold: function()
    {
      this.insertTag('[b]', '[/b]');  
    },
    
    
    onItalic: function()
    {
      this.insertTag('[i]', '[/i]');
    },
    
    onUnderscore:function()
    {
        this.insertTag('[u]', '[/u]');
    },
    
    onLink: function()
    {
        var url = prompt('Ссылка на страницу', 'http://');
        if(!url || url.strip() == 'http://'){
            return ;
        }
        if(this.checkSelection()){
            var startTag = '[url=%s]'
        }else{
            var startTag = '[url=%s]%s'
        }
        startTag = startTag.replace('%s', url);
        startTag = startTag.replace('%s', url);
        this.insertTag(startTag, '[/url]');
    },
    
    onImg: function()
    {
        var url = prompt('Ссылка на страницу', 'http://');
        if(!url || url.strip() == 'http://'){
            return ;
        }
        var startTag = "[img]%s"
        
        startTag = startTag.replace('%s', url);
          this.insertTag(startTag, '[/img]');
        
    },
    
    insertTag: function(startTag, endTag)
    {
        if(Prototype.Browser.IE){
          this.insertTagIE(startTag, endTag);  
          
        }else{
            this.insertTagFF(startTag, endTag);
        }
    },
    
    
    
   
    
    insertTagFF: function(stag, etag)
    {
        var txt;
        if (window.getSelection) {
            txt = window.getSelection();
        } else if (document.getSelection) {
            txt = document.getSelection();
        }
        if (!txt || txt == "") {
            var scrollPos = this.getElement().scrollTop;
            if (this.getElement().selectionStart == this.getElement().selectionEnd) {
                this.getElement().value = this.getElement().value.substring(0, this.getElement().selectionStart) 
                    + stag + etag + this.getElement().value.substring(this.getElement().selectionEnd, this.getElement().value.length);
                this.getElement().scrollTop = scrollPos;
                return;
            }
            txt = this.getElement().value.substring(this.getElement().selectionStart, this.getElement().selectionEnd);
            if (txt) {
                this.getElement().value = this.getElement().value.substring(0, this.getElement().selectionStart) 
                    + stag + txt + etag + this.getElement().value.substring(this.getElement().selectionEnd, this.getElement().value.length);
                this.getElement().scrollTop = scrollPos;
                return;
            }
        }
        this.getElement().value = this.getElement().value + stag + etag;
    },
    
    insertTagIE:function(stag, etag) 
    {
        
        var r = document.selection.createRange();
        if (document.selection.type == "Text" &&
        this.getElement().value.indexOf(r.text) != -1) {
            
            a = r.text;
            r.text = stag + r.text + etag;
            r.select();
    //        r.focus();
            if (this.getElement().value.indexOf(document.selection.createRange().text) == -1) {
                var range = document.selection.createRange();
                range.text = a;
            }
        } else {

            
            this.insertAtCaret(stag + etag);
        }
    },

    insertAtCaret: function(text) 
    {
        if (this.getElement().createTextRange && this.getElement().caretPos) {
            var caretPos = this.getElement().caretPos;
            caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == " " ? text + " " : text;
        } else {
            this.getElement().value = this.getElement().value + text;
    
        }
    },
    
    checkSelection: function(element) 
    {
        element = Adept.Core.defaultValue(element,this.getElement());
        if (Prototype.Browser.IE) {
            return this.checkSelIE(element);
        } else {
            return this.checkSelFF(element);
        }

    },

    checkSelFF: function(element)
    {
        var txt;
        if (window.getSelection) {
            txt = window.getSelection();
        } else if (document.getSelection) {
            txt = document.getSelection();
        }
        if (!txt || txt == "") {
            var t = element;//document.getElementById("txtb");
            var scrollPos = t.scrollTop;
            if (t.selectionStart == t.selectionEnd) {
                return 0;
            }
            txt = t.value.substring(t.selectionStart, t.selectionEnd);
            if (txt) {
                return 1;
            } else {
                return 0;
            }
        }
    },

    checkSelIE: function(element)
    {
        var r = document.selection.createRange();
        if (document.selection.type == "Text" && this.getElement().value.indexOf(r.text) != -1) {
            if(r.text){
                return 1;
            }else{
                return 0;
            }
        } else {
            if (element.createTextRange && element.caretPos) {
                var caretPos = this.getElement().caretPos;
                //            alert(caretPos.text);
                if(caretPos.text.length){
                    return 1;
                }else{
                    return 0;
                }
            } else {
                return 0;
            }
        }

    }
    
    
});