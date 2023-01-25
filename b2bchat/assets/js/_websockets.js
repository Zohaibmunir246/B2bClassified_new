const RECONNECT_IN_SEC = 10
let ws = {
	/**
	 * Start the connection
	 * @type {WebSocket}
	 */
	conn: null,
}

WebSocket.prototype.reconnect = function (callback) {

	if (this.readyState === WebSocket.OPEN || this.readyState !== WebSocket.CONNECTING) {
		this.close()
	}

	if ($('.connection_alert .error_reconnect_countdown').length > 0){
		let seconds = RECONNECT_IN_SEC;
		let container = dom('.connection_alert .error_reconnect_countdown')
		let countHandle = setInterval(() => {
			if (--seconds <= 0) {
				clearInterval(countHandle)
				delete container

				callback()
			}
			container.text(seconds.toString())
		}, 1000)
	}
}

let connect = function () {

	if (ws.conn) {
		if (ws.conn.readyState === WebSocket.OPEN || ws.conn.readyState == WebSocket.CONNECTING) {
			ws.conn.close()
		}
		delete ws.conn
	}

	ws.conn = new WebSocket('ws://' + socket_host + ':' + socket_port);

	/**
	 * Connection has been established
	 *
	 * @param {Event} event The onopen event
	 */
	ws.conn.onopen = function (event) {

		console.log('Connection established!');

		if ($('.connection_alert').length > 0){
			if (dom('.client_chat').length > 0){
				dom('.client_chat').prop('disabled', false)
			}
			dom('.connection_alert').hide();
			get_users_list_for_persistance();
			/**
			 * Register te client to the
			 * server. This allows the server
			 * to return a list of chat clients
			 * to list on the side.
			 */
			register_client();

			/**
			 * Request the user list from
			 * the server. If the server replies the user list
			 * will be populated.
			 */
			request_userlist()
		}else {
			/**
			 * Register te client to the
			 * server. This allows the server
			 * to return a list of chat clients
			 * to list on the side.
			 */
			register_client();
		}
	};

	/**
	 * A new message (read package) has been received.
	 *
	 * @param {Event} event the onmessage event
	 */
	ws.conn.onmessage = function (event) {
		let pkg = JSON.parse(event.data);

		if (pkg.type === 'message') {
			//console.log('nothing');

			//console.log(pkg);
			let sender = pkg.user.id;
			if ($('.user_uid').length < 1){
				// this is chat window.

				// load old chat from db
				load_chat($('.from_md5_id').val(), sender, $('.chat-body .chat-box'));

				update_dynamic_chat_values(
					pkg.user.id,
					pkg.user.username,
					pkg.user.db_id,
					pkg.user.username
				);
				dialog_output_chatbox(pkg);

				if ($('.chat_listing_id').val().length < 1){
					// it means its not the details page and we need to add listing id element by our self
					$('.chat_listing_id').val(pkg.listing_id);

					$('.chat-body').find('> .sub-header .title').text(pkg.listing_title);
				}
			}else {


				// this is full width chat page.

				let element = '';
				let list = $(users_list).find('.user-box-chat-screen');
				$(list).each(function (i, e){
					let id_input_el = $(e).find('input[name="id"]');
					if ($(id_input_el).val() === sender){
						element = $(e);
					}

					$(e).find('a').removeClass('active');
				});

				$(element).find('a').addClass('active');
				$('.client_chat').attr('disabled', false);
				$('.chat_btn').attr('disabled', false);

				// load old chat from db
				load_chat($('.user_uid').val(), $(element).find('input[name="id"]').val());

				dialog_output(pkg);

			}
		} else if (pkg.type === 'userlist') {
			let _package = pkg.details[0];

			users_output(pkg.users, _package);
		}
	}

	/**
	 * Notify the user that the connection is closed
	 * and disable the chat bar.
	 *
	 * @param {Event} event The onclose event
	 */
	ws.conn.onclose = function (event) {
		console.log('Connection closed!');

		if($('.client_chat').length > 0){
			dom('.client_chat').prop('disabled', true);
			dom('.connection_alert').show();
		}

		clear_userlist();


		if (event.target.readyState === WebSocket.CLOSING || event.target.readyState === WebSocket.CLOSED) {
			event.target.reconnect(connect)
		}
	}

	/**
	 * Display a message in the terminal if
	 * we run into an error.
	 *
	 * @param {Event} event The error event
	 */
	ws.conn.onerror = function (event) {
		console.log('We have received an error!')
	}
};

let users_list = $('.users_list');
let chat_dialog = $('.chat_dialog');

document.addEventListener('DOMContentLoaded', connect)

