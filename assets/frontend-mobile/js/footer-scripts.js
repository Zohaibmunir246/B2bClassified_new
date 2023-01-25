jQuery(document).ready(function ($) {
	// scroll top
	var btn = $('#top');

	$(window).scroll(function() {
		if ($(window).scrollTop() > 300) {
			btn.fadeIn();
		} else {
			btn.fadeOut();
		}
	});

	btn.on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop:0}, '300');

	});

	$("body").on('click','.fav_add_listing',function (e) {
		e.preventDefault();

		var $this = $(this);
		$this.find(".fa-spinner").show();

		var listing_id = $this.data('lisitngid'); //getter
		var userid = $this.data("user_id");

		$.ajax({/* THEN THE AJAX CALL */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			dataType: "json",
			url: "<?php echo base_url('dashboard/fav_add'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			data: {listing_id: listing_id, userid: userid}, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				console.log(result);

				if (result == 'nolog') {
					window.location.replace("<?php echo base_url('login?redirected_to=') . base_url() . uri_string(); ?>");
				}
				if (result == 'fav_added') {

					$this.find(".fa-spinner").hide();
					$this.hide();
					$this.siblings('.remove_fav_listing').show();

				}


			}
		});
	});

	$("body").on('click','.remove_fav_listing',function (e) {
		e.preventDefault();

		var $this = $(this);
		$this.find(".fa-spinner").show();

		var listing_id = $this.data('lisitngid'); //getter
		var userid = $this.data("user_id");

		$.ajax({/* THEN THE AJAX CALL */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			dataType: "json",
			url: "<?php echo base_url('dashboard/remove_fav'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			data: {listing_id: listing_id, userid: userid}, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				console.log(result);


				if (result == 'fav_removed') {


					$this.find(".fa-spinner").hide();
					$this.siblings().show();
					$this.hide();

				}


			}
		});
	});
	//chat with seller model popup js start
	$("#myModal").modal({
		backdrop: 'static',
		keyboard: true,
		show: false
	});
	//chat with seller model popup js end
	var nearToBottom = 100;
	var bottom = true
	var page = 2;
	var masonrow = $('.masonrow');
	if(masonrow.length > 0){
		$(window).scroll(function () {
			if(bottom && $(window).scrollTop() >= ($('.masonrow').offset().top + $('.masonrow').outerHeight() - window.innerHeight)) {
				bottom = false;
				$('body').find(".spin").show();
				$.ajax({/* THEN THE AJAX CALL */
					type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
					dataType: "json",
					url: "<?php echo base_url('mobilehome/index'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
					data: {page: page}, /* THE DATA WE WILL BE PASSING */

					success: function (result) { /* GET THE TO BE RETURNED DATA */
						$('.masonrow').append(result);
						page++;
						bottom = true;
						$('body').find(".spin").hide();

					},
					error: function(){
						$('body').find(".spin").hide();
					}
				});
			}
		});
	}

	$(".parent_cat_").on('change',function (e) {
		e.preventDefault();
		var $this = $(this);
		var cat_id = $this.val(); //getter
		$('.search-loader').show();
		$.ajax({/* THEN THE AJAX CALL */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			dataType: "json",
			url: "<?php echo base_url('child-cats'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			data: {parent_cat_id: cat_id}, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				// console.log(result);
				$('.child_cat_').empty();
				jQuery.each(result,function( index, value ){
					$('.child_cat_').append('<option value="'+value.id+'">'+value.name+'</option>');
				})
				$('.search-loader').hide();
				$('.child_cat_').removeAttr('disabled');
			}
		});
	});
	// get cities
	$('.state_selected').on('change',function () {
		let $this = $(this);

		$('.search-loader').show();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('users/ajax__get_cities_by_state_id'); ?>",
			data: {state_id: $($this).val()}
		}).done(function (data) {
			data = $.parseJSON(data);

			let html = "<option>Choose City</option>";

			$(data).each(function (i, e) {
				html += "<option value='" + e.id + "' >" + e.name + "</option>";
			});

			$('.city_selected').attr('disabled', false).empty().append(html);
			$('.search-loader').hide();
		});
	});
	// cookie set and update based on user country in the top header.
	$('.topheader_user_country').change(function (e) {
		let $this = $(this);

		$('.top-header-loader').show();
		if ($.cookie('volgo_user_country_id') === undefined) {
			$.cookie(
				"volgo_user_country_id",
				$($this).val(),
				{
					// The "expires" option defines how many days you want the cookie active. The default value is a session cookie, meaning the cookie will be deleted when the browser window is closed.
					expires: 2,
					// The "path" option setting defines where in your site you want the cookie to be active. The default value is the page the cookie was defined on.
					path: '',
					// The "domain" option will allow this cookie to be used for a specific domain, including all subdomains (e.g. labs.openviewpartners.com). The default value is the domain of the page where the cookie was created.
					domain: '',
					// The "secure" option will make the cookie only be accessible through a secure connection (like https://)
					secure: false
				}
			);

		} else {
			$.cookie("volgo_user_country_id", $($this).val());
		}

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('MobileHome/ajax__get_states_by_country_id'); ?>",
			data: {country_id: $($this).val()}
		}).done(function (data) {
			data = $.parseJSON(data);

			if (data.status === 'error') {
				console.error("unable to get states");
				return;
			}

			$('.top-header-loader').hide();
			location.reload();
		});
	});
	// country and lang
	$('#select_country_burger_menu a,#select_country_burger_menu .selected_country').on('click',function(){
		$('#select_country_burger_menu').addClass('active');
	});
	$('.burger_menu_header a').on('click',function(){
		$('#select_country_burger_menu').removeClass('active');
	});
	$('#select_lang_burger_menu a,#select_lang_burger_menu .selected_country').on('click',function(){
		$('#select_lang_burger_menu').addClass('active');
	});
	$('.burger_menu_header a').on('click',function(){
		$('#select_lang_burger_menu').removeClass('active');
	});
	// read image url
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#profile_img').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#profile_pic_').on('change',function(){
		var property = document.getElementById('profile_pic_').files[0];
		var form_data = new FormData();
		form_data.append('file',property);
		form_data.append('userid',$(this).data('id'));
		// console.log(form_data);
		readURL(this);
		$.ajax({/* THEN THE AJAX CALL */
			url: "<?php echo base_url('mobilehome/update_profile_pic'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			contentType:false,
			cache:false,
			processData:false,
			data: form_data, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				// console.log(result);

			}
		});
	});

	$('#parent_cat_my_ads').on('change',function(){
		$(this).closest('form').submit();
	});
	$('input[name="ads_status"]').on('change',function(){
		$(this).closest('form').submit();
	});
	$('.post_del_btn').on('click',function(){
		$('.post_del_checkbox').slideToggle();
		$(this).siblings('.post_del_submit_btn').slideToggle();
	});
	$('.search_dash_submit').on('click',function(e){
		e.preventDefault();
		$(this).siblings('input').val();
		if($('.dashboard_seach_').length > 0){
			$('.dashboard_seach_ input[name="search_query"]').val($(this).siblings('input').val());
			$('.dashboard_seach_ input[name="search_query"]').closest('form').submit();
		}else{
			$(this).closest('form').submit();
		}

	});
	$('.post_del_submit_btn').on('click',function(){
		var myCheckboxes = new Array();
		$('.post_del_checkbox input:checked').each(function() {
			myCheckboxes.push($(this).val());
		});
		$.ajax({/* THEN THE AJAX CALL */
			url: "<?php echo base_url('dashboard/del-my-ads'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			data: {postIds: myCheckboxes}, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				location.reload();

			}
		});
	});

});

