/**
 * Prints out the inline javascript needed for the colorpicker and choosing
 * the tabs in the panel.
 */

jQuery(document).ready(function($) {

	
  $("#if_show_excerpts").change(function() {
    var toShow = $("#section-if_excerpt_link_text, #section-if_excerpt_length");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
	$("#if_favicon_toggle").change(function() {
    var toShow = $("#section-if_favicon");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
		}).change();
	$("#if_apple_touch_toggle").change(function() {
    var toShow = $("#section-if_apple_touch");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
		}).change();
  $("#if_show_featured_images").change(function() {
    var toShow = $("#section-if_featured_image_align, #section-if_featured_image_height, #section-if_featured_image_width");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
   $("#if_custom_background").change(function() {
    var toShow = $("#section-if_background_upload, #section-if_bg_image_position, #section-if_bg_image_repeat, #section-if_background_color, #section-if_bg_image_attachment ");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
   }).change();
  $("#if_slider_type").change(function(){
    var val = $(this).val(),
      post = $("#section-if_slider_category"),
      custom = $("#section-if_customslider_category");
    if(val == 'custom') {
      post.hide(); custom.show();
    } else {
      post.show(); custom.hide();
    }
  }).change();
   $("#if_blog_product_link_toggle").change(function() {
    var toShow = $("#section-if_blog_product_link_url, #section-if_blog_product_link_text");
    if($(this).is(':checked')) {
      toShow.show();
    } else {
      toShow.hide();
    }
  }).change();
   $("#section-if_blog_product_type").change(function() {
    if($(this).find(":selected").val() == 'key1') {
      $('#section-if_blog_product_image').fadeIn();
    } else {
      $('#section-if_blog_product_image').hide();
    }
  }).change();
     $("#section-if_blog_product_type").change(function() {
    if($(this).find(":selected").val() == 'key2') {
      $('#section-if_blog_product_video').fadeIn();
    } else {
      $('#section-if_blog_product_video').hide();
    }
  }).change();


  $.each(['twitter', 'facebook', 'gplus', 'flickr', 'linkedin', 'pinterest', 'youtube', 'googlemaps', 'email', 'rsslink'], function(i, val) {
	  $("#section-if_" + val).each(function(){
		  var $this = $(this), $next = $(this).next();
		  $this.find(".controls").css({float: 'left', clear: 'both'});
		  $next.find(".controls").css({float: 'right', width: 80});
		  $next.hide();
		  $this.find('.option').before($next.find(".option"));
		  $this.find("input[type='checkbox']").change(function() {
			  if($(this).is(":checked")) {
				  $(this).closest('.option').next().show();
			  } else {
				  $(this).closest('.option').next().hide();
			  }
		  }).change();
	  });
  });
});	

jQuery(function($) {
	var initialize = function(id) {
		var el = $("#" + id);
		function update(base) {
			var hidden = base.find("input[type='hidden']");
			var val = [];
			base.find('.right_list .list_items span').each(function() {
				val.push($(this).data('key'));
			});
			hidden.val(val.join(",")).change();
			el.find('.right_list .action').show();
			el.find('.left_list .action').hide();
		}
		el.find(".left_list .list_items").delegate(".action", "click", function() {
			var item = $(this).closest('.list_item');
			$(this).closest('.section_order').children('.right_list').children('.list_items').append(item);
			update($(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").delegate(".action", "click", function() {
			var item = $(this).closest('.list_item');
			$(this).val('Add');
			$(this).closest('.section_order').children('.left_list').children('.list_items').append(item);
			$(this).hide();
			update($(this).closest(".section_order"));
		});
		el.find(".right_list .list_items").sortable({
			update: function() {
				update($(this).closest(".section_order"));
			},
			connectWith: '#' + id + ' .left_list .list_items'
		});

		el.find(".left_list .list_items").sortable({
			connectWith: '#' + id + ' .right_list .list_items'
		});

		update(el);
	}

	$('.section_order').each(function() {
		initialize($(this).attr('id'));
	});

	$("input[name='ifeature[if_blog_section_order]']").change(function(){
		var show = $(this).val().split(",");
		var map = {
			synapse_blog_slider: "subsection-blogslider",
			synapse_twitterbar_section: "subsection-twtterbaroptions",
			synapse_product_element: "subsection-productoptions"
		};

		$.each(map, function(key, value) {
			$("#" + value).hide();
			$.each(show, function(i, show_key) {
				if(key == show_key)
					$("#" + value).show();
			});
		});
	}).trigger('change');
	
	$("input[name='ifeature[header_section_order]']").change(function(){
		var show = $(this).val().split(",");
		var map = {
			ifeature_sitename_contact: "section-if_header_contact",
			ifeature_banner: "section-if_banner"
			// , synapse_box_section: ""
		};

		$.each(map, function(key, value) {
			$("#" + value).hide();
			$.each(show, function(i, show_key) {
				if(key == show_key)
					$("#" + value).show();
			});
		});
	}).trigger('change');

});
