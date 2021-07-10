var setTimer = setInterval(showTime, 1000);
function showTime() {
	const date = new Date();

	let hours = date.getHours();
	let minutes = date.getMinutes();
	let seconds = date.getSeconds();
	let dd = date.getDate();
	let mm = date.getMonth() + 1;
	let yyyy = date.getFullYear();
	if (dd < 10) {
		dd = "0" + dd;
	}
	if (mm < 10) {
		mm = "0" + mm;
	}
	today = dd + "/" + mm + "/" + yyyy;

	currentTime =
		hours + "<span>:</span>" + minutes + "<span>:</span>" + seconds;

	let weekday = new Array(7);
	weekday[0] = "Sunday";
	weekday[1] = "Monday";
	weekday[2] = "Tuesday";
	weekday[3] = "Wednesday";
	weekday[4] = "Thursday";
	weekday[5] = "Friday";
	weekday[6] = "Saturday";

	let weekdays = weekday[date.getDay()];

	let output = document.querySelector(".time");

	output.innerHTML = currentTime;
}
