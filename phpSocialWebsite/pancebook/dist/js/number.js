$(document).ready(function () {
	$(".edit").click(function (e) {
		$("#updateid").attr("value", $(this).attr("value"));
	});
});
