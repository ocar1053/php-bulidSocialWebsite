function sendMsg() {
	$.post("../insert.php", {
		nickname: $("#nickname").val(),
		msg: $("#msg").val(),
		page: $("#page").val(),
	});
	$("#msg").val("");
}

function showMsg() {
	$.get(
		"../show.php",
		{ page: $("#page").val() },
		(response) => {
			str = "";
			response.forEach((item) => {
				str += item["nickname"] + ": " + item["msg"] + "\n";
			});
			console.log(str);
			$("#showMsgHere").val(str);
		},
		"json"
	);
}

$(function () {
	// 定時抓取訊息
	setInterval(showMsg, 1000);
	// 按下 enter 後送出訊息
	$("#msg").bind("keydown", function (e) {
		if (e.which == 13) {
			sendMsg();
		}
	});
});
