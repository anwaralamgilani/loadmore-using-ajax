<?php get_header(); ?>

<script src="https://kit.fontawesome.com/66eb86052a.js" crossorigin="anonymous"></script>

<main class="container">
<?php while (have_posts()) : the_post(); ?>
	<?php $img_url = get_field('page_banner', get_the_ID()); ?>
		<?php if($img_url){ ?>
			<div class="best-items-banner-bg lazyloaded" data-bg="<?PHP echo $img_url["url"]; ?>" style="background-image: url(<?PHP echo $img_url["url"]; ?>);">
				<div class="best-items-banner-bg-text">
					<h1 class="banner-bg-title"><?php the_title(); ?></h1>
				</div>
			</div>
		<?php }?>
		<section class="row">
			<div class="col-sm-10" style="margin: 0 auto;">
				<div class="row">
					<div class="container">
						
						<?php the_content(); ?>
					
					</div>
				</div>
			</div>
		</section>
<?php endwhile; ?>
<div class="annoucement-cards-wrap video-gallery-wrap">
	<h2 class="new-home-section-heading text-center">Video gallery</h2>		
	<div id="photo-gallery">
		<div class="row">
			<?php
			if( have_rows('media') ): 
				$total = count(get_field('media'));
				$count = 0;
				$number = 5;					
				while ( have_rows('media') ) : the_row(); ?>						
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
					<?php
					if ($count == $number) {
						// we've shown the number, break out of loop
						break;
					} ?>					
				<?php $count++; endwhile;
			else : endif;
			?>
		</div>
		<script type = "text/javascript" language = "javascript">
			jQuery(document).ready(function() {
				jQuery("#photo-gallery a").removeAttr("target");
			});
		</script>

		<a target="none" id="gallery-load-more" href="javascript: my_repeater_show_more();" <?php if ($total < $count) { ?> style="display: none;"<?php } ?>>
			<h2 id="title-bg"><span>Load more</span></h2>
		</a>
	</div>
</div>
<script type="text/javascript">
	var my_repeater_field_post_id = <?php echo $post->ID; ?>;
	var my_repeater_field_offset = <?php echo $number + 1; ?>;
	var my_repeater_field_nonce = '<?php echo wp_create_nonce('my_repeater_field_nonce'); ?>';
	var my_repeater_ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
	var my_repeater_more = true;
	
	function my_repeater_show_more() {
		
		// make ajax request
		jQuery.post(
			my_repeater_ajax_url, {
				// this is the AJAX action we set up in PHP
				'action': 'my_repeater_show_more',
				'post_id': my_repeater_field_post_id,
				'offset': my_repeater_field_offset,
				'nonce': my_repeater_field_nonce
			},
			function (json) {
				// add content to container
				// this ID must match the containter 
				// you want to append content to
				jQuery('#photo-gallery .row').append(json['content']);
				// update offset
				my_repeater_field_offset = json['offset'];
				// see if there is more, if not then hide the more link
				if (!json['more']) {
					// this ID must match the id of the show more link
					jQuery('#gallery-load-more').css('display', 'none');
				}
			},
			'json'
		);
	}
	
</script>


