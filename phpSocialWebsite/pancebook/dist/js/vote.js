$(document).ready(function () {
	$(".like-btn").on("click", function (e) {
		let postid = $(this).data("id");
		$click_btn = $(this);

		//for the like button can only once
		if ($click_btn.hasClass("o-up")) {
			action = "like";
		} else if ($click_btn.hasClass("up")) {
			action = "unlike";
		}

		$.ajax({
			url: "../viewboard.php",
			type: "post",
			data: {
				action: action,
				postid: postid,
			},
			success: function (data) {
				response = JSON.parse(data);

				if (action == "like") {
					$click_btn.removeClass("o-up");
					$click_btn.addClass("up");
				} else if (action == "unlike") {
					$click_btn.removeClass("up");
					$click_btn.addClass("o-up");
				}

				response[0].likes;
				$click_btn.siblings("span.likes").text(response[0].likes);
				$click_btn.siblings("span.dislikes").text(response[0].dislikes);
			},
		});
	});

	//dislike
	$(".dislike-btn").on("click", function (e) {
		let postid = $(this).data("id");
		$click_btn = $(this);

		//for the like button can only once
		if ($click_btn.hasClass("o-down")) {
			action = "dislike";
		} else if ($click_btn.hasClass("down")) {
			action = "undislike";
		}

		$.ajax({
			url: "../viewboard.php",
			type: "post",
			data: {
				action: action,
				postid: postid,
			},
			success: function (data) {
				response = JSON.parse(data);

				if (action == "dislike") {
					$click_btn.removeClass("o-down");
					$click_btn.addClass("down");
				} else if (action == "undislike") {
					$click_btn.removeClass("down");
					$click_btn.addClass("o-down");
				}
				$click_btn.siblings("span.likes").text(response[0].likes);
				$click_btn.siblings("span.dislikes").text(response[0].dislikes);
			},
		});
	});
});
