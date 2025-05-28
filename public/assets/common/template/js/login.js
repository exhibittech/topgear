$(document).ready(function() {
	LoadLogin();
});

function LoadLogin() {
	$("#loginFrm").submit(function(evt) {
		evt.preventDefault();
		var uri = $(this).attr('action');
		var request = $(this).serializeArray();
		$.post(uri, request).done(function(response) {
			response = JSON.parse(response);
			console.log(response);
			if (!response.success) {

			}
			$('.box-color').addClass(response.class);
			$(response.id).html(response.message);
			$('.box-color').slideDown("slow").delay(5000).slideUp('slow', function() {
				$(response.id).html("");
				$('.box-color').removeClass(response.class)
			});

			console.log(response);
		});
		console.log(request);
	});
}