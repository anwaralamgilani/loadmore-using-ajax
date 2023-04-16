<?php

//Staging restrictions
// if (file_exists(sys_get_temp_dir().'/staging-restrictions.php')) {
// 	define('STAGING_RESTRICTIONS', true);
// 	require_once sys_get_temp_dir().'/staging-restrictions.php';
// }

//include( get_template_directory() .'/classes.php' );
//include( get_template_directory() .'/widgets.php' );

add_action('themecheck_checks_loaded', 'theme_disable_cheks');
function theme_disable_cheks() {
	$disabled_checks = array('TagCheck');
	global $themechecks;
	foreach ($themechecks as $key => $check) {
		if (is_object($check) && in_array(get_class($check), $disabled_checks)) {
			unset($themechecks[$key]);
		}
	}
}

add_theme_support( 'automatic-feed-links' );

if ( ! isset( $content_width ) ) $content_width = 900;

remove_action('wp_head', 'wp_generator');

add_action( 'after_setup_theme', 'theme_localization' );
function theme_localization () {
	load_theme_textdomain( 'base', get_template_directory() . '/languages' );
}


if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'id' => 'default-sidebar',
		'name' => __('Default Sidebar', 'base'),
		'before_widget' => '<div class="widget %2$s" id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 50, 50, true ); // Normal post thumbnails
	add_image_size( 'single-post-thumbnail', 400, 9999, true );
}

register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'base' ),
	'footer' => __( 'Footer Navigation', 'base' ),
) );


//Add [email]...[/email] shortcode
// function shortcode_email($atts, $content) {
// 	$result = '';
// 	for ($i=0; $i<strlen($content); $i++) {
// 		$result .= '&#'.ord($content{$i}).';';
// 	}
// 	return $result;
// }
// add_shortcode('email', 'shortcode_email');

//Register tag [template-url]
function filter_template_url($text) {
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}
add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');

//Register tag [site-url]
function filter_site_url($text) {
	return str_replace('[site-url]',get_bloginfo('url'), $text);
}
add_filter('the_content', 'filter_site_url');
add_filter('get_the_content', 'filter_site_url');
add_filter('widget_text', 'filter_site_url');

//Replace standard wp menu classes
function change_menu_classes($css_classes) {
	$css_classes = str_replace("current-menu-item", "active", $css_classes);
	$css_classes = str_replace("current-menu-parent", "active", $css_classes);
	return $css_classes;
}
add_filter('nav_menu_css_class', 'change_menu_classes');

//Replace standard wp body classes and post classes
function theme_body_class($classes) {
	if (is_array($classes)) {
		foreach ($classes as $key => $class) {
			$classes[$key] = 'body-class-' . $classes[$key];
		}
	}
	
	return $classes;
}
add_filter('body_class', 'theme_body_class', 9999);

function theme_post_class($classes) {
	if (is_array($classes)) {
		foreach ($classes as $key => $class) {
			$classes[$key] = 'post-class-' . $classes[$key];
		}
	}
	
	return $classes;
}
add_filter('post_class', 'theme_post_class', 9999);

//Allow tags in category description
$filters = array('pre_term_description', 'pre_link_description', 'pre_link_notes', 'pre_user_description');
foreach ( $filters as $filter ) {
    remove_filter($filter, 'wp_filter_kses');
}


//Make wp admin menu html valid
function wp_admin_bar_valid_search_menu( $wp_admin_bar ) {
	if ( is_admin() )
		return;

	$form  = '<form action="' . esc_url( home_url( '/' ) ) . '" method="get" id="adminbarsearch"><div>';
	$form .= '<input class="adminbar-input" name="s" id="adminbar-search" tabindex="10" type="text" value="" maxlength="150" />';
	$form .= '<input type="submit" class="adminbar-button" value="' . __('Search', 'base') . '"/>';
	$form .= '</div></form>';

	$wp_admin_bar->add_menu( array(
		'parent' => 'top-secondary',
		'id'     => 'search',
		'title'  => $form,
		'meta'   => array(
			'class'    => 'admin-bar-search',
			'tabindex' => -1,
		)
	) );
}

function fix_admin_menu_search() {
	remove_action( 'admin_bar_menu', 'wp_admin_bar_search_menu', 4 );
	add_action( 'admin_bar_menu', 'wp_admin_bar_valid_search_menu', 4 );
}

add_action( 'add_admin_bar_menus', 'fix_admin_menu_search' );

//Disable comments on pages by default
function theme_page_comment_status($post_ID, $post, $update) {
	if (!$update) {
		remove_action('save_post_page', 'theme_page_comment_status', 10);
		wp_update_post(array(
			'ID' => $post->ID,
			'comment_status' => 'closed',
		));
		add_action('save_post_page', 'theme_page_comment_status', 10, 3);
	}
}
add_action('save_post_page', 'theme_page_comment_status', 10, 3);

