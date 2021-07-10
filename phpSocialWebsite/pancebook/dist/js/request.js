$(document).ready(function () {
	$(".ac").on("click", function (e) {
		let tableid = $(this).data("tableid");
		let urlid = $(this).data("id");
		$click_btn = $(this);
		action = "ac";
		$.ajax({
			url: `../request.php?&id=${urlid}`,
			type: "post",
			data: {
				action: action,
				tableid: tableid,
				urlid: urlid,
			},
			success: function (data) {
				//alert(data);
				window.location.reload();
			},
		});
	});
	$(".refuse").on("click", function (e) {
		let tableid = $(this).data("tableid");
		let urlid = $(this).data("id");
		$click_btn = $(this);
		action = "refuse";
		$.ajax({
			url: `../friendlist.php?&id=${urlid}`,
			type: "post",
			data: {
				action: action,
				tableid: tableid,
				urlid: urlid,
			},
			success: function (data) {
				//alert(data);
				window.location.reload();
			},
		});
	});
});
