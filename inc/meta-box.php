<?php
/**
 * Create meta box for editing pages in WordPress
 *
 * Compatible with custom post types since WordPress 3.0
 * Support input types: text, textarea, checkbox, checkbox list, radio box, select, wysiwyg, file, image, date, time, color
 *
 * @author: Rilwis
 * @url: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 * @usage: please read document at project homepage and meta-box-usage.php file
 * @version: 3.0.1
 */
 
	

// Ajax delete files on the fly. Modified from a function used by "Verve Meta Boxes" plugin (http://goo.gl/LzYSq)
add_action('wp_ajax_rw_delete_file', 'rw_delete_file');
function rw_delete_file() {
	if (!isset($_POST['data'])) return;
	list($post_id, $key, $attach_id, $src, $nonce) = explode('!', $_POST['data']);
	if (!wp_verify_nonce($nonce, 'rw_ajax_delete_file')) {
		_e('You don\'t have permission to delete this file.');
	}
	wp_delete_attachment($attach_id);
	delete_post_meta($post_id, $key, $src);
	('File has been successfully deleted.');
	die();
}


/**
 * Meta Box class
 */
class RW_Meta_Box {

	var $_meta_box;
	var $tabs;

	// Create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;

		// assign meta box values to local variables and add it's missed values
		$this->_meta_box = $meta_box;
		$this->tabs = & $this->_meta_box['tabs'];
		$this->add_missed_values();

		add_action('admin_menu', array(&$this, 'add'));	// add meta box
		add_action('save_post', array(&$this, 'save'));	// save meta box's data