/**
 * Remove all users from the users on the
 * side of the screen.
 */
function clear_userlist() {
	/**
	 * First of all clear the current userlist
	 */

	$(users_list).html('');
}

/**
 * Put a package (message) on the screen
 * for you or others to read.
 *
 * @param {object} pkg - The package object to display
 */
function dialog_output(pkg) {
	let extra_class = '';

	if (dom('.user_uid').val() !== pkg.to_user) {
		extra_class = 'right';
	}else {
		extra_class = 'left';
	}

	if (pkg.to_user.length > 0) {
		$(chat_dialog).append('<div class="'+extra_class+'-msg msg-container"><div class="message-inner">' + pkg.message + '</div></div>');
		$(chat_dialog).animate({scrollTop: 10000000});
	} else {
		$(chat_dialog).append('<b>' + pkg.user.username + '</b>: ' + pkg.message + '<br/>')
	}
}
function dialog_output_chatbox(pkg) {
	let extra_class = '';

	if ($('.chat-popup').find('.from_md5_id').val() !== pkg.to_user) {
		extra_class = 'right';
	}else {
		extra_class = 'left';
	}

	let chat_box = $('.chat-box');

	if (pkg.to_user.length > 0) {
		$(chat_box).append('<div class="'+extra_class+'-msg msg-container"><div class="message-inner">' + pkg.message + '</div></div>');
		$(chat_box).animate({scrollTop: 1000000000});
	} else {
		$(chat_box).append('<b>' + pkg.user.username + '</b>: ' + pkg.message + '<br/>')
	}
}



/**
 * Update the user list in the UI
 *
 * @param {array} users Array of uses to display in the chatroom.
 */
function users_output(users, details) {

	console.log(details);

	/**
	 * First get the current select value
	 * on the list. This is so we can restore
	 * the selected list item after requesting
	 * fow new users.
	 */
	let selected_user = $(users_list).find('.user-box-chat-screen > a.active > input[name="id"]').val();

	/**
	 * Before we start adding users
	 * to the userlist make sure we erase
	 * all the old users of the screen.
	 */
		//clear_userlist();


	let available_items = $(users_list).find('input[name="id"]');

	/*
    // @todo: pending -- set offline user --- 1 is wrong approach as there may be more users.
    if (parseInt(Object.keys(users).length) === 1 ){
        $(available_items).each(function (i, e){
            if ($(e).val() === user.id){
                $(e).parents('a').removeClass('active');
                console.log($(available_items));
            }
        });
    }*/

	for (let connid in users) {
		if (users.hasOwnProperty(connid)) {
			let user = users[connid];

			if (chat_user.id === user.id)
				continue; // do not add html because this is the current user.


			let selected_class = '';
			if (selected_user === user.id){
				selected_class = 'active';
			}



			add_user_box_in_sidebar(user.username, user.id, user.db_id, selected_class);
		}
	}
}

/**
 * We need to register this browser window (client)
 * to the server. We do this so we can sent private
 * messages to other users.
 */
function register_client() {

	/**
	 * Create a registration package to send to the
	 * server.
	 */
	let pkg = {
		'user': chat_user, /* Defined in index.php */
		'type': 'registration',
	}

	pkg = JSON.stringify(pkg)

	/**
	 * Send the package to the server
	 */
	if (ws.conn && ws.conn.readyState === WebSocket.OPEN) {
		ws.conn.send(pkg)
	}
}

/**
 * Request a list of current active
 * chat users. We do this every x seconds
 * so we can update the ui.
 */
function request_userlist() {
	setInterval(function () {
		if (ws.conn.readyState !== WebSocket.CLOSING && ws.conn.readyState !== WebSocket.CLOSED) {

			/**
			 * Create a package to request the list of users
			 */
			let pkg = {
				'user': chat_user, /* Defined in index.php */
				'type': 'userlist',
			}



			/**
			 * We need a object copy of package
			 * to send to dialog_output() but we
			 * also want to turn the original package
			 * into a string so we can send it over the
			 * socket to the server.
			 *
			 * @type {{user, message: any}}
			 */
			pkg = JSON.stringify(pkg)
			if (ws.conn && ws.conn.readyState === WebSocket.OPEN) {
				ws.conn.send(pkg)
			}
		}
	}, 2000)
}

/**
 * Send a chat message to the server
 */
