<?php

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
