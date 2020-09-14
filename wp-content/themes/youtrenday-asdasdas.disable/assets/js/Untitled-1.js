// document.addEventListener('DOMContentLoaded', function() {  
//     window.onscroll = function() {myFunction()};

// 	var header = document.getElementById("masthead");
// 	var sidebar = document.getElementById("home-comp-details");
//     var sticky = header.offsetTop;

//     function myFunction() {
// 		if (window.pageYOffset > sticky) {
// 			sidebar.classList.add("sticky");
// 		} else {
// 			sidebar.classList.remove("sticky");
// 		}
//     }
// });
jQuery(document).ready(function ($){ 

	// $('.js-example-basic-multiple').select2();
	// $('.select2_select .gfield_select').select2();
	$('.custom_btngrp ul.gfield_radio').addClass("btn-group btn-group-toggle");
	// $('.custom_btngrp ul.gfield_radio li').addClass("w-50"); 
	$('.custom_fileupload input[type="file"]').addClass("rounded-pill"); 

	$("ul.dropdown-menu").parent().addClass("dropdown");
	$("ul.header_menu li.dropdown").addClass("dropdown-popup");
	$(".navbar-nav .dropdown-popup").append(
		'<span class="submenu-arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></span>'
	);
	$("a.dropdown-toggle").attr("data-toggle", "dropdown");

	$(window).bind("resize", function ()
		{
			if ($(this).width() < 993)
			{
				$(".desktop_menu").addClass("d-none");
				$(".menu_section").addClass("w-50");
				$(".profile_section").addClass("w-50 mx-auto");
				$(
					".user-profile-dropdown .polygon-each-img-wrap .submenu-arrow"
				).remove();
				$(".user-profile-dropdown .polygon-each-img-wrap").append(
					'<span class="submenu-arrow"><i class="fa fa-angle-down" aria-hidden="true"></i></span>'
				);
				$(".profile_section .user-profile-dropdown .submenu-arrow").on("click", function ()
				{
					$(this).parents(".dropdown-toggle").siblings(".dropdown-menu").toggleClass("show");
					if ($(this).parents(".dropdown-toggle").siblings(".dropdown-menu").hasClass("show"))
					{
						$(this).find("i").removeClass("fa-angle-down");
						$(this).find("i").addClass("fa-angle-up");
					}
					else
					{
						$(this).find("i").removeClass("fa-angle-up");
						$(this).find("i").addClass("fa-angle-down");
					}
				});
			}
			else
			{
				$(".desktop_menu").removeClass("d-none");
				$(".menu_section").removeClass("w-50");
				$(".profile_section").removeClass("w-50 mx-auto");
				$(".user-profile-dropdown .polygon-each-img-wrap .submenu-arrow").remove();
				$(".dropdown").each(function ()
				{
					var dropdown = $(this);
					dropdown.hover(function ()
					{
						dropdown.find(".dropdown-menu").toggleClass("show");
					});
				});
			}
		})
		.trigger("resize"); 
	$("body").on("click", ".mobile_menu .dropdown-popup .submenu-arrow", function ()
	{
		$(this).parent(".dropdown-popup").find(".sub-menus").toggleClass("show");
		$(this).find("i").toggleClass("fa-angle-up");
		if ($(this).parent(".dropdown-popup").find(".sub-menus").hasClass("show"))
		{
			$(".submenu-arrow").not($(this)).parent(".dropdown-popup").find(".sub-menus").removeClass("show");
			$(this).find("i").removeClass("fa-angle-down");
			$(this).find("i").addClass("fa-angle-up");
			$(".submenu-arrow").not($(this)).parents(".dropdown").find("i").addClass("fa-angle-down");
			$(".submenu-arrow").not($(this)).parents(".dropdown").find("i").removeClass("fa-angle-up");
		}
		else
		{
			$(this).find("i").removeClass("fa-angle-up");
			$(this).find("i").addClass("fa-angle-down");
		}
	});
	$(".testimonials_slider").slick(
	{
		slidesToShow: 2,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 1000000,
		arrows: false,
		dots: true,		 
		responsive: [
		{
			breakpoint: 480,
			settings:
			{
				arrows: false,
				centerMode: false,
				slidesToShow: 1,
			},
		}, ],
	}).on('setPosition', function () {
			$(this).find('.slick-slide').height('auto');
			var slickTrack = $(this).find('.slick-track');
			var slickTrackHeight = $(slickTrack).height();
			$(this).find('.slick-slide').css('height', slickTrackHeight + 'px');
	});
  
	var ppp = 6;
	var total_post = $(".total_posts").text(); 
	var posttype = $(".posttype").text(); 
	// alert(posttype);
	function load_posts(){
		var offset = $(".single-music").length;
		var str = "ppp=" + ppp + "&offset=" + offset + "&posttype=" + posttype + "&action=more_post_ajax";
		$.ajax(
		{
			type: "POST",
			dataType: "html",
			url: ajax_posts.ajaxurl,
			data: str,
			success: function (data)
			{
				var $data = $(data);
				if ($data.length)
				{
					$("#ajax-posts").hide().append($data).fadeIn(1000);
					var new_item_length = $(".single-music").length;
					if (new_item_length == total_post)
					{
						$("#load_more_posts").addClass("remove_item").removeClass("load_items");
						$("#load_more_posts").find("i").addClass("fa-minus ").removeClass("fa-plus");
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			},
		});
		return false;
	} 
	$("body").on("click", ".load_items", function (){
		load_posts();
	});
	$("body").on("click", ".remove_item", function (){
		$("#load_more_posts").addClass("load_items").removeClass("remove_item");
		$("#load_more_posts").find("i").addClass("fa-plus").removeClass("fa-minus");
		$("#ajax-posts").empty();
		$("#ajax-posts").fadeOut(1000).hide();
	});
	 
	$(".delete_music_a").click(function(){
		// alert($(this).data("postid"));
		var mus_id = $(this).data("postid");
		var mus_title = $(this).data("posttitle");
		$(".music_id").val(mus_id);
		$(".music_title").text('"' + mus_title + '"?');
	});
	var cpp = 4;
	var total_cats = $(".total_cats").text();  
	var cat_ids =  $(".musc_arr").val();   
	function load_masTax_posts()
	{
		var offset = $(".musics-data").length;
		// alert("offset = " + offset );
		var str = "cpp=" + cpp + "&offset=" + offset + "&action=more_muscTax_ajax";
		$.ajax(
		{
			type: "POST",
			dataType: "html",
			url: ajax_posts.ajaxurl,
			data: str,
			success: function (data)
			{ 
				var $data = $(data);
				if ($data.length)
				{
					$("#ajax_musCat").hide().append($data).fadeIn(1000);
					common_play_buttons();
					// $(".play_pause_buttons").each(function( i ) {
					// 	var count = 0;   
					// 	$(this).on("click", '.pause_btn', function (){
					// 		count += 1; 
					// 		if(count == 1){
					// 			var video_url = $(this).parents(".main_item").find('.video_url').val(); 
					// 			$(this).parents(".main_item").find('.video').show();
					// 			$(this).parents(".main_item").find('.video').attr('src', video_url);	
					// 			$(this).parents(".main_item").find('.image_thumb').hide();
					// 		} 
					// 		$(this).addClass("is_playing"); 
					// 		$(this).addClass("play_btn fa-pause-circle-o").removeClass("pause_btn fa-play-circle-o"); 
					// 		$(this).parents(".main_item").find('.video').trigger('play');  
					// 	}); 
					// 	$(this).on("click", '.play_btn', function (){ 
					// 		$(this).removeClass("is_playing");
					// 		$(this).addClass("pause_btn fa-play-circle-o").removeClass("play_btn fa-pause-circle-o");
					// 		$(this).parents(".main_item").find('.video').trigger('pause');  
					// 	});
					// });
					var new_item_length = $(".musics-data").length;
					if (new_item_length == total_cats)
					{
						$("#load_more_categories").addClass("remove_musCat").removeClass("load_items");
						$("#load_more_categories").find("i").addClass("fa-minus ").removeClass("fa-plus");
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				$loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
			},
		});
		return false;
	}

	$("body").on("click", ".load_musCat", function (){
		load_masTax_posts();
	});
	$("body").on("click", ".remove_musCat", function (){
		$("#load_more_categories").addClass("load_musCat").removeClass("remove_musCat");
		$("#load_more_categories").find("i").addClass("fa-plus").removeClass("fa-minus");
		$("#ajax_musCat").empty();
		$("#ajax_musCat").fadeOut(1000).hide();
	});

	$(".from_youtube").hide();
	$("input[name='media_from']").change(function(){  
		var type_val = $(this).val();
		if(type_val == 'media_system'){
			$(".from_system").show();
			$(".from_youtube").hide();	
			$('#youtubeResult').addClass('d-none');
		}else{
			$(".from_youtube").show();
			$(".from_system").hide(); 
			$('#videoMp3Result').attr('src', '');
			$('#imageResult').attr('src', ''); 
			$('#videoMp3Result').addClass('d-none');
			$('#imageResult').addClass('d-none'); 
		}
	});  
	  
	$('#youtube_url').keyup(function() { 
		var url = $(this).val(); 
		$('#youtubeResult').removeClass('d-none');
		$('#youtubeResult').attr('src', url); 
	}); 
	var tag = document.createElement('script');

	tag.src = "https://www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	landing_play_buttons();
	common_play_buttons();
	
	// $(window).scroll(function() {
	// 	$('video').each(function() {
	// 		if ($(this).visible(true)) {
	// 			$(this)[0].play();
	// 		} else {
	// 			$(this)[0].pause();
	// 		}
	// 	})
	// });
	$(".gform_wrapper .custom_competprice_cls input").attr("readonly", "readonly");
	$(".ginput_cardextras .ginput_card_expiration_container").parent().removeClass("ginput_cardinfo_left");
	$(".ginput_cardextras .ginput_card_security_code").parent().removeClass("ginput_cardinfo_right");
	$("#input_6_11_5_container").insertBefore("#input_6_11_1_container");
	$(".gform_card_icon_container").insertBefore(".ginput_container_creditcard");
	$(".ginput_card_security_code_icon").addClass("d-none");
	$( ".address_line_1 label" ).append( "<span class='gfield_required'>*</span>" );
	$( ".address_city label" ).append( "<span class='gfield_required'>*</span>" );
	$( ".address_zip label" ).append( "<span class='gfield_required'>*</span>" );
	$( ".address_country label" ).append( "<span class='gfield_required'>*</span>" );
	$( ".ginput_container_creditcard label" ).append( "<span class='gfield_required'>*</span>" );
	$( ".ginput_cardextras .ginput_card_security_code" ).attr('type', 'password' );
	$( "#gform_6 .ginput_container_textarea" ).append('<div class="charleft ginput_counter">Minimum 30 Characters</div>' );
	$( ".gform_button.button" ).addClass('for-button-style' );
	$( ".bbp-submit-wrapper .user-submit" ).addClass('for-button-style' );
	
	$('.card-body').on('show.bs.collapse', function () {
		$(this).siblings('.card-header-cust').find(".card-title ").text('Read the summary');
	  });
	
	$('.card-body').on('hide.bs.collapse', function () {
		$(this).siblings('.card-header-cust').find(".card-title ").text('Reat in Full');
	});

	// Upload user Profile
	$uploadCrop = $('#upload-demo').croppie( {
		enableExif: true,
		viewport: {
			width: 250,
			height: 250,
			type: 'square'
		},
		boundary: {
			// width: 400,
			height: 400
		}  
	}); 
	$('.cr-image').hide();
	$('.profil-page-profile img.avatar').addClass("polygon-clip-hexagon");
	$('#upload').on('change', function () { 
		var reader = new FileReader();
		reader.onload = function (e) {
			$uploadCrop.croppie('bind', {
				url: e.target.result
			}).then(function(){  
				$('.cr-image').show();
			});
			
		}
		reader.readAsDataURL(this.files[0]);
	}); 
	
	// Edit User Profile Image
	$('.upload-result').on('click', function (ev) {
		$uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (resp) {  
			var str = "image=" + resp + "&action=edit_upload_user_image";
			$.ajax({
				url: ajax_posts.ajaxurl,
				type: "POST",
				// dataType: "html",
				data: str,
				success: function (data) { 
					html = '<img src="' + resp + '" />';
					$("#upload-demo-i").html(html);
					var url      = window.location.href;  
					window.location.href = url;   
				}
			});
		});
	});

	jQuery(".editfield input[type='radio']").change(function(){ 
		jQuery(".option-label.checked").removeClass("checked");
		if(jQuery(this).prop("checked")){
			jQuery(this).parent().addClass('checked');
		}
	}); 
	// $("#all_users_posts_row").addClass("d-none");
	// $("#all_users_posts_row").hide();
	// // $("#all_posts").addClass("d-none"); 
	// $('.paid_videos').on('click', function (ev) {
	// 	// $('.paid_videos').addClass('active1');
	// 	// $('.all_user_posts').removeClass('active1');
	// 	$("#user_paid_videos_row").removeClass('d-none'); 
	// 	$("#all_users_posts_row").addClass("d-none");
	// 	$("#user_paid_videos_row").show("fade", {}, 1000);
	// 	$("#all_users_posts_row").hide("fade", {}, 1000);
	// 	// $("#competition_videos").removeClass('d-none'); 
	// 	// $("#all_posts").addClass("d-none"); 
	// });
	 
	// $('.all_user_posts').on('click', function (ev) {
	// 	// $('.paid_videos').removeClass('active1');
	// 	// $('.all_user_posts').addClass('active1');
	// 	$("#user_paid_videos_row").addClass('d-none'); 
	// 	$("#all_users_posts_row").removeClass("d-none");
	// 	$("#user_paid_videos_row").hide("fade", {}, 1000);
	// 	$("#all_users_posts_row").show("fade", {}, 1000);
	// 	// $("#competition_videos").addClass('d-none'); 
	// 	// $("#all_posts").removeClass("d-none"); 
	// });

	  
	$("#all_users_posts_row").hide();
	$('.paid_videos').on('click', function (ev) {
		$("#user_paid_videos_row").removeClass('d-none'); 
		$("#all_users_posts_row").addClass("d-none");
		$("#user_paid_videos_row").show("fade", {}, 1000);
		$("#all_users_posts_row").hide("fade", {}, 1000);
	});
	$('.all_user_posts').on('click', function (ev) {
		$("#user_paid_videos_row").addClass('d-none'); 
		$("#all_users_posts_row").removeClass("d-none");
		$("#user_paid_videos_row").hide("fade", {}, 1000);
		$("#all_users_posts_row").show("fade", {}, 1000);
	});

	$( "#bbp_search_submit" ).wrap( "<span class='bb_ctm_btn'></span>" );

	$(".collapse.show").each(function(){
		$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
	}); 
	// Toggle plus minus icon on show hide of collapse element
	$(".collapse").on('show.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
	}).on('hide.bs.collapse', function(){
		$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
	});

	
	$(document).on( "click", '.like_share_dislike .com_cls',  function (){
		var postaction =  $(this).find("a").data("postaction");  
		var postid =  $(this).find("a").data("postid");
		var userid =  $(this).find("a").data("userid");
		var actionData = "postaction="+postaction+"&postid=" + postid + "&userid=" + userid + "&action=like_post_ajax"; 
		$.ajax({
			url: ajax_posts.ajaxurl,
			type: "POST",
			dataType: "json",
			data: actionData,
			context: this,
			success: function (data) {   
				// alert(data.postaction );
				if(data){ 
					if(data.postaction == 'like'){
						if(data.like_count != null && data.like_count != ''){  
							$(this).find(".likes_count").text(data.like_count); 
						}  
						if(data.dislike_count != null && data.dislike_count != ''){ 
							$(this).siblings(".dislike_mus_comp").find('.dislikes_count').text(data.dislike_count);
						}    
						$(this).find("a").data("postaction", 'unlike');
						var postaction1 =  $(this).find("a").data("postaction"); 
						// alert('Like = ' + postaction1);
						$(this).find("a").addClass("unlike_a");  
						$(this).siblings(".dislike_mus_comp").find('a').addClass("dislike_a").removeClass("remove_dislike_a");  
						$(this).find("a").removeClass("like_a");
					}else if(data.postaction == 'unlike'){
						if(data.like_count != null && data.like_count != ''){  
							$(this).find(".likes_count").text(data.like_count);
						}  
						if(data.dislike_count != null && data.dislike_count != ''){ 
							$(this).siblings(".dislike_mus_comp").find('.dislikes_count').html(data.dislike_count);
						}    
						$(this).find("a").data("postaction", 'like');
						var postaction2 =  $(this).find("a").data("postaction");
						// alert('Un like = ' + postaction2);
						$(this).find("a").addClass("like_a"); 
						$(this).find("a").removeClass("unlike_a");  
					}else if(data.postaction == 'dislike'){
						if(data.dislike_count != null && data.dislike_count != ''){ 
							$(this).find('.dislikes_count').text(data.dislike_count);
						}  
						if(data.like_count != null && data.like_count != ''){ 
							$(this).siblings(".like_mus_comp").find('.likes_count').text(data.like_count);
						}   
						$(this).find("a").data("postaction", 'remove_dislike');
						var postaction3 =  $(this).find("a").data("postaction");
						// alert('Dislike = ' + postaction3);
						$(this).find("a").addClass("remove_dislike_a");  
						$(this).siblings(".like_mus_comp").find('a').addClass("like_a").removeClass("unlike_a"); 
						$(this).find("a").removeClass("dislike_a");  
					}else if(data.postaction == 'remove_dislike'){
						if(data.dislike_count != null && data.dislike_count != ''){ 
							$(this).find(".dislikes_count").text(data.dislike_count);
						}  
						if(data.like_count != null && data.like_count != ''){ 
							$(this).siblings(".like_mus_comp").find('.likes_count').text(data.like_count);
						}   
						$(this).find("a").data("postaction", 'dislike');
						var postaction4 =  $(this).find("a").data("postaction");
						// alert('Remove Dislike = ' + postaction4);
						$(this).find("a").addClass("dislike_a"); 
						$(this).find("a").removeClass("remove_dislike_a");  
					}
					
				}
			}
		}); 

	});
	 
	// Show Share post in Modal
	$('.share-post').on('click', function (ev) {
		var postid = $(this).data("postid");
		var userid = $(this).data("userid");
		var actionData = "postid=" + postid + "&userid=" + userid + "&action=showdata_in_modal_ajax";
		$.ajax({
			url: ajax_posts.ajaxurl,
			type: "POST",
			dataType: "JSON",
			data: actionData,
			success: function (data) {  
				var id = data.post_id;
				var title = data.title;
				var url = data.url;
				var desc = data.desc;
				var thumbnail = data.thumbnail;
				$("meta[property='og\\:url']").attr("content", url);
				$("meta[property='og\\:title']").attr("content", title);
				$("meta[property='og\\:description']").attr("content", desc);
				$("meta[property='og\\:image']").attr("content", thumbnail);

				$("meta[name='title']").attr("content", title);
				$("meta[name='description']").attr("content", desc);
 
				$("meta[name='twitter\\:title']").attr("content", title);
				$("meta[name='twitter\\:description']").attr("content", desc);
				$("meta[name='twitter\\:image']").attr("content", thumbnail);
 
				var facebook_url = 'https://www.facebook.com/sharer/sharer.php?u='+ url; 
				var twitter_url =  'https://twitter.com/intent/tweet?text=' + title + '&url=' + url; 
				var pinterest_url = 'https://pinterest.com/pin/create/button/?url='+ url + '&description='+ desc;
				var reddit_url = 'https://www.reddit.com/submit?url='+ url +'&title='+ title ;
				 
				$('.social-sharing-icon').attr("data-id", id); 
				$('.social-sharing-icon').attr("data-url", url);
				$('.social-sharing-icon').attr("data-title", title); 
				$('.social-sharing-icon').attr("data-desc", desc); 
				$('.social-sharing-icon').attr("data-image", thumbnail); 

				$('.social-sharing-icon-facebook').attr("href", facebook_url);
				$('.social-sharing-icon-twitter').attr("href", twitter_url);
				$('.social-sharing-icon-pinterest').attr("href", pinterest_url);
				$('.social-sharing-icon-reddit').attr("href", reddit_url);
				$('.social-sharing-icon-twitter').attr("data-postid", id); 
				$(".share_post_modal").modal(); 
			}
		});
	});   
	var comp_id = getUrlVars()["comp_id"]; 
	if(comp_id){ 
		hide_show_plan();
		upload_form_2_hide_show();
		// Button 1 
		var radio_1_text  = $(".custom_comp_plan #label_6_16_0").text(); 
		var value1 = $(".custom_comp_plan #choice_6_16_0").val();
		$(".custom_comp_plan #choice_6_16_0").appendTo(".custom_comp_plan #label_6_16_0");
	  
		// var radio_1_val = value1.match(/\d+/); \
		var  radio_1_val; 
		if (typeof value1 == 'undefined') {   
            radio_1_val = '';
        }  else{ 
            var regular_ex=/\d+/;
            var matches = value1.match(regular_ex);
            var radio_1_val = matches.join(''); 
		}
		
		$(".custom_comp_plan #label_6_16_0").append('<div class="panel panel-default card-input"><div class="panel-body py-2 px-3"><div class="pack-one"><h5>' + radio_1_text +'</h5><p> 3 Badges </p>	<img src="../wp-content/themes/youtrenday/assets/images/singer.png"><h3 class="text-left pack-prize position-relative discounted"> $45 <span class="plan_prize">$'+ radio_1_val +'</span></h3><p class="discounted-text">Savings of just below 50%</p></div></div></div>');

		// // Button 2
		var radio_2_text = $(".custom_comp_plan #label_6_16_1").text();
		var value2 = $(".custom_comp_plan #choice_6_16_1").val();
		$(".custom_comp_plan #choice_6_16_1").appendTo(".custom_comp_plan #label_6_16_1"); 
		 
		var radio_2_val;
		if (typeof value2 == 'undefined') {   
            radio_2_val = '';
        } else{ 
            var regular_ex=/\d+/;
            var matches = value2.match(regular_ex);
            var radio_2_val = matches.join('');  
		}
		
		$(".custom_comp_plan #label_6_16_1").append('<div class="panel panel-default card-input"><div class="panel-body py-2 px-3"><div class="pack-two"><h5>' + radio_2_text +'</h5><p> 2 Badges </p>	<img src="../wp-content/themes/youtrenday/assets/images/singer.png"><h3 class="text-left pack-prize position-relative discounted"> $30 <span class="plan_prize">$'+ radio_2_val +'</span></h3><p class="discounted-text">Savings of over 15%</p></div></div></div>');

		// Button 3
		var radio_3_text = $(".custom_comp_plan #label_6_16_2").text();
		var value3 = $(".custom_comp_plan #choice_6_16_2").val();
		$(".custom_comp_plan #choice_6_16_2").appendTo(".custom_comp_plan #label_6_16_2");
	 
		var radio_3_val;
		if (typeof value3 == 'undefined') {   
            radio_3_val = '';
        } else{ 
            var regular_ex=/\d+/;
            var matches = value3.match(regular_ex);
            var radio_3_val = matches.join(''); 
		}
		$(".custom_comp_plan #label_6_16_2").append('<div class="panel panel-default card-input"><div class="panel-body py-2 px-3"><div class="pack-two"><h5>' + radio_3_text +'</h5><p> 1 Badge </p>	<img src="../wp-content/themes/youtrenday/assets/images/singer.png"><h3 class="text-center pack-prize position-relative"> $'+ radio_3_val +' </h3></div></div></div>');

		if($(".custom_fileupload label .gfield_required").length  === 0 ) {
			$( ".custom_fileupload label" ).append( "<span class='gfield_required'>*</span>" );
		} 
		if($(".custom_youtube label .gfield_required").length  === 0 ) {
			$( ".custom_youtube label" ).append( "<span class='gfield_required'>*</span>" );
		}  
		if($(".custom_soundcloud label .gfield_required").length  === 0 ) {
			$( ".custom_soundcloud label" ).append( "<span class='gfield_required'>*</span>" );
		} 
		if($(".custom_spotify label .gfield_required").length  === 0 ) {
			$( ".custom_spotify label" ).append( "<span class='gfield_required'>*</span>" );
		} 
		if($(".custom_question_answer label .gfield_required").length  === 0 ) {
			$( ".custom_question_answer label" ).append( "<span class='gfield_required'>*</span>" );
		} 
		if($(".custom_question_answer label .gfield_required").length  === 0 ) {
			$( ".custom_question_answer label" ).append( "<span class='gfield_required'>*</span>" );
		} 
		jQuery('.custom_comp_plan .gfield_radio input[type=radio]').change("click", function() { 
			hide_show_plan(); 
			selected_plan = jQuery(".hidden_selected_plan input[name='input_26']:checked").val(); 
			// alert(selected_plan);
			if(selected_plan == 'pre_pack' ){
				jQuery(".compit_fileupload_2").show();
				jQuery(".compit_youtube_2").hide();  
				jQuery(".compit_soundcloud_2").hide();  	
				jQuery(".compit_spotify_2").hide();	 
			}else if(selected_plan == 'standard_plan' ){
				jQuery(".compit_fileupload_2").show();
				jQuery(".compit_youtube_2").hide();  
				jQuery(".compit_soundcloud_2").hide();  	
				jQuery(".compit_spotify_2").hide();	 
			}else if(selected_plan == 'starter_plan'){
				jQuery(".compit_fileupload_2").hide();
				jQuery(".compit_youtube_2").hide();  
				jQuery(".compit_soundcloud_2").hide();  	
				jQuery(".compit_spotify_2").hide();	  
			} 
		});   
		jQuery('.compet_upload_from_1 .gfield_radio input[name=input_9]').change("click", function() { 
			hide_show_plan();  
			// upload_form_2_hide_show();
		});   
		jQuery('.compet_upload_from_2 .gfield_radio input[name=input_35]').change("click", function() { 
			hide_show_plan(); 
			// upload_form_2_hide_show();
		});   
		jQuery('.compet_upload_from_3 .gfield_radio input[name=input_34]').change("click", function() { 
			hide_show_plan();  
		});   
	} 
	selected_plan_type = jQuery(".hidden_freepaid_plan input[name='input_28']:checked").val(); 
	// alert(selected_plan_type);
	if(selected_plan_type == 'free_pack'){
		$( '.custom_question_answer' ).removeClass( "d-none" ); 
		$( '.premium_field_cls').addClass( "d-none" );
	}else{
		$( '#gform_6 .custom_question_answer' ).addClass( "d-none" ); 
		$( '#gform_6 .custom_question_answer' ).removeClass( "d-block" ); 
	}
	$('.registration_btm_subtext').on('click', function (ev) {
		var tgcls = $( '.premium_field_cls' ).toggleClass( "showhide_premium_field d-none" ); 
		$( '.custom_question_answer' ).removeClass( "d-none" ); 
		if(tgcls.hasClass('showhide_premium_field d-none')){
			jQuery(".hidden_freepaid_plan input[value='free_pack']").prop('checked', true); 
			$( '.custom_question_answer' ).removeClass( "d-none" ); 
		}else {
			jQuery(".hidden_freepaid_plan input[value='paid_plan']").prop('checked', true);  
			$( '.custom_question_answer' ).addClass( "d-none" ); 
		}  
	});  
	var total_posts = $(".total_all_posts").text(); 
	var total_videos = $(".total_comp_videos").text(); 
	var ready = true; //Assign the flag here
	var postready = true; 
	 
	var $window = jQuery(window);
	
	$(window).scroll("scroll", function(){ 
 
		jQuery(".home_video_compvideo").each(function( i ) { 
			var $topOfVideo =jQuery(this).offset().top;
			var $bottomOfVideo = jQuery(this).offset().top + jQuery(this).outerHeight();
		
			var $topOfScreen = $window.scrollTop();
			var $bottomOfScreen = $window.scrollTop() + $window.innerHeight();
			
			if(($bottomOfScreen > $bottomOfVideo) && ($topOfScreen < $topOfVideo)){ 
				jQuery(this).trigger('play');
			} else {  
				jQuery(this).trigger('pause');
			}
		});
	
		jQuery(".home_video_all").each(function( i ) { 
			var $topOfVideo =jQuery(this).offset().top;
			var $bottomOfVideo = jQuery(this).offset().top + jQuery(this).outerHeight();
		
			var $topOfScreen = $window.scrollTop();
			var $bottomOfScreen = $window.scrollTop() + $window.innerHeight();
			
			if(($bottomOfScreen > $bottomOfVideo) && ($topOfScreen < $topOfVideo)){ 
				jQuery(this).trigger('play');
			} else {  
				jQuery(this).trigger('pause');
			}
		}); 

		var offset_post = $(".home_post").length;
		var offset_video = $(".home_video").length;  
		if ( $(window).scrollTop() + $(window).height() == $(document).height()  ){  
			if(ready && $( '.home_tabs a[data-toggle="tab"]' ).hasClass("paid_videos active")){    
				ready = false;
				var str = "offset=" + offset_video  +"&action=infinite_scroll_videos"; 
				if(offset_video < total_videos){
					$(".video_loader").removeClass('d-none').addClass("d-flex");
					$.ajax({
						type: "POST",
						dataType: "html",
						url: ajax_posts.ajaxurl,
						data: str,
						success: function (data)
						{    
							if (data.length)
							{
								$(".video_loader").addClass('d-none').removeClass('d-flex');
								var html = '';
								var pasreData = jQuery.parseJSON(data);
								$.each(pasreData.result, function( index, value ) { 
									html += '<div class="col-md-12 main_videos home_video">'+ value.media +'</div>';
								}); 
								$("#ajax_compvideos").append(html);  
								ready = true; 
							}
						}, 
					});
				}else{
					$(".video_loader").addClass('d-none').removeClass('d-flex');
				}
			} 
			if(postready && $( '.home_tabs a[data-toggle="tab"]' ).hasClass("all_user_posts active")){ 
				postready = false;  
				var str = "offset=" + offset_post + "&action=infinite_scroll_allposts";
				if(offset_post < total_posts){
					$(".all_post_loader").removeClass('d-none').addClass("d-flex");
					$.ajax({
						type: "POST",
						dataType: "html",
						url: ajax_posts.ajaxurl,
						data: str,
						success: function (data)
						{   
							if (data.length)
							{
								$(".all_post_loader").addClass('d-none').removeClass('d-flex');
								var html = '';
								var pasreData = jQuery.parseJSON(data);
								$.each(pasreData.result, function( index, value ) { 
									html += '<div class="col-md-12 main_videos home_post">'+ value.media +'</div>';
								}); 
								$("#ajax_allposts_home").append(html);  
								postready = true; 
							}
						}, 
					});
				}else{
					$(".all_post_loader").addClass('d-none').removeClass('d-flex');
				}
			}  
		}  
	});
  
	// equalheight('.page-template-template-about .team-member'); 
	// equalheight('#gform_wrapper_6 .panel.panel-default.card-input');
	// equalheight('#gform_wrapper_6 .panel-body h5');
	equalheight('.page-template-template-about .prize-content');
	equalheight('.common_sidebar .side-content');
	$(".team_row").each(function(i, obj) { 
		equalheight('.page-template-template-about .team_row:eq('+i+') .team-member');  
	}); 

}); 
function hide_show_plan(){
	selected_plan_val = jQuery(".custom_comp_plan input[name='input_16']:checked").val();
	var number;
	if (typeof selected_plan_val == 'undefined') {   
		number = '';
	} else{ 
		var regular_ex=/\d+/;
		var matches = selected_plan_val.match(regular_ex);
		var number = matches.join(''); 
	} 
	// var number = selected_plan_val.match(/(\d+)/g);
	jQuery(".custom_competprice_cls .ginput_product_price").text("$"+number+".00");
	selected_plan = jQuery(".custom_comp_plan input[name='input_16']:checked").attr('id'); 
 
	if(selected_plan == 'choice_6_16_0' ){
		jQuery(".hidden_selected_plan input[value='pre_pack']").prop('checked', true); 
	}else if(selected_plan == 'choice_6_16_1' ){
		jQuery(".hidden_selected_plan input[value='standard_plan']").prop('checked', true); 
	}else if(selected_plan == 'choice_6_16_2'){
		jQuery(".hidden_selected_plan input[value='starter_plan']").prop('checked', true); 
	}
}
function upload_form_2_hide_show(){  
	selected_from_1= jQuery(".compet_upload_from_1 input[name='input_9']:checked").val(); 
	selected_from_2 = jQuery(".compet_upload_from_2 input[name='input_35']:checked").val(); 
	selected_from_3 = jQuery(".compet_upload_from_3 input[name='input_34']:checked").val(); 


	// alert(selected_from_1);
	// alert(selected_from_2);
	// alert(selected_from_3);
	selected_from_2 = jQuery(".compet_upload_from_2 input[name='input_35']:checked").val(); 
   
	if(selected_from_2 == 'comp_from_computer' ){
		jQuery(".compit_fileupload_2").show();
		jQuery(".compit_youtube_2").hide();  
		jQuery(".compit_soundcloud_2").hide();  	
		jQuery(".compit_spotify_2").hide();	 
	}else if(selected_from_2 == 'comp_from_yoututbe' ){
		jQuery(".compit_fileupload_2").hide();
		jQuery(".compit_youtube_2").show();  
		jQuery(".compit_soundcloud_2").hide();  	
		jQuery(".compit_spotify_2").hide();	 
	}else if(selected_from_2 == 'comp_from_soundcloud'){
		jQuery(".compit_fileupload_2").hide();
		jQuery(".compit_youtube_2").hide();  
		jQuery(".compit_soundcloud_2").show();  	
		jQuery(".compit_spotify_2").hide();	  
	}else if(selected_from_2 == 'comp_spotify'){
		jQuery(".compit_fileupload_2").hide();
		jQuery(".compit_youtube_2").hide();  
		jQuery(".compit_soundcloud_2").hide();  	
		jQuery(".compit_spotify_2").show();	  
	}else{
		jQuery(".compit_fileupload_2").hide();
		jQuery(".compit_youtube_2").hide();  
		jQuery(".compit_soundcloud_2").hide();  	
		jQuery(".compit_spotify_2").hide();	
	}
	 
}  

function landing_play_buttons(){
	jQuery(".video-section .play_pause_buttons").each(function( i ) {
		var count = 0;   
		jQuery(this).on("click", '.pause_btn', function (){
			count += 1; 
			if(count == 1){
				var video_url = jQuery(this).parents(".main_item").find('.video_url').val(); 
				jQuery(this).parents(".main_item").find('.video').show();
				jQuery(this).parents(".main_item").find('.video').attr('src', video_url);	
				jQuery(this).parents(".main_item").find('.image_thumb').hide();
			} 
			jQuery(this).addClass("is_playing"); 
			jQuery(this).addClass("play_btn fa-pause-circle-o").removeClass("pause_btn fa-play-circle-o"); 
			
			// setInterval(function() {
				jQuery(this).parents(".main_item").find('.video').trigger('play');  
				// $(this).parents(".main_item").find('.video').play();
				// $(this).parents(".main_item").find('.video').get(0).playVideo();
				// $(this).parents(".main_item").find('.video').get(0).play(); 
			// }, 1000);

		}); 
		jQuery(this).on("click", '.play_btn', function (){ 
			jQuery(this).removeClass("is_playing");
			jQuery(this).addClass("pause_btn fa-play-circle-o").removeClass("play_btn fa-pause-circle-o");
			
			// setInterval(function() {
				jQuery(this).parents(".main_item").find('.video').trigger('pause');   
				// $(this).parents(".main_item").find('.video').pause(); 
				// $(this).parents(".main_item").find('.video').get(0).pauseVideo();
				// $(this).parents(".main_item").find('.video').get(0).pause(); 
			// }, 1000);

		});
	});
}
function common_play_buttons(){
	jQuery(".cat-music-list .main_item").each(function( i ) {
		var count = 0;   
		jQuery(this).on("click", function (){
			count += 1; 
			if(count == 1){
				var video_url = jQuery(this).find('.video_url').val(); 
				jQuery(this).find('.video').show();
				jQuery(this).find('.video').attr('src', video_url);	
				jQuery(this).find('.image_thumb').hide();
			} 
			var result = jQuery(this).find(".play_pause_buttons").toggleClass("is_playing") ;  
			// jQuery(this).find('.video').trigger('play'); 
			jQuery(this).find("i").addClass("play_btn fa-pause-circle-o").removeClass("pause_btn fa-play-circle-o"); 
			  
			if(result.hasClass('is_playing') === true){
				jQuery(this).find('.video').trigger('play');
			}else{
				jQuery(this).find('.video').trigger('pause'); 
			}
		});  
	});
} 
//play when video is visible
var videos = document.getElementsByTagName("iframe"), fraction = 0.8;

function checkScroll() {

  for(var i = 0; i < videos.length; i++) {
    var video = videos[i];

    var x = 0,
        y = 0,
        w = video.width,
        h = video.height,
        r, //right
        b, //bottom 
        visibleX, visibleY, visible,
        parent;

    
    parent = video;
    while (parent && parent !== document.body) {
      x += parent.offsetLeft;
      y += parent.offsetTop;
      parent = parent.offsetParent;
    }

    r = x + parseInt(w);
    b = y + parseInt(h);
   

    visibleX = Math.max(0, Math.min(w, window.pageXOffset + window.innerWidth - x, r - window.pageXOffset));
    visibleY = Math.max(0, Math.min(h, window.pageYOffset + window.innerHeight - y, b - window.pageYOffset));
    

    visible = visibleX * visibleY / (w * h);


    if (visible > fraction) {
      playVideo();
    } else {
      pauseVideo();

    }
  }

}; 
var tag = document.createElement('script'); 
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;

function onYouTubeIframeAPIReady() {
  player = new YT.Player('player', {
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange
    }
  });
};

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    window.addEventListener('scroll', checkScroll, false);
    window.addEventListener('resize', checkScroll, false);

    //check at least once so you don't have to wait for scrolling for the    video to start
    window.addEventListener('load', checkScroll, false);
};
 
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING) {
      //console.log("event played");
    } else {
      //console.log("event paused");
    }
};