<style>
	.box-border-style {
		border-bottom: 1px solid #eee;
		margin-bottom: 50px;
	}
	.hero {
		background: #024836;
		padding: initial;
		max-width: 1980px;
		width: 100%;
		padding-right: 0;
		padding-left: 50px;
		margin-right: auto;
		margin-left: auto;
		margin-top: -25px;
	}

	/* ------------- */


	ul {
		margin: 0;
		padding: 0;
		list-style: none !important
	}

	ul li {
		list-style: none !important
	}

	.fake-padding {
		-webkit-box-flex: 0;
		-ms-flex: 0 0 auto;
		flex: 0 0 auto
	}

	.header {
		-webkit-box-flex: 0;
		-ms-flex: 0 0 auto;
		flex: 0 0 auto
	}

	.sticky-footer-wrap {
		-webkit-box-flex: 1;
		-ms-flex: 1 0 auto;
		flex: 1 0 auto
	}

	.flex-container,
	.container {
		position: relative;
		padding: 0 15px;
		max-width: 1140px;
		margin: 0 auto;
		width: 100%
	}

	.td-container {
		width: 900px
	}

	@media(max-width: 1140px) and (min-width:1019px) {
		.td-container {
			width: 980px
		}
	}

	@media(max-width: 1018px) and (min-width:768px) {
		.td-container {
			width: 740px
		}
	}

	@media(max-width: 767px) {
		.td-container {
			width: 100%
		}
	}

	.clearfix:before,
	.clearfix:after {
		display: table;
		content: " "
	}

	.clearfix:after {
		clear: both
	}

	.clearfix .helper {
		display: inline-block;
		vertical-align: middle;
		height: 100%;
		width: 0
	}

	img {
		-webkit-border-radius: 0;
		-moz-border-radius: 0;
		-ms-border-radius: 0;
		border-radius: 0
	}

	h2:first-child,
	h3:first-child,
	h4:first-child {
		margin-top: 0
	}

	h2 {
		margin: 25px 0 15px
	}

	@media(min-width: 768px) {
		h2 {
			margin: 30px 0 15px
		}
	}

	h3,
	h4 {
		margin: 20px 0 12px
	}

	@media(min-width: 768px) {

		h3,
		h4 {
			margin: 25px 0 12px
		}
	}

	h1 {
		font-style: normal;
		font-weight: 900;
		font-size: 30px;
		line-height: 1.3;
		letter-spacing: .02em;
		color: #44444b;
		margin-bottom: 25px
	}

	@media(min-width: 768px) {
		h1 {
			font-size: 33px;
			margin-bottom: 30px
		}
	}

	@media(min-width: 1200px) {
		h1 {
			font-size: 36px
		}
	}

	h2 {
		font-style: normal;
		font-weight: 900;
		font-size: 24px;
		line-height: 1.3;
		letter-spacing: .02em;
		color: #44444b
	}

	@media(min-width: 768px) {
		h2 {
			font-size: 30px
		}
	}

	@media(min-width: 1200px) {
		h2 {
			font-size: 34px
		}
	}

	h3 {
		font-style: normal;
		font-weight: 900;
		font-size: 21px;
		line-height: 1.3;
		letter-spacing: .02em;
		color: #44444b
	}

	@media(min-width: 768px) {
		h3 {
			font-size: 24px
		}
	}

	@media(min-width: 1200px) {
		h3 {
			font-size: 28px
		}
	}

	p {
		font-size: 15px;
		line-height: 1.875;
		color: #44444b;
		text-align: justify;
		margin-bottom: 15px
	}

	p:last-child {
		margin-bottom: 0
	}

	strong {
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700
	}

	a {
		color: #cb2026;
		display: inline-block;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s;
		text-decoration: none
	}

	@media(min-width: 992px) {
		a:hover {
			color: #ff7152
		}
	}

	.home {
		background-color: #f9f8f6
	}

	.box-content h2,
	.box-content h3 {
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700
	}

	.box-content h2 strong,
	.box-content h3 strong {
		font-style: normal;
		font-weight: 900
	}

	.box-content ol {
		margin: 0 0 15px;
		padding: 0 0 0 15px
	}

	.box-content ol li {
		margin-bottom: 10px;
		position: relative;
		font-size: 15px;
		line-height: 1.875;
		list-style-position: inside
	}

	.box-content ol li:last-child {
		margin-bottom: 0
	}

	.box-content a>img {
		display: block
	}

	.box-content ul {
		margin-bottom: 15px
	}

	.box-content ul li {
		font-size: 15px;
		line-height: 1.875;
		display: block;
		list-style: none;
		padding-left: 20px;
		position: relative;
		margin-bottom: 10px
	}

	.box-content ul li:after {
		content: "";
		position: absolute;
		top: 13px;
		left: 8px;
		width: 4px;
		height: 4px;
		background: #44444b;
		border-radius: 50%
	}

	.box-content ul li:last-child {
		margin-bottom: 0
	}

	.box-content img {
		max-width: 100%;
		height: 100%
	}

	.box-content img.aligncenter {
		text-align: center;
		margin: 0 auto;
		display: block
	}

	.box-content iframe {
		max-width: 100%;
		height: auto;
		min-height: 300px
	}

	.full-width .td-container {
		width: 1068px
	}

	@media(max-width: 1140px) and (min-width:1019px) {
		.full-width .td-container {
			width: 980px
		}
	}

	@media(max-width: 1018px) and (min-width:768px) {
		.full-width .td-container {
			width: 740px
		}
	}

	@media(max-width: 767px) {
		.full-width .td-container {
			width: 100%
		}
	}

	.section-title-decor {
		position: relative;
		margin: 0 0 25px;
		text-align: center;
		font-size: 32px;
		line-height: 1.2;
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700;
		letter-spacing: .02em;
		text-transform: capitalize
	}

	@media(min-width: 768px) {
		.section-title-decor {
			font-size: 34px;
			margin: 0 0 30px;
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-pack: justify;
			-ms-flex-pack: justify;
			justify-content: space-between;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center
		}

		.section-title-decor:before,
		.section-title-decor:after {
			content: "";
			display: block;
			width: 100%;
			flex: 1;
			background-color: #cb2026;
			height: 1px
		}

		.section-title-decor:before {
			margin: 0 25px 0 0
		}

		.section-title-decor:after {
			margin: 0 0 0 25px
		}
	}

	@media(min-width: 992px) {
		.section-title-decor {
			font-size: 36px;
			margin: 0 0 40px
		}
	}

	.btn {
		font-size: 15px;
		line-height: 1.2;
		display: inline-block;
		position: relative;
		padding: 12px 10px;
		border-radius: 28px;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s;
		cursor: pointer;
		min-width: 200px;
		text-align: center
	}

	@media(min-width: 992px) {
		.btn {
			font-size: 16px;
			padding: 15px 10px
		}
	}

	.btn-box1 {
		background: #ff7152;
		color: #fff;
		border: 1px solid #ff7152
	}

	@media(min-width: 992px) {
		.btn-box1:hover {
			text-decoration: none;
			background: 0 0;
			color: #ff7152
		}
	}

	.btn-box2 {
		background: 0 0;
		color: #cb2026;
		border: 1px solid #cb2026
	}

	@media(min-width: 992px) {
		.btn-box2:hover {
			text-decoration: none;
			background: #cb2026;
			color: #fff
		}
	}

	.btn-bn-wrap {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap
	}

	.slick-slider {
		position: relative;
		display: block;
		box-sizing: border-box;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		-webkit-touch-callout: none;
		-khtml-user-select: none;
		-ms-touch-action: pan-y;
		touch-action: pan-y;
		-webkit-tap-highlight-color: transparent
	}

	.slick-list {
		position: relative;
		display: block;
		overflow: hidden;
		margin: 0;
		padding: 0
	}

	.slick-list:focus {
		outline: none
	}

	.slick-list.dragging {
		cursor: pointer;
		cursor: hand
	}

	.slick-slider .slick-track,
	.slick-slider .slick-list {
		-webkit-transform: translate3d(0, 0, 0);
		-moz-transform: translate3d(0, 0, 0);
		-ms-transform: translate3d(0, 0, 0);
		-o-transform: translate3d(0, 0, 0);
		transform: translate3d(0, 0, 0)
	}

	.slick-track {
		position: relative;
		top: 0;
		left: 0;
		display: block;
		margin-left: auto;
		margin-right: auto
	}

	.slick-track:before,
	.slick-track:after {
		display: table;
		content: ''
	}

	.slick-track:after {
		clear: both
	}

	.slick-loading .slick-track {
		visibility: hidden
	}

	.slick-slide {
		display: none;
		float: left;
		height: 100%;
		min-height: 1px
	}

	[dir=rtl] .slick-slide {
		float: right
	}

	.slick-slide img {
		display: block
	}

	.slick-slide.slick-loading img {
		display: none
	}

	.slick-slide.dragging img {
		pointer-events: none
	}

	.slick-initialized .slick-slide {
		display: block
	}

	.slick-loading .slick-slide {
		visibility: hidden
	}

	.slick-vertical .slick-slide {
		display: block;
		height: auto;
		border: 1px solid transparent
	}

	.slick-arrow.slick-hidden {
		display: none
	}

	.best-items-banner-bg {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		padding: 80px 30px;
		border-radius: 0 0 20px 20px;
		margin-bottom: 20px;
		position: relative;
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center
	}

	@media(min-width: 768px) {
		.best-items-banner-bg {
			min-height: 300px;
			border-radius: 0 0 32px 32px
		}
	}

	@media(min-width: 992px) {
		.best-items-banner-bg {
			margin-bottom: 30px;
			min-height: 320px
		}
	}

	.best-items-banner-bg:before {
		content: "";
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		border-radius: 0 0 20px 20px;
		background: linear-gradient(to right, rgba(17, 19, 20, .7) 0%, rgba(17, 19, 20, .5) 61%, rgba(17, 19, 20, .3) 100%);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#111314", endColorstr="#111314", GradientType=1);
		z-index: 1
	}

	@media(min-width: 768px) {
		.best-items-banner-bg:before {
			border-radius: 0 0 32px 32px
		}
	}

	.best-items-banner-bg h1 {
		position: relative;
		z-index: 2;
		font-size: 36px;
		font-style: normal;
		font-weight: 900;
		line-height: 1.2;
		letter-spacing: .02em;
		color: #fff;
		text-align: center
	}

	.breadcrumbs {
		margin-bottom: 10px
	}

	.breadcrumbs ul {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		margin: 0
	}

	.breadcrumbs li+li {
		margin-left: 20px
	}

	.breadcrumbs li {
		margin: 0;
		list-style: none;
		position: relative
	}

	.breadcrumbs li:after {
		content: "";
		position: absolute;
		right: -11px;
		top: 50%;
		border: solid #cb2026;
		border-width: 0 2px 2px 0;
		display: inline-block;
		padding: 3px;
		border-radius: 1px;
		transform: translate(0, -50%) rotate(-45deg)
	}

	.breadcrumbs li:last-child:after {
		display: none
	}

	.breadcrumbs li span {
		color: #ff7152
	}

	.breadcrumbs li a {
		color: #a3a3a3;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s
	}

	@media(min-width: 992px) {
		.breadcrumbs li a:hover {
			text-decoration-line: none;
			color: #ff7152
		}
	}

	.breadcrumbs a,
	.breadcrumbs span {
		position: relative;
		font-size: 14px;
		line-height: 1.2
	}

	.breadcrumbs a:hover,
	.breadcrumbs span:hover {
		text-decoration: none
	}

	.post-author-wrap {
		position: relative;
		margin-bottom: 20px;
		padding: 0 0 12px;
		border-bottom: 1px solid #cb2026
	}

	.post-author {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex
	}

	@media(max-width: 991px) {
		.post-author {
			-webkit-box-orient: vertical;
			-webkit-box-direction: normal;
			-ms-flex-direction: column;
			flex-direction: column
		}
	}

	@media(min-width: 992px) {
		.post-author {
			-webkit-box-pack: justify;
			-ms-flex-pack: justify;
			justify-content: space-between;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center
		}
	}

	.author-info-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center
	}

	.author-info-wrapper .author-img {
		display: inline-block;
		border-radius: 50%;
		box-shadow: 0 5px 8px 0 rgba(29, 29, 29, .29);
		width: 45px;
		min-width: 45px;
		height: 45px;
		position: relative;
		overflow: hidden
	}

	.author-info-wrapper .author-img img {
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		position: absolute;
		object-fit: cover;
		margin-bottom: 0
	}

	.author-info-wrapper .author-img svg {
		padding: 7px;
		fill: #000;
		width: 100%
	}

	.author-info-wrapper .author-info {
		margin-left: 15px
	}

	.author-info-wrapper .follow-text-box {
		font-size: 15px;
		line-height: 19px;
		letter-spacing: .02em;
		color: #003525;
		margin-bottom: 4px
	}

	.author-info-wrapper .follow-text-box span {
		color: #cb2026
	}

	.author-info-wrapper .published-time {
		font-size: 12px;
		line-height: 1.2;
		color: #a3a3a3
	}

	.info-link {
		margin-top: 10px;
		color: #898989;
		font-size: 14px;
		line-height: 1.8;
		font-family: gothambookitalic, Helvetica, Arial, sans-serif;
		font-style: italic;
		font-weight: 300
	}

	.info-link a {
		text-decoration: underline
	}

	@media(min-width: 992px) {
		.info-link a:hover {
			text-decoration: none
		}
	}

	.user-rating-wrap {
		align-self: flex-start
	}

	@media(max-width: 991px) {
		.user-rating-wrap {
			margin-top: 15px
		}
	}

	.user-rating-title {
		margin: 0 0 3px
	}

	.user-rating-wrap {
		display: inline-block
	}

	.user-rating-title {
		text-transform: uppercase;
		font-size: 13px;
		font-weight: 700
	}

	.user-rating {
		position: relative;
		height: 21px;
		width: 92px
	}

	.user-rating>span {
		color: #c9d1d5;
		font-size: 15px
	}

	.user-rating>span:first-of-type {
		padding-left: 0
	}

	.user-rating>span:nth-of-type(5) {
		padding-right: 0
	}

	.user-rating span {
		display: inline-block;
		padding: 0 2px
	}

	.user-rating .icon-star {
		background: url(//www.mypetneedsthat.com/wp-content/themes/mypetneedsthat/assets/css/../images/star.svg);
		display: block;
		width: 15px;
		height: 21px;
		background-repeat: no-repeat
	}

	.user-rating .user-rating-inner .icon-star {
		background: url(//www.mypetneedsthat.com/wp-content/themes/mypetneedsthat/assets/css/../images/star-active.svg);
		background-repeat: no-repeat
	}

	.user-rating-inner {
		position: absolute;
		height: 21px;
		top: 0;
		left: 0;
		overflow: hidden;
		white-space: nowrap
	}

	.user-rating-inner span {
		color: #4ab5a0;
		font-size: 15px
	}

	.user-rating-inner>span:first-of-type {
		padding-left: 0
	}

	.user-rating-inner>span:nth-of-type(5) {
		padding-right: 0
	}

	.default-sharing {
		display: none
	}

	@media(min-width: 992px) {
		.default-sharing {
			display: block
		}
	}

	.default-sharing ul {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex
	}

	.default-sharing ul li {
		line-height: 1
	}

	.default-sharing ul li+li {
		margin-left: 10px
	}

	.default-sharing ul a {
		line-height: 1
	}

	.default-sharing ul a.social-facebook i {
		color: #516eab
	}

	.default-sharing ul a.social-twitter i {
		color: #29c5f6
	}

	.default-sharing ul a.social-pinterest i {
		color: #ca212a
	}

	.default-sharing ul i {
		font-size: 35px
	}

	#td-outer-wrap {
		overflow: visible !important
	}

	body.admin-bar .fixed-mob-sidebar {
		top: 106px
	}

	@media(min-width: 768px) {
		body.admin-bar .fixed-mob-sidebar {
			top: 116px
		}
	}

	@media(min-width: 803px) {
		body.admin-bar .fixed-mob-sidebar {
			top: 102px
		}
	}

	@media(min-width: 992px) {
		body.admin-bar .fixed-mob-sidebar {
			top: 130px
		}
	}

	.fixed-mob-sidebar {
		position: -webkit-sticky !important;
		position: sticky !important;
		top: 100px;
		z-index: 100
	}

	@media(max-width: 991px) {
		.fixed-mob-sidebar {
			top: 70px;
			margin: 0 -15px 25px
		}
	}

	@media(max-width: 767px) {
		.fixed-mob-sidebar {
			top: 60px
		}
	}

	@media(max-width: 991px) {
		.widget {
			overflow: visible !important
		}
	}

	.sidebar .desktop-toc {
		margin-bottom: 0
	}

	.sidebar .desktop-toc.open-toc .list-widget-wrap {
		display: block
	}

	.sidebar .desktop-toc.open-toc .bg-widget-title i {
		transform: translateY(-50%) rotate(-90deg)
	}

	.sidebar .bg-widget-title {
		font-size: 16px;
		line-height: 19px;
		letter-spacing: .02em;
		color: #fff;
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700;
		background: #cb2026;
		position: relative;
		padding: 10px 35px 10px 15px;
		cursor: pointer
	}

	@media(min-width: 992px) {
		.sidebar .bg-widget-title {
			color: #44444b;
			cursor: default;
			padding: 0 0 4px;
			border-bottom: 1px solid #a3a3a3;
			margin-bottom: 15px;
			background: 0 0
		}
	}

	.sidebar .bg-widget-title i {
		color: #fff;
		position: absolute;
		top: 50%;
		right: 15px;
		transform: translateY(-50%) rotate(90deg);
		font-size: 11px;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s
	}

	@media(min-width: 992px) {
		.sidebar .bg-widget-title i {
			display: none
		}
	}

	.sidebar .list-widget-wrap {
		display: none
	}

	@media(max-width: 991px) {
		.sidebar .list-widget-wrap {
			position: absolute;
			top: 100%;
			left: 0;
			right: 0
		}
	}

	@media(min-width: 992px) {
		.sidebar .list-widget-wrap {
			display: block
		}
	}

	.sidebar .toc_widget_list {
		margin: 0;
		background: #cb2026;
		padding: 0 35px 10px 15px
	}

	@media(min-width: 992px) {
		.sidebar .toc_widget_list {
			padding: 0 4px 0 0;
			background: 0 0;
			max-height: 320px;
			overflow-y: auto
		}
	}

	.sidebar .toc_widget_list::-webkit-scrollbar {
		width: 8px
	}

	.sidebar .toc_widget_list::-webkit-scrollbar-track {
		background: rgba(0, 0, 0, .05);
		border: 3px solid #fff;
		border-radius: 8px
	}

	.sidebar .toc_widget_list::-webkit-scrollbar-thumb {
		background: #4cb7a2;
		border: 1px solid #f0f0f0;
		box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
		border-radius: 8px
	}

	.sidebar .toc_widget_list li {
		list-style: none;
		margin: 0
	}

	@media(min-width: 992px) {
		.sidebar .toc_widget_list li {
			margin: 0 0 10px
		}
	}

	.sidebar .toc_widget_list li:last-child {
		margin-bottom: 0
	}

	.sidebar .toc_widget_list a {
		font-size: 13px;
		padding: 6px 0;
		letter-spacing: .02em;
		color: #fff;
		display: block;
		text-decoration: none;
		cursor: pointer;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s
	}

	@media(min-width: 992px) {
		.sidebar .toc_widget_list a {
			line-height: 1.2;
			font-size: 12px;
			padding: 0;
			color: rgba(68, 68, 75, .7)
		}

		.sidebar .toc_widget_list a:hover {
			color: #cb2026
		}
	}

	.approve-badge-wrapper {
		position: relative;
		margin-bottom: 20px;
		margin-top: 30px;
		padding: 25px 15px;
		border: 2px solid #ade0d6;
		border-radius: 16px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		text-align: left
	}

	@media(min-width: 768px) {
		.approve-badge-wrapper {
			min-height: 140px;
			padding: 25px 25px 25px 120px;
			margin-left: 63px;
			border-radius: 0 16px 16px 0;
			margin-bottom: 45px;
			-webkit-box-align: start;
			-ms-flex-align: start;
			align-items: flex-start
		}
	}

	.approve-badge-wrapper img {
		width: 100%;
		height: 175px;
		max-width: 160px;
		margin-bottom: 15px
	}

	@media(min-width: 768px) {
		.approve-badge-wrapper img {
			position: absolute;
			top: -9px;
			left: -63px;
			margin-bottom: 0
		}
	}

	.approve-badge-wrapper .badge-title p {
		font-size: 15px;
		line-height: 1.7;
		letter-spacing: .02em;
		color: #44444b;
		transition: all .3s
	}

	@media(min-width: 992px) {
		.approve-badge-wrapper .badge-title p a:hover {
			text-decoration: underline;
			color: #ff7152
		}
	}

	.approve-badge-wrapper .badge-title p:first-child {
		font-size: 20px;
		line-height: 1.4;
		font-style: normal;
		font-weight: 900;
		margin-bottom: 8px;
		color: #ff7152;
		letter-spacing: 0
	}

	@media(min-width: 768px) {
		.approve-badge-wrapper .badge-title p:first-child {
			margin-bottom: 5px;
			font-size: 22px
		}
	}

	.table-wrapper {
		overflow: hidden
	}

	.custom-table {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		width: 100%;
		border: 1px solid #cb2026;
		border-radius: 15px;
		margin: 50px 0 30px;
		position: relative
	}

	.custom-table:after,
	.custom-table:before {
		content: "";
		position: absolute;
		transition: all .3s ease-in
	}

	.custom-table:after {
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: rgba(255, 255, 255, .9);
		z-index: 1;
		backdrop-filter: blur(10px);
		border-radius: 15px
	}

	.custom-table:before {
		top: 50%;
		left: 50%;
		width: 64px;
		height: 64px;
		transform: translate(-50%, 50%);
		background-image: url(//www.mypetneedsthat.com/wp-content/themes/mypetneedsthat/assets/css/../images/spiner/spinner-gif.gif);
		display: block;
		z-index: 2;
		mix-blend-mode: multiply
	}

	.custom-table.table-preload:after,
	.custom-table.table-preload:before {
		opacity: 0;
		pointer-events: none
	}

	.custom-table.table-mr {
		margin: 30px 0
	}

	.custom-table .table-init-slider:not(.slick-initialized) {
		display: flex
	}

	@media(min-width: 768px) and (max-width:991px) {
		.custom-table .table-init-slider:not(.slick-initialized) .table-tr:nth-child(3) .table-th {
			border-right: none
		}
	}

	@media(min-width: 992px) and (max-width:1199px) {
		.custom-table .table-init-slider:not(.slick-initialized) .table-tr:nth-child(4) .table-th {
			border-right: none
		}
	}

	@media(min-width: 1200px) {
		.custom-table .table-init-slider:not(.slick-initialized) .table-tr:nth-child(5) .table-th {
			border-right: none
		}
	}

	.custom-table .table-init-slider:not(.slick-initialized):first-child {
		border-radius: 0 15px 0 0
	}

	.custom-table .table-init-slider:not(.slick-initialized) .table-items {
		width: 33.33%;
		min-width: 33.33%
	}

	@media(min-width: 992px) {
		.custom-table .table-init-slider:not(.slick-initialized) .table-items {
			width: 25%;
			min-width: 25%
		}
	}

	@media(min-width: 1200px) {
		.custom-table .table-init-slider:not(.slick-initialized) .table-items {
			width: 20%;
			min-width: 20%
		}
	}

	.custom-table .table-init-slider:not(.slick-initialized) .table-tbody {
		width: calc(100% - 120px)
	}

	.custom-table .table-thead .table-tr>p,
	.custom-table .table-tbody .table-tr>p {
		display: none
	}

	.custom-table .table-thead .table-th,
	.custom-table .table-tbody .table-th {
		font-size: 13px;
		line-height: 1.6;
		color: #000;
		min-height: 40px;
		padding: 8px 10px;
		border-bottom: 1px solid #cb2026
	}

	.custom-table .table-thead .table-th:last-child,
	.custom-table .table-tbody .table-th:last-child {
		border-bottom: none
	}

	.custom-table .table-tbody .table-th>p {
		font-size: 13px;
		line-height: 1.6;
		text-align: center
	}

	.custom-table .table-thead {
		width: 120px;
		min-width: 120px;
		border-right: 1px solid #cb2026;
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700
	}

	.custom-table .table-tbody {
		width: calc(100% - 120px);
		border-radius: 0 15px 15px 0
	}

	.custom-table .table-tbody .table-th {
		border-right: 1px solid #cb2026;
		text-align: center;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center
	}

	.custom-table .table-tbody .table-th .title {
		margin-top: 5px
	}

	.custom-table .table-tbody .image-wrap {
		width: 120px;
		height: 120px
	}

	.custom-table .table-tbody .image-wrap img {
		width: auto;
		height: auto;
		max-width: 100%
	}

	.custom-table .btn_slider {
		position: absolute;
		top: -30px;
		right: 0;
		background: 0 0;
		border: none;
		cursor: pointer;
		padding: 0;
		transition: all .3s ease-in
	}

	@media(min-width: 992px) {
		.custom-table .btn_slider:hover {
			color: #cb2026
		}
	}

	.custom-table .btn_slider i {
		display: inline-block;
		font-size: 12px
	}

	.custom-table .btn_slider.btn-prev {
		right: 80px
	}

	.custom-table .btn_slider.btn-prev i {
		margin-right: 8px
	}

	.custom-table .btn_slider.btn-next i {
		margin-left: 8px
	}

	.card-grid {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap;
		margin: 0 -12px
	}

	.card-grid .card-item-link {
		position: absolute;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		font-size: 0;
		z-index: 1
	}

	.card-grid .card-grid-wrap {
		width: 100%;
		min-width: 100%;
		padding: 0 12px;
		margin-bottom: 25px
	}

	@media(min-width: 768px) {
		.card-grid .card-grid-wrap {
			width: 50%;
			min-width: 50%
		}
	}

	@media(min-width: 992px) {
		.card-grid .card-grid-wrap {
			width: 33.33%;
			min-width: 33.33%
		}
	}

	.card-grid .card-item {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
		height: 100%;
		background: #fff;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s;
		border-radius: 32px;
		overflow: hidden;
		position: relative;
		-webkit-box-shadow: 0 0 20px rgba(191, 214, 207, .6);
		-moz-box-shadow: 0 0 20px rgba(191, 214, 207, .6);
		box-shadow: 0 0 20px rgba(191, 214, 207, .6)
	}

	@media(min-width: 992px) {
		.card-grid .card-item:hover {
			text-decoration: none
		}

		.card-grid .card-item:hover .info {
			background-color: #ade0d6
		}

		.card-grid .card-item:hover .label-wrapper svg {
			fill: #fff
		}
	}

	.card-grid .image-wrap {
		position: relative;
		display: block;
		padding-top: 70%
	}

	.card-grid .image-wrap img {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		width: 100%;
		height: 100%;
		display: block;
		object-fit: cover
	}

	.card-grid .info {
		flex-grow: 1;
		display: block;
		text-align: center;
		position: relative;
		background-color: #fff;
		border-radius: 180px 180px 0 0/20px 20px 0 0;
		padding: 35px 20px 20px;
		margin-top: -20px;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s
	}

	@media(min-width: 768px) {
		.card-grid .info {
			padding: 45px 25px 20px
		}
	}

	@media(min-width: 1200px) {
		.card-grid .info {
			padding: 45px 25px 25px
		}
	}

	.card-grid .info .label-wrapper {
		width: 70px;
		height: 68px;
		position: absolute;
		top: -44px;
		left: 50%;
		transform: translateX(-50%);
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center
	}

	@media(min-width: 768px) {
		.card-grid .info .label-wrapper {
			width: 75px;
			height: 73px
		}
	}

	.card-grid .info .label-wrapper svg {
		position: absolute;
		top: 0;
		left: 50%;
		transform: translateX(-50%);
		bottom: 0;
		z-index: 1;
		fill: #ade0d6;
		width: 100%;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s
	}

	.card-grid .info .label-wrapper .label {
		position: absolute;
		bottom: 17px;
		left: 50%;
		transform: translateX(-50%);
		font-size: 8px;
		line-height: 1.1;
		text-align: center;
		color: #459484;
		z-index: 2;
		font-style: normal;
		font-weight: 700;
		width: 50px
	}

	@media(min-width: 768px) {
		.card-grid .info .label-wrapper .label {
			font-size: 10px
		}
	}

	.card-grid .info .title {
		display: block;
		font-size: 18px;
		font-style: normal;
		font-weight: 700;
		line-height: 1.5;
		text-align: center;
		text-transform: capitalize;
		color: #003525
	}

	@media(min-width: 768px) {
		.card-grid .info .title {
			font-size: 19px
		}
	}

	.title-schedule {
		font-style: normal;
		font-weight: 700;
		font-size: 18px;
		line-height: 1.2;
		letter-spacing: .496657px;
		color: #0e4434;
		margin-bottom: 15px;
		text-align: center
	}

	.subtitle-schedule {
		font-size: 15px;
		line-height: 1.4;
		letter-spacing: .28px;
		color: #cb2026;
		margin-bottom: 16px;
		text-align: center
	}

	.horizontal-grid {
		max-width: 600px;
		margin: 0 auto 25px
	}

	.horizontal-grid-items {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		margin-bottom: 10px
	}

	@media(min-width: 768px) {
		.horizontal-grid-items {
			margin-bottom: 16px
		}
	}

	.horizontal-grid-items:last-child {
		margin-bottom: 0
	}

	.horizontal-grid-items .schedule-description {
		max-width: 125px;
		min-width: 125px;
		padding-right: 10px;
		text-align: right;
		font-size: 11px;
		line-height: 1.3
	}

	@media(min-width: 768px) {
		.horizontal-grid-items .schedule-description {
			font-size: 12px;
			padding-right: 16px;
			max-width: 200px;
			min-width: 200px
		}
	}

	.horizontal-grid-items .schedule-line {
		min-height: 40px;
		border-radius: 0 15px 15px 0;
		position: relative
	}

	@media(min-width: 768px) {
		.horizontal-grid-items .schedule-line {
			min-height: 48px;
			border-radius: 0 24px 24px 0
		}
	}

	.horizontal-grid-items .schedule-line span {
		position: absolute;
		top: 50%;
		left: 5px;
		transform: translateY(-50%);
		color: #fff;
		font-size: 11px
	}

	@media(min-width: 768px) {
		.horizontal-grid-items .schedule-line span {
			left: 10px
		}
	}

	.barchart {
		max-width: 600px;
		padding-bottom: 60px;
		margin: 0 auto 25px
	}

	.barchart .subtitle-schedule {
		border-bottom: 1px solid rgba(0, 0, 0, .05);
		padding-bottom: 10px;
		margin-bottom: 15px
	}

	.scale-wrapper {
		position: absolute;
		height: 100%;
		width: 100%
	}

	.scale-wrapper span {
		position: absolute;
		font-size: 12px;
		line-height: 1.2;
		color: #8898aa;
		left: -25px;
		width: 100%;
		height: 20px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center
	}

	@media(min-width: 768px) {
		.scale-wrapper span {
			font-size: 14px
		}
	}

	.scale-wrapper span:after {
		content: "";
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		left: 25px;
		width: 96%;
		height: 1px;
		border-bottom: 1px dashed #dee2e6
	}

	.scale-wrapper span:nth-child(1) {
		bottom: 0
	}

	.scale-wrapper span:nth-child(1):after {
		display: none
	}

	.scale-wrapper span:nth-child(2) {
		bottom: 25%
	}

	.scale-wrapper span:nth-child(3) {
		bottom: 50%
	}

	.scale-wrapper span:nth-child(4) {
		bottom: 75%
	}

	.barchart-grid {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		border-bottom: 1px dashed #dee2e6;
		height: 280px;
		position: relative;
		margin-left: 40px
	}

	@media(min-width: 768px) {
		.barchart-grid {
			margin-left: 50px
		}
	}

	.barchart-grid .barchart-items {
		width: 16.66%;
		min-width: 16.66%;
		padding: 0 5px;
		position: relative
	}

	@media(min-width: 768px) {
		.barchart-grid .barchart-items {
			padding: 0 10px
		}
	}

	.barchart-grid .barchart-items .barchart-text {
		position: absolute;
		bottom: -25px;
		left: 50%;
		transform: translateX(-50%);
		font-size: 12px;
		line-height: 1.2;
		color: #8898aa
	}

	.barchart-grid .barchart-items:nth-last-child(-n+3) .description-wrapper {
		right: 100%;
		left: auto;
		padding: 0 10px 0 0
	}

	.barchart-grid .barchart-items:nth-last-child(-n+3) .description-wrapper:before {
		border-width: 4px 5px 4px 0;
		border-color: transparent #000 transparent transparent;
		right: 5px;
		left: auto;
		transform: translateY(-50%) rotate(180deg)
	}

	.barchart-grid .barchart-line-wrapper {
		height: 100%;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: end;
		-ms-flex-align: end;
		align-items: flex-end
	}

	.barchart-grid .barchart-line {
		width: 8px;
		min-width: 8px;
		position: relative;
		border-radius: 5.5px 5.5px 0 0;
		cursor: pointer
	}

	@media(min-width: 768px) {
		.barchart-grid .barchart-line {
			width: 10px
		}
	}

	@media(max-width: 991px) {
		.barchart-grid .barchart-line {
			user-select: none
		}

		.barchart-grid .barchart-line.show .description-wrapper {
			opacity: 1;
			visibility: visible
		}
	}

	@media(min-width: 992px) {
		.barchart-grid .barchart-line:hover .description-wrapper {
			opacity: 1;
			visibility: visible
		}
	}

	.barchart-grid .barchart-line .description-wrapper {
		display: block;
		position: absolute;
		top: 10px;
		left: 100%;
		transform: translate(0, -50%);
		padding: 0 0 0 10px;
		transition: all .15s ease;
		width: 160px;
		opacity: 0;
		visibility: hidden;
		z-index: 3
	}

	@media(min-width: 768px) {
		.barchart-grid .barchart-line .description-wrapper {
			width: 170px
		}
	}

	@media(min-width: 992px) {
		.barchart-grid .barchart-line .description-wrapper {
			width: 210px
		}
	}

	.barchart-grid .barchart-line .description-wrapper span {
		display: block;
		position: relative;
		padding: 10px;
		background: #000;
		color: #fff;
		font-size: .7rem;
		box-shadow: 0 0 8px rgba(0, 0, 0, .2);
		border-radius: 5px
	}

	.barchart-grid .barchart-line .description-wrapper:before {
		content: "";
		width: 0;
		height: 0;
		border-style: solid;
		border-width: 4px 5px 4px 0;
		border-color: transparent #000 transparent transparent;
		position: absolute;
		left: 5px;
		top: 50%;
		transform: translateY(-50%)
	}

	.barchart-grid .barchart-scale-title {
		position: absolute;
		left: -40px;
		top: 50%;
		font-size: 12px;
		line-height: 1.2;
		color: #8898aa;
		-moz-transform: translate(0, -50%) rotate(-90deg);
		-o-transform: translate(0, -50%) rotate(-90deg);
		-ms-transform: translate(0, -50%) rotate(-90deg);
		-webkit-transform: translate(0, -50%) rotate(-90deg);
		transform: translate(0, -50%) rotate(-90deg);
		transform-origin: left
	}

	@media(min-width: 768px) {
		.barchart-grid .barchart-scale-title {
			left: -50px;
			font-size: 14px
		}
	}

	.barchart-grid .barchart-items-title {
		position: absolute;
		left: 50%;
		bottom: -60px;
		font-size: 12px;
		line-height: 1.2;
		color: #8898aa;
		-moz-transform: translate(-50%, 0);
		-o-transform: translate(-50%, 0);
		-ms-transform: translate(-50%, 0);
		-webkit-transform: translate(-50%, 0);
		transform: translate(-50%, 0)
	}

	@media(min-width: 768px) {
		.barchart-grid .barchart-items-title {
			font-size: 14px
		}
	}

	.author-box-wrap {
		margin: 35px 0 0;
		border: 1px solid #4ab5a0;
		padding: 25px 15px;
		border-radius: 16px;
		background: #fff;
		box-shadow: 4px 0 20px rgba(191, 214, 207, .2)
	}

	.author-box-wrap:after {
		content: "";
		clear: both;
		display: block
	}

	@media(min-height: 768px) {
		.author-box-wrap {
			padding: 20px
		}
	}

	@media(min-width: 992px) {
		.author-box-wrap {
			margin: 45px 0 0
		}
	}

	.author-box-wrap .author-box-image {
		width: 65px;
		height: 65px;
		display: inline-block;
		margin: 0 15px 0 0;
		float: left
	}

	@media(min-width: 992px) {
		.author-box-wrap .author-box-image {
			margin: 0 15px 5px 0;
			width: 85px;
			height: 85px
		}
	}

	.author-box-wrap .author-box-image img {
		width: 100%;
		height: 100%
	}

	.author-box-wrap .author-name {
		text-transform: capitalize;
		font-size: 18px;
		margin-bottom: 8px;
		line-height: 1.2;
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700;
		text-align: left
	}

	@media(min-width: 992px) {
		.author-box-wrap .author-name {
			font-size: 20px
		}
	}

	.author-box-wrap .social-icon-list {
		margin-top: 15px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center
	}

	.author-box-wrap .social-icon-list>li+li {
		margin-left: 15px
	}

	.author-box-wrap .social-icon-list .social-icon>a {
		transition: all .3s;
		display: block;
		line-height: 1
	}

	@media(min-width: 992px) {
		.author-box-wrap .social-icon-list .social-icon>a:hover {
			text-decoration: none;
			transform: rotateY(360deg)
		}
	}

	.author-box-wrap .social-icon-list .social-icon>a i {
		font-size: 30px;
		color: #4db7a2
	}

	.comments-wrap {
		margin-top: 45px;
		padding: 30px 20px 10px;
		background: #fff;
		border: 1px solid #cb2026;
		box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
		border-radius: 32px
	}

	@media(min-width: 768px) {
		.comments-wrap {
			padding: 50px 40px 30px
		}
	}

	@media(min-width: 992px) {
		.comments-wrap {
			margin-top: 65px
		}
	}

	.comments-wrap.no-comments.no-form {
		display: none
	}

	.comments-wrap.no-comments .comment-list {
		display: none
	}

	.comments-wrap.no-form .comment-respond {
		display: none
	}

	.comments-wrap .admin-wrapper {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		margin-bottom: 5px
	}

	.comments-wrap .logged-in-as {
		margin: -20px 0 10px;
		font-size: 14px
	}

	@media(min-width: 768px) {
		.comments-wrap .logged-in-as {
			font-size: 15px
		}
	}

	.comments-wrap .comment-author-label {
		width: max-content;
		text-align: center;
		padding: 4px 10px;
		background: #4ab5a0;
		color: #fff;
		border-radius: 22px;
		display: inline-block;
		margin-right: 10px;
		font-size: 13px;
		line-height: 1.2
	}

	.comments-wrap .comment-edit-admin {
		line-height: 1.2
	}

	.comments-wrap .comment-author-name {
		text-transform: capitalize;
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700;
		line-height: 1.2;
		margin-bottom: 5px
	}

	.comments-wrap .comment-date {
		line-height: 1;
		font-size: 12px;
		color: #a3a3a3
	}

	.comments-wrap .comment-meta {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: justify;
		-ms-flex-pack: justify;
		justify-content: space-between
	}

	.comments-wrap .comment-meta .line-comments {
		display: block;
		width: 100%;
		flex: 1;
		background-color: #cb2026;
		height: 1px;
		margin: 0 0 0 20px
	}

	.comments-wrap .comment-meta .comment-reply-link {
		text-transform: uppercase;
		color: #44444b;
		font-family: gothammedium, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 500
	}

	@media(min-width: 992px) {
		.comments-wrap .comment-meta .comment-reply-link:hover {
			color: #ff7152
		}
	}

	.comments-wrap .comment-meta .hide_thread {
		font-family: gothammedium, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 500;
		font-size: 15px;
		line-height: 30px;
		text-transform: uppercase;
		cursor: pointer;
		margin: 0 0 0 20px
	}

	.comments-wrap .comment-meta .hide_thread span {
		color: #4cb7a2;
		text-decoration: underline
	}

	.comments-wrap .comment-list {
		margin: 0;
		padding: 0 0 25px
	}

	@media(min-width: 768px) {
		.comments-wrap .comment-list {
			padding: 0 0 30px
		}
	}

	.comments-wrap .comment-list>li:first-child {
		margin-top: 0 !important
	}

	.comments-wrap .comment-list>li:last-child {
		margin-bottom: 0
	}

	.comments-wrap .comment-list li {
		margin-bottom: 20px;
		list-style: none;
		position: relative
	}

	.comments-wrap .comment-list li .author-info-wrapper {
		position: relative;
		margin-bottom: 12px
	}

	.comments-wrap .comment-list li .author-info-wrapper .author-img {
		width: 55px;
		min-width: 55px;
		height: 55px
	}

	.comments-wrap .comment-list>ul>li {
		margin: 20px 0 20px 20px
	}

	@media(min-width: 768px) {
		.comments-wrap .comment-list>ul>li {
			margin: 20px 0 20px 40px
		}
	}

	.comments-wrap .comment-list>ul>ul>li {
		margin: 20px 0 20px 40px
	}

	@media(min-width: 768px) {
		.comments-wrap .comment-list>ul>ul>li {
			margin: 20px 0 20px 60px
		}
	}

	.comments-wrap ul.children {
		list-style: none
	}

	.comments-wrap ul.children .author-info-wrapper:after {
		display: none
	}

	.comments-wrap .comment-form>div {
		margin-bottom: 15px
	}

	.comments-wrap .comment-form input[type=text],
	.comments-wrap .comment-form input[type=url],
	.comments-wrap .comment-form input[type=tel],
	.comments-wrap .comment-form input[type=email],
	.comments-wrap .comment-form textarea {
		font-size: 13px;
		line-height: 1.2;
		width: 100%;
		max-width: 100%;
		height: 34px;
		padding: 10px 15px;
		background: #fff;
		border: 1px solid transparent;
		box-shadow: 0 3px 12px rgba(0, 0, 0, .13);
		border-radius: 8px
	}

	@media(min-width: 992px) {

		.comments-wrap .comment-form input[type=text]:focus-within,
		.comments-wrap .comment-form input[type=url]:focus-within,
		.comments-wrap .comment-form input[type=tel]:focus-within,
		.comments-wrap .comment-form input[type=email]:focus-within,
		.comments-wrap .comment-form textarea:focus-within {
			border: 1px solid #4cb7a2
		}
	}

	.comments-wrap .comment-form input[type=text],
	.comments-wrap .comment-form input[type=url],
	.comments-wrap .comment-form input[type=tel],
	.comments-wrap .comment-form input[type=email] {
		min-height: 40px
	}

	.comments-wrap .comment-form textarea {
		min-height: 150px;
		resize: none
	}

	@media(min-width: 768px) {
		.comments-wrap .comment-form textarea {
			min-height: 200px
		}
	}

	.comments-wrap .comment-form input[type=submit] {
		font-family: gothammedium, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 500;
		color: #fff;
		cursor: pointer;
		font-size: 15px;
		line-height: 1.2;
		display: inline-block;
		position: relative;
		padding: 12px 10px;
		border-radius: 28px;
		-webkit-transition: all .3s;
		-moz-transition: all .3s;
		-ms-transition: all .3s;
		-o-transition: all .3s;
		transition: all .3s;
		min-width: 200px;
		text-align: center;
		background: #ff7152;
		border: 1px solid #ff7152;
		transition: all .3s
	}

	@media(max-width: 767px) {
		.comments-wrap .comment-form input[type=submit] {
			width: 100%
		}
	}

	@media(min-width: 992px) {
		.comments-wrap .comment-form input[type=submit] {
			font-size: 16px;
			padding: 15px 10px
		}

		.comments-wrap .comment-form input[type=submit]:hover {
			text-decoration: none;
			background: 0 0;
			color: #ff7152
		}
	}

	.comments-wrap .comment-form .td-warning-comment,
	.comments-wrap .comment-form .td-warning-email,
	.comments-wrap .comment-form .td-warning-email-error,
	.comments-wrap .comment-form .td-warning-author {
		line-height: 1;
		display: none;
		font-size: 13px
	}

	.comments-wrap .comment-form .comment-form-cookies-consent {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center
	}

	.comments-wrap .comment-form .comment-form-cookies-consent label {
		font-size: 13px
	}

	.comments-wrap .comment-form .comment-form-cookies-consent input {
		display: inline-block;
		margin-right: 10px;
		border: 1px solid #cb2026
	}

	.comments-wrap .comment-form .comment-form-cookies-consent input:hover,
	.comments-wrap .comment-form .comment-form-cookies-consent input input:focus {
		-webkit-appearance: checkbox
	}

	.comments-wrap .comment-form .form-submit {
		margin-bottom: 0
	}

	.comment-respond {
		margin-bottom: 20px
	}

	.comment-respond .comment-reply-title {
		margin-bottom: 20px;
		position: relative;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: justify;
		-ms-flex-pack: justify;
		justify-content: space-between
	}

	.comment-respond .comment-reply-title span {
		display: block;
		text-transform: uppercase;
		line-height: 1.25;
		color: #44444b;
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700;
		font-size: 20px
	}

	@media(min-width: 768px) {
		.comment-respond .comment-reply-title span {
			font-size: 28px
		}
	}

	@media(min-width: 992px) {
		.comment-respond .comment-reply-title span {
			font-size: 34px
		}
	}

	.comment-respond .comment-reply-title:after {
		content: "";
		display: block;
		width: 100%;
		flex: 1;
		background-color: #cb2026;
		height: 1px;
		margin-left: 25px
	}

	.faq-block-new {
		padding: 20px 0 0
	}

	@media(min-width: 992px) {
		.faq-block-new {
			padding: 30px 0 0
		}
	}

	.faq-block-new .section-title {
		font-style: normal;
		font-weight: 900;
		margin-bottom: 20px;
		text-align: center
	}

	.faq-grid-item {
		position: relative;
		margin-bottom: 20px;
		background: #fff;
		box-shadow: 0 3px 12px rgba(0, 0, 0, .13);
		border-radius: 16px
	}

	.faq-grid-item:last-of-type {
		margin-bottom: 0
	}

	.faq-grid-item .accordion-input {
		display: none
	}

	.faq-grid-item .accordion-input:checked~.accordion-body {
		display: block;
		border-top: 1px solid #cb2026;
		padding: 15px 20px 25px
	}

	@media(min-width: 768px) {
		.faq-grid-item .accordion-input:checked~.accordion-body {
			padding: 15px 30px 30px 35px
		}
	}

	.faq-grid-item .accordion-input:checked~label .text {
		color: #cb2026
	}

	.faq-grid-item .accordion-input:checked~label .accordion-btn i {
		transform: rotate(90deg)
	}

	.faq-title {
		padding: 15px 20px;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: justify;
		-ms-flex-pack: justify;
		justify-content: space-between;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		cursor: pointer
	}

	@media(min-width: 768px) {
		.faq-title {
			padding: 15px 30px 15px 35px
		}
	}

	.faq-title h3 {
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700;
		margin-bottom: 0;
		transition: all .3s;
		padding-right: 15px;
		font-size: 24px
	}

	@media(max-width: 768px) {
		.faq-title h3 {
			font-size: 18px
		}
	}

	.accordion-btn i {
		display: block;
		color: #cb2026;
		transition: all .3s;
		transform: rotate(0deg)
	}

	.accordion-body {
		display: none
	}

	.related-posts {
		position: relative;
		padding: 30px 0 15px
	}

	@media(min-width: 768px) {
		.related-posts {
			padding: 50px 0 35px
		}
	}

	@media(min-width: 1200px) {
		.related-posts {
			padding: 70px 0 50px
		}
	}

	.related-posts .container {
		position: relative;
		z-index: 2
	}

	.related-posts:after {
		content: "";
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		height: 77%;
		background-color: #e8f4ff;
		z-index: 1
	}

	.related-posts .section-title-decor {
		color: #cb2026
	}

	.related-posts .section-title-decor:after,
	.related-posts .section-title-decor:before {
		background: #cb2026
	}

	.buying-guide-page-2.no-toc .page-breadcrumbs {
		max-width: 975px;
		margin: 0 auto
	}

	@media(min-width: 992px) {
		.buying-guide-page-2.no-toc .page-breadcrumbs {
			padding: 0 15px
		}
	}

	@media(min-width: 992px) {
		.buying-guide-page-2.no-toc .best-items-banner-bg {
			margin-bottom: 20px
		}
	}

	@media(min-width: 768px) {
		.buying-guide-page-2.no-toc .content-wrap {
			margin: 20px auto 55px;
			max-width: 975px
		}
	}

	@media(min-width: 992px) {
		.buying-guide-page-2.no-toc .content-wrap {
			margin: 20px auto 65px;
			padding: 0 15px
		}
	}

	.buying-guide-page-2.no-toc .main-content {
		padding-left: 0
	}

	.content-wrap {
		margin: 20px 0 45px
	}

	@media(min-width: 768px) {
		.content-wrap {
			margin: 30px 0 55px
		}
	}

	@media(min-width: 992px) {
		.content-wrap {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flexbox;
			display: flex;
			margin: 40px 0 65px
		}
	}

	.content-wrap .sidebar {
		border-radius: 16px
	}

	@media(min-width: 992px) {
		.content-wrap .sidebar {
			padding: 16px 8px;
			background: #fff;
			box-shadow: 4px 0 20px rgba(191, 214, 207, .2);
			border-radius: 0 16px 16px 0;
			height: max-content;
			width: 150px;
			min-width: 150px
		}
	}

	@media(min-width: 992px) {
		.content-wrap .main-content {
			flex-grow: 1;
			padding-left: 30px;
			width: calc(100% - 150px)
		}
	}

	.content-wrap .main-content .content {
		margin-bottom: 30px
	}

	@media(min-width: 768px) {
		.content-wrap .main-content .content {
			margin-bottom: 35px
		}
	}

	.product-item {
		margin-bottom: 45px
	}

	@media(min-width: 768px) {
		.product-item {
			margin-bottom: 60px
		}
	}

	.product-item.extend .product-info-hide {
		display: none
	}

	.product-item.extend .product-show-hide i {
		transform: rotate(90deg)
	}

	.product-item .title-wrap {
		margin-bottom: 25px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center
	}

	.product-item .title-wrap>span {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center
	}

	.product-item .bg-item-title {
		font-size: 20px;
		line-height: 1.2;
		letter-spacing: .02em;
		color: #cb2026;
		font-style: normal;
		font-weight: 900;
		text-transform: capitalize
	}

	@media(min-width: 768px) {
		.product-item .bg-item-title {
			font-size: 32px
		}
	}

	@media(min-width: 1200px) {
		.product-item .bg-item-title {
			font-size: 36px
		}
	}

	.product-item .bg-item-title.sponsored-product>span {
		-webkit-box-align: start;
		-ms-flex-align: start;
		align-items: flex-start;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column
	}

	.product-item .bg-item-title.sponsored-product .sponsored-product-wrap {
		font-size: 15px;
		line-height: 1.7;
		text-transform: capitalize;
		font-family: gothammedium, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 500;
		color: #ff7152
	}

	.product-item .bg-item-number {
		min-width: 45px;
		height: 43px;
		margin-right: 15px;
		position: relative
	}

	@media(min-width: 768px) {
		.product-item .bg-item-number {
			margin-right: 25px;
			min-width: 55px;
			height: 53px
		}
	}

	.product-item .bg-item-number svg {
		position: absolute;
		top: 0;
		left: 50%;
		transform: translateX(-50%);
		bottom: 0;
		z-index: 1;
		fill: #cb2026;
		width: 100%;
		transition: all .3s
	}

	.product-item .bg-item-number .number-product {
		position: absolute;
		top: 55%;
		left: 50%;
		transform: translate(-50%);
		font-size: 15px;
		line-height: 14px;
		color: #fff;
		z-index: 2
	}

	.product-item .product-item-image {
		position: relative;
		padding-top: 45%;
		margin-bottom: 20px;
		border-radius: 32px;
		overflow: hidden;
		background: linear-gradient(90deg, rgba(249, 248, 246, .2) 0%, rgba(255, 255, 255, .2) 50.6%, rgba(249, 248, 246, .2) 100%), #f9f8f6
	}

	.product-item .product-item-image img {
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		width: 100%;
		height: 100%;
		-o-object-fit: cover;
		object-fit: cover;
		mix-blend-mode: multiply
	}

	.product-item .product-key-features {
		margin-bottom: 25px
	}

	.product-item .product-key-features .title {
		font-style: normal;
		font-weight: 900;
		font-size: 18px;
		line-height: 1.2;
		color: #ff7152;
		padding-bottom: 8px;
		margin-bottom: 20px;
		border-bottom: 1px solid #ff7152
	}

	@media(min-width: 768px) {
		.product-item .product-key-features .title {
			font-size: 22px
		}
	}

	@media(min-width: 992px) {
		.product-item .product-key-features .title {
			margin-bottom: 25px;
			font-size: 24px
		}
	}

	.product-item .product-key-features ul {
		margin: 0
	}

	@media(min-width: 768px) {
		.product-item .product-key-features ul {
			column-gap: 30px;
			column-count: 2
		}
	}

	.product-item .product-key-features ul li {
		margin: 0 0 8px;
		font-size: 15px;
		line-height: 1.5;
		display: block;
		list-style: none;
		padding-left: 20px;
		position: relative
	}

	@media(min-width: 768px) {
		.product-item .product-key-features ul li {
			margin: 0 0 10px;
			font-size: 16px
		}
	}

	@media(min-width: 992px) {
		.product-item .product-key-features ul li {
			margin: 0 0 12px
		}
	}

	.product-item .product-key-features ul li:after {
		content: "";
		position: absolute;
		top: 10px;
		left: 8px;
		width: 4px;
		height: 4px;
		background: #44444b;
		border-radius: 50%
	}

	.product-item .product-description {
		margin-bottom: 15px
	}

	.product-item .product-info-hide .product-description {
		margin-bottom: 25px
	}

	.product-item .product-ingredients {
		margin-bottom: 25px
	}

	.product-item .product-ingredients .title-block {
		font-style: normal;
		font-weight: 900;
		font-size: 18px;
		line-height: 1.2;
		color: #44444b;
		margin-bottom: 10px
	}

	@media(min-width: 992px) {
		.product-item .product-ingredients .title-block {
			margin-bottom: 15px;
			font-size: 20px
		}
	}

	.product-item .product-charts {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-ms-flex-wrap: wrap;
		flex-wrap: wrap
	}

	.product-item .product-charts .chart-direction {
		width: 100%;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center
	}

	@media(min-width: 768px) {
		.product-item .product-charts .chart-direction {
			width: 50%
		}
	}

	@media(min-width: 992px) {
		.product-item .product-charts .chart-direction {
			width: 33.33%
		}
	}

	.product-item .product-charts svg g[column-id]>g>text {
		font-size: 13px
	}

	.product-item .product-charts svg text[font-weight=bold] {
		font-size: 14px
	}

	.product-item .product-charts .google-visualization-tooltip {
		pointer-events: none
	}

	.product-item .product-charts .google-visualization-tooltip>g:last-child {
		font-size: 10px
	}

	.product-item .product-reviews {
		margin-bottom: 30px
	}

	.product-item .product-reviews-slider .product-reviews-item {
		display: none
	}

	.product-item .product-reviews-slider .product-reviews-item:first-child {
		display: block
	}

	.product-item .product-reviews-slider.slick-initialized .product-reviews-item {
		display: block
	}

	.product-item .product-reviews .title {
		font-style: normal;
		font-weight: 900;
		font-size: 20px;
		line-height: 1.4;
		text-align: center;
		color: #44444b;
		margin-bottom: 30px
	}

	.product-item .product-reviews .reviews-decor {
		position: relative;
		max-width: 550px;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		margin: 0 auto 15px
	}

	.product-item .product-reviews .reviews-decor:after,
	.product-item .product-reviews .reviews-decor:before {
		content: "";
		position: absolute;
		width: 40%;
		height: 1px;
		background: #cb2026;
		top: 50%
	}

	.product-item .product-reviews .reviews-decor:after {
		right: 0
	}

	.product-item .product-reviews .reviews-decor:before {
		left: 0
	}

	.product-item .product-reviews .reviews-decor img {
		max-width: 43px;
		width: 100%;
		display: inline-block
	}

	.product-item .product-reviews .slick-btn {
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		border: none;
		background: 0 0;
		z-index: 2;
		cursor: pointer;
		color: #ff7152
	}

	.product-item .product-reviews .slick-btn.btn__next {
		right: -12px
	}

	@media(min-width: 768px) {
		.product-item .product-reviews .slick-btn.btn__next {
			right: 0
		}
	}

	.product-item .product-reviews .slick-btn.btn__nextbtn__prev {
		left: -12px
	}

	@media(min-width: 768px) {
		.product-item .product-reviews .slick-btn.btn__nextbtn__prev {
			left: 0
		}
	}

	.product-item .product-reviews .slick-dots {
		margin: 10px 0 0;
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center
	}

	@media(min-width: 768px) {
		.product-item .product-reviews .slick-dots {
			margin: 16px 0 0
		}
	}

	.product-item .product-reviews .slick-dots li {
		list-style: none;
		margin: 0 5px;
		line-height: 0
	}

	.product-item .product-reviews .slick-dots li.slick-active button {
		background: #ff7152
	}

	.product-item .product-reviews .slick-dots li button {
		width: 8px;
		height: 8px;
		background: rgba(163, 163, 163, .5);
		border-radius: 50%;
		color: transparent;
		border: none;
		font-size: 0;
		line-height: 0;
		padding: 0
	}

	.product-item .slick-track {
		width: 100%
	}

	.product-item .product-reviews-item {
		width: 100%;
		position: relative
	}

	.product-item .product-reviews-item .item-inner {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		max-width: 600px;
		margin: 0 auto
	}

	.product-item .product-reviews-item .post-author {
		margin-bottom: 15px
	}

	@media(max-width: 767px) {
		.product-item .product-reviews-item .author-reviews-description {
			padding: 0 10px
		}
	}

	.product-item .product-reviews-item .author-reviews-description p {
		font-style: italic;
		font-size: 16px;
		text-align: center;
		letter-spacing: .02em
	}

	.product-item .product-reviews-item .author-reviews-description a {
		text-align: center;
		display: block
	}

	.product-item .ps-wrapper-box {
		margin-bottom: 30px
	}

	@media(min-width: 768px) {
		.product-item .ps-wrapper-box {
			margin-bottom: 35px
		}
	}

	.product-item .ps-wrapper-box .title {
		font-style: normal;
		font-weight: 900;
		font-size: 20px;
		margin-bottom: 15px;
		line-height: 1.3;
		color: #44444b
	}

	@media(min-width: 768px) {
		.product-item .ps-wrapper {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flexbox;
			display: flex;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin: 0 -12px
		}
	}

	@media(min-width: 768px) {
		.product-item .ps-wrapper .ps-info {
			width: 50%;
			min-width: 50%;
			padding: 0 12px
		}
	}

	@media(max-width: 767px) {
		.product-item .ps-wrapper .ps-info.pros {
			margin-bottom: 20px
		}
	}

	.product-item .ps-wrapper .ps-info.pros .ps-info-inner {
		background: rgba(75, 181, 160, .05)
	}

	.product-item .ps-wrapper .ps-info.pros .ps-info-title {
		border-color: #cb2026
	}

	.product-item .ps-wrapper .ps-info.pros .ps-info-title i {
		color: #cb2026
	}

	.fa.fa-check {
		top: 5px;
		left: 5px;
		position: absolute;
		font-family: fontawesome !important;
		font-size: 20px;
		color: #4cb7a2;

	}

	.fa.fa-close {
		top: 5px;
		left: 5px;
		position: absolute;
		font-family: fontawesome !important;
		font-size: 20px;
		color: #cb2026
	}

	/* .product-item .ps-wrapper .ps-info.pros li:after {
		content: "\e917";
		color: #cb2026
	} */

	.product-item .ps-wrapper .ps-info.cons .ps-info-inner {
		background: rgba(237, 42, 35, .05)
	}

	.product-item .ps-wrapper .ps-info.cons .ps-info-title {
		border-color: #ed2a23
	}

	.product-item .ps-wrapper .ps-info.cons .ps-info-title i {
		color: #ed2a23
	}

	/* .product-item .ps-wrapper .ps-info.cons li:after {
		content: "\e916";
		color: #ed2a23
	} */

	.product-item .ps-wrapper .ps-info-inner {
		padding: 25px 20px 30px;
		border-radius: 16px;
		height: 100%
	}

	@media(min-width: 768px) {
		.product-item .ps-wrapper .ps-info-inner {
			padding: 25px 30px 40px
		}
	}

	@media(min-width: 992px) {
		.product-item .ps-wrapper .ps-info-inner {
			padding: 35px 45px 60px
		}
	}

	.product-item .ps-wrapper .ps-info-title {
		font-size: 20px;
		line-height: 1.7;
		letter-spacing: .02em;
		position: relative;
		padding: 0 0 5px 30px;
		border-bottom: 1px solid
	}

	@media(min-width: 768px) {
		.product-item .ps-wrapper .ps-info-title {
			font-size: 20px;
			padding: 0 0 10px 30px
		}
	}

	@media(min-width: 992px) {
		.product-item .ps-wrapper .ps-info-title {
			padding: 0 0 18px 30px
		}
	}

	.product-item .ps-wrapper .ps-info-title i {
		position: absolute;
		left: 0;
		top: 7.5px;
		font-size: 17px
	}

	@media(min-width: 768px) {
		.product-item .ps-wrapper .ps-info-title i {
			font-size: 20px
		}
	}

	.product-item .ps-wrapper ul {
		margin: 18px 0 0;
		padding: 0
	}

	.product-item .ps-wrapper ul li {
		list-style: none;
		margin: 0 0 8px;
		position: relative;
		padding-left: 30px
	}

	.product-item .ps-wrapper ul li:last-child {
		margin-bottom: 0
	}

	.product-item .ps-wrapper ul li:after {
		top: 5px;
		left: 5px;
		position: absolute;
		font-family: icomoon !important;
		font-size: 12px
	}

	.product-item .product-show-hide {
		display: -webkit-box;
		display: -webkit-flex;
		display: -moz-flex;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-pack: center;
		-ms-flex-pack: center;
		justify-content: center;
		-webkit-box-align: center;
		-ms-flex-align: center;
		align-items: center;
		margin-bottom: 25px
	}

	@media(min-width: 768px) {
		.product-item .product-show-hide {
			margin-bottom: 30px
		}
	}

	.product-item .product-show-hide span {
		font-family: gothambold, Helvetica, Arial, sans-serif;
		font-style: normal;
		font-weight: 700;
		font-size: 16px;
		display: inline-block;
		line-height: 1.25;
		color: #ff7152;
		cursor: pointer
	}

	.product-item .product-show-hide i {
		transition: all .3s;
		margin-left: 8px;
		display: inline-block;
		font-size: 8px;
		transform: rotate(-90deg);
		color: #cb2026
	}

	@media(min-width: 768px) {
		.product-item .btn-bn-wrap {
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-flex;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			justify-content: center
		}
	}

	.product-item .btn-bn-wrap .btn {
		margin: 0 15px
	}

	@media(max-width: 768px) {
		.product-item .btn-bn-wrap .btn {
			width: 100%;
			margin: 0 0 10px
		}
	}

	.product-item .btn-bn-wrap .btn:last-child {
		margin-bottom: 0
	}

	.text-content {
		padding-bottom: 20px
	}

	@media(min-width: 992px) {
		.text-content {
			padding-bottom: 30px
		}
	}

	@media(min-width: 1200px) {
		.text-content h2 {
			margin-bottom: 24px
		}
	}

	.text-content img {
		width: 100%;
		max-width: 100%;
		height: auto
	}

	.tnp-subscription {
		display: block;
		margin: 15px auto;
		max-width: 500px;
		width: 100%
	}

	.tnp-subscription div.tnp-field {
		margin-bottom: 10px;
		border: 0;
		padding: 0
	}

	.tnp-subscription label {
		display: block;
		color: inherit;
		font-weight: 700;
		line-height: normal;
		padding: 5px;
		margin: 0
	}

	.tnp-subscription input[type=text],
	.tnp-subscription input[type=email],
	.tnp-subscription input[type=submit],
	.tnp-subscription select {
		width: 100%;
		height: 50px;
		padding: 10px;
		display: block;
		border: 1px;
		border-color: #ddd;
		background-color: #f4f4f4;
		background-image: none;
		text-shadow: none;
		color: #444;
		font-size: 14px;
		line-height: 20px;
		margin: 0;
		line-height: normal;
		box-sizing: border-box
	}

	.tnp-subscription input[type=checkbox],
	.tnp-widget input[type=radio] {
		max-width: 20px;
		display: inline-block
	}

	.tnp-subscription select option {
		margin-right: 10px
	}

	.tnp-subscription input.tnp-submit {
		background-color: #444;
		color: #fff;
		width: auto;
		height: auto;
		margin: 0
	}

	@media all and (max-width: 480px) {
		.tnp-subscription input[type=submit] {
			width: 100%
		}
	}

	.tnp-profile form .tnp-field {
		margin-bottom: 10px;
		border: 0;
		padding: 0
	}

	.tnp-profile form .tnp-field label {
		display: block;
		color: #333
	}

	.tnp-profile form .tnp-field input[type=text],
	.tnp-profile form .tnp-field input[type=email],
	.tnp-profile form .tnp-field input[type=submit],
	.tnp-profile form .tnp-field textarea,
	.tnp-profile form .tnp-field select {
		padding: 10px;
		display: block;
		border: 1px;
		border-color: #ddd;
		background-color: #f4f4f4;
		background-image: none;
		text-shadow: none;
		color: #444;
		font-size: 14px;
		margin: 0;
		line-height: normal;
		box-sizing: border-box;
		border-radius: 0;
		height: auto;
		float: none
	}

	.tnp-profile form input[type=checkbox],
	.tnp-profile input[type=radio] {
		max-width: 20px;
		display: inline-block
	}

	.tnp-profile form .tnp-list-label {
		margin-left: 15px
	}

	.tnp-profile form select option {
		margin-right: 10px
	}

	.tnp-profile form .tnp-field input[type=submit] {
		background-color: #444;
		color: #fff;
		width: auto;
		height: auto;
		margin: 0
	}

	@media all and (max-width: 480px) {
		.tnp-profile input[type=submit] {
			width: 100%;
			margin: 0
		}
	}

	.tnp-widget {
		width: 100%;
		display: block;
		box-sizing: border-box
	}

	.tnp-widget .tnp-field {
		margin-bottom: 10px;
		border: 0;
		padding: 0
	}

	.tnp-widget label {
		display: block;
		color: inherit;
		font-size: 14px
	}

	.tnp-widget input[type=text],
	.tnp-widget input[type=email],
	.tnp-widget input[type=submit],
	.tnp-widget select {
		width: 100%;
		padding: 10px;
		display: block;
		border: 1px solid #ddd;
		border-color: #ddd;
		background-color: #f4f4f4;
		background-image: none;
		text-shadow: none;
		color: #444;
		font-size: 14px;
		line-height: normal;
		box-sizing: border-box;
		height: auto
	}

	.tnp-widget input[type=checkbox],
	.tnp-widget input[type=radio] {
		width: auto;
		display: inline-block
	}

	.tnp-widget select option {
		margin-right: 10px
	}

	.tnp-widget input.tnp-submit {
		background-color: #444;
		background-image: none;
		text-shadow: none;
		color: #fff;
		margin: 0
	}

	.tnp-field input[type=submit] {
		position: inherit
	}

	.tnp-widget-minimal {
		width: 100%
	}

	.tnp-widget-minimal form {
		margin: 0;
		padding: 0;
		border: 0
	}

	.tnp-widget-minimal input.tnp-email {
		width: 100%;
		box-sizing: border-box;
		padding: 10px;
		display: inline-block;
		border: 1px solid #ddd;
		background-color: #f4f4f4;
		color: #444;
		font-size: 14px
	}

	.tnp-widget-minimal input.tnp-submit {
		width: 100%;
		box-sizing: border-box;
		padding: 10px;
		display: inline-block;
		border: 1px;
		border-color: #ddd;
		background-color: #444;
		background-image: none;
		text-shadow: none;
		color: #fff;
		font-size: 14px;
		line-height: normal;
		border-radius: 0;
		height: auto;
		margin: 0
	}

	.tnp-subscription-minimal {
		width: 100%;
		box-sizing: border-box
	}

	.tnp-subscription-minimal form {
		margin: 0;
		padding: 0;
		border: 0
	}

	.tnp-subscription-minimal input.tnp-email {
		width: 70%;
		max-width: 300px;
		box-sizing: border-box;
		padding: 10px;
		display: inline-block;
		border: 1px solid #ddd;
		background-color: #f4f4f4;
		color: #444;
		font-size: 14px;
		line-height: 20px;
		border-radius: 0
	}

	.tnp-subscription-minimal .tnp-privacy-field {
		margin-top: 10px
	}

	.tnp-subscription-minimal input.tnp-submit {
		width: 29%;
		box-sizing: border-box;
		display: inline-block;
		padding: 10px;
		border: 1px;
		border-color: #ddd;
		background-color: #444;
		background-image: none;
		text-shadow: none;
		color: #fff;
		font-size: 14px;
		line-height: 20px;
		border-radius: 0;
		margin: 0
	}

	.tnp-comments {
		clear: both;
		margin-top: 15px;
		margin-bottom: 15px
	}

	.tnp-comments label {
		display: block
	}

	.tnp-comments input[type=checkbox] {
		display: inline-block;
		width: auto !important
	}

	.tnp-lock {
		clear: both;
		display: block;
		box-sizing: border-box;
		box-shadow: none;
		margin: 20px;
		padding: 15px;
		background-color: #fff;
		border: 1px solid #ddd
	}

	.tnp-nl-checkout {
		margin-bottom: 1em
	}

	@font-face {
		font-display: block;
		font-family: TablePress;
		font-style: normal;
		font-weight: 400;
		src: url(data:application/font-woff2;charset=utf-8;base64,d09GMgABAAAAAAPUAA0AAAAACZAAAAN+AAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP0ZGVE0cGh4GYACCUhEICoQIgnILFgABNgIkAygEIAWGcgeBARv6B8iuBzK53oAhKg2KWDsrezjalSefocfD9/uZ575PSbYEqJHAIdo6tMDGdCprFIHd+F9r+rZE46O2iHBJfoAuxwW0yfgKS8KGVFE4dHX1gPmgVhzwhcJbReQ9RWXcraeutbmNHE7T7B1sex8stfMfnkvv0XsgUZrYO1hirXme9TnUkBvQ22RGX50VAr48H54Cn9b8GD73edAAhjboBpIQ6kKOhCz7GA8V5HfzyeA6h0mnrFTJnPjxC7KCrl9caqIUg0EAYACGDBn6YGCxeIE+EkwANTWJX/brZpNfyE5o/7r9uPZjS4tESbCTExLCjxOEbxGi2dQeNEAXUMMlvADkqSV0IHXtkQXNOnI2ctJpRIPt8+HjNivx3rlQYA8FqGwdCxF2aZrdJluMnaqFvy+yngVKbBcn0fSOd1xTpnW4HTkptV8Gi2kvCeUHC0BD+D0VKMIqXniZPJyPya9D7gT6DvUpwJER6avgKDsOfW9jU+YGc/ng6MhA3VSar3NdtvrD9WHZurKVKYOi0RwlY9500YSuWDE084F+jMinu4sTudD5yBTTozA9Horpmb+M3TwIBHempnzdpu1/raWypX0JND/ki4p71CQQlFqnAvkijABrVFIq5BdNJbFncoBOF03/h3IINPQRBxJCYDoAOnkRIDR0w0BSmYiBzDinAuQ6eROg0DEGY6DUiEUYqKyILwFq2qS9GKhrpFsykdeFLmDjknYG4jKbNeNyQ1zhCoP840pdYiqu8jTW4mp6pMXH1HVJp8wRmHmQKTKiUOBVSMHrlKuBlYidxkMgw6/bMoG5RD6qfs8yO8LVqFCFa8ELrcVLEqTaS7UG5aqVq1GlWi28k3rRgCjbiU+qqOItvDEqXjkvwF/dUF595jB8LSqqgwIWAWsRmcJJ5GsHbYUqVbirBi5IpRMxLso/i2oSA6ZYDoMFCiknI7ZkGacSVYUjlLSXyG8n08nOQcXTeyzU5ozbiGRQZRt0vu/TMoEV8RLI3DiBSiVzMtNKAPgErlwLoqiAY2fJ9UbRMU/0rz38UP5FQtH3i8V3KYSHYJdSYRnwW8XazUAUop3gQY19hkEH98OA2QQ6wg0S+FjtwOwdOvF5J2VXBBLQmo2EAxsIKVJkkUcRZVRRa7NrP+my6Ns8cKszHYJf+fPPLPTq5vFcmYKZNL+fn1CZDgoYecKZHwA=) format("woff2"), url(//www.mypetneedsthat.com/wp-content/plugins/tablepress/css/build/tablepress.woff) format("woff")
	}

	.tablepress {
		--text-color: #111;
		--head-text-color: var(--text-color);
		--head-bg-color: #d9edf7;
		--odd-text-color: var(--text-color);
		--odd-bg-color: #f9f9f9;
		--even-text-color: var(--text-color);
		--even-bg-color: #fff;
		--hover-text-color: var(--text-color);
		--hover-bg-color: #f3f3f3;
		--border-color: #ddd;
		--padding: .5rem;
		border: none;
		border-collapse: collapse;
		border-spacing: 0;
		clear: both;
		margin: 0 auto 1rem;
		table-layout: auto;
		width: 100%
	}

	.tablepress>:not(caption)>*>* {
		background: 0 0;
		border: none;
		box-sizing: initial;
		float: none !important;
		padding: var(--padding);
		text-align: left;
		vertical-align: top
	}

	.tablepress>*+tbody>*>*,
	.tablepress>tbody>*~*>*,
	.tablepress>tfoot>*>* {
		border-top: 1px solid var(--border-color)
	}

	.tablepress>:where(thead, tfoot)>*>th {
		background-color: var(--head-bg-color);
		color: var(--head-text-color);
		font-weight: 700;
		vertical-align: middle;
		word-break: normal
	}

	.tablepress>:where(tbody)>.odd>* {
		background-color: var(--odd-bg-color);
		color: var(--odd-text-color)
	}

	.tablepress>:where(tbody)>.even>* {
		background-color: var(--even-bg-color);
		color: var(--even-text-color)
	}

	.tablepress>.row-hover>tr:hover>* {
		background-color: var(--hover-bg-color);
		color: var(--hover-text-color)
	}

	.tablepress img {
		border: none;
		margin: 0;
		max-width: none;
		padding: 0
	}

	.tablepress-table-description {
		clear: both;
		display: block
	}

	.dataTables_wrapper {
		clear: both;
		margin-bottom: 1rem;
		position: relative
	}

	.dataTables_wrapper .tablepress {
		clear: both;
		margin-bottom: 0
	}

	.dataTables_wrapper:after {
		clear: both;
		content: "";
		display: block;
		height: 0;
		line-height: 0;
		visibility: hidden
	}

	.dataTables_wrapper label input,
	.dataTables_wrapper label select {
		display: inline;
		margin: 2px;
		width: auto
	}

	.dataTables_length {
		float: left;
		white-space: nowrap
	}

	.dataTables_filter {
		float: right;
		white-space: nowrap
	}

	.dataTables_filter label input {
		margin-left: .5em;
		margin-right: 0
	}

	.dataTables_info {
		clear: both;
		float: left;
		margin: 4px 0 0
	}

	.dataTables_paginate {
		float: right;
		margin: 4px 0 0
	}

	.dataTables_paginate .paginate_button {
		color: #111;
		display: inline-block;
		margin: 0 5px;
		outline: none;
		position: relative;
		text-decoration: underline
	}

	.dataTables_paginate .paginate_button:first-child {
		margin-left: 0
	}

	.dataTables_paginate .paginate_button:last-child {
		margin-right: 0
	}

	.dataTables_paginate .paginate_button:after,
	.dataTables_paginate .paginate_button:before {
		color: #d9edf7
	}

	.dataTables_paginate .paginate_button:hover {
		cursor: pointer;
		text-decoration: none
	}

	.dataTables_paginate .paginate_button:hover:after,
	.dataTables_paginate .paginate_button:hover:before {
		color: #049cdb
	}

	.dataTables_paginate .paginate_button.disabled {
		color: #999;
		cursor: default;
		text-decoration: none
	}

	.dataTables_paginate .paginate_button.disabled:after,
	.dataTables_paginate .paginate_button.disabled:before {
		color: #f9f9f9
	}

	.dataTables_paginate .paginate_button.current {
		cursor: default;
		font-weight: 700;
		text-decoration: none
	}

	.dataTables_paginate.paging_simple {
		padding: 0 15px
	}

	.dataTables_paginate.paging_simple .paginate_button.next:after,
	.dataTables_paginate.paging_simple .paginate_button.previous:before {
		-webkit-font-smoothing: antialiased;
		bottom: 0;
		content: "\f053";
		font-family: TablePress;
		font-size: 14px;
		font-weight: 700;
		height: 14px;
		left: -14px;
		line-height: 1;
		margin: auto;
		position: absolute;
		right: auto;
		text-align: left;
		text-shadow: .1em .1em #666;
		top: 0;
		width: 14px
	}

	.dataTables_paginate.paging_simple .paginate_button.next:after {
		content: "\f054";
		left: auto;
		text-align: right
	}

	.dataTables_scroll {
		clear: both
	}

	.dataTables_scroll .tablepress {
		width: 100% !important
	}

	.dataTables_scrollHead table.tablepress {
		margin: 0
	}

	.dataTables_scrollBody {
		-webkit-overflow-scrolling: touch
	}

	.dataTables_scrollBody .tablepress thead th:after {
		content: ""
	}

	.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody td>div.dataTables_sizing,
	.dataTables_wrapper .dataTables_scroll div.dataTables_scrollBody th>div.dataTables_sizing {
		height: 0;
		margin: 0 !important;
		overflow: hidden;
		padding: 0 !important
	}

	.tablepress {
		--head-active-bg-color: #049cdb;
		--head-active-text-color: var(--head-text-color)
	}

	.tablepress .sorting,
	.tablepress .sorting_asc,
	.tablepress .sorting_desc {
		cursor: pointer;
		outline: none;
		padding-right: 20px;
		position: relative
	}

	.tablepress .sorting:after,
	.tablepress .sorting_asc:after,
	.tablepress .sorting_desc:after {
		-webkit-font-smoothing: antialiased;
		bottom: 0;
		font-family: TablePress;
		font-size: 14px;
		font-weight: 400;
		height: 14px;
		left: auto;
		line-height: 1;
		margin: auto;
		position: absolute;
		right: 6px;
		top: 0
	}

	.tablepress .sorting:after {
		content: "\f0dc"
	}

	.tablepress .sorting_asc:after {
		content: "\f0d8";
		padding: 0 0 2px
	}

	.tablepress .sorting_desc:after {
		content: "\f0d7"
	}

	.tablepress .sorting:hover,
	.tablepress .sorting_asc,
	.tablepress .sorting_desc {
		background-color: var(--head-active-bg-color);
		color: var(--head-active-text-color)
	}

	.subcategory-filter {
		display: flex;
		width: 100%;
		align-items: center;
		justify-content: center;
		margin-bottom: 3rem;
		flex-wrap: wrap
	}

	.subcategory-filter a {
		display: inline-block;
		padding: 3px 15px;
		text-align: center
	}

	.subcategory-filter a:hover {
		background-color: #cb2026;
		color: #fff
	}

	.main-content .content ul li {
		position: relative;
		padding-left: 20px
	}

	.main-content .content ul li:after {
		content: "";
		position: absolute;
		top: 10px;
		left: 8px;
		width: 4px;
		height: 4px;
		background: #44444b;
		border-radius: 50%
	}

	.wp-admin ul li {
		list-style-type: none !important
	}

	.review-pros-title,
	.review-cons-title {
		text-transform: uppercase
	}

	.pros-and-cons-wrap {
		width: 100%;
		margin-top: 36px
	}

	.pros-and-cons-wrap:after {
		content: "";
		display: block;
		clear: both;
		visibility: hidden;
		line-height: 0;
		height: 0;
		margin: 0;
		padding: 0
	}

	.review-pros-wrap,
	.review-cons-wrap {
		display: inline-block;
		width: 48.86%;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		border-radius: 10px;
		background: #fff;
		margin-bottom: 36px
	}

	.review-pros-wrap {
		float: left;
		border: 1px solid #2ec7f3
	}

	.review-cons-wrap {
		float: right;
		border: 1px solid #ed5e75
	}

	.review-pros-title,
	.review-cons-title {
		padding: 11px 0 11px 32px;
		border-radius: 8px 8px 0 0
	}

	.review-pros-title {
		background: #2ec7f3
	}

	.review-cons-title {
		background: #ed5e75
	}

	.review-cons-title span {
		font-weight: 700;
		font-size: 14px
	}

	.review-pros-title span {
		font-family: open-sans, sans-serif !important;
		font-weight: 700;
		font-size: 14px
	}

	.review-pros-title span,
	.review-cons-title span {
		display: inline-block;
		line-height: 25px;
		padding-left: 20px;
		color: #fff;
		font-size: 18px;
		font-family: Montserrat !important
	}

	.review-pros-content>li,
	.review-cons-content>li {
		padding-left: 25px;
		margin: 0
	}

	.review-pros-content,
	.review-cons-content {
		padding: 30px 40px 25px;
		line-height: 1.6;
		color: #2a2d32
	}

	.review-pros-content ul,
	.review-cons-content ul {
		margin: 0;
		padding: 0
	}

	.review-pros-item,
	.review-cons-item,
	.review-cons-content ul li,
	.review-pros-content ul li,
	.review-cons-content li,
	.review-pros-content li {
		margin-bottom: 12px
	}

	.review-custom-content {
		position: relative;
		padding-left: 22.7%;
		padding-right: 30%;
		width: 130%;
		padding-top: 110px;
		overflow: hidden
	}

	ul li {
		list-style-type: disc
	}

	ul li span.td-cat-no {
		color: #fff
	}

	@media only screen and (max-width: 768px) {

		.review-pros-wrap,
		.review-cons-wrap {
			display: block;
			width: 100%;
			-moz-border-radius: 10px;
			-webkit-border-radius: 10px;
			border-radius: 10px;
			background: #fff;
			margin: 36px;
			margin-left: 0
		}

		.review-pros-wrap {
			float: none
		}

		.review-cons-wrap {
			float: none
		}
	}
</style>

<?php get_footer(); ?>