/* advanced custom fields settings*/

//theme options tab in appearance
if(function_exists('acf_add_options_sub_page')) {
	acf_add_options_sub_page(array(
		'title' => 'Theme Options',
		'parent' => 'themes.php',
	));
}

//acf theme functions placeholders
if(!class_exists('acf') && !is_admin()) {
	function get_field_reference( $field_name, $post_id ) {return '';}
	function get_field_objects( $post_id = false, $options = array() ) {return false;}
	function get_fields( $post_id = false) {return false;}
	function get_field( $field_key, $post_id = false, $format_value = true )  {return false;}
	function get_field_object( $field_key, $post_id = false, $options = array() ) {return false;}
	function the_field( $field_name, $post_id = false ) {}
	function have_rows( $field_name, $post_id = false ) {return false;}
	function the_row() {}
	function reset_rows( $hard_reset = false ) {}
	function has_sub_field( $field_name, $post_id = false ) {return false;}
	function get_sub_field( $field_name ) {return false;}
	function the_sub_field($field_name) {}
	function get_sub_field_object( $child_name ) {return false;}
	function acf_get_child_field_from_parent_field( $child_name, $parent ) {return false;}
	function register_field_group( $array ) {}
	function get_row_layout() {return false;}
	function acf_form_head() {}
	function acf_form( $options = array() ) {}
	function update_field( $field_key, $value, $post_id = false ) {return false;}
	function delete_field( $field_name, $post_id ) {}
	function create_field( $field ) {}
	function reset_the_repeater_field() {}
	function the_repeater_field($field_name, $post_id = false) {return false;}
	function the_flexible_field($field_name, $post_id = false) {return false;}
	function acf_filter_post_id( $post_id ) {return $post_id;}
}

// Add Shortcode Supplement
function supplement_shortcode() {
	$supplementPage = get_field( "supplement_page_list", 2 ); 
	foreach ($supplementPage as $key => $pages) { $featured_img_url = get_the_post_thumbnail_url($pages->ID, 'full'); 		?>
				<div class="card-grid-wrap">
					<div class="card-item">
						<a href="<?php echo get_the_permalink($pages->ID);?>" class="card-item-link"><?php echo $pages->post_title;?></a>
						<div class="image-wrap">
							<noscript><img src="<?php echo $featured_img_url;?>" alt="merrick-dog-food-review"></noscript><img class=" lazyloaded" src="<?php echo $featured_img_url;?>" data-src="<?php echo $featured_img_url;?>" alt="<?php echo $pages->post_title;?>">
						</div>
						<div class="info">
							<div class="label-wrapper">
								<svg viewBox="0 0 89 86" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M63.8864 43.0347C55.9772 38.8683 52.1604 35.9879 49.8787 34.2662C47.911 32.7845 46.4916 31.7118 44.4498 31.7118C42.4081 31.7118 40.9886 32.7845 39.021 34.2662C36.7392 35.9879 32.9194 38.8683 25.0132 43.0347C21.0513 45.1091 17.7145 47.5064 15.095 50.126C9.99504 55.2259 7.40804 61.3274 7.40804 68.2646C7.40804 73.5571 10.0899 78.9326 14.4045 82.3138C18.8051 85.7483 24.4799 86.8299 30.3769 85.3601C33.7136 84.5274 35.6961 83.1821 37.2904 82.1005C39.2195 80.7936 40.4937 79.9313 44.4291 79.8602H44.4646C48.4059 79.9313 49.6801 80.7936 51.6092 82.1005C53.2035 83.1791 55.189 84.5245 58.5227 85.3601C65.1932 87.0226 71.6089 85.3868 76.128 80.8647C79.4854 77.5073 81.4916 72.7956 81.4916 68.2646C81.4916 57.6736 75.5679 49.1866 63.8864 43.0347ZM29.4435 0.0247983C26.8161 0.222646 24.3542 1.3834 22.53 3.28447C19.3829 6.42858 17.7086 11.3981 18.0494 16.5751C18.3191 20.6408 19.777 24.4131 22.1625 27.1957C24.7288 30.1916 28.0477 31.7177 31.5119 31.4896C34.1386 31.2895 36.5997 30.1291 38.4253 28.2299C41.5694 25.0858 43.2437 20.1162 42.9029 14.9393C42.6362 10.8736 41.1753 7.10125 38.7928 4.31868C36.2265 1.31978 32.9046 -0.203379 29.4435 0.0247983ZM15.5572 24.5079C13.2636 22.4336 10.3981 21.5209 7.69253 22.0365C6.02133 22.3681 4.48826 23.194 3.29198 24.4072C0.574593 27.1216 -0.57816 31.5844 0.278246 36.059C0.870914 39.1735 2.35259 41.9531 4.48619 43.8822C6.77982 45.9566 9.64538 46.8723 12.3509 46.3537C14.0233 46.023 15.5576 45.197 16.7544 43.983C19.4688 41.2686 20.6068 36.8028 19.7652 32.3311C19.1695 29.2196 17.676 26.44 15.5572 24.5079ZM50.1068 4.31572C47.7362 7.0983 46.2545 10.8706 45.9967 14.9363C45.6559 20.1133 47.3302 25.0828 50.4743 28.2269C52.2999 30.1262 54.761 31.2866 57.3877 31.4866C60.8519 31.7148 64.1709 30.1886 66.7371 27.1927C69.1226 24.4101 70.5894 20.6378 70.8502 16.5721C71.188 11.3951 69.5138 6.42561 66.3697 3.28151C64.5454 1.38043 62.0835 0.21968 59.4562 0.0218321C55.995 -0.203382 52.6731 1.31978 50.1068 4.31572ZM69.1315 32.3341C68.278 36.8058 69.4278 41.2715 72.1452 43.986C73.3416 45.2005 74.8761 46.0266 76.5487 46.3566C79.2543 46.8752 82.1198 45.9744 84.4105 43.8852C86.5293 41.9561 88.0257 39.1765 88.6214 36.062C89.4778 31.5873 88.3251 27.1246 85.6077 24.4101C84.4103 23.1969 82.8762 22.371 81.2041 22.0395C78.5016 21.5238 75.636 22.4247 73.3424 24.5109C71.2236 26.44 69.7301 29.2196 69.1315 32.3341Z"></path>
								</svg>
								<div class="label">Dogs</div>
							</div>
							<div class="title"><?php echo $pages->post_title;?></div>
						</div>
					</div>
				</div>
			<?php
	}
 }