function send_message() {

	/**
	 * Catch the chat text
	 * @type {string}
	 */
	let chat_message = dom('.client_chat').val();
	if (typeof chat_message === 'undefined' || chat_message.length === 0) {
		dom('.client_chat ').addClass('error');
		setTimeout(() => {
			dom('.client_chat ').removeClass('error')
		}, 500);
		return
	}

	/**
	 * When to_user is empty the
	 * message will be sent to all users
	 * in the chat room.
	 * @type {string}
	 */

	/**
	 *  If a user is selected in the
	 *  userlist this will mean send messages
	 *  to that user.
	 */
	let to_user = $(users_list).find('.user-box-chat-screen > a.active > input[name="id"]').val();
	let selected_user_db_id = $(users_list).find('.user-box-chat-screen > a.active > input[name="user_db_id"]').val();

	let listing_id = 0;
	if (($('.listing_id').length < 1 || $('.listing_id').val() === '')){
		listing_id = $('.chat_listing_id').val();
	}else {
		listing_id = $('.listing_id').val();
	}

	/**
	 * Create a package to send to the
	 * server.
	 */
	let pkg = {
		'user': chat_user, /* Defined in index.php */
		'message': chat_message,
		'to_user': to_user,
		'type': 'message',
		'from_user_db_id': $('.logged_in_user_db_id').val(),
		'to_user_db_id': selected_user_db_id,
		'listing_id': listing_id,
	};

	console.log(pkg);

	/**
	 * We need a object copy of package
	 * to send to dialog_output() but we
	 * also want to turn the original package
	 * into a string so we can send it over the
	 * socket to the server.
	 *
	 * @type {{user, message: any}}
	 */
	let pkg_object = pkg;
	pkg = JSON.stringify(pkg);


	/**
	 * Send the package to the server
	 */
	if (ws.conn && ws.conn.readyState === WebSocket.OPEN) {
		ws.conn.send(pkg)
	}

	/**
	 * Display the message we just wrote
	 * to the screen.
	 */
	dialog_output(pkg_object);

	/**
	 * Empty the chat input bar
	 * we don't need it anymore.
	 */
	if (dom('.client_chat').length > 0){
		dom('.client_chat').val('')
	}
}
function send_message_chat_box(chat_message) {

	/**
	 * Catch the chat text
	 * @type {string}
	 */
	let chat_box_elem = $('.client_chat_box');

	chat_message = chat_message || $(chat_box_elem).val();
	if (typeof chat_message === 'undefined' || chat_message.length === 0) {
		$(chat_box_elem).addClass('error');
		setTimeout(() => {
			$(chat_box_elem).removeClass('error')
		}, 500);
		return
	}

	/**
	 * When to_user is empty the
	 * message will be sent to all users
	 * in the chat room.
	 * @type {string}
	 */

	/**
	 *  If a user is selected in the
	 *  userlist this will mean send messages
	 *  to that user.
	 */
	let to_user = $(chat_box_elem).parents('.chat-popup').find('.to_md5_id').val();
	let selected_user_db_id = $(chat_box_elem).parents('.chat-popup').find('.to_user_db_id').val();


	/**
	 * Create a package to send to the
	 * server.
	 */
	let pkg = {
		'user': chat_user, /* Defined in index.php */
		'message': chat_message,
		'to_user': to_user,
		'type': 'message',
		'from_user_db_id': $(chat_box_elem).parents('.chat-popup').find('.from_user_db_id').val(),
		'to_user_db_id': selected_user_db_id,
		'listing_id': $('.chat_listing_id').val(),
		'listing_title': $('.chat-body').find('> .sub-header .title').text()
	};



	/**
	 * We need a object copy of package
	 * to send to dialog_output() but we
	 * also want to turn the original package
	 * into a string so we can send it over the
	 * socket to the server.
	 *
	 * @type {{user, message: any}}
	 */
	let pkg_object = pkg;
	pkg = JSON.stringify(pkg);

	/**
	 * Send the package to the server
	 */
	if (ws.conn && ws.conn.readyState === WebSocket.OPEN) {
		ws.conn.send(pkg)
	}

	/**
	 * Display the message we just wrote
	 * to the screen.
	 */
	dialog_output_chatbox(pkg_object);

	/**
	 * Empty the chat input bar
	 * we don't need it anymore.
	 */
	if (dom('.client_chat').length > 0){
		dom('.client_chat').val('')
	}
}