		// check for some special fields and add needed actions for them
		$this->check_field_upload();
		$this->check_field_color();

	}

	/******************** BEGIN UPLOAD **********************/

	// Check field upload and add needed actions
	function check_field_upload() {
		if ($this->has_field('image') || $this->has_field('file')) {
			add_action('post_edit_form_tag', array(&$this, 'add_enctype'));				// add data encoding type for file uploading
			add_action('admin_head-post.php', array(&$this, 'add_script_upload'));		// add scripts for handling add/delete images
			add_action('admin_head-post-new.php', array(&$this, 'add_script_upload'));
			add_action('delete_post', array(&$this, 'delete_attachments'));				// delete all attachments when delete post
		}
	}

	// Add data encoding type for file uploading
	function add_enctype() {
		echo ' enctype="multipart/form-data"';
	}

	// Add scripts for handling add/delete images
	function add_script_upload() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			// add more file
			$(".rw-add-file").click(function(){
				var $first = $(this).parent().find(".file-input:first");
				$first.clone().insertAfter($first).show();
				return false;
			});

			// delete file
			$(".rw-delete-file").click(function(){
				var $parent = $(this).parent(),
					data = $(this).attr("rel");
				$.post(ajaxurl, {action: \'rw_delete_file\', data: data}, function(response){
					$parent.fadeOut("slow");
					
				});
				return false;
			});
		});
		</script>';
	}

	// Delete all attachments when delete post
	function delete_attachments($post_id) {
		$attachments = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'attachment',
			'post_parent' => $post_id
		));
		if (!empty($attachments)) {
			foreach ($attachments as $att) {
				wp_delete_attachment($att->ID);
			}
		}
	}

	/******************** END UPLOAD **********************/

	/******************** BEGIN COLOR PICKER **********************/

	// Check field color
	function check_field_color() {
		if ($this->has_field('color') && $this->is_edit_page()) {
			wp_enqueue_style('farbtastic');									// enqueue built-in script and style for color picker
			wp_enqueue_script('farbtastic');
		}
	}

	// Custom script for color picker
	function add_script_color() {
		$ids = array();
		foreach($this->tabs as $tab) {
			foreach ($tab['fields'] as $field) {
				if ('color' == $field['type']) {
					$ids[] = $field['id'];
				}
			}
		}
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function($){
		';
		foreach ($ids as $id) {
			echo "
			$('#picker-$id').farbtastic('#$id');
			$('#select-$id').click(function(){
				$('#picker-$id').toggle();
				return false;
			});
			";
		}
		echo '
		});
		</script>
		';
	}

	/******************** END COLOR PICKER **********************/


	/******************** BEGIN META BOX PAGE **********************/

	// Add meta box for multiple post types
	function add() {
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}

	// Callback function to show fields in meta box
	function show() {
		global $post;

		wp_nonce_field(basename(__FILE__), 'rw_meta_box_nonce');

		echo '<div class="metabox-tabs-div">';
		echo '<ul class="metabox-tabs" id="metabox-tabs">';
		foreach($this->tabs as $counter => $tab) {
			$counter++;
			echo '<li class="' . ($counter == 1 ? 'active ' : '') . 'tab' . $counter . '"><a class="' . ($counter == 1 ? 'active' : '') . '" href="javascript:void(null);">' . $tab['title'] . '</a></li>';
		}
		echo '</ul>';

		foreach($this->_meta_box['tabs'] as $counter => $tab) {
			$counter++;
			$this->render_fields($tab['fields'], "tab{$counter}");
		}
		echo '</div>';

		$this->add_script_color();
	}

	function render_fields($fields, $tab = '') {
		global $post;
		echo '<div class="', $tab,'">';
		echo '<table class="form-table">';
		foreach($fields as $field) {
			$meta = get_post_meta($post->ID, $field['id'], !(isset($field['multiple']) && $field['multiple']));
			$meta = !empty($meta) ? $meta : $field['std'];
			
			echo '<tr class="'.$field['id'].'">';
			// call separated methods for displaying each type of field
			call_user_func(array(&$this, 'show_field_' . $field['type']), $field, $meta);
			echo '</tr>';
		}
		echo '</table>';
		echo '</div>';
	}
	/******************** END META BOX PAGE **********************/

	/******************** BEGIN META BOX FIELDS **********************/

	function show_field_begin($field, $meta) {
		echo "<th style='width:20%'><label for='{$field['id']}'>{$field['name']}</label></th><td>";
	}

	function show_field_end($field, $meta) {
		echo "<br />{$field['desc']}</td>";
	}

	function show_field_text($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<input type='text' name='{$field['id']}' id='{$field['id']}' value='$meta' size='30' style='width:60%' />";
		$this->show_field_end($field, $meta);
	}

	function show_field_textarea($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<textarea name='{$field['id']}' cols='60' rows='15' style='width:97%'>$meta</textarea>";
		$this->show_field_end($field, $meta);
	}

	function show_field_select($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		$this->show_field_begin($field, $meta);
		echo "<select name='{$field['id']}" . ((isset($field['multiple']) && $field['multiple']) ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";
		foreach ($field['options'] as $key => $value) {
			echo "<option value='$key'" . selected(in_array($key, $meta), true, false) . ">$value</option>";
		}
		echo "</select>";
		$this->show_field_end($field, $meta);
	}

	function show_field_radio($field, $meta) {
		$this->show_field_begin($field, $meta);
		foreach ($field['options'] as $key => $value) {
			echo "<input type='radio' name='{$field['id']}' value='$key'" . checked($meta, $key, false) . " /> $value ";
		}
		$this->show_field_end($field, $meta);
	}

	function show_field_checkbox($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<input type='checkbox' name='{$field['id']}'" . checked(!empty($meta), true, false) . " /> {$field['desc']}</td>";
	}

	function show_field_wysiwyg($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "<textarea name='{$field['id']}' class='theEditor' cols='60' rows='15' style='width:97%'>$meta</textarea>";
		$this->show_field_end($field, $meta);
	}
	
	
	function show_field_pagehelp($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "Visit our iFeature 3 Page Options help page here: <a href='http://cyberchimps.com/question/using-the-ifeature-pro-page-meta-options/' target='_blank'>Page Options Documentation</a></td>";
	}
		
	function show_field_sliderhelp($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "Visit our iFeature Pro Slider help page here: <a href='http://cyberchimps.com/question/using-the-ifeature-pro-2-slider' target='_blank'>Page Options Documentation</a></td>";
	}
	
	function show_field_reorder($field, $meta) {
		$this->show_field_begin($field, $meta);
		echo "Install the <a href='http://wordpress.org/extend/plugins/post-types-order/' target='_blank'>Post Types Order Plugin</a> to control the order of your custom slides.</td>";
	}

	function show_field_file($field, $meta) {
		global $post;

		if (!is_array($meta)) $meta = (array) $meta;

		$this->show_field_begin($field, $meta);
		echo "{$field['desc']}<br />";

		if (!empty($meta)) {
			// show attached files
			$attachs = get_posts(array(
				'numberposts' => -1,
				'post_type' => 'attachment',
				'post_parent' => $post->ID
			));

			$nonce = wp_create_nonce('rw_ajax_delete_file');

			echo '<div style="margin-bottom: 10px"><strong>' . _('Uploaded files') . '</strong></div>';
			echo '<ol>';
			foreach ($attachs as $att) {
				if (wp_attachment_is_image($att->ID)) continue; // what's image uploader for?

				$src = wp_get_attachment_url($att->ID);
				if (in_array($src, $meta)) {
					echo "<li>" . wp_get_attachment_link($att->ID) . " (<a class='rw-delete-file' href='javascript:void(0)' rel='{$post->ID}!{$field['id']}!{$att->ID}!{$src}!{$nonce}'>Delete</a>)</li>";
				}
			}
			echo '</ol>';
		}

		// show form upload
		echo "<div style='clear: both'><strong>" . _('Upload new files') . "</strong></div>
			<div class='new-files'>
				<div class='file-input'><input type='file' name='{$field['id']}[]' /></div>
				<a class='rw-add-file' href='javascript:void(0)'>" . _('Add more file') . "</a>
			</div>
		</td>";
	}

	function show_field_image($field, $meta) {
		global $post;

		if (!is_array($meta)) $meta = (array) $meta;

		$this->show_field_begin($field, $meta);
		echo "{$field['desc']}<br />";

		if (!empty($meta)) {
			// show attached images
			$attachs = get_posts(array(
				'numberposts' => -1,
				'post_type' => 'attachment',
				'post_parent' => $post->ID,
				'post_mime_type' => 'image', // get attached images only
				'output' => ARRAY_A
			));

			$nonce = wp_create_nonce('rw_ajax_delete_file');

			echo '<div style="margin-bottom: 10px"><strong>' . _('Uploaded images') . '</strong></div>';
			foreach ($attachs as $att) {
				$src = wp_get_attachment_image_src($att->ID, 'full');
				$src = $src[0];

				if (in_array($src, $meta)) {
					echo "<div style='margin: 0 10px 10px 0; float: left'><img width='150' src='$src' /><br />
							<a class='rw-delete-file' href='javascript:void(0)' rel='{$post->ID}!{$field['id']}!{$att->ID}!{$src}!{$nonce}'>Delete</a>
						</div>";
				}
			}
		}

		// show form upload
		echo "<div style='clear: both'><strong>" . _('Upload new images (Make sure to publish the post to save)') . "</strong></div>
			<div class='new-files'>
				<div class='file-input'><input type='file' name='{$field['id']}[]' /></div>
				
			</div>
		</td>";
	}

	function show_field_color($field, $meta) {
		if (empty($meta)) $meta = '#';
		$this->show_field_begin($field, $meta);
		echo "<input type='text' name='{$field['id']}' id='{$field['id']}' value='$meta' size='8' />
			  <a href='#' id='select-{$field['id']}'>" . _('Select a color') . "</a>
			  <div style='display:none' id='picker-{$field['id']}'></div>";
		$this->show_field_end($field, $meta);
	}

	function show_field_checkbox_list($field, $meta) {
		if (!is_array($meta)) $meta = (array) $meta;
		$this->show_field_begin($field, $meta);
		$html = array();
		foreach ($field['options'] as $key => $value) {
			$html[] = "<input type='checkbox' name='{$field['id']}[]' value='$key'" . checked(in_array($key, $meta), true, false) . " /> $value";
		}
		echo implode('<br />', $html);
		$this->show_field_end($field, $meta);
	}

	function show_field_date($field, $meta) {
		$this->show_field_text($field, $meta);
	}

	function show_field_time($field, $meta) {
		$this->show_field_text($field, $meta);
	}

	function show_field_section_order($field, $meta) {
		$root = get_template_directory_uri();  
		$this->show_field_begin($field, $meta);
		$meta = explode(",", $meta);
		echo "<div class='section_order'>";
		echo "<div class='left_list'>";
		echo "<div id='inactive'>Inactive Elements</div>";
		echo "<div class='list_items'>";
			foreach($field['options'] as $key => $value) {
				if(in_array($key, $meta)) continue;
				echo "<div class='list_item'>";
					echo "<img src='$root/images/minus.png' class='action' title='Remove'/>";
					echo "<span data-key='{$key}'>{$value}</span>";
				echo "</div>";
			}
		echo "</div>";
		echo "</div>";
		echo "<div id='arrow'><img src='$root/images/arrowdrag.png' /></div>";
		echo "<div class='right_list'>";
		echo "<div id='active'>Active Elements</div>";
		echo "<div id='drag'>Drag & Drop Elements</div>";
		echo "<div class='list_items'>";
			foreach($meta as $key) {
				if(!$key) continue;
				$value = $field['options'][$key];
				echo "<div class='list_item'>";
					echo "<img src='$root/images/minus.png' class='action' title='Remove'/>";
					echo "<span data-key='{$key}'>{$value}</span>";
				echo "</div>";
			}
		echo "</div>";
		echo "</div>";
		echo "<input type='hidden' id={$field['id']} name={$field['id']} />";
		echo "</div>";
?>

<script type="text/javascript">
		jQuery(function($) {
			function update(base) {
				var hidden = base.find("input[type='hidden']");
				var val = [];
				base.find('.right_list .list_items span').each(function() {
					val.push($(this).data('key'));
				})
				hidden.val(val.join(","));
				$('.right_list .action').show();
				$('.left_list .action').hide();
			}
			$(".left_list .list_items").delegate(".action", "click", function() {
				var item = $(this).closest('.list_item');
				$(this).closest('.section_order').children('.right_list').children('.list_items').append(item);
				update($(this).closest(".section_order"));
			});
			$(".right_list .list_items").delegate(".action", "click", function() {
				var item = $(this).closest('.list_item');
				$(this).val('Add');
				$(this).closest('.section_order').children('.left_list').children('.list_items').append(item);
				$(this).hide();
				update($(this).closest(".section_order"));
			});
			$(".right_list .list_items").sortable({
				update: function() {
					update($(this).closest(".section_order"));
				},
				connectWith: '.left_list .list_items'
			});

			$(".left_list .list_items").sortable({
				connectWith: '.right_list .list_items'
			});

			$('.section_order').each(function() {
				update($(this));
			});
		});
</script>
<style type="text/css">
.left_list, .right_list {
	float: left;
	margin: 20px;
	width: 130px;
}
.list_items {
	padding-bottom: 5px;
}
</style>

	<?php
		$this->show_field_end($field, $meta);
	}

	/******************** END META BOX FIELDS **********************/

	/******************** BEGIN META BOX SAVE **********************/

	// Save data from meta box
	function save($post_id) {

		if (isset($_POST['post_type'])) {
			$post_type = $_POST['post_type'];
		}
		else {
		$post_type = 'null';
		}

		$post_type_object = get_post_type_object($post_type);

		if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)						// check autosave
		|| (!isset($_POST['post_ID']) || $post_id != $_POST['post_ID'])			// check revision
		|| (!in_array($_POST['post_type'], $this->_meta_box['pages']))			// check if current post type is supported
		|| (!check_admin_referer(basename(__FILE__), 'rw_meta_box_nonce'))		// verify nonce
		|| (!current_user_can($post_type_object->cap->edit_post, $post_id))) {	// check permission
			return $post_id;
		}

		foreach($this->tabs as $tab) {
			foreach ($tab['fields'] as $field) {
				$name = $field['id'];
				$type = $field['type'];
				$old = get_post_meta($post_id, $name, !$field['multiple']);
				$new = isset($_POST[$name]) ? $_POST[$name] : ($field['multiple'] ? array() : '');

				// validate meta value
				if (class_exists('RW_Meta_Box_Validate') && method_exists('RW_Meta_Box_Validate', $field['validate_func'])) {
					$new = call_user_func(array('RW_Meta_Box_Validate', $field['validate_func']), $new);
				}

				// call defined method to save meta value, if there's no methods, call common one
				$save_func = 'save_field_' . $type;
				if (method_exists($this, $save_func)) {
					call_user_func(array(&$this, 'save_field_' . $type), $post_id, $field, $old, $new);
				} else {
					$this->save_field($post_id, $field, $old, $new);
				}
			}
		}
	}

	// Common functions for saving field
	function save_field($post_id, $field, $old, $new) {
		$name = $field['id'];

		// single value
		if (!$field['multiple']) {
			if ('' != $new && $new != $old) {
				update_post_meta($post_id, $name, $new);
			} elseif ('' == $new) {
				delete_post_meta($post_id, $name, $old);
			}
			return;
		}

		// multiple values
		// get new values that need to add and get old values that need to delete
		$add = array_diff($new, $old);
		$delete = array_diff($old, $new);
		foreach ($add as $add_new) {
			add_post_meta($post_id, $name, $add_new, false);
		}
		foreach ($delete as $delete_old) {
			delete_post_meta($post_id, $name, $delete_old);
		}
	}

	function save_field_wysiwyg($post_id, $field, $old, $new) {
		$new = wpautop($new);
		$this->save_field($post_id, $field, $old, $new);
	}

	function save_field_file($post_id, $field, $old, $new) {
		$name = $field['id'];
		if (empty($_FILES[$name])) return;

		$this->fix_file_array($_FILES[$name]);

		foreach ($_FILES[$name] as $position => $fileitem) {
			$file = wp_handle_upload($fileitem, array('test_form' => false));

			if (empty($file['file'])) continue;
			$filename = $file['file'];

			$attachment = array(
				'post_mime_type' => $file['type'],
				'guid' => $file['url'],
				'post_parent' => $post_id,
				'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
				'post_content' => ''
			);
			$id = wp_insert_attachment($attachment, $filename, $post_id);
			if (!is_wp_error($id)) {
				wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $filename));
				add_post_meta($post_id, $name, $file['url'], false);	// save file's url in meta fields
			}
		}
	}

	// Save images, call save_field_file, cause they use the same mechanism
	function save_field_image($post_id, $field, $old, $new) {
		$this->save_field_file($post_id, $field, $old, $new);
	}

	/******************** END META BOX SAVE **********************/

	/******************** BEGIN HELPER FUNCTIONS **********************/

	// Add missed values for meta box
	function add_missed_values() {
		// default values for meta box
		$this->_meta_box = array_merge(array(
			'context' => 'normal',
			'priority' => 'high',
			'pages' => array('if_custom_slides')
		), $this->_meta_box);

		// default values for fields
		foreach($this->tabs as $tabkey => $tab) {
			foreach ($tab['fields'] as $key => $field) {
				$multiple = in_array($field['type'], array('checkbox_list', 'file', 'image')) ? true : false;
				$std = $multiple ? array() : '';
				$format = 'date' == $field['type'] ? 'yy-mm-dd' : ('time' == $field['type'] ? 'hh:mm' : '');
				$this->tabs[$tabkey][$key] = array_merge(array(
					'multiple' => $multiple,
					'std' => $std,
					'desc' => '',
					'format' => $format,
					'validate_func' => ''
				), $field);
			}
		}
	}

	// Check if field with $type exists
	function has_field($type) {
		foreach($this->_meta_box['tabs'] as $tab) {
			foreach($tab['fields'] as $field) {
				if ($type == $field['type']) return true;
			}
		}
		return false;
	}

	// Check if current page is edit page
	function is_edit_page() {
		global $pagenow;
		if (in_array($pagenow, array('post.php', 'post-new.php'))) return true;
		return false;
	}

	/**
	 * Fixes the odd indexing of multiple file uploads from the format:
	 *     $_FILES['field']['key']['index']
	 * To the more standard and appropriate:
	 *     $_FILES['field']['index']['key']
	 */
	function fix_file_array(&$files) {
		$output = array();
		foreach ($files as $key => $list) {
			foreach ($list as $index => $value) {
				$output[$index][$key] = $value;
			}
		}
		$files = $output;
	}

	/******************** END HELPER FUNCTIONS **********************/
}

