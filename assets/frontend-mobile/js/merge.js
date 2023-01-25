$(document).ready(function () {

//	Ejaz js code start

	$('.opener').on('click', function () {
		$(this).attr('href');
		$(this).next().toggleClass('active');
		$(this).children().toggleClass('rotate');
	});

	$(function () {

		// for Custom Select
		var flag = false;
		$('.custom-select ul li a').click(function (e) {
			var parentID = $(this).parents().eq(2).prop("id");
			$('#' + parentID + ' .form-control').text($(this).text());
			$('#' + parentID + ' .hidden-field').val($(this).text());
			$('.custom-select').removeClass('active');
			$('#' + parentID).addClass('selected focus');
			flag = false;
			return false;
		});


		var _id;
		$('.custom-select strong').click(function (e) {

			if (_id != $(this).parent().prop('id'))
				flag = false;

			if (flag == false) {
				$(this).parent().addClass('active');
				flag = false;
			} else {
				$(this).parent().removeClass('active');
				flag = false;
			}


			_id = $(this).parent().prop('id');
		});

		$(document).mouseup(function (e) {
			var container = $(".custom-select ul");

			if (!container.is(e.target) &&
				container.has(e.target).length === 0) {
				$('.custom-select').removeClass('active');
			}
		});

	});

	//	Ejaz js code end


	//	Andrew js code start

	//	Load more items by clicking on load more button start --ANDREW--
	$(".more-box").slice(0, 0).show();
	if ($(".ad-box:hidden").length !== 0) {
		$("#loadMore").show();
	}
	$("#loadMore").on('click', function (e) {
		e.preventDefault();
		$(".more-box:hidden").slice(0, 2).slideDown();
		if ($(".more-box:hidden").length == 0) {
			$("#loadMore").fadeOut('slow');
		}
	});
//	Load more items by clicking on load more button end

//	Favourite an item script start --ANDREW--
	$('a.favourite').on('click', function () {
		$(this).toggleClass('liked');
	});
//	Favourite an item script end

//	Sticky top on Details listing pages start -- ANDREW--
// 	function fixDiv() {
//     var $div = $(".sticky-top");
//     if ($(window).scrollTop() > $div.data("top")) {
//         $('.sticky-top').css({'position': 'fixed', 'top': '0', 'width': '100%', 'background': '#fff', 'padding-top': '10px'});
// 				$('.carousel-indicators.carousel-thumbnails').css({'display': 'none'});
//     }
//     else {
//         $('.sticky-top').css({'position': 'static', 'top': 'auto', 'width': '100%'});
// 				$('.carousel-indicators.carousel-thumbnails').css({'display': 'inline-flex'});
//     }
// }
// 	if($(".sticky-top").length >0){
// 		$(".sticky-top").data("top", $(".sticky-top").offset().top); // set original position on load
// 	}
//
// 	$(window).scroll(fixDiv);
//	Sticky top on Details listing pages end

	//	Andrew js code end



});

$(document).ready(function() {
	$('.opener').on('click', function() {
		$(this).attr('href');
		$(this).next().toggleClass('active');
		$(this).children().toggleClass('rotate');
	});
	
});

// Ejaz js code

$(document).on('keyup', function(evt) {
	if (evt.keyCode == 27) {
		$('body').removeClass('menu-open');
	}
});
$(document).ready(function() {
	$('.opener').on('click', function() {
		$('body').addClass('menu-open');
	});

	$('.menu-close').on('click', function() {
		$('body').removeClass('menu-open');
	});

});
$(document).ready(function() {

	$(function() {

		// for Custom Select
		var flag = false;
		$('.custom-select ul li a').click(function(e) {
			var parentID = $(this).parents().eq(2).prop("id");
			$('#' + parentID + ' .form-control').text($(this).text());
			$('#' + parentID + ' .hidden-field').val($(this).text());
			$('.custom-select').removeClass('active');
			$('#' + parentID).addClass('selected focus');
			flag = false;
			return false;
		});

		var _id;
		$('.custom-select strong').click(function(e) {

			if (_id != $(this).parent().prop('id'))
				flag = false;

			if (flag == false) {
				$(this).parent().addClass('active');
				flag = false;
			} else {
				$(this).parent().removeClass('active');
				flag = false;
			}

			_id = $(this).parent().prop('id');
		});

		$(document).mouseup(function(e) {
			var container = $(".custom-select ul");

			if (!container.is(e.target) &&
				container.has(e.target).length === 0) {
				$('.custom-select').removeClass('active');
			}
		});

	});
});