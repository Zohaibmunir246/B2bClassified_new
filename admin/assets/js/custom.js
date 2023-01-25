/*
 *
 *   Custom Js
 *   version 1.0
 *
 */
$(document).ready(function () {

	$(function () {
		$('#row_icon').show();
		$('#row_image').hide();

		$('#volgo_image_icon').change(function () {
			if ($('#volgo_image_icon').val() == 'icon') {
				$('#row_icon').show();
				$('#row_image').hide();
				//$('#row_image input').val(null);
			}
			if ($('#volgo_image_icon').val() == 'image') {
				$('#row_image').show();
				$('#row_icon').hide();
				//$('#row_icon input').val(null);
			}
		});


		$('#volgo_image_icon_mobile').change(function () {
			if ($('#volgo_image_icon_mobile').val() == 'icon') {
				$('#row_icon_mobile').show();
				$('#row_image_mobile').hide();
				//$('#row_image input').val(null);
			}
			if ($('#volgo_image_icon_mobile').val() == 'image') {
				$('#row_image_mobile').show();
				$('#row_icon_mobile').hide();
				//$('#row_icon input').val(null);
			}
		});

		var category_edit_value = $('#volgo_image_icon').find(":selected").text();
		if (category_edit_value == 'I-con') {
			$('#row_icon').show();
			$('#row_image').hide();

		} else if (category_edit_value == 'Image') {
			$('#row_image').show();
			$('#row_icon').hide();

		}


	});


	if ($('.footable').length > 0)
		$('.footable').footable();


});


