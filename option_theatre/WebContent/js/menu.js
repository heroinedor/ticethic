//
//var monthNames = new Array( "janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre");
//var dayNames = new Array("dimanche","lundi","mardi","mercredi","jeudi","vendredi","samedi");
//var now = new Date();
//var year = now.getYear()
//
//	if(year <= 1900) {year += 1900;}
//		document.write(dayNames[now.getDay()]+" "+ now.getDate()+ " " + monthNames[now.getMonth()] + " " + year);
//	document.write("<br>",now.getHours(),":");
//	min = now.getMinutes();
//	if(min < 10)
//		{document.write("0"+ min);}
//	else
//		{document.write(min);}

function Menu(urlmenu,urlpage) {
	top.principal.location=urlpage;
	top.menu_haut.location=urlmenu;
}