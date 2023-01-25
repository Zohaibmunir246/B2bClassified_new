jQuery(document).ready(function ($){
    /***
     * This is more like a confidence setup
     * for the interface. It does not really help
     * with the chat functionality.
     */
    let client_chat = $('.client_chat');
    let chat_dialog = $('.chat_dialog');

	let client_chat_box = $('.client_chat_box');


    /**
     * Before we start hide the error
     * message.
     */
    $('.connection_alert').hide();

    /**
     * Just to make it feel like a real chat.
     * Send the message if enter has been pressed.
     */
    if ($(client_chat).length > 0){
        $(client_chat).on('keypress', function (evt) {
            if (evt.keyCode === 13) {
				handle_send_message();
            }
        })
    }

	if ($(client_chat_box).length > 0){
		$(client_chat_box).on('keypress', function (evt) {
			if (evt.keyCode === 13) {
				//let uid = $(this).parents('.chat-popup').find('.from_md5_id').val();
				handle_send_message_chat_box();
			}
		})
	}


    /**
     * Submit has been pressed execute sending
     * to server.
     */
    if ($('.btn-send.chat_btn').length > 0){
        $('.btn-send.chat_btn').on('click', function () {
			handle_send_message();
		})
    }
	if ($('.btn-send.chat_btn_box').length > 0){
		$('.btn-send.chat_btn_box').on('click', function () {
			handle_send_message_chat_box();
		})
	}

	let is_delete_button_clicked = false;
    $('body').on('click', '.users_list > .user-box-chat-screen', function (e){
        e.preventDefault();

        if (is_delete_button_clicked)
        	return;

        $(chat_dialog).html(''); // clearing the chat box
        $(client_chat).val(''); // clearing the message input

        // remove active class on others
        $('.users_list').find('.user-box-chat-screen > a').removeClass('active');

        $(this).find('a').addClass('active');

        $(client_chat).attr('disabled', false);
        $('.chat_btn').attr('disabled', false);

        //Send ajax to DB to load the old chat.
		load_chat($('.user_uid').val(), $(this).find('input[name="id"]').val());

    });
    if($('.users_list').length > 0){
        setInterval(function () {
            load_chat($('.user_uid').val(), $('.users_list').find('.user-box-chat-screen > a').find('input[name="id"]').val());
        },1000)
    }


	$('body').on('click', '.user-box-chat-screen .delete-btn-wrapper > span', function (e){
		e.preventDefault();
		let $this = $(this);

		is_delete_button_clicked = true;

		jQuery.post( js_base_url, { fn: "del_chat", id: $(this).parents('.user-box-chat-screen').find('.id').val(), user_db_id: $(this).parents('.user-box-chat-screen').find('.user_db_id').val(), listings_id: $(this).parents('.user-box-chat-screen').find('.listing_title').val() })
			.done(function( data ) {

				$($this).parents('.user-box-chat-screen').fadeOut(1000, function (){
					$($this).parents('.user-box-chat-screen').remove();
				});

				is_delete_button_clicked = false;
			});
	});

    // Chat relevant interface --------------------------------------------------------------




	$('.chat-popup-wrapper .chat-popup .close-btn, .chat-popup-wrapper .chat-popup .header').click(function (e){
		e.preventDefault();
		let $this = $(this);
		let chat_dialog = $('.chat-box');

		$(this).toggleClass('open');

		$(chat_dialog).html(''); // clearing the chat box

		if ($(this).hasClass('open')){
			//Send ajax to DB to load the old chat.
			load_chat($($this).find('.from_md5_id').val(), $($this).find('.to_md5_id').val(), $(chat_dialog));
		}else {

			$('.chat-popup-wrapper .chat-popup .chat-body').slideToggle(110);
		}
	});

	$('.chat_box > .btn-chat').click(function (e){
		e.preventDefault();
		e.stopImmediatePropagation();

		let seller_id = $('.detail_page_seller_id').val();

		jQuery.post( js_base_url, { fn: "get_si", id: seller_id})
			.done(function( data ) {
				data = $.parseJSON(data);

				update_dynamic_chat_values(
					data.md5_id,
					data.username,
					seller_id,
					data.username
				);

				load_chat($('.from_md5_id').val(), data.md5_id,  $('.chat-box'));
			});
	});

	$('.chat_box_chat_image').on('change', function(e){
		//Get the first (and only one) file element
		//that is included in the original event
		var file = e.originalEvent.target.files[0],
			reader = new FileReader();
		//When the file has been read...
		reader.onload = function(evt){
			let html = '<a class="chat_image_anchor" href="#" target="_blank"><img class="img img-thumbnail img-sm img-bordered" src="'+evt.target.result+'" width="100"  /></a>';
			handle_send_message_chat_box(html);
		};
		//And now, read the image and base64
		reader.readAsDataURL(file);

	});

	$(document).on('click', '.chat_image_anchor', function (e){
		e.preventDefault();

		var newTab = window.open();
		newTab.document.body.innerHTML = '<img src="'+$(this).find('img').attr('src')+'" >';
 
	})
});

function handle_send_message(to_user){
	to_user = to_user || $(users_list).find('.user-box-chat-screen > a.active > input[name="id"]').val();

	if (! to_user || to_user === undefined || to_user.length < 1)
		return;

	send_message();
	$('.client_chat').val('');
	$('.client_chat_box').val('');
}

function handle_send_message_chat_box(chat_message){
	chat_message = chat_message || '';
	send_message_chat_box(chat_message);
	$('.client_chat_box').val('');
}

function load_chat(sender, recevier, chat_dialog){

	chat_dialog = chat_dialog || $('.chat_dialog');

	jQuery.post( js_base_url, { fn: "get_user_chat", sender: sender, rec: recevier,receiver_id :$('.logged_in_user_db_id').val(),listing_id:$('.chat_listing_id').val() })
		.done(function( data ) {
			
			$(chat_dialog).html(data).after(function (){

				$('.chat-popup').find('.header').addClass('open');

				$('.chat-popup-wrapper .chat-popup .chat-body').slideDown(110);
				$(chat_dialog).scrollTop(100000000);
			});
		});
}

function update_dynamic_chat_values(to_md5_id, to_username, to_user_db_id, chat_person_uname){
	$('.to_md5_id').val(to_md5_id);
	$('.to_username').val(to_username);
	$('.to_user_db_id').val(to_user_db_id);
	$('.chat-popup-wrapper').find('.chat-popup > .header > .username').text(chat_person_uname);

	$('.chat-popup-wrapper').removeClass('hidden');
}