?>
<?php


/********************* BEGIN EXTENDING CLASS ***********************/

/**
 * Extend RW_Meta_Box class
 * Add field type: 'taxonomy'
 */
class RW_Meta_Box_Taxonomy extends RW_Meta_Box {

	function add_missed_values() {
		parent::add_missed_values();

		// add 'multiple' option to taxonomy field with checkbox_list type
		foreach($this->tabs as $keytab => $tab) {
			foreach ($tab['fields'] as $key => $field) {
				if ('taxonomy' == $field['type'] && 'checkbox_list' == $field['options']['type']) {
					$this->tabs[$keytab]['fields'][$key]['multiple'] = true;
				}
			}
		}
	}

	// show taxonomy list
	function show_field_taxonomy($field, $meta) {
		global $post;

		if (!is_array($meta)) $meta = (array) $meta;

		$this->show_field_begin($field, $meta);

		$options = $field['options'];
		$terms = get_terms($options['taxonomy'], $options['args']);

		// checkbox_list
		if ('checkbox_list' == $options['type']) {
			foreach ($terms as $term) {
				echo "<input type='checkbox' name='{$field['id']}[]' value='$term->slug'" . checked(in_array($term->slug, $meta), true, false) . " /> $term->name<br/>";
			}
		}
		// select
		else {
			echo "<select name='{$field['id']}" . ($field['multiple'] ? "[]' multiple='multiple' style='height:auto'" : "'") . ">";

			foreach ($terms as $term) {
				echo "<option value='$term->slug'" . selected(in_array($term->slug, $meta), true, false) . ">$term->name</option>";
			}
			echo "</select>";
		}

		$this->show_field_end($field, $meta);
	}
}

