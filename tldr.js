(function(){
	"use strict";

	var links = document.getElementsByClassName("discover-tldr-title");

	for(var  i = 0; i <= links.length; i++){ 
		
		if(links != 'undefined'){
			
			console.log( links[i].href.substring(0, links[i].href.indexOf("#") ));
		}
	}})();
