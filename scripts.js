	function absorbEvent_(event) {
		var e = event || window.event;
		e.preventDefault && e.preventDefault();
		e.stopPropagation && e.stopPropagation();
		e.cancelBubble = true;
		e.returnValue = false;
		return false;
	}

	function preventLongPressMenu(node) {
		node.ontouchstart = absorbEvent_;
		node.ontouchmove = absorbEvent_;
		node.ontouchend = absorbEvent_;
		node.ontouchcancel = absorbEvent_;
	}

$(function() {
	setTimeout(function() {
		$("#btn-si, #btn-no").removeClass("btn-disabled");
	}, 2000);
	$("#exampleModal").on("shown.bs.modal", function() {
		$("#select-value").focus();
	});
	$("#btn-si").css("width", $("#btn-no").css("width"));
	$("#btn-no").click(function() {
		if ($(this).hasClass("btn-disabled")) {
			return;
		}
		let confirmed = $(this).data("confirmed");
		if (!confirmed) {
			$(this).removeClass("btn-info");
			$(this).addClass("btn-success");
			$(this).data("confirmed", "true");
			return;
		}

		$("#photo-form").submit();
	});
	$("#btn-si").click(function() {
		if ($(this).hasClass("btn-disabled")) {
			return;
		}
		$("#exampleModal").modal();
	});
	$("#btn-confirm").click(function() {
		let confirmed = $(this).data("confirmed");

		let comment = $.trim($("#message-text").val());
		if (comment.length < 1) {
			alert("Inserire un commento");
			return;
		}

		let value = $("#radio-value input:checked").val();
		if (value == -1) {
			alert("Selezionare la tipologia");
			return;
		}

		if (!confirmed) {
			$(this).removeClass("btn-primary");
			$(this).addClass("btn-success");
			$(this).data("confirmed", "true");
			return;
		}

		$("#ret-value").val(value);
		$("#ret-comment").val(comment);

		$("#photo-form").submit();
	});
	$("body").on("contextmenu",function(e){
		return false;
	});
	$("img").mousedown(function(e){
		e.preventDefault()
	});
	preventLongPressMenu(document.getElementById('instagram-image'));
});