function stopVideo() {
    player.stopVideo();
};

function playVideo() {
  player.playVideo();
};

function pauseVideo() {
  player.pauseVideo();
};


equalheight = function(container){

	var currentTallest = 0,
	currentRowStart = 0,
	rowDivs = new Array(),
	$el,
	topPosition = 0;
	jQuery(container).each(function() {

		$el = jQuery(this);
		jQuery($el).height('auto')
		topPostion = $el.position().top;

		if (currentRowStart != topPostion) {
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}
			rowDivs.length = 0; // empty the array
			currentRowStart = topPostion;
			currentTallest = $el.height();
			rowDivs.push($el);
		} else {
			rowDivs.push($el);
			currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
		}
		for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			rowDivs[currentDiv].height(currentTallest);
		}
	});
}

// Get Query String Param
function getUrlVars(){
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i = 0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
} 
   
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
		// console.log(input.files[0] );
        reader.onload = function (e) {
			var fileName = input.files[0].name;
			var fileType = input.files[0].type;
			if(fileType == 'video/mp4'  || fileType == 'video/webm' || fileType == 'audio/mp3' || fileType == 'audio/wav' || fileType == 'audio/ogg' ){ 
				jQuery('#imageResult').addClass('d-none');
				jQuery('#videoMp3Result').removeClass('d-none');
				jQuery('#videoMp3Result').attr('src', e.target.result );
			}else if(fileType == 'image/jpeg'  || fileType == 'image/png' || fileType == 'image/gif' || fileType == 'image/svg+xml' || fileType == 'image/webp'){
				jQuery('#videoMp3Result').addClass('d-none');
				jQuery('#imageResult').removeClass('d-none');
            	jQuery('#imageResult').attr('src', e.target.result);
			}else{
				jQuery('#videoMp3Result').addClass('d-none');
				jQuery('#imageResult').addClass('d-none');
			}
			jQuery('#uploaded_file').val( e.target.result);
			jQuery('#upload-label').text(fileName);
        };
        reader.readAsDataURL(input.files[0]);
    }
} 
function countDownTimer(date) {
	var elem = jQuery('#countDown'); 
	var elem_homePage = jQuery('#countDown_homePage');
	
	var futureTime = new Date(date).getTime(); 
	setInterval(function() {   
		var timeLeft = Math.floor( (futureTime - new Date().getTime()) / 1000 ); 
		var days =  Math.floor(timeLeft / 86400); 
		timeLeft -= days * 86400; 
		var hours = Math.floor(timeLeft / 3600) % 24; 
		timeLeft -= hours * 3600; 
		var min = Math.floor(timeLeft / 60) % 60; 
		timeLeft -= min * 60; 
		var sec = timeLeft % 60; 
		var timeString = "<span class='days'>"+days+" </br> <span class='days-txt'>Days"+"</span></span>"+
					   "<span class='hours'>"+hours+"</br> <span class='days-txt'> Hours"+"</span></span>"+
					   "<span class='minutes'>"+min+"</br> <span class='days-txt'> Minutes"+"</span></span>"+
					   "<span class='seconds'>"+sec+"</br> <span class='days-txt'> Seconds"+"</span></span>";
		var timeString_homePage = "<p class='d_h_m_s text-center'>"+days+" Days "+  hours+" Hours " +min+" Minutes "+sec+" Seconds "+"</p>";
		jQuery('#countDown').removeClass("d-none");
		jQuery('#countDown_homePage').removeClass("d-none");
		elem.html(timeString); 
		elem_homePage.html(timeString_homePage); 
	}, 1000);
} 
 