// Actual function to generate the user box html and append into old chat sidebar.
function add_user_box_in_sidebar(username, md5_id, db_id, selected_class, listing_title, created_at, country_name, state_name, city_name, listing_id, price, currency_code, listing_image, last_message ){


	if (listing_title === undefined || listing_title === null){
		console.log("listing title not found");
		return;
	}


	listing_title = listing_title || 'N/A';
	if (listing_title.length < 1)
		listing_title = 'N/A';

	var html =
		'<div class="user-box-chat-screen">' +
		'<a href="#" class="'+ selected_class  +'">' +
		'<span class="image-wrapper">' +
		'<img src="https://img.icons8.com/bubbles/2x/user.png" alt="user-image" width="70" />' +
		'</span>' +
		'<span class="user-name-wrapper">' + username + '</span>' +
		'<span class="user_status_wrapper">' +
		'    <span class="title">User Status</span>' +
		'    <span class="user_status_offline"></span>' +
		'</span>' +
		'<div class="delete-btn-wrapper" >' +
		'<span href="#" class="delete-btn" ><i class="fa fa-trash-o"></i></span> ' +
		'</div>' +
		'<div class="listing_title">'+ listing_title +'</div>' +
		'<input type="hidden" class="username" name="username" value="' + username + '">' +
		'<input type="hidden" class="id" name="id" value="' + md5_id + '">' +
		'<input type="hidden" class="user_db_id" name="user_db_id" value="' + db_id + '">' +
		'<input type="hidden" class="listing_title" name="listing_title" value="' + listing_title + '">' +
		'<input type="hidden" class="listing_created_at" name="listing_created_at" value="' + created_at + '">' +
		'<input type="hidden" class="listing_country_name" name="listing_country_name" value="' + country_name + '">' +
		'<input type="hidden" class="listing_state_name" name="listing_state_name" value="' + state_name + '">' +
		'<input type="hidden" class="listing_city_name" name="listing_city_name" value="' + city_name + '">' +
		'<input type="hidden" class="listing_id" name="listing_id" value="' + listing_id + '">' +
		'<input type="hidden" class="listing_price" name="listing_price" value="' + price + '">' +
		'<input type="hidden" class="listing_currency_code" name="listing_currency_code" value="' + currency_code + '">' +
		'<input type="hidden" class="listing_image" name="listing_image" value="' + listing_image + '">' +
		'</a>' +
		'</div>';

	let found = false;
	/*

	//Found with ID

	let available_items = $(users_list).find('input[name="id"]');
	$(available_items).each(function (i, e){
		if ($(e).val() === md5_id){
			found = true;
		}
	});

	*/

	let available_items = $(users_list).find('input[name="listing_title"]');
	$(available_items).each(function (i, e){
		if ($(e).val() === listing_title){
			found = true;
		}
	});

	if (! found)
		$(users_list).append(html);

	update_right_chat_params(md5_id);
}

// update parameters in UI (in views/frontend/b2bchat/index.php)
function update_right_chat_params(md5_id) {
	let all_elems = $('.users_list').find('> .user-box-chat-screen > a');
	let ids_elem = $(all_elems).find('> .id');

	$(ids_elem).each(function (i, v){
		if ($(this).parent().find('.s-country-name').length < 1){
			$(v).after('<div class="s-country-name">Country: ' + $(this).parent().find('.listing_country_name').val());
		}
	});

	// set listing title
	let elem = $('.users_list > .active_chat > .listing_title');
	$('.b2b_chat_listing_title').text(elem.val());

	// set listing location
	$('.posted-in-info').find('.country').text($('.users_list > .active_chat > .listing_country_name').val());
	$('.posted-in-info').find('.state').text($('.users_list > .active_chat > .listing_state_name').val());
	$('.posted-in-info').find('.city').text($('.users_list > .active_chat > .listing_city_name').val());

	// set Date
	$('.listing-posted-date').text($('.users_list > .active_chat > .listing_created_at').val());

	// set price & currency code
	let price = $('.users_list > .active_chat > .listing_price').val();
	let currency_code = $('.users_list > .active_chat > .listing_currency_code').val();
	$('.listing_price').text(currency_code + " " + price);

	// Listing Image
	$('.listing_image > img').attr('src', $('.users_list > .active_chat > .listing_image').val());

	// set other vars -- if needs
}



// Add user box for old chat in the sidebar.
function get_users_list_for_persistance(){
	$.post( js_base_url, { fn: "get_user_list", accessor:chat_user })
		.done(function( data ) {
			if (data.length < 1)
				return;


			let receviers_data = $.parseJSON(data);

			$(receviers_data).each(function (i, e) {
				//make_log('', e);
				add_user_box_in_sidebar(
					e.username,
					e.md5_id,
					e.id,
					'',
					e.listing_title,
					e.listing_created_at,
					e.listing_country_name,
					e.listing_state_name,
					e.listing_city_name,
					e.listing_id,
					e.price,
					e.currency_code,
					e.listing_image,
					e.message
				)
			});
		});
}
get_users_list_for_persistance();


function make_log(text, e) {
	console.log('---');
	console.log(text);
	console.log(e);
	console.log('---');
}
