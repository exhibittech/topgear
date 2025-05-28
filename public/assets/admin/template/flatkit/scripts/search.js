$(document).ready(function() {

	$(".dashboard-txt").removeClass("none");
	$(".menu-list li#search").addClass("active");
	$("#sorting").change(function() {
		$("#searchFrm").submit();
	});
	LoadShortPopup();
	LoadSearch();
	LoadHideCreateFrm();
	LoadProfileClick();

});

function LoadProfileClick() {
	$(".serch-inf-container").click(function() {
		var uri = $(this).attr("data-uri");
		$(location).attr("href", uri);
	});
}

function LoadCreateNewGroup() {
	$("#createNewGrp").click(function() {
		console.log("here");
		$("#createGrpFrm").show();
	});
	$("#createGrpFrm").submit(function(evt) {
		evt.preventDefault();
		var uri = $(this).attr("action");
		var data = $(this).serializeArray();
		$.post(uri, data).done(function(response) {
			response = JSON.parse(response);
			if (!response.success) {
				$(response.container).addClass(response.class);
				$(response.container).html(response.message);
				if (response.errordata.lenght != 0) {
					$.each(response.errordata, function(idx, val) {
						console.log(idx + "-" + val.message + "-" + val.errordiv_id);
						$(val.errordiv_id).addClass(response.class);
						$(val.errordiv_id).html(val.message).slideDown("slow").delay(5000).slideUp('slow', function() {
							$(this).html("");
							$(this).removeClass(response.class)
						});

					});
				}

			} else {
				$("#createGrpFrm")[0].reset();
				$("#createGrpFrm").hide();
				$(response.databindcontainer).html(response.data);

				$(response.container).addClass(response.class);
				$(response.container).html(response.message);
				LoadShortListAdd();


			}
		});
	});

}

function LoadShortListAdd() {
	$(".shortlist").click(function() {
		var uri = $("#url").val();
		var influencerid = $("#influencerid").val();
		var groupid = $(this).attr("data-groupid");
		$.post(uri, {
			"InfluencerID": influencerid,
			"UserShortListGroupID": groupid
		}).done(function(response) {
			response = JSON.parse(response);
			if (!response.success) {
				$(response.container).addClass(response.class);
				$(response.container).html(response.message);
			} else {
				$(response.container).addClass(response.class);
				$(response.container).html(response.message);
				$(".closebtn").click();
			}
		});

	});
}

function LoadHideCreateFrm() {
	$("#createGrpFrm").hide();

}

function LoadShortPopup() {
	$(function() {
		$('.short-btn').click(function() {
			$('.targetDiv').hide();
			$('#div' + $(this).attr('target')).fadeIn('slow');
			$('.overlay').addClass('show');
			$('body').addClass('overscroll');
			$('.closebtn').fadeIn('slow');
			$("#influencerid").val($(this).attr("data-id"));
			LoadCreateNewGroup();
			LoadShortListAdd();
		});
		$('.closebtn').click(function() {
			$('.targetDiv').fadeOut('slow');
			$('.overlay').removeClass('show');
			$('body').removeClass('overscroll');
			LoadHideCreateFrm();
		});
	});
}

function LoadCreateGroupSubmit() {

}

function LoadSearch() {
	$("#searchFrm").submit(function(evt) {
		evt.preventDefault();
		var data = $(this).serializeArray();
		var uri = $(this).attr("action");
    console.log(data);
    console.log(uri);
		$.post(uri, data).done(function(response) {
			console.log(response);
			response = JSON.parse(response);
			if (response.success) {
				$(response.container).html(response.data);
				LoadShortPopup();
			}
		});
		//console.log(data);

	});
}

// $("#searchFrm").submit(function(evt) {
// 	evt.preventDefault();
// 	var data = $(this).serializeArray();
// 	var uri = $(this).attr("action");
// 	console.log(data);
// 	console.log(uri);
// 	$.post(uri, data).done(function(response) {
// 		console.log(response);
// 		response = JSON.parse(response);
// 		if (response.success) {
// 			$(response.container).html(response.data);
// 			LoadShortPopup();
// 		}
// 	});
// 	//console.log(data);
//
// });