/********************* END EXTENDING CLASS ***********************/

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it

add_action('init', 'initialize_the_meta_boxes');

function initialize_the_meta_boxes() {

	global  $themename, $themeslug, $themenamefull, $options;
	
	$prefix = 'slider_';

	$meta_boxes = array();

	$meta_boxes[] = array(
		'id' => 'feature',
		'title' => $themenamefull.' Slider Options',
		'pages' => array('post'),

		'tabs' => array(
			array(
				'fields' => array(

					array(
						'name' => $themenamefull.' Pro Slider Image',
						'desc' => 'Upload your image here:',
						'id' => $prefix . 'image',
						'type' => 'image',
						'std' => ''
					),
					array(
						'name' => $themenamefull.' Pro Slider Text',
						'desc' => 'Enter your slider text here (optional):',
						'id' => $prefix . 'text',
						'type' => 'text',
						'std' => ''
					),
					array(
						'name' => 'Hide Title Bar',
						'desc' => 'Click to disable the title bar on this slide:',
						'id' => $prefix . 'hidetitle',
						'type' => 'checkbox',
						'std' => ''
					),
					
					array(
						'name' => 'Custom Thumbnail',
						'desc' => 'Use the image uploader to upload a custom navigation thumbnail',
						'id' => $prefix . 'custom_thumb',
						'type' => 'image'
					),
					
					array(
						'name' => 'Need help?',
						'desc' => '',
						'id' => '',
						'type' => 'sliderhelp',
						'std' => ''
			),


				)
			)
		)
	);
	
		
	$terms2 = get_terms('category', 'hide_empty=0');

	$blogoptions = array();
	
	$blogoptions['all'] = "All";

	foreach($terms2 as $term) {

		$blogoptions[$term->slug] = $term->name;

	}


	$meta_boxes[] = array(
		'id' => 'pages',
		'title' => $themenamefull.' Page Options',
		'pages' => array('page'),

		'tabs' => array(

		array(
				'title' => 'Page Options',
				'fields' => array(
					
			array(
				'name' => 'Select Page Layout',
				'desc' => 'Select your sidebar options',
				'id' => 'page_sidebar',
				'type' => 'select',
				'options' => array('Sidebar Right (default)', 'Full-Width'),
				'std' => ''
			 ),	
			 
			 array(
				'name' => "Page Elements",
				'desc' => "",
				'id' => 'page_section_order',
				'type' => 'section_order',
				'options' => array(
					'twitterbar_section' => "Twitter Bar",
					'page_section' => "Page",		
					),
					'std' => 'page_section'
				),

			
		
		
		
			array(
				'name' => 'Hide Page Title',
				'desc' => 'Check this box to hide the title on this page',
				'id' => 'hide_page_title',
				'type' => 'checkbox',
				'std' => ''
			),
			
				array(
				'name' => 'Need help?',
				'desc' => '',
				'id' => '',
				'type' => 'pagehelp',
				'std' => ''
			),

			)),
				
				array(
				'title' => 'Twitter Options',
				'fields' => array(
			
					
				array(
				'name' => 'Twitter Handle',
				'desc' => 'Enter your Twitter handle if using the Twitter bar - Requires <a href="http://wordpress.org/extend/plugins/twitter-for-wordpress/" target="_blank">Twitter for WordPress Plugin',
				'id' => 'twitter_handle',
				'type' => 'text',
				'std' => ''
			),
					
				
				)),			
				
				array(
				'title' => "SEO Options",
				'fields' => array(
				array(
						'name' => 'Title',
						'desc' => 'Enter your title',
						'id' => 'seo_title',
						'type' => 'text',
						'std' => ''
					),
					array(
						'name' => 'Description',
						'desc' => 'Enter your description',
						'id' => 'seo_description',
						'type' => 'textarea',
						'std' => ''
					),

					array(
						'name' => 'Keywords',
						'desc' => 'Enter your keywords',
						'id' => 'seo_keywords',
						'type' => 'text',
						'std' => ''
					),	 
				
					array(
						'name' => 'Need help?',
						'desc' => '',
						'id' => '',
						'type' => 'pagehelp',
						'std' => ''
			),

		)),
		

		)
	);


	foreach ($meta_boxes as $meta_box) {
		$my_box = new RW_Meta_Box_Taxonomy($meta_box);
	}
}


add_action( 'admin_print_styles-post-new.php', 'metabox_enqueue' );
add_action( 'admin_print_styles-post.php', 'metabox_enqueue' );

function metabox_enqueue() {
	$path =  get_template_directory_uri()."/core/library/js/";
	$path2 = get_template_directory_uri()."/css/";
	$color = get_user_meta( get_current_user_id(), 'admin_color', true );

	wp_register_style(  'metabox-tabs-css', $path2. 'metabox-tabs.css');

	wp_register_script ( 'jf-metabox-tabs', $path. 'metabox-tabs.js');

	wp_enqueue_script('jf-metabox-tabs');
	
	wp_enqueue_script('jf-metabox-tabs');
	wp_enqueue_script('jquerycustom', get_template_directory_uri().'/core/library/js/jquery-custom.js', array('jquery') );
	
	
	wp_enqueue_style('metabox-tabs-css');
}

/********************* END DEFINITION OF META BOXES ***********************/


?>
