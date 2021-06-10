$(document).ready(function () {
	$(".addf").on("click", function (e) {
		let urlid = $(this).data("url");
		$click_btn = $(this);
		action = "addf";
		$.ajax({
			url: `../profile.php?&id=${urlid}`,
			type: "POST",
			data: {
				action: action,
				urlid: urlid,
			},
			success: function (data) {
				if (data == 0) {
					alert("error");
				} else {
					$click_btn.removeClass("addf");
					$click_btn.text("sended");
					$click_btn.attr("disabled", true);
					alert("success");
				}
			},
		});
	});
});
