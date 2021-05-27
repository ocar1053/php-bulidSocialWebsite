const date = new Date();

const months = [
	"January",
	"February",
	"March",
	"April",
	"May",
	"June",
	"July",
	"August",
	"September",
	"October",
	"November",
	"December",
];
const weeks = [
	"Sunday",
	"Monday",
	"Tuesday",
	"Wednesday",
	"Thursday",
	"Friday",
	"Saturday",
];
document.getElementById("titularmonth").innerHTML = months[date.getMonth()];
document.getElementById("titularyear").innerHTML = date.getFullYear();
document.getElementById("titularday").innerHTML = date.getDate();
document.getElementById("titularweek").innerHTML = weeks[date.getDay()];
