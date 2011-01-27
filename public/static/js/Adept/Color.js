Adept.Core.namespace('Adept');

Adept.Color = Class.create(
{
    r: 0,
    g: 0,
    b: 0,
    
    h: 0,
    s: 0,
    v: 0,
    
    hex: '000000',
    
    initialize: function(r, g, b) 
    {
        this.setRgb(r, g, b);
    },
    
    getHex: function()
    {
        return this.hex;
    },
    
    setRgb: function(r, g, b) {
        this.r = Adept.Core.defaultValue(r, 0);
        this.g = Adept.Core.defaultValue(g, 0);
        this.b = Adept.Core.defaultValue(b, 0);
        
        var newHsv = this.rgbToHsv(this.r, this.g, this.b);
        this.h = newHsv.h;
        this.s = newHsv.s;
        this.v = newHsv.v;
            
        this.hex = this.rgbToHex(this.r, this.g, this.b);
    },
    
    setHsv: function(h, s, v) {
        this.h = h;
        this.s = s;
        this.v = v;
            
        var newRgb = this.hsvToRgb(this.h, this.s, this.v);
        this.r = newRgb.r;
        this.g = newRgb.g;
        this.b = newRgb.b;  
            
        this.hex = this.rgbToHex(this.r, this.g, this.b);
    },
        
    setHex: function(hex) {
        this.hex = hex;
            
        var newRgb = this.hexToRgb(this.hex);
        this.r = newRgb.r;
        this.g = newRgb.g;
        this.b = newRgb.b;
            
        var newHsv = this.rgbToHsv(this.r, this.g, this.b);
        this.h = newHsv.h;
        this.s = newHsv.s;
        this.v = newHsv.v;          
    },    
    
    rgbToHsv: function(r, g, b) 
    {
        var r = r / 255;
        var g = g / 255;
        var b = b / 255;

        hsv = {h:0, s:0, v:0};

        var min = 0;
        var max = 0;

        if (r >= g && r >= b) {
            max = r;
            min = (g > b) ? b : g;
        } else if (g >= b && g >= r) {
            max = g;
            min = (r > b) ? b : r;
        } else {
            max = b;
            min = (g > r) ? r : g;
        }

        hsv.v = max;
        hsv.s = (max) ? ((max - min) / max) : 0;

        if (!hsv.s) {
            hsv.h = 0;
        } else {
            delta = max - min;
            if (r == max) {
                hsv.h = (g - b) / delta;
            } else if (g == max) {
                hsv.h = 2 + (b - r) / delta;
            } else {
                hsv.h = 4 + (r - g) / delta;
            }

            hsv.h = parseInt(hsv.h * 60);
            if (hsv.h < 0) {
                hsv.h += 360;
            }
        }
        
        hsv.s = parseInt(hsv.s * 100);
        hsv.v = parseInt(hsv.v * 100);

        return hsv;
    },

    rgbToHex: function (r, g, b) 
    {
        return this.intToHex(r) + this.intToHex(g) + this.intToHex(b);
    },
    
    intToHex: function (dec)
    {
        var result = (parseInt(dec).toString(16));
        if (result.length == 1) {
            result = ('0' + result);
        }
        return result.toUpperCase();
    },
    
    hexToInt: function (hex)
    {
        return(parseInt(hex,16));
    },
    
    hexToRgb: function(hex) 
    {
        hex = this.validateHex(hex);

        var r='00', g='00', b='00';

        if (hex.length == 6) {
            r = hex.substring(0,2);
            g = hex.substring(2,4);
            b = hex.substring(4,6); 
        } else {
            if (hex.length > 4) {
                r = hex.substring(4, hex.length);
                hex = hex.substring(0,4);
            }
            if (hex.length > 2) {
                g = hex.substring(2,hex.length);
                hex = hex.substring(0,2);
            }
            if (hex.length > 0) {
                b = hex.substring(0,hex.length);
            }                   
        }
        
        return { r: this.hexToInt(r), g: this.hexToInt(g), b: this.hexToInt(b) };
    },
    
    validateHex: function(hex) 
    {
        hex = new String(hex).toUpperCase();
        hex = hex.replace(/[^A-F0-9]/g, '0');
        if (hex.length > 6) {
            hex = hex.substring(0, 6);
        }
        return hex;
    },
    
    hsvToRgb: function (h, s, v) 
    {
        rgb = {r:0, g:0, b:0};
        
        if (s == 0) {
            if (v == 0) {
                rgb.r = rgb.g = rgb.b = 0;
            } else {
                rgb.r = rgb.g = rgb.b = parseInt(v * 255 / 100);
            }
        } else {
            if (h == 360) {
                h = 0;
            }
            h /= 60;

            // 100 scale
            s = s/100;
            v = v/100;

            var i = parseInt(h);
            var f = h - i;
            var p = v * (1 - s);
            var q = v * (1 - (s * f));
            var t = v * (1 - (s * (1 - f)));
            switch (i) {
                case 0:
                    rgb.r = v;
                    rgb.g = t;
                    rgb.b = p;
                    break;
                case 1:
                    rgb.r = q;
                    rgb.g = v;
                    rgb.b = p;
                    break;
                case 2:
                    rgb.r = p;
                    rgb.g = v;
                    rgb.b = t;
                    break;
                case 3:
                    rgb.r = p;
                    rgb.g = q;
                    rgb.b = v;
                    break;
                case 4:
                    rgb.r = t;
                    rgb.g = p;
                    rgb.b = v;
                    break;
                case 5:
                    rgb.r = v;
                    rgb.g = p;
                    rgb.b = q;
                    break;
            }
            rgb.r = parseInt(rgb.r * 255);
            rgb.g = parseInt(rgb.g * 255);
            rgb.b = parseInt(rgb.b * 255);
        }
        return rgb;
    }

});
