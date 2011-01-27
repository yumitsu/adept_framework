Adept.Core.namespace("Adept.Effect");

Adept.Effect.Factory = 
{
	TYPE_APPEAR: 'appear',
	TYPE_FADE: 'fade',
	TYPE_MORPH: 'morph',
	TYPE_MOVE: 'move',
	TYPE_OPACITY: 'opacity',
	TYPE_SLIDEUP: 'slideUp',
	TYPE_SLIDEDOWN: 'slideDown',
	TYPE_HIGHLIGHT: 'highlight',
	TYPE_BLINDDOWN: 'blindDown',
	TYPE_BLINDUP: 'blindUp',
	TYPE_SCALE: 'scale',
	
	create: function(element, type)
	{
		switch(type){
			case this.TYPE_HIGHLIGHT:
			     return new Adept.Effect.Highlight(element);
			 case this.TYPE_SCALE:
			     return new Adept.Effect.Scale(element);
			 case this.TYPE_APPEAR:
                 return new Adept.Effect.Appear(element);
             case this.TYPE_FADE:
                 return new Adept.Effect.Fade(element);
             case this.TYPE_MORPH:
                 return new Adept.Effect.Morph(element);
             case this.TYPE_MOVE:
                 return new Adept.Effect.Move(element);
             case this.TYPE_OPACITY:
                 return new Adept.Effect.Opacity(element);
             case this.TYPE_SLIDEUP:
                 return new Adept.Effect.SlideUp(element);
             case this.TYPE_SLIDEDOWN:
                 return new Adept.Effect.SlideDown(element);
                 case this.TYPE_BLINDUP:
                 return new Adept.Effect.BlindUp(element);
             case this.TYPE_BLINDDOWN:
                 return new Adept.Effect.BlindDown(element);
			default: 
			 throw new Adept.Exception.IllegalArgument('effect type not supported');
		}
	}
};