<?php
	function bones_ahoy() {
		require_once( 'library/inc/custom-cleanup.php' );
		require_once( 'library/inc/custom-admin.php' );
		require_once( 'library/inc/custom-dashboard.php' );
		require_once( 'library/inc/acf.php' );
		require_once( 'library/inc/custom-post/cpt-casestudies.php' );
	}
	add_action( 'after_setup_theme', 'bones_ahoy' );


	/* ************************* */
	// Register menu
	/* ************************* */
	function register_my_menu() {
		register_nav_menu('primary-menu',__( 'Menu Principal' ));
		register_nav_menu('footer-annexe',__( 'Footer - Annexe' ));
	}
	add_action( 'init', 'register_my_menu' );

	/* ************************* */
	// Pic size
	/* ************************* */
	add_image_size('xsmall', 320, 320, false);
	add_image_size('small', 768, 768, false);
	add_image_size('medium', 1200, 1200, false);
	add_image_size('xlarge', 1920, 1920, false);

	/* ************************* */
	// Add `loading="lazy"` attribute to images output by the_post_thumbnail().
	/* ************************* */
	add_filter( 'post_thumbnail_html', 'wpdd_modify_post_thumbnail_html', 10, 5 );
	
	function wpdd_modify_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		return str_replace( '<img', '<img loading="lazy"', $html );
	}


	/* ************************* */
	// Add a custom tool bar
	/* ************************* */
	function custom_acf_wysiwyg_toolbar($toolbars) {
		$toolbars['Custom'] = [];
		$toolbars['Custom'][1] = ['formatselect', 'forecolor'];
		return $toolbars;
	}
	add_filter('acf/fields/wysiwyg/toolbars', 'custom_acf_wysiwyg_toolbar');


	/* ************************* */
	/* Add styles to wysiwyg editor */
	/* ************************* */
	function add_style_select_button($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	add_filter('mce_buttons_2', 'add_style_select_button');
	function my_mce_before_init_insert_formats( $init_array ) {
		$style_formats = array(
			array(
				'title' => 'Bouton orange',
				'block' => 'a',
				'classes' => 'cbo-button',
				'wrapper' => true,
				'attributes' => array(
					'href' => '#'
				)
			),
		);
		$init_array['style_formats'] = json_encode( $style_formats );
		return $init_array;
	}
	add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );

	/* ************************* */
	/* AJOUT OPTIONS AU DASHBOARD */
	/* ************************* */
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page();
	}

	/* ************************* */
	/* CURRENT PAGE FOR ARCHIVE */
	/* ************************* */
	function current_paged( $var = '' ) {
		if( empty( $var ) ) {
			global $wp_query;
			if( !isset( $wp_query->max_num_pages ) )
				return;
			$pages = $wp_query->max_num_pages;
		}
		else {
			global $$var;
				if( !is_a( $$var, 'WP_Query' ) )
					return;
			if( !isset( $$var->max_num_pages ) || !isset( $$var ) )
				return;
			$pages = absint( $$var->max_num_pages );
		}
		if( $pages < 1 )
			return;
		$page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		echo 'Page ' . $page ;
	}

	/* ************************* */
	/* CRÉATION PAGINATION */
	/* ************************* */
	function page_navi($before = '', $after = '') {
		global $wpdb, $wp_query;
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
		if ( $numposts <= $posts_per_page ) { return; }
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = 7;
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
		echo $before.'<ul class="cbo-pagination">'."";

		$prevposts = get_previous_posts_link('<i class="icon icon--arrow-next"></i>');
		if($prevposts) { echo '<li class="cbo-paginate-prev">' . $prevposts  . '</li>'; }
		else { echo '<li class="disabled"><a href="#"><i class="icon icon--arrow-next"></i></a></li>'; }

		for($i = $start_page; $i  <= $end_page; $i++) {
			if($i == $paged) {
				echo '<li class="active"><a href="#">'.$i.'</a></li>';
			} else {
				echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
			}
		}

		$nextposts = get_next_posts_link('<i class="icon icon--arrow-next"></i>');
		if($nextposts) { echo '<li class="cbo-paginate-next">' . $nextposts  . '</li>'; }
		else { echo '<li class="disabled"><a href="#"><i class="icon icon--arrow-next"></i></a></li>'; }
		
		echo '</ul>'.$after."";
	}

	/* ************************* */
	/* REMOVE P & SPAN FROM CF7 FIELD */
	/* ************************* */
	add_filter('wpcf7_autop_or_not', '__return_false');
	add_filter('wpcf7_form_elements', function($content) {
		$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
		return $content;
	});

	/* ************************* */
	// Add Color choices
	/* ************************* */
	function my_mce4_options($init) {

		$custom_colours = '
			"F55C48", "Orange",
			"FCCEC8", "Orange clair",
		';
		$init['textcolor_map'] = '['.$custom_colours.']';
		$init['textcolor_rows'] = 1;
		return $init;
	}
	add_filter('tiny_mce_before_init', 'my_mce4_options');


	/* ************************* */
	/* CUSTOM LOGIN */
	/* ************************* */
	function childtheme_custom_login() {
	 echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/library/css/style.css" />';
	}
	add_action('login_head', 'childtheme_custom_login');


	/* ************************* */
	/* NBR PAGES VUES / LEADS - SETTINGS FOR DASHBOARD WIDGET */
	/* ************************* */
	function enregistrer_vue_page() {
		// On ne compte pas les vues des utilisateurs connectés
		if (is_user_logged_in()) {
			return;
		}
		if (is_singular(['page', 'casestudies'])) {
			$post_id = get_the_ID();
			$vues = get_post_meta($post_id, 'compteur_vues', true);
			$vues = ($vues) ? (int) $vues + 1 : 1;
			update_post_meta($post_id, 'compteur_vues', $vues);
		}
	}
	add_action('wp', 'enregistrer_vue_page');


	// Incrémenter un compteur de visites du site
	function enregistrer_visite_site() {
		if (is_admin()) return;
		if (!isset($_COOKIE['site_visited'])) {
			$total = (int) get_option('site_total_visits', 0);
			update_option('site_total_visits', $total + 1);
	
			setcookie('site_visited', '1', time() + (30 * 60), COOKIEPATH, COOKIE_DOMAIN);
		}
	}
	add_action('init', 'enregistrer_visite_site');


	// Incrémenter un compteur de leads à chaque envoi de formulaire CF7
	add_action('wpcf7_mail_sent', 'compter_lead_cf7');
	function compter_lead_cf7($contact_form) {
		$current_count = get_option('compteur_leads_cf7', 0);
		$current_count++;
		update_option('compteur_leads_cf7', $current_count);
	}
?>