jQuery(document).ready(function ($) {
	// scroll top
	var btn = $('#top');

	$(window).scroll(function() {
		if ($(window).scrollTop() > 300) {
			btn.fadeIn();
		} else {
			btn.fadeOut();
		}
	});

	btn.on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({scrollTop:0}, '300');

	});



	$("body").on('click','.fav_add_listing',function (e) {
		e.preventDefault();

		var $this = $(this);
		$this.find(".fa-spinner").show();

		var listing_id = $this.data('lisitngid'); //getter
		var userid = $this.data("user_id");

		$.ajax({/* THEN THE AJAX CALL */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			dataType: "json",
			url: "<?php echo base_url('dashboard/fav_add'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			data: {listing_id: listing_id, userid: userid}, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				console.log(result);

				if (result == 'nolog') {
					window.location.replace("<?php echo base_url('login?redirected_to=') . base_url() . uri_string(); ?>");
				}
				if (result == 'fav_added') {

					$this.find(".fa-spinner").hide();
					$this.hide();
					$this.siblings('.remove_fav_listing').show();

				}


			}
		});
	});

	$("body").on('click','.remove_fav_listing',function (e) {
		e.preventDefault();

		var $this = $(this);
		$this.find(".fa-spinner").show();

		var listing_id = $this.data('lisitngid'); //getter
		var userid = $this.data("user_id");

		$.ajax({/* THEN THE AJAX CALL */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			dataType: "json",
			url: "<?php echo base_url('dashboard/remove_fav'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			data: {listing_id: listing_id, userid: userid}, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				console.log(result);


				if (result == 'fav_removed') {


					$this.find(".fa-spinner").hide();
					$this.siblings().show();
					$this.hide();

				}


			}
		});
	});
	//chat with seller model popup js start
	$("#myModal").modal({
		backdrop: 'static',
		keyboard: true,
		show: false
	});
	//chat with seller model popup js end
	var nearToBottom = 100;
	var bottom = true
	var page = 2;
	var masonrow = $('.masonrow');
	if(masonrow.length > 0){
		$(window).scroll(function () {
			if(bottom && $(window).scrollTop() >= ($('.masonrow').offset().top + $('.masonrow').outerHeight() - window.innerHeight)) {
				bottom = false;
				$('body').find(".spin").show();
				$.ajax({/* THEN THE AJAX CALL */
					type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
					dataType: "json",
					url: "<?php echo base_url('mobilehome/index'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
					data: {page: page}, /* THE DATA WE WILL BE PASSING */

					success: function (result) { /* GET THE TO BE RETURNED DATA */
						$('.masonrow').append(result);
						page++;
						bottom = true;
						$('body').find(".spin").hide();

					},
					error: function(){
						$('body').find(".spin").hide();
					}
				});
			}
		});
	}

	$(".parent_cat_").on('change',function (e) {
		e.preventDefault();
		var $this = $(this);
		var cat_id = $this.val(); //getter
		$('.search-loader').show();
		$.ajax({/* THEN THE AJAX CALL */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			dataType: "json",
			url: "<?php echo base_url('child-cats'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			data: {parent_cat_id: cat_id}, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				// console.log(result);
				$('.child_cat_').empty();
				jQuery.each(result,function( index, value ){
					$('.child_cat_').append('<option value="'+value.id+'">'+value.name+'</option>');
				})
				$('.search-loader').hide();
				$('.child_cat_').removeAttr('disabled');
			}
		});
	});
	// get cities
	$('.state_selected').on('change',function () {
		let $this = $(this);

		$('.search-loader').show();

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('users/ajax__get_cities_by_state_id'); ?>",
			data: {state_id: $($this).val()}
		}).done(function (data) {
			data = $.parseJSON(data);

			let html = "<option>Choose City</option>";

			$(data).each(function (i, e) {
				html += "<option value='" + e.id + "' >" + e.name + "</option>";
			});

			$('.city_selected').attr('disabled', false).empty().append(html);
			$('.search-loader').hide();
		});
	});
	// cookie set and update based on user country in the top header.
	$('.topheader_user_country').change(function (e) {
		let $this = $(this);

		$('.top-header-loader').show();
		if ($.cookie('volgo_user_country_id') === undefined) {
			$.cookie(
				"volgo_user_country_id",
				$($this).val(),
				{
					// The "expires" option defines how many days you want the cookie active. The default value is a session cookie, meaning the cookie will be deleted when the browser window is closed.
					expires: 2,
					// The "path" option setting defines where in your site you want the cookie to be active. The default value is the page the cookie was defined on.
					path: '',
					// The "domain" option will allow this cookie to be used for a specific domain, including all subdomains (e.g. labs.openviewpartners.com). The default value is the domain of the page where the cookie was created.
					domain: '',
					// The "secure" option will make the cookie only be accessible through a secure connection (like https://)
					secure: false
				}
			);

		} else {
			$.cookie("volgo_user_country_id", $($this).val());
		}

		$.ajax({
			method: "POST",
			url: "<?php echo base_url('MobileHome/ajax__get_states_by_country_id'); ?>",
			data: {country_id: $($this).val()}
		}).done(function (data) {
			data = $.parseJSON(data);

			if (data.status === 'error') {
				console.error("unable to get states");
				return;
			}

			$('.top-header-loader').hide();
			location.reload();
		});
	});
	// country and lang
	$('#select_country_burger_menu a,#select_country_burger_menu .selected_country').on('click',function(){
		$('#select_country_burger_menu').addClass('active');
	});
	$('.burger_menu_header a').on('click',function(){
		$('#select_country_burger_menu').removeClass('active');
	});
	$('#select_lang_burger_menu a,#select_lang_burger_menu .selected_country').on('click',function(){
		$('#select_lang_burger_menu').addClass('active');
	});
	$('.burger_menu_header a').on('click',function(){
		$('#select_lang_burger_menu').removeClass('active');
	});
	// read image url
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#profile_img').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#profile_pic_').on('change',function(){
		var property = document.getElementById('profile_pic_').files[0];
		var form_data = new FormData();
		form_data.append('file',property);
		form_data.append('userid',$(this).data('id'));
		// console.log(form_data);
		readURL(this);
		$.ajax({/* THEN THE AJAX CALL */
			url: "<?php echo base_url('mobilehome/update_profile_pic'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			contentType:false,
			cache:false,
			processData:false,
			data: form_data, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				// console.log(result);

			}
		});
	});

	$('#parent_cat_my_ads').on('change',function(){
		$(this).closest('form').submit();
	});
	$('input[name="ads_status"]').on('change',function(){
		$(this).closest('form').submit();
	});
	$('.post_del_btn').on('click',function(){
		$('.post_del_checkbox').slideToggle();
		$(this).siblings('.post_del_submit_btn').slideToggle();
	});
	$('.search_dash_submit').on('click',function(e){
		e.preventDefault();
		$(this).siblings('input').val();
		if($('.dashboard_seach_').length > 0){
			$('.dashboard_seach_ input[name="search_query"]').val($(this).siblings('input').val());
			$('.dashboard_seach_ input[name="search_query"]').closest('form').submit();
		}else{
			$(this).closest('form').submit();
		}

	});
	$('.post_del_submit_btn').on('click',function(){
		var myCheckboxes = new Array();
		$('.post_del_checkbox input:checked').each(function() {
			myCheckboxes.push($(this).val());
		});
		$.ajax({/* THEN THE AJAX CALL */
			url: "<?php echo base_url('dashboard/del-my-ads'); ?>", /* PAGE WHERE WE WILL PASS THE DATA */
			type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
			data: {postIds: myCheckboxes}, /* THE DATA WE WILL BE PASSING */

			success: function (result) { /* GET THE TO BE RETURNED DATA */
				location.reload();

			}
		});
	});

});
