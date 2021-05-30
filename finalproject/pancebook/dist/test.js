$(document).ready(function () {
	var date = new Date();
	$(".edit").click(function (e) {
		let value = $(this).attr("value");
		$("#updateid").attr("value", value);
	});
});
