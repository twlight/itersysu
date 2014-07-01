window.onload = initial;

var thisAd = 0;
var adImages;
var adButtons;

function initial(){
	adImages = getElementsByClassName("adBanner");
	adButtons = getElementsByClassName("adButton");

	for (var i = 0; i < adButtons.length; i++){
		adButtons[i].setAttribute("index", i);
		adButtons[i].onclick = function(){
			removeClass(adButtons[thisAd], "ad-active");
			addClass(adImages[thisAd], "hideAd");
			thisAd = this.getAttribute("index");
			addClass(adButtons[thisAd], "ad-active");
			removeClass(adImages[thisAd], "hideAd");
			return false;
		}
	}
	rotate();
}

function rotate(){
	if (adImages.length == 0)
		return;
	addClass(adImages[thisAd], "hideAd");
	removeClass(adButtons[thisAd], "ad-active");
	thisAd++;
	if (thisAd == adImages.length){
		thisAd = 0;
	}
	removeClass(adImages[thisAd], "hideAd");
	addClass(adButtons[thisAd], "ad-active");

	setTimeout(rotate, 6*1000);
}

function getElementsByClassName(classname){
	var results = new Array();
	var elems = document.getElementsByTagName("*");
	for (var i = 0; i < elems.length; i++){
		if (elems[i].className.indexOf(classname) != -1){
			results[results.length] = elems[i];
		}
	}
	return results;
}

function hasClass(element, classname){
	return element.className.match(new RegExp('(\\s|^)'+classname+'(\\s|$)'));
}

function addClass(element, classname){
	if (!hasClass(element, classname))
		element.className += " "+classname;
}

function removeClass(element, classname){
	if (hasClass(element, classname)){
		var reg = new RegExp('(\\s|^)'+classname+'(\\s|$)');
		element.className = element.className.replace(reg, ' ');
	}
}