add_shortcode( 'homeSupplement', 'supplement_shortcode' );

/**
 * ACF Load More Repeater
*/

// add action for logged in users
add_action('wp_ajax_my_repeater_show_more', 'my_repeater_show_more');
// add action for non logged in users
add_action('wp_ajax_nopriv_my_repeater_show_more', 'my_repeater_show_more');

function my_repeater_show_more() {
	// validate the nonce
	if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'my_repeater_field_nonce')) {
		exit;
	}
	// make sure we have the other values
	if (!isset($_POST['post_id']) || !isset($_POST['offset'])) {
		return;
	}
	$show = 6; // how many more to show
	$start = $_POST['offset'];
	$end = $start+$show;
	$post_id = $_POST['post_id'];
	// use an object buffer to capture the html output
	// alternately you could create a varaible like $html
	// and add the content to this string, but I find
	// object buffers make the code easier to work with
	ob_start();
	if (have_rows('media', $post_id)) {
		$total = count(get_field('media', $post_id));
		$count = 0;
		while (have_rows('media', $post_id)) {
			the_row();
			if ($count < $start) {
				// we have not gotten to where
				// we need to start showing
				// increment count and continue
				$count++;
				continue;
			}
			?>
			        <!-- Video Gallery Card start -->
                    <div class="col-xs-12 col-sm-6 col-md-4" style="margin-bottom:30px">
                        <div class="annoucement-card video-card" style="cursor:pointer" class="xiq-over-video-wrap" data-toggle="modal" data-target="<?php echo "#modal-".$counter; ?>">
                            <div class="img-wrap">

                                <img class="img-responsive" src="<?php the_sub_field('_title') ?>" alt="<?php the_sub_field('video_title') ?>" />
                                
                                <img class="video-play-icon" src="https://media.xiq.io/wepapp/wp-content/uploads/2022/09/22163133/Button.svg" alt="play-icon" />
                            </div>
                            <div class="text-block text-center">
                                <h2 class="title">

                                    <?php the_sub_field('_title') ?>
                                    
                                </h2>
                                <p class="published-date-2021"><?php the_time('m/j/y') ?></p>
                                <div class="watch-now-wrap">
                                    <span href="" class="watch-now"> 
                                        <img src="<?php //echo get_template_directory_uri(); ?>/img/play_button.png" class="img-responsive" alt="arrow" /> 
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- Video Gallery Card End -->
			<?php 
			$count++;
			if ($count == $end) {
				// we have shown the number, break out of loop
				break;
			}
		} // end while have rows
	} // end if have rows
	$content = ob_get_clean();
	// check to see if we have shown the last item
	$more = false;
	if ($total > $count) {
		$more = true;
	}
	// output our 3 values as a json encoded array
	echo json_encode(array('content' => $content, 'more' => $more, 'offset' => $end));
	exit;
} // end function my_repeater_show_more