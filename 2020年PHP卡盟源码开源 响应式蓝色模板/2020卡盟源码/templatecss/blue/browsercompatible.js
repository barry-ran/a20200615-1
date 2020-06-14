function BrowserCompatible(){
}

/**
*��ȡ���������
*@return ��������ͣ�MSIE;Safari;Firefox
*/
BrowserCompatible.prototype.getBrowserType = function(){
	var ua = navigator.userAgent;
	if (ua.indexOf("MSIE")>-1) {
		return 'MSIE';
	}else if (ua.indexOf("Chrome")>-1) {
		return 'Chrome';
	}else if (ua.indexOf("Safari")>-1) {
		return 'Safari';
	}else if (ua.indexOf("Firefox")>-1) {
		return 'Firefox';
	}
}

/**
*�ж��Ƿ���IE
*@return true/false
*/
BrowserCompatible.prototype.isIE = function(){
	if(this.getBrowserType()==='MSIE') return true;
	else return false;
}
/**
*�ж��Ƿ���Chrome
*@return true/false
*/
BrowserCompatible.prototype.isChrome = function(){
	if(this.getBrowserType()==='Chrome') return true;
	else return false;
}
/**
*�ж��Ƿ���Safari
*@return true/false
*/
BrowserCompatible.prototype.isSafari = function(){
	if(this.getBrowserType()==='Safari') return true;
	else return false;
}
/**
*�ж��Ƿ���Firefox
*@return true/false
*/
BrowserCompatible.prototype.isFirefox = function(){
	if(this.getBrowserType()==='Firefox') return true;
	else return false;
}

var SCBrowserCompatible = new BrowserCompatible();

function pluginHasInstalled() {
    navigator.plugins.refresh(false);
    var pluginsFlag;
    if(SCBrowserCompatible.isChrome()){
		pluginsFlag = 
		typeof(navigator.mimeTypes['application/x-klgedit'])!="undefined";
	}
    if (pluginsFlag) {return true;}
    return false;
  }