<?php

/**

 * You Tren Day functions and definitions

 *

 * @link https://developer.wordpress.org/themes/basics/theme-functions/

 *

 * @package You_Tren_Day

 */



if ( ! defined( '_S_VERSION' ) ) {

	// Replace the version number of the theme on each release.

	define( '_S_VERSION', '1.0.0' );

}



if ( ! function_exists( 'youtrenday_setup' ) ) :

	/**

	 * Sets up theme defaults and registers support for various WordPress features.

	 *

	 * Note that this function is hooked into the after_setup_theme hook, which

	 * runs before the init hook. The init hook is too late for some features, such

	 * as indicating support for post thumbnails.

	 */

	function youtrenday_setup() {

		/*

		 * Make theme available for translation.

		 * Translations can be filed in the /languages/ directory.

		 * If you're building a theme based on You Tren Day, use a find and replace

		 * to change 'youtrenday' to the name of your theme in all the template files.

		 */

		load_theme_textdomain( 'youtrenday', get_template_directory() . '/languages' );



		// Add default posts and comments RSS feed links to head.

		add_theme_support( 'automatic-feed-links' );



		/*

		 * Let WordPress manage the document title.

		 * By adding theme support, we declare that this theme does not use a

		 * hard-coded <title> tag in the document head, and expect WordPress to

		 * provide it for us.

		 */

		add_theme_support( 'title-tag' );



		/*

		 * Enable support for Post Thumbnails on posts and pages.

		 *

		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/

		 */

		add_theme_support( 'post-thumbnails' );



		// This theme uses wp_nav_menu() in one location.

		register_nav_menus(

			array(

				'menu-1' => esc_html__( 'Primary', 'youtrenday' ),

			)

		);



		/*

		 * Switch default core markup for search form, comment form, and comments

		 * to output valid HTML5.

		 */

		add_theme_support(

			'html5',

			array(

				'search-form',

				'comment-form',

				'comment-list',

				'gallery',

				'caption',

				'style',

				'script',

			)

		);



		// Set up the WordPress core custom background feature.

		add_theme_support(

			'custom-background',

			apply_filters(

				'youtrenday_custom_background_args',

				array(

					'default-color' => 'ffffff',

					'default-image' => '',

				)

			)

		);



		// Add theme support for selective refresh for widgets.

		add_theme_support( 'customize-selective-refresh-widgets' );



		/**

		 * Add support for core custom logo.

		 *

		 * @link https://codex.wordpress.org/Theme_Logo

		 */

		add_theme_support(

			'custom-logo',

			array(

				'height'      => 250,

				'width'       => 250,

				'flex-width'  => true,

				'flex-height' => true,

			)

		);

	}

endif;

add_action( 'after_setup_theme', 'youtrenday_setup' );



/**

 * Set the content width in pixels, based on the theme's design and stylesheet.

 *

 * Priority 0 to make it available to lower priority callbacks.

 *

 * @global int $content_width

 */

function youtrenday_content_width() {

	// This variable is intended to be overruled from themes.

	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.

	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

	$GLOBALS['content_width'] = apply_filters( 'youtrenday_content_width', 640 );

}

add_action( 'after_setup_theme', 'youtrenday_content_width', 0 );



/**

 * Register widget area.

 *

 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar

 */

function youtrenday_widgets_init() {

	register_sidebar(

		array(

			'name'          => esc_html__( 'Sidebar', 'youtrenday' ),

			'id'            => 'sidebar-1',

			'description'   => esc_html__( 'Add widgets here.', 'youtrenday' ),

			'before_widget' => '<section id="%1$s" class="widget %2$s">',

			'after_widget'  => '</section>',

			'before_title'  => '<h2 class="widget-title">',

			'after_title'   => '</h2>',

		)

	);

}

add_action( 'widgets_init', 'youtrenday_widgets_init' );



/**

 * Enqueue scripts and styles.

 */

function youtrenday_scripts() {

	wp_enqueue_style( 'youtrendaynewww-style', get_stylesheet_uri(), array(), '1.1.2', 'all' );

	wp_style_add_data( 'youtrenday-style', 'rtl', 'replace' );



	wp_enqueue_script( 'youtrenday-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );



	wp_enqueue_script( 'youtrenday-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}

add_action( 'wp_enqueue_scripts', 'youtrenday_scripts' );



/**

 * Implement the Custom Header feature.

 */

// require get_template_directory() . '/inc/custom-header.php';



/**

 * Custom template tags for this theme.

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Functions which enhance the theme by hooking into WordPress.

 */

require get_template_directory() . '/inc/template-functions.php';



/**

 * Functions which enhance the theme by hooking into WordPress.

 */

require get_template_directory() . '/inc/custom-post-types.php';



/**

 * Functions which enhance the theme by hooking into WordPress.

 */

// require get_template_directory() . '/inc/socialNetworkShareCounts.php';



/**

 * Customizer additions.

 */

require get_template_directory() . '/inc/customizer.php';



/**

 * Load Jetpack compatibility file.

 */

if ( defined( 'JETPACK__VERSION' ) ) {

	require get_template_directory() . '/inc/jetpack.php';

}

 

// Other dev Code



function php_execute($html){

	if(strpos($html,"<"."?php")!==false){ ob_start(); eval("?".">".$html);

	$html=ob_get_contents();

	ob_end_clean();

	}

	return $html;

}

add_filter('widget_text','php_execute',100);

function bpd_add_new_xprofile_field_type($field_types){

    $image_field_type = array('image');

    $field_types = array_merge($field_types, $image_field_type);

    return $field_types;

}



function remove_admin_login_header() {

    remove_action('wp_head', '_admin_bar_bump_cb');

}

add_action('get_header', 'remove_admin_login_header');

// xprofile_delete_field_group('field_1');

add_filter( 'bp_xprofile_is_richtext_enabled_for_field', 'my_disable_rt_function', 10, 2 );

function my_disable_rt_function( $enabled, $field_id ) {

  if ( 20 == $field_id ) {

    $enabled = false;

  }

  return $enabled;

}

function new_excerpt_more($more) {

    return '';

}

add_filter('excerpt_more', 'new_excerpt_more', 21 );

// Custom Functions

if(! current_user_can('administrator') ) {

	add_filter('show_admin_bar', '__return_false');

};

function custom_youtrenday_enqueue(){  

	wp_enqueue_script('jquery');

	// phpinfo();

	$theme_version = wp_get_theme()->get( 'Version' ); 

	// css



	// wp_enqueue_script('jquery-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, 'true' );

	// wp_enqueue_script('jquery-easing-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.compatibility.js', array(), null, 'true' );

	wp_enqueue_style( 'customnew', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0.8', 'all' );

	wp_enqueue_style( 'landing-pagenew', get_template_directory_uri() . '/assets/css/landing-page.css', array(), '1.0.1', 'all' );

	// wp_enqueue_style( 'youtrenday-new-style', get_stylesheet_uri(), array(), $theme_version );

	wp_enqueue_style('responsivenew-css', get_template_directory_uri() . '/assets/css/responsive.css', array(), '1.0.1', 'all' );

	wp_enqueue_style('bootstrapnew-css', get_template_directory_uri() . '/assets/css/bootstrap.css', array(), '1.0.1', 'all' ); 

	wp_enqueue_style('fancyboxnew-css', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css", array(), '1.0.1', 'all' );

	wp_enqueue_style('slicknew-css', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0.1', 'all' );  

	wp_enqueue_style('select2-minnew-css', get_template_directory_uri() . '/assets/css/select2.min.css', array(), '1.0.1', 'all' ); 

	wp_enqueue_style('croppienew-css', get_template_directory_uri() . '/assets/css/croppie.css', array(), '1.0.1', 'all' );  



	// js

	wp_enqueue_script('bootstrapnew-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '1.0.1', 'true' ); 

	wp_enqueue_script('customnewas-js', get_template_directory_uri() . '/assets/js/custom.js', array(), '5.3', 'true' );

	wp_enqueue_script('slick-minnew-js', get_template_directory_uri() . '/assets/js/slick.min.js', array(), '1.0.1', 'true' );  

	wp_enqueue_script('select2-minnew-js', get_template_directory_uri() . '/assets/js/select2.min.js', array(), '1.0.1', 'true' );   

	wp_enqueue_script('platformnew-js', get_template_directory_uri() . '/assets/js/platform.js', '', null );   

	// wp_enqueue_script('jQuery-inViewmin-js', get_template_directory_uri() . '/assets/js/jQuery-inView.min.js', '', null );   



	wp_enqueue_script('croppienew-js', get_template_directory_uri() . '/assets/js/croppie.js', array(), '1.0.1', 'true' );



	// wp_deregister_script('jquery');

  

	wp_enqueue_script("jquery-effects-core");

	 

	wp_localize_script( 'customnewas-js', 'ajax_posts', array(

	'ajaxurl' => admin_url( 'admin-ajax.php' ),

	'noposts' => __('No older posts found', 'twentyfifteen'),

	 

	) );

	

}

add_action('wp_enqueue_scripts', 'custom_youtrenday_enqueue');

function wpdocs_selectively_enqueue_admin_script( $hook ) {

 

	wp_enqueue_script('custom-admin-js', get_template_directory_uri() . '/assets/js/custom-admin.js', '', null );



}



// add_action( 'admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script' );

function youtrenday_menus() { 

	$locations = array(

		'header_loggedin'  => __( 'Header Logged in Menu', 'youtrenday' ), 

		'header_loggedout'  => __( 'Header Logged out Menu', 'youtrenday' ), 

		'header_profile_menu'   => __( 'Header Profile Menu', 'youtrenday' ),

		'mobile-menu'   => __( 'Mobile Menu', 'youtrenday' ),

		'footer-menu'   => __( 'Footer Menu', 'youtrenday' ),

		'social-menu'   => __( 'Social Menu', 'youtrenday' ),

	);



	register_nav_menus( $locations );

} 

add_action( 'init', 'youtrenday_menus' ); 



function the_excerpt_more_link( $excerpt ){

    $post = get_post();

    $read_more  = '... <a href="'. get_permalink($post->ID) . '" class="read_more_link">Read More</a></p>';

    return str_replace('</p>', $read_more, $excerpt) ;

}

add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

function li_tag_menu_classes($classes, $item, $args) { 

	if($args->theme_location == 'header_loggedin' || $args->theme_location == 'header_loggedout') {

	  	$classes[] = 'nav-item';

	}

	return $classes;

}

add_filter('nav_menu_css_class', 'li_tag_menu_classes', 1, 3);

add_filter('nav_menu_link_attributes', 'a_nav_menu_link_attributes', 10, 4);

function a_nav_menu_link_attributes($atts, $item, $args, $depth){ 

	 

     if ($args->menu->slug == 'header-logged-in-menu' || $args->menu->slug == 'header-logged-out-menu'  ){ 

        $class = "menu-link px2";  

        $atts['class'] = (!empty($atts['class'])) ? $atts['class'].' '.$class : $class; 

    }

    return $atts;

}

function add_submenu_class($menu) { 

	$menu = preg_replace('/ class="sub-menu"/','/ class="dropdown-menu sub-menus" /',$menu);   

	return $menu;   

}

add_filter( 'gform_countries', 'remove_country' );

function remove_country( $countries ){

    return array( 'Canada' );

}

add_filter('wp_nav_menu','add_submenu_class'); 

add_filter( 'wp_nav_menu_items', 'my_nav_menu_profile_link',10, 2 );

function my_nav_menu_profile_link( $items, $args) { 	 		

	if($args->theme_location == 'header_profile_menu' && is_user_logged_in()){ 

		$user  = get_userdata( get_current_user_id() ); 

		$name = '';

		$email = $user->user_email; 

		$first_name = BP_XProfile_ProfileData::get_value_byid( 1, get_current_user_id() );
		$displayName = '';
		if( $first_name){ 
			$displayName = $first_name;
		}else{
			$displayName = $user->first_name ;
		}
		?>

		<?php // $length = strlen($text);

		// if($length >= 7 ){

		// 	$name = substr($text, 0, 7) .'...';

		// }else{

		// 	$name = substr($text, 0, 7);

		// }  

		$user_link = '<li class="rigtsidebar_username"><span>Welcome,</span></br><span class="user_email_floating1">'. $displayName . '</span></li> <li><a href="'.home_url( '/members/' . bp_core_get_username( get_current_user_id() ) . '/profile/' ) .'">Profile</a></li>';

		$items = $user_link .$items ;

		return $items; 

	}else{

		return $items;

	}

}

   

add_filter( 'wp_nav_menu_objects', 'custom_add_menuSubmenu', 10, 2 ); 

function custom_add_menuSubmenu( $items, $args ){ 

	if( $args->menu->slug   == 'header-logged-in-menu'){ 	 

		$args  = array( 

			'post_type' => 'competition',

			'posts_per_page' =>  1,

			'order' => 'ASC',

			'post_status' => 'publish',

			'tax_query' => array(

				array(

					'taxonomy' => 'competition_status',

					'field'    => 'slug',

					'terms'    => 'running',

				),

			), 

		);

		$query  = new WP_Query($args); 

	 

		if($query->found_posts  > 0){

			$child_items = array(); 

			$menu_order = count($items); 

			$parent_item_id = 0; 

			foreach ( $items as $item ) {

				if ( in_array('competition-menu', $item->classes) ){ //add this class to your menu item

					$parent_item_id = $item->ID;

				}

			}  

			if($parent_item_id > 0){  

				foreach ( get_posts( 'post_type=competition&order=ASC&numberposts=1' ) as $post ) {

				  	$post->menu_item_parent = $parent_item_id;

					$post->post_type = 'nav_menu_item';

					$post->object = 'page';

					$post->type = 'post_type';

					$post->menu_order = 4;

					$post->title = 'Join Now';

					$post->target = '';

					$post->url = site_url( '/competition-detail/' );

					array_push($child_items, $post); 

				} 

			}  

			// insert item

			$location = 2;   // insert at 3rd place

			array_splice( $items, $location, 0, $child_items );  

			// $new_links = array(); 

			// // Create a nav_menu_item object

			// while ($query->have_posts()) : $query->the_post(); 

			// 	$item1 = array(

			// 		'title'            => 'Upload Music',

			// 		'menu_item_parent' => 0,

			// 		'ID'               => 'upload-music',

			// 		'db_id'            => '',

			// 		'url'              => site_url( '/competition-registration/?comp_id="'.get_the_ID().'"&music_type=free' ),

			// 		'classes'          => array( 'join-competition-item' )

			// 	);

			// endwhile;

			// $new_links[] = (object) $item1; // Add the new menu item to our array

		

			// // insert item

			// $location  = 8;   // insert at 3rd place

			// array_splice( $items, $location, 0, $new_links );



			// array_merge( $items, $child_items )

			return $items;

		}else{

			return  $items;

		}

			

	}else if( $args->menu->slug   == 'header-profile-menu'){ 	   

		$args  = array( 

			'post_type' => 'competition',

			'posts_per_page' => 1,

			'tax_query' => array(

				array(

					'taxonomy' => 'competition_status',

					'field'    => 'slug',

					'terms'    => 'running',

				),

			), 

		);

		$query  = new WP_Query($args); 

	 

		if($query->found_posts  > 0){

			$new_links = array(); 

			// Create a nav_menu_item object

			$item = array(

				'title'            => 'Join Competition',

				'menu_item_parent' => 0,

				'ID'               => 'yourItemID',

				'db_id'            => '',

				'url'              => site_url( '/competition-detail/' ),

				'classes'          => array( 'join-competition-item' )

			);

		

			$new_links[] = (object) $item; // Add the new menu item to our array

		

			// insert item

			$location = 2;   // insert at 3rd place

			array_splice( $items, $location, 0, $new_links );

		 

		}

		return $items;

	} else{

		

		return $items;

	} 

}

add_filter('mc4wp_use_sslverify', '__return_false');



// On Click load more button on profiel-detail page

// add_shortcode("get_posts_shortcode", 'get_posts_shortcode' );

function get_posts_shortcode($posttype){   

	$user_info = get_userdata(bp_displayed_user_id()); 

	// $first_name = BP_XProfile_ProfileData::get_value_byid( 1, bp_displayed_user_id() );
	$b_first_name = BP_XProfile_ProfileData::get_value_byid( 1, bp_displayed_user_id() );
	$user  = get_userdata(bp_displayed_user_id()); 
	$first_name = '';
	if( $b_first_name){ 
		$first_name = $b_first_name;
	}else{
		$first_name = $user->first_name ;
	}?>

	<div class="container user-profile-musics mt-5">

		<h3 class="text-center"><?php echo $first_name; ?>'s <?php echo $posttype; ?> </h3> 

		<div class="row user-profile-single-music"> 

			<?php  

			$loop_music = new WP_Query( 

									array( 

										'post_type' => $posttype, 

										'author' => bp_displayed_user_id(), 

										'posts_per_page' => 8, 

										'order'   => 'DESC',

										'post_status' => 'publish'  

									));

			if($loop_music->have_posts()): ?>

				<span class="d-none total_posts"><?php echo $loop_music->found_posts; ?></span>

				<span class="d-none posttype"><?php echo $posttype; ?></span>

				<?php while ( $loop_music->have_posts() ) : $loop_music->the_post(); ?>

					<div class="col-xs-12 col-lg-3 single-music"> 

						<?php 

						$musicMedia_from = get_post_meta(get_the_ID(), 'musicMedia_from', true);  

						$musicMedia_url = get_post_meta(get_the_ID(), 'musicMedia_url', true);  

						$media_uploaded_types = wp_check_filetype($musicMedia_url);

						$media_uploaded_type = $media_uploaded_types['type']; 

						echo get_media_music_html(get_the_ID());  ?>

						<div class="pindex">

							<div class="ptitle">

								<a href="<?php the_permalink(); ?>" class="my-0"><h2 class="my-0"><?php the_title(); ?></h2></a>

							</div>   

						</div>

					</div>

				<?php endwhile;  

				wp_reset_postdata();

			else:

				echo '<h2 class="text-center mt-0 w-100">There are currently no posts</h2>'; 

			endif;

			?>   			

		</div>   

		<div class="row user-profile-single-music" id="ajax-posts"></div>

	</div>

	<?php if ( $loop_music->found_posts > 8 ){ ?>

		<div class="row home-page w-100 mb-5"> 

			<div class="blog-design mx-auto text-center"> 

				<button class="more-blogs px-5 py-3 load_items user-edit-follow for-button-style" id="load_more_posts" > <i class="fa fa-plus text-danger" aria-hidden="true"></i> </button>

			</div>

		</div>

	<?php }  

}

function more_post_ajax(){ 

	$current_user = wp_get_current_user(); 

	$posttype = $_POST["posttype"];

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;

	$page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;  

	$offset = (isset($_POST['offset'])) ? $_POST['offset'] : 0;  

    $args = array(

		'suppress_filters' => true,

		'author' =>bp_displayed_user_id(), 

        'post_type' => 'music',

        'posts_per_page' => $ppp,  

		'offset' => $offset,

		'post_status' => 'publish',

		'order'   => 'DESC',

    );

    $loop = new WP_Query($args);

    $out = ''; 

	if ($loop -> have_posts()) :  

		$media = '';

		while ($loop -> have_posts()) : $loop -> the_post(); 

			$musicMedia_from = get_post_meta(get_the_ID(), 'musicMedia_from', true);  

			$musicMedia_url = get_post_meta(get_the_ID(), 'musicMedia_url', true);  

			$media_uploaded_types = wp_check_filetype($musicMedia_url);

			$media_uploaded_type = $media_uploaded_types['type']; 

			 



			/* if( $musicMedia_from == 'media_system'  ){

				if(  $media_uploaded_type == 'video/x-ms-asf' ||  

					$media_uploaded_type == 'video/x-ms-wmv' || 

					$media_uploaded_type == 'video/x-ms-wmx' || 

					$media_uploaded_type == 'video/x-ms-wm' || 

					$media_uploaded_type == 'video/avi' || 

					$media_uploaded_type == 'video/divx' || 

					$media_uploaded_type == 'video/x-flv' || 

					$media_uploaded_type == 'video/quicktime' || 

					$media_uploaded_type == 'video/mpeg' || 

					$media_uploaded_type == 'video/mp4' || 

					$media_uploaded_type == 'video/ogg' || 

					$media_uploaded_type == 'video/webm' || 

					$media_uploaded_type == 'video/x-matroska' || 

					$media_uploaded_type == 'video/3gpp' || 

					$media_uploaded_type == 'video/3gpp2' ){ 

					$media = '<div class="embed-responsive"><video  width="255" height="170"  controls>

							<source src="'. $musicMedia_url .'" type="'.$media_uploaded_type .'">

						</video></div>';    

				} elseif ($media_uploaded_type == 'audio/mp3' ||  

					$media_uploaded_type == 'audio/mpeg' || 

					$media_uploaded_type == 'audio/aac' || 

					$media_uploaded_type == 'audio/x-realaudio' || 

					$media_uploaded_type == 'audio/wav' ||  

					$media_uploaded_type == 'audio/ogg' || 

					$media_uploaded_type == 'audio/flac' || 

					$media_uploaded_type == 'audio/midi' || 

					$media_uploaded_type == 'audio/x-ms-wma' || 

					$media_uploaded_type == 'audio/x-ms-wax' || 

					$media_uploaded_type == 'audio/x-matroska' ){ 

					$media = '<audio controls class="pt-2"width="255" height="170" >

							<source src="'. $musicMedia_url .'"  >

						</audio>'; 

					

				} elseif ( $media_uploaded_type == 'image/jpeg' || 

					$media_uploaded_type == 'image/gif' || 

					$media_uploaded_type == 'image/png' || 

					$media_uploaded_type == 'image/bmp' || 

					$media_uploaded_type == 'image/tiff' || 

					$media_uploaded_type == 'image/x-icon'  ){  

					$media = '<img id="imageResult" src="'. $musicMedia_url .'" alt="" class="img-fluid mx-auto" width="255" height="170" >';  

				}

			}elseif( $musicMedia_from == 'youtube' ){  

				preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);

				$youtube_id = $match[1];

				$media = '<div class="embed-responsive"><iframe width="255" height="170" src="https://www.youtube.com/embed/'. $youtube_id .'" autoplay="false" frameborder="0" allowfullscreen></iframe></div>';

			}elseif( $musicMedia_from == 'soundcloud' ||  $musicMedia_from == 'spotify' 

			|| $musicMedia_from == 'comp_from_soundcloud' || $musicMedia_from == 'comp_spotify' ){  

				$media = '<div class="embed-responsive"><blockquote class="embedly-card"><h4><a href="'. $musicMedia_url .'"> </a></h4></blockquote></div>';

			} */  



			if( $musicMedia_from == 'media_system' ){

				if(  $media_uploaded_type == 'video/x-ms-asf' ||  

					$media_uploaded_type == 'video/x-ms-wmv' || 

					$media_uploaded_type == 'video/x-ms-wmx' || 

					$media_uploaded_type == 'video/x-ms-wm' || 

					$media_uploaded_type == 'video/avi' || 

					$media_uploaded_type == 'video/divx' || 

					$media_uploaded_type == 'video/x-flv' || 

					$media_uploaded_type == 'video/quicktime' || 

					$media_uploaded_type == 'video/mpeg' || 

					$media_uploaded_type == 'video/mp4' || 

					$media_uploaded_type == 'video/ogg' || 

					$media_uploaded_type == 'video/webm' || 

					$media_uploaded_type == 'video/x-matroska' || 

					$media_uploaded_type == 'video/3gpp' || 

					$media_uploaded_type == 'video/3gpp2' ){ 

						

					$path_parts = pathinfo($musicMedia_url);

					$image = $path_parts['dirname'].'/'.$path_parts['filename'].'.jpg';

				 

					if($image){

						$img_path = $image; 

					}else{

						$img_path = get_template_directory_uri().'/assets/images/default_img.png';

					}	

					  

					$media = '<input type="hidden" name="video_url" class="video_url" value="'. $musicMedia_url  .'" > <img  src="'. $img_path .'" alt="" class="thumb_image image_thumb" width="400" height="600">

					<div class="embed-responsive">

						<video class="video" src="" controls></video> 

					</div>    

					<div class="play_pause_buttons"> 

						<i class="fa fa-play-circle-o pause_btn m-auto" aria-hidden="true"></i>  

					</div>';   

				//$increment++;

				} elseif ($media_uploaded_type == 'audio/mp3' ||  

							$media_uploaded_type == 'audio/mpeg' || 

							$media_uploaded_type == 'audio/aac' || 

							$media_uploaded_type == 'audio/x-realaudio' || 

							$media_uploaded_type == 'audio/wav' ||  

							$media_uploaded_type == 'audio/ogg' || 

							$media_uploaded_type == 'audio/flac' || 

							$media_uploaded_type == 'audio/midi' || 

							$media_uploaded_type == 'audio/x-ms-wma' || 

							$media_uploaded_type == 'audio/x-ms-wax' || 

							$media_uploaded_type == 'audio/x-matroska' ){  

					$media = '<audio controls class="pt-2"><source src="'. $musicMedia_url .'"  >

					</audio>'; 

			    } elseif ( $media_uploaded_type == 'image/jpeg' || 

								$media_uploaded_type == 'image/gif' || 

								$media_uploaded_type == 'image/png' || 

								$media_uploaded_type == 'image/bmp' || 

								$media_uploaded_type == 'image/tiff' || 

								$media_uploaded_type == 'image/x-icon'  ){  

					$media = '<img id="imageResult" src="'. $musicMedia_url .'" alt="" class="img-fluid mx-auto" >';

				}

			}elseif( $musicMedia_from == 'youtube' ){ 

				preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);

				$youtube_id = $match[1];   

				$media = '<input type="hidden" name="video_url" class="video_url" value="https://www.youtube.com/embed/'. $youtube_id .'" >	<img src="https://img.youtube.com/vi/'.$youtube_id .'/mqdefault.jpg" alt="" class="thumb_image image_thumb" width="400" height="600"><div class="embed-responsive"><iframe src="" class="video" autoplay="false" frameborder="0" allowfullscreen></iframe></div><div class="play_pause_buttons"><i class="fa fa-play-circle-o pause_btn m-auto" aria-hidden="true"></i></div>';    

			}elseif( $musicMedia_from == 'soundcloud'){  

				$media = '<div class="embed-responsive"> '. do_shortcode("[soundcloud url=". $musicMedia_url ." width='100%'  iframe='true' /]")  .'</div>';

			}elseif( $musicMedia_from == 'spotify' ){  

				$str = '';

				if(strpos($musicMedia_url, '/album/') !== false){

					$str = str_replace("/album/","/embed/album/",$musicMedia_url); 

				}  else if(strpos($musicMedia_url, '/embed/track/') !== false){

					$str =  $musicMedia_url ; 

				}  else if(strpos($musicMedia_url, '/playlist/') !== false){

					$str = str_replace("/playlist/","/embed/playlist/",$musicMedia_url); 

				} else if(strpos($musicMedia_url, '/track/') !== false){  

					$str = str_replace("/track/","/embed/track/",$musicMedia_url); 

				}

				$media = '<div class="embed-responsive">   

					<iframe src="'. $str .'" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

				</div>';   

			} 

			$out .= '<div class="col-xs-12 col-lg-3 single-music">   

				<div class="cat-music-list">

					<div class="main_item pId_'. get_the_ID().'">'. $media .'

					</div>

				</div>

				<div class="pindex">

					<div class="ptitle">

						<a href="'. get_the_permalink() .'" class="my-0"><h2 class="my-0">'.get_the_title().'</h2></a>

					</div>   

				</div>

			</div>';

		endwhile;

    endif;

    wp_reset_postdata();

    die($out);

}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');

add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

 

function get_media_music_html($post_id ){  

	$html = '';  

	$html .= '<div class="cat-music-list">

		<div class="main_item pId_'. $post_id .'">'; 

			$musicMedia_from = get_post_meta($post_id, 'musicMedia_from', true);  

			$musicMedia_url = get_post_meta($post_id, 'musicMedia_url', true);  

			$media_uploaded_types = wp_check_filetype($musicMedia_url);

			$media_uploaded_type = $media_uploaded_types['type']; 



			if( $musicMedia_from == 'media_system' || $musicMedia_from === 'comp_from_computer' ){

				if(  $media_uploaded_type == 'video/x-ms-asf' ||  

					$media_uploaded_type == 'video/x-ms-wmv' || 

					$media_uploaded_type == 'video/x-ms-wmx' || 

					$media_uploaded_type == 'video/x-ms-wm' || 

					$media_uploaded_type == 'video/avi' || 

					$media_uploaded_type == 'video/divx' || 

					$media_uploaded_type == 'video/x-flv' || 

					$media_uploaded_type == 'video/quicktime' || 

					$media_uploaded_type == 'video/mpeg' || 

					$media_uploaded_type == 'video/mp4' || 

					$media_uploaded_type == 'video/ogg' || 

					$media_uploaded_type == 'video/webm' || 

					$media_uploaded_type == 'video/x-matroska' || 

					$media_uploaded_type == 'video/3gpp' || 

					$media_uploaded_type == 'video/3gpp2' ){ 

						

					$path_parts = pathinfo($musicMedia_url);

					$image = $path_parts['dirname'].'/'.$path_parts['filename'].'.jpg';

				 

					if($image){

						$img_path = $image; 

					}else{

						$img_path = get_template_directory_uri().'/assets/images/default_img.png';

					}	 

					$html .= '<input type="hidden" name="video_url" class="video_url" value="'. $musicMedia_url .'" > 

				 			<img src="'. $img_path .'" alt="" class="thumb_image image_thumb" width="400" height="600">

					 		<div class="embed-responsive">

								<video class="video" src="" controls></video> 

							</div>    

							<div class="play_pause_buttons"> 

								<i class="fa fa-play-circle-o pause_btn m-auto" aria-hidden="true"></i>  

							</div>';      

				} elseif ($media_uploaded_type == 'audio/mp3' ||  

							$media_uploaded_type == 'audio/mpeg' || 

							$media_uploaded_type == 'audio/aac' || 

							$media_uploaded_type == 'audio/x-realaudio' || 

							$media_uploaded_type == 'audio/wav' ||  

							$media_uploaded_type == 'audio/ogg' || 

							$media_uploaded_type == 'audio/flac' || 

							$media_uploaded_type == 'audio/midi' || 

							$media_uploaded_type == 'audio/x-ms-wma' || 

							$media_uploaded_type == 'audio/x-ms-wax' || 

							$media_uploaded_type == 'audio/x-matroska' ){ 

					$html .= '<audio controls class="pt-2">

									<source src="'. $musicMedia_url .'">

								</audio>';

				} elseif ( $media_uploaded_type == 'image/jpeg' || 

								$media_uploaded_type == 'image/gif' || 

								$media_uploaded_type == 'image/png' || 

								$media_uploaded_type == 'image/bmp' || 

								$media_uploaded_type == 'image/tiff' || 

								$media_uploaded_type == 'image/x-icon'  ){ 

					$html .= '<img id="imageResult" src="'. $musicMedia_url .'" alt="" class="img-fluid mx-auto">';

				}

			}elseif( $musicMedia_from == 'youtube' || $musicMedia_from == 'comp_from_yoututbe' ){ 

				preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);

				$youtube_id = $match[1];  

				$html .= '<input type="hidden" name="video_url" class="video_url" value="https://www.youtube.com/embed/'.$youtube_id .'" >	

						<img src="https://img.youtube.com/vi/'.$youtube_id.'/mqdefault.jpg" alt="" class="thumb_image image_thumb" width="400" height="600">				

						<div class="embed-responsive">

							<iframe src="" class="video" autoplay="false" frameborder="0" allowfullscreen></iframe>

						</div> 

						<div class="play_pause_buttons"> 

							<i class="fa fa-play-circle-o pause_btn m-auto" aria-hidden="true"></i>  

						</div>';    

			}elseif( $musicMedia_from == 'soundcloud' || $musicMedia_from == 'comp_from_soundcloud' ){ 

				$html .= '<div class="embed-responsive">'. do_shortcode("[soundcloud url=". $musicMedia_url ." width='100%'  iframe='true' /]") .'</div>'; 

			}elseif( $musicMedia_from == 'spotify' || $musicMedia_from == 'comp_spotify' ){ 

				$str = '';

				if(strpos($musicMedia_url, '/album/') !== false){

					$str = str_replace("/album/","/embed/album/",$musicMedia_url); 

				}  else if(strpos($musicMedia_url, '/embed/track/') !== false){

					$str =  $musicMedia_url ; 

				}  else if(strpos($musicMedia_url, '/playlist/') !== false){

					$str = str_replace("/playlist/","/embed/playlist/",$musicMedia_url); 

				} else if(strpos($musicMedia_url, '/track/') !== false){  

					$str = str_replace("/track/","/embed/track/",$musicMedia_url); 

				}

				$html .= '<div class="embed-responsive">   

					<iframe src="'.$str .'" width="300" height="380" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>

				</div>';   

		    } 			

			$html .= '</div>

	</div>'; 	 

	$output = str_replace(array("\r\n", "\r"), "\n", $html);

	$lines = explode("\n", $output);

	$new_output = array();



	foreach ($lines as $i => $line) {

		if(!empty($line))

			$new_output[] = trim($line);

	} 

	return implode($new_output);

}



function get_home_mediaall_html($post_id ){  

		

	$posttype = get_post_type($post_id); 

	$video_cls = '';

	if($posttype  == 'music' || $posttype  == 'competition') { 

		$video_cls = 'home_video_all';

	} else{  

		$video_cls = 'home_video_compvideo';

	} 

	$html = '';  

	$html .= '<div class="home-music-list">

		<div class="home_item pId_'. $post_id .'">'; 

			$musicMedia_from = get_post_meta($post_id, 'musicMedia_from', true);  

			$musicMedia_url = get_post_meta($post_id, 'musicMedia_url', true);  

			$media_uploaded_types = wp_check_filetype($musicMedia_url);

			$media_uploaded_type = $media_uploaded_types['type']; 



			if( $musicMedia_from == 'media_system' || $musicMedia_from === 'comp_from_computer' ){

				if(  $media_uploaded_type == 'video/x-ms-asf' ||  

					$media_uploaded_type == 'video/x-ms-wmv' || 

					$media_uploaded_type == 'video/x-ms-wmx' || 

					$media_uploaded_type == 'video/x-ms-wm' || 

					$media_uploaded_type == 'video/avi' || 

					$media_uploaded_type == 'video/divx' || 

					$media_uploaded_type == 'video/x-flv' || 

					$media_uploaded_type == 'video/quicktime' || 

					$media_uploaded_type == 'video/mpeg' || 

					$media_uploaded_type == 'video/mp4' || 

					$media_uploaded_type == 'video/ogg' || 

					$media_uploaded_type == 'video/webm' || 

					$media_uploaded_type == 'video/x-matroska' || 

					$media_uploaded_type == 'video/3gpp' || 

					$media_uploaded_type == 'video/3gpp2' ){ 

						

					$path_parts = pathinfo($musicMedia_url);

					$image = $path_parts['dirname'].'/'.$path_parts['filename'].'.jpg';

				 

					if($image){

						$img_path = $image; 

					}else{

						$img_path = get_template_directory_uri().'/assets/images/default_img.png';

					}	 

					$html .= '<video class="'.$video_cls.'" width="100%" src="'. $musicMedia_url .'" controls></video>';      

				} elseif ($media_uploaded_type == 'audio/mp3' ||  

							$media_uploaded_type == 'audio/mpeg' || 

							$media_uploaded_type == 'audio/aac' || 

							$media_uploaded_type == 'audio/x-realaudio' || 

							$media_uploaded_type == 'audio/wav' ||  

							$media_uploaded_type == 'audio/ogg' || 

							$media_uploaded_type == 'audio/flac' || 

							$media_uploaded_type == 'audio/midi' || 

							$media_uploaded_type == 'audio/x-ms-wma' || 

							$media_uploaded_type == 'audio/x-ms-wax' || 

							$media_uploaded_type == 'audio/x-matroska' ){ 

					$html .= '<audio controls class="pt-2">

									<source src="'. $musicMedia_url .'">

								</audio>';

				} elseif ( $media_uploaded_type == 'image/jpeg' || 

								$media_uploaded_type == 'image/gif' || 

								$media_uploaded_type == 'image/png' || 

								$media_uploaded_type == 'image/bmp' || 

								$media_uploaded_type == 'image/tiff' || 

								$media_uploaded_type == 'image/x-icon'  ){ 

					$html .= '<img id="imageResult" src="'. $musicMedia_url .'" alt="" class="img-fluid mx-auto">';

				}

			}elseif( $musicMedia_from == 'youtube' || $musicMedia_from == 'comp_from_yoututbe' ){ 

				preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);

				$youtube_id = $match[1];  

				$html .= '<iframe src="https://www.youtube.com/embed/'.$youtube_id .'" width="100%" class="'.$video_cls.'" autoplay="false" frameborder="0" allowfullscreen></iframe>';    

			}elseif( $musicMedia_from == 'soundcloud' || $musicMedia_from == 'comp_from_soundcloud' ){ 

				$html .=  do_shortcode("[soundcloud url=". $musicMedia_url ." width='100%'  iframe='true' /]"); 

			}elseif( $musicMedia_from == 'spotify' || $musicMedia_from == 'comp_spotify' ){ 

				$str = '';

				if(strpos($musicMedia_url, '/album/') !== false){

					$str = str_replace("/album/","/embed/album/",$musicMedia_url); 

				}  else if(strpos($musicMedia_url, '/embed/track/') !== false){

					$str =  $musicMedia_url ; 

				}  else if(strpos($musicMedia_url, '/playlist/') !== false){

					$str = str_replace("/playlist/","/embed/playlist/",$musicMedia_url); 

				} else if(strpos($musicMedia_url, '/track/') !== false){  

					$str = str_replace("/track/","/embed/track/",$musicMedia_url); 

				}

				$html .= '<iframe class="'.$video_cls.'" src="'.$str .'" width="100%"  frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>';   

		    } 			

			$html .= '</div>

	</div>'; 	 

	$output = str_replace(array("\r\n", "\r"), "\n", $html);

	$lines = explode("\n", $output);

	$new_output = array();



	foreach ($lines as $i => $line) {

		if(!empty($line))

			$new_output[] = trim($line);

	} 

	return implode($new_output);

}

function show_home_postsdata($post_id){

	$post = get_post( $post_id ); 

	$post_likes_data = get_post_meta($post_id, 'post_likes_data', true); 

	$like_cls= '';

	$action='';

	if($post_likes_data){

		if(in_array(get_current_user_id(), $post_likes_data)){

			$like_cls = 'unlike_a';

			$action = 'unlike';

		}else{

			$like_cls = 'like_a';

			$action = 'like';

		}

	}else{

		$like_cls = 'like_a';

		$action = 'like';

	}

	$like_count = 0;

	$post_likes_count = get_post_meta($post_id, 'post_likes_count', true);

	if($post_likes_count != null && $post_likes_count && $post_likes_count > 0){

		$like_count =  $post_likes_count; 

	}

	$post_dislikes_data = get_post_meta($post_id, 'post_dislikes_data', true);

	$post_dislikes_count = get_post_meta($post_id, 'post_dislikes_count', true);

	$dislike_count = 0;

	

	if($post_dislikes_count != null && $post_dislikes_count && $post_dislikes_count > 0 ){

		$dislike_count = '-' .$post_dislikes_count; 

	}	 

	$dislike_cls= '';

	$dislike_action= '';

	if($post_dislikes_data){

		if(in_array(get_current_user_id(), $post_dislikes_data)){

			$dislike_cls = 'remove_dislike_a';

			$dislike_action= 'remove_dislike';

		}else{

			$dislike_cls = 'dislike_a';

			$dislike_action= 'dislike';

		}

	}else{

		$dislike_cls = 'dislike_a';

		$dislike_action= 'dislike';

	} 

	

	$posttype = get_post_type($post_id); 

	$html = '';

	if($posttype  == 'music' || $posttype  == 'competition_video' ) { 

		$html .= get_home_mediaall_html($post_id);

	} elseif($posttype  == 'competition' ) { 

		$html .= '<div class="cat-music-list">

			<div class="main_item pId_'.$post_id.'">'.get_the_post_thumbnail($post_id) .'</div>

		</div>';  

	}  

	

	$author_id = $post->post_author; 

	$author_obj = get_user_by('id', $author_id);  



	$html .=  '<div class="row">'; 

	$html .=  '<div class="col-md-8"><ul class="p-0 text-center like_share_dislike" data-pid="'. get_the_ID() .'">

		<li class="like_mus_comp"> 

			<span class="likes_count">'. $like_count .'</span>

			<a href="javascript:void(0);" class="d-inline '. $like_cls .'" data-postid="'. get_the_ID() .'" data-userid="'. get_current_user_id() .'">Trend-it</a>

		</li>

		<li class="dislike_mus_comp">

			<span class="dislikes_count">'. $dislike_count .'</span>

			<a href="javascript:void(0);" class="d-inline '. $dislike_cls .'" data-postid="'. get_the_ID() .'" data-userid="'. get_current_user_id() .'"> End-it</a>

		</li>

		<li class="share_mus_comp">

			<a href="javascript:void(0);" class="share-post" data-postid="'. get_the_ID() .'" data-userid="'. get_current_user_id() .'"   >Share-it</a>

		</li>

	</ul></div>'; 

	

	$html .=  '<div class="col-md-4"><ul class="p-0 text-center">

		<li class="post_auther_name">  

			<a href="'.home_url( "/members/".  bp_core_get_username( $author_id ) . "/profile/") .'" rel="author">' . ucfirst( get_the_author()) .'</a> 

		</li> 

	</ul></div>'; 

	 

	$html .=  '</div>';

	$output = str_replace(array("\r\n", "\r"), "\n", $html);

	$lines = explode("\n", $output);

	$new_output = array();



	foreach ($lines as $i => $line) {

		if(!empty($line))

			$new_output[] = trim($line);

	} 

	return implode($new_output);





}

// add_action( 'template_redirect', function() { 
// 	if (!is_user_logged_in() ) {

// 		wp_redirect( site_url( '/login/' ) ); 
// 		exit(); 
//     }

// } );

 

// Show Errors

function custom_wp_errors(){

    static $wp_error; // Will hold global variable safely

    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));

}

// displays error messages from form submissions

function custom_wpshow_error_messages() {

	if($codes = custom_wp_errors()->get_error_codes()) {

		echo '<div class="custom_wp_errors">';

		    // Loop error codes and display errors

		   foreach($codes as $code){

		        $message = custom_wp_errors()->get_error_message($code);

		        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span></br>';

		    }

		echo '</div>';

	}	

}

function custom_login_member() {

 

	if(isset($_POST['email']) && wp_verify_nonce($_POST['pippin_login_nonce'], 'pippin-login-nonce')) {

 

		// this returns the user ID and other info from the user name

		// $user = get_userdatabylogin($_POST['email']);

		$user = get_user_by('email', $_POST['email']);

		if(!isset($_POST['email']) || $_POST['email'] == '') {

			// if no password was entered

			custom_wp_errors()->add('empty_email', __('Please enter an email'));

		}

 

		if(!$user) {

			// if the user name doesn't exist

			custom_wp_errors()->add('empty_email', __('Please enter a correct email'));

		}

 

		if(!isset($_POST['password']) || $_POST['password'] == '') {

			// if no password was entered

			custom_wp_errors()->add('empty_password', __('Please enter a password'));

		}

 

		// check the user's login with their password

		if(!wp_check_password($_POST['password'], $user->user_pass, $user->ID)) {

			// if the password is incorrect for the specified user

			custom_wp_errors()->add('empty_password', __('Please enter a correct password'));

		}

 

		// retrieve all error messages

		$errors = custom_wp_errors()->get_error_messages();

 

		// only log the user in if there are no errors

		if(empty($errors)) {

			$user_info = get_userdata( $user->ID ); 

			$username =  $user_info->user_login; 

			// $user = get_user_by('login', $username );

			// wp_clear_auth_cookie();

			// wp_set_current_user ( $user->ID ); // Set the current user detail

			wp_set_auth_cookie  ( $user->ID ); // Set auth details in cookie

			

			 

			// wp_setcookie( $username, $_POST['password'], true);

			wp_set_current_user($user->ID, $_POST['email']);	

			do_action('wp_login', $username, $user);  

			wp_redirect(home_url('/home/')); exit;

		} 

	}

}

add_action('init', 'custom_login_member');



/* What to do on logout */

function logout_redirect() {

	$login_page = home_url('/');

	wp_redirect($login_page . "?login=false");

	exit;

}

add_action('wp_logout','logout_redirect');

function modify_logo() {

	$logo_style = '';

	if( have_rows('header_options', 'option') ): 

		while ( have_rows('header_options', 'option') ) : the_row();   

			$header_logo = get_sub_field('header_circle_logo', 'option'); 

			$logo_style .= '<style type="text/css">';

			$logo_style .= 'h1 a {background-image: url(' .$header_logo['url'] . ') !important; width: 70% !important;  }h1 a:focus{outline: none !important;}.mo_image_id { display: none; width: 0; height: 0; float: none !important;}';

			$logo_style .= '</style>';

		endwhile; 

	endif;

    echo $logo_style;

}

add_action('login_head', 'modify_logo');

add_filter('acf/settings/remove_wp_meta_box', '__return_false');



// Set and Get Music type post tyoe a 

function getPostViews($postID){

    $count_key = 'post_views_count';

    $count = get_post_meta($postID, $count_key, true);

    if($count==''){

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '0');

        return "0 View";

    }

    return $count.' Views';

}

function setPostViews($postID) {

    $count_key = 'post_views_count';

    $count = get_post_meta($postID, $count_key, true);

    if($count==''){

        $count = 0;

        delete_post_meta($postID, $count_key);

        add_post_meta($postID, $count_key, '0');

    }else{

        $count++;

        update_post_meta($postID, $count_key, $count);

    }

}

// Remove issues with prefetching adding extra views

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

 

// Custom columns to Music in wp-admin

add_filter('manage_music_posts_columns', 'columns_head_only_musics', 10);

add_action('manage_music_posts_custom_column', 'columns_content_only_musics', 10, 2);

function columns_head_only_musics($defaults) {

	$defaults['music_count'] = 'Music Counts';

	$defaults['music_total_points'] = 'Total Points';

	$defaults['music_media_type'] = 'Music Media Type';

	// $defaults['music_media_from'] = 'Music Media From';

    return $defaults;

}

function  columns_content_only_musics($column_name, $post_ID) {

	$musicMedia_from = get_post_meta($post_ID, 'musicMedia_from', true); 

    if ($column_name == 'music_count') {

        echo getPostViews($post_ID);

	}

	$post_total_points = get_post_meta($post_ID, 'post_total_points', true); 

	if ($column_name == 'music_total_points') {

        echo $post_total_points;

	}

	if ($column_name == 'music_media_type') {

        $musicMedia_url = get_post_meta($post_ID, 'musicMedia_url', true); 

		$media_uploaded_type = wp_check_filetype($musicMedia_url); 

		if($musicMedia_from == 'media_system' ){

			echo $media_uploaded_type['type'];

		}else{

			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);

			$youtube_id = $match[1]; 

			echo $youtube_id;

		} 

	} 

}



// Custom column to COmpetition in wp-admin

add_filter('manage_competition_posts_columns', 'columns_head_only_competitions', 10);

add_action('manage_competition_posts_custom_column', 'columns_content_only_competitions', 10, 2);

function columns_head_only_competitions($defaults) {

	$defaults['start_date'] = 'Start Date'; 

	$defaults['end_date'] = 'End Date'; 

	$defaults['voting_date'] = 'Voting Date'; 

	$defaults['total_points'] = 'Total Points'; 

	unset($defaults['comments']);

    return $defaults;

}

function columns_content_only_competitions($column_name, $post_ID) { 

	$comp_start_date =  get_field('comp_start_date', $post_ID) ; 

	$comp_end_date =  get_field('comp_end_date', $post_ID) ; 

	$comp_voting_date =  get_field('comp_voting_date', $post_ID) ; 

	$post_total_points = get_post_meta($post_ID, 'post_total_points', true); 

	

    if ($column_name == 'start_date') {

        echo $comp_start_date;

	}  

	if ($column_name == 'end_date') {

        echo $comp_end_date;

	} 

	if ($column_name == 'voting_date') {

        echo $comp_voting_date;

	} 

	if ($column_name == 'total_points') {

        echo $post_total_points;

	}

}



// Custom column to COmpetition Videos in wp-admin

add_filter('manage_competition_video_posts_columns', 'columns_head_only_competition_videos', 10);

add_action('manage_competition_video_posts_custom_column', 'columns_content_only_competition_videos', 10, 2);

function columns_head_only_competition_videos($defaults) {

	$defaults['competition'] = 'Competition'; 

	$defaults['total_points'] = 'Total Points'; 

	$defaults['comp_from'] = 'Competition From'; 

	$defaults['video_type'] = 'Video Type'; 

	unset($defaults['comments']);

    return $defaults;

}

function columns_content_only_competition_videos($column_name, $post_ID) { 

	$compVideo_from_competition =  get_post_meta($post_ID, 'compVideo_from_competition', true ) ; 

	$post_total_points =  get_post_meta($post_ID, 'post_total_points', true ) ;

	$musicMedia_from =  get_post_meta($post_ID, 'musicMedia_from', true ) ; 

	$compVideo_plan_type =  get_post_meta($post_ID, 'compVideo_plan_type', true ) ; 

	if ($column_name == 'competition') {

        echo $compVideo_from_competition;

	}  

    if ($column_name == 'total_points') {

        echo $post_total_points;

	}

	if ($column_name == 'comp_from') {

        echo $musicMedia_from;

	}  

	if ($column_name == 'video_type') {

        echo $compVideo_plan_type;

	}  

}

// Gravity form after save 

add_filter( 'gform_field_validation_1_15', 'validate_youtubeURL_music_1', 10, 4 );

function validate_youtubeURL_music_1( $result, $value, $form, $field ) { 

	// $pattern = "/^(?:https?:\/\/)?(?:www\/|m\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/";

	// $url_parsed_arr = parse_url($value); 

	$pattern = '~

	^(?:https?://)?                            

	 (?:www[.])?                             

	 (?:youtu\.be\/|youtube\.com/|m.youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))  

	 ([^&]{11})                                

	  ~x';

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) {  

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Youtube URL.';  

		} else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

} 

add_filter( 'gform_field_validation_1_17', 'validate_soundcloud_music_1', 10, 4 );

function validate_soundcloud_music_1( $result, $value, $form, $field ) {

	$pattern = "/^https?:\/\/(soundcloud\.com|snd\.sc)\/(.*)$/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Soundcloud URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

}

add_filter( 'gform_field_validation_1_16', 'validate_spotify_music_1', 10, 4 );

function validate_spotify_music_1( $result, $value, $form, $field ) {

	$pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/)/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Spotify URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

}

add_action( 'gform_after_submission_1', 'custom_gform_after_submission_1', 10, 2 );

function custom_gform_after_submission_1( $entry, $form ) {

 

	$form_id = $entry[ 'form_id' ];   

	// if($entry['11'] == 'media_system' ){

	// 	$dir = GFFormsModel::get_file_upload_path( 1, 'PLACEHOLDER' );

	// 	$dir['path'] = dirname( $dir['path'] );

	// 	$dir['url']  = dirname( $dir['url'] ); 

	// 	$jsonData = stripslashes(html_entity_decode(  $entry[ '13' ]  )); 

	// 	$jsonArray = json_decode( $jsonData, true );

	 

	// 	$video =  $jsonArray[0];  

	// 	$path_parts = pathinfo($video);                      

  

	// 	$ffmpegpath = "";   

	// 	$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 

	// 	if (strpos($link, 'localweb') !== false) {

	// 		$ffmpegpath = "C:/FFmpeg/bin/ffmpeg.exe"; 

	// 	}else{

	// 		$ffmpegpath = "/usr/bin/ffmpeg";    

	// 	}

	// 	$img_path  =  $dir['path'] .'/'.$path_parts['filename'].'.jpg';

	// 	$video_url = $video;

	// 	$cmd =  $ffmpegpath .' -ss 00:00:15 -i '. $video_url .' -vf scale=800:-1 -vframes 1 ' . $img_path;

	// 	@exec($cmd, $output, $retval); 

	// }   

	$update_music = array(

		'ID'           => $entry['post_id'], 

		'comment_status' => 'open',

	);  

	wp_update_post( $update_music );

	update_post_meta($entry['post_id'] , "gf_entry_id", $entry['id'] ); 

}    

 

add_filter( 'gform_field_validation_4_15', 'validate_youtubeURL_editmusic_1', 10, 4 );

function validate_youtubeURL_editmusic_1( $result, $value, $form, $field ) {

	// $pattern = "/^(?:https?:\/\/)?(?:www\/|m\.)?(?:youtu\.be\/|cc\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/";

	// $url_parsed_arr = parse_url($value); 

	$pattern = '~

  ^(?:https?://)?                            

   (?:www[.])?                             

   (?:youtu\.be\/|youtube\.com/|m.youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))  

   ([^&]{11})                                

    ~x';

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) {  

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Youtube URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

	// echo '<pre>'; 

	// print_r($result);

	//  echo '</pre>';

    return $result; 

} 

add_filter( 'gform_field_validation_4_17', 'validate_soundcloud_editmusic_1', 10, 4 );

function validate_soundcloud_editmusic_1( $result, $value, $form, $field ) {

	$pattern = "/^https?:\/\/(soundcloud\.com|snd\.sc)\/(.*)$/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Soundcloud URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

}

add_filter( 'gform_field_validation_4_16', 'validate_spotify_editmusic_1', 10, 4 );

function validate_spotify_editmusic_1( $result, $value, $form, $field ) {

	// $pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/embed\/)/"; 

	$pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/)/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Spotify URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

}

add_action( 'gform_post_submission_4', 'edit_music_form', 10, 2 );

function edit_music_form( $entry, $form ) { 

	if( isset( $_GET['id'] ) && !empty($_GET['id']) ){  

		$post_id=$_GET['id']; 

		$update_music = array(

			'ID'           => $post_id,

			'post_title'   => $entry[10],

			'post_type'    => 'music',

			'post_content' =>  $entry[14],

			'comment_status' => 'open',

		);  

		wp_update_post( $update_music );

		update_post_meta($post_id, "gf_entry_id", $entry['id'] );

		if(!empty($_POST["input_12"])){

			wp_set_post_terms($post_id, $_POST["input_12"], 'music_category');

		}

		if(!empty($_POST["input_11"])){

			update_post_meta($post_id, "musicMedia_from", $entry['11'] );

		}    

		if($entry[11] == 'youtube') { 

			update_post_meta($post_id, "musicMedia_url", $entry['15'] );

		}else if($entry[11] == 'soundcloud') { 

			update_post_meta($post_id, "musicMedia_url", $entry['17'] );

		}else if($entry[11] == 'spotify') { 

			update_post_meta($post_id, "musicMedia_url", $entry['16'] );

		}	

		// else{

		// 	// if(!empty($_POST["gform_uploaded_files"])){

		// 	// 	$jsonData = stripslashes(html_entity_decode(  $entry[ 13 ]  )); 

		// 	// 	$jsonArray = json_decode( $jsonData, true ); 

		// 	// 	update_post_meta($post_id, "musicMedia_url", $jsonArray[0] );

				

		// 	// 	$dir = GFFormsModel::get_file_upload_path( 4, 'PLACEHOLDER' );

		// 	// 	$dir['path'] = dirname( $dir['path'] );

		// 	// 	$dir['url']  = dirname( $dir['url'] );   

		// 	// 	$video =  $jsonArray[0];  

		// 	// 	$path_parts = pathinfo($video);                      



		// 	// 	$ffmpegpath = "";   

		// 	// 	$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 

		// 	// 	if (strpos($link, 'localweb') !== false) {

		// 	// 		$ffmpegpath = "C:/FFmpeg/bin/ffmpeg.exe"; 

		// 	// 	}else{

		// 	// 		$ffmpegpath = "/usr/bin/ffmpeg";    

		// 	// 	}

		// 	// 	$img_path  =  $dir['path'] .'/'.$path_parts['filename'].'.jpg';

		// 	// 	$video_url = $video;

		// 	// 	$cmd =  $ffmpegpath .' -ss 00:00:15 -i '. $video_url .' -vf scale=800:-1 -vframes 1 ' . $img_path;

		// 	// 	@exec($cmd, $output, $retval); 

		// 	// } 

		// } 

		$getentry = GFAPI::get_entry( $entry['id'] ); 

		$getentry['post_id'] = $_GET['id']; 

		$updateit = GFAPI::update_entry($getentry);  

	} 

} 

function disable_post_creation($is_disabled, $form, $entry){

	return true;

}

add_filter( 'gform_disable_post_creation_4', 'disable_post_creation', 10, 3 ); 

add_filter( 'gform_disable_post_creation_6', 'disable_post_creation', 10, 3 );

 

add_filter( 'gform_field_validation_6', 'custom_validation', 10, 4  );

function custom_validation( $result, $value, $form, $field) {

	$form = $validation_result['form'];

	$comp_id = $_GET['comp_id'];

	$userId = get_current_user_id();

	$args_video  = array( 

		'post_type' => 'competition_video',

		'posts_per_page' => -1, 

		'meta_query' => array(

			'relation' => "AND",

			array(

				'key'     => 'compVideo_user',

				'value'   => $userId,

				'type'    => 'NUMERIC',

				'compare' => '=',

			),

			array(

				'key'     => 'compVideo_from_competition',

				'value'   => $comp_id, 

				'type'    => 'NUMERIC',

				'compare' => '=',

			),

		),

	);

	$query_video  = new WP_Query($args_video); 

 

	if( rgpost( 'input_28' ) == 'paid_plan'){

		if ( $query_video->found_posts >= 3 ) { 

			if ( rgpost( 'input_26' ) == 'pre_pack' ||  rgpost( 'input_26' ) == 'standard_plan' ||  rgpost( 'input_26' ) == 'starter_plan' ) { 

				if ( $field->id == '16' ) {

					$result['is_valid'] = false;

					$result["message"] = "You have reached the maximum number of entries for

					this competition. In one week you will be able to join another competition.";

					

				} 

			} else{

				$result['is_valid'] = true; 

			}

		} else if ( $query_video->found_posts == 2 ) {

			if ( rgpost( 'input_26' ) == 'pre_pack' ||  rgpost( 'input_26' ) == 'standard_plan'  ) {  

				if ( $field->id == '16' ) {

					$result['is_valid'] = false;

					$result["message"] = "You have reached the maximum number of entries for

					this competition. In one week you will be able to join another competition.";

					

				} 

			}else{

				$result['is_valid'] = true; 

			}

		}else if ( $query_video->found_posts == 1 ) {

			if ( rgpost( 'input_26' ) == 'pre_pack'  ) {  

				if ( $field->id == '16' ) {

					$result['is_valid'] = false;

					$result["message"] = "You have reached the maximum number of entries for

					this competition. In one week you will be able to join another competition.";

					

				}  

			}else{

				$result['is_valid'] = true; 

			}

		} else if ( $query_video->found_posts == 0) {

			$result['is_valid'] = true; 

		} 

	} 

    return $result; 

}



add_filter( 'gform_pre_validation_6', 'gw_conditional_requirement' );

function gw_conditional_requirement( $form ) { 

	$selected_plan = rgpost( 'input_26' ); 

	$freepaidplan = rgpost( 'input_28' ); 

	// echo $freepaidplan; die;

	//   die;

	$upload_from_1 = rgpost( 'input_9' );  

	$upload_from_2 = rgpost( 'input_35' ); 

	$upload_from_3 = rgpost( 'input_34' ); 

 

    foreach ( $form['fields'] as &$field ) {  

		if($freepaidplan == 'paid_plan'){



			// if(	($selected_plan == 'pre_pack' && $upload_from_1 == 'comp_from_computer') || 

			// 	($selected_plan == 'standard_plan' && $upload_from_1 == 'comp_from_computer') || 

			// 	($selected_plan == 'starter_plan' && $upload_from_1 == 'comp_from_computer') ){ 

			// 	if ( $field->id === 8  ) { 

			// 		$field->isRequired = true; 

			// 	}   

			// } else 

			if(($selected_plan == 'pre_pack' && $upload_from_1 == 'comp_from_yoututbe') || 

				($selected_plan == 'standard_plan' && $upload_from_1 == 'comp_from_yoututbe') || 

				($selected_plan == 'starter_plan' && $upload_from_1 == 'comp_from_yoututbe') ){

				if ( $field->id === 12 ) {

					$field->isRequired = true;  

				}  

			} else if(($selected_plan == 'pre_pack' && $upload_from_1 == 'comp_from_soundcloud') || 

				($selected_plan == 'standard_plan' && $upload_from_1 == 'comp_from_soundcloud') || 

				($selected_plan == 'starter_plan' && $upload_from_1 == 'comp_from_soundcloud') ){

				if ( $field->id === 13 ) {

					$field->isRequired = true; 

				}  

			} else if( ($selected_plan == 'pre_pack' && $upload_from_1 == 'comp_spotify') || 

				($selected_plan == 'standard_plan' && $upload_from_1 == 'comp_spotify') || 

				($selected_plan == 'starter_plan' && $upload_from_1 == 'comp_spotify') ){

				if ( $field->id === 14 ) {

					$field->isRequired = true; 

				}  

			} 



			// if(	($selected_plan == 'pre_pack' && $upload_from_2 == 'comp_from_computer') || 

			// 	($selected_plan == 'standard_plan' && $upload_from_2 == 'comp_from_computer')   ){ 

			// 	if ( $field->id === 18  ) { 

			// 		$field->isRequired = true; 

			// 	}   

			// } else 

			if(($selected_plan == 'pre_pack' && $upload_from_2 == 'comp_from_yoututbe') || 

				($selected_plan == 'standard_plan' && $upload_from_2 == 'comp_from_yoututbe')   ){

				if ( $field->id === 20 ) {

					$field->isRequired = true;  

				}  

			} else if(($selected_plan == 'pre_pack' && $upload_from_2 == 'comp_from_soundcloud') || 

				($selected_plan == 'standard_plan' && $upload_from_2 == 'comp_from_soundcloud')   ){

				if ( $field->id === 22 ) {

					$field->isRequired = true; 

				}  

			} else if( ($selected_plan == 'pre_pack' && $upload_from_2 == 'comp_spotify') || 

				($selected_plan == 'standard_plan' && $upload_from_2 == 'comp_spotify') ){

				if ( $field->id === 24 ) {

					$field->isRequired = true; 

				}  

			} 



			// if( $selected_plan == 'pre_pack' && $upload_from_3 == 'comp_from_computer' ){ 

			// 	if ( $field->id === 19  ) { 

			// 		$field->isRequired = true; 

			// 	}   

			// } else 

			if( $selected_plan == 'pre_pack' && $upload_from_3 == 'comp_from_yoututbe' ){

				if ( $field->id === 21 ) {

					$field->isRequired = true;  

				}  

			} else if( $selected_plan == 'pre_pack' && $upload_from_3 == 'comp_from_soundcloud' ){

				if ( $field->id === 23 ) {

					$field->isRequired = true; 

				}  

			} else if( $selected_plan == 'pre_pack' && $upload_from_3 == 'comp_spotify'  ){

				if ( $field->id === 25) {

					$field->isRequired = true; 

				}  

			}  

		 

		}else if( $freepaidplan == 'free_pack' ){

			if ( $field->id === 29 ||  $field->id === 30 || $field->id === 31 || $field->id === 32 || $field->id === 33 ) { 

				$field->isRequired = true; 

				$field->cssClass = 'custom_question_answer d-block'; 

			}  

			if ( $field->id === 16 ||  $field->id === 18 || $field->id === 19 || $field->id === 20 || $field->id === 21

				|| $field->id === 22 ||  $field->id === 23 || $field->id === 24 || $field->id === 25 || $field->id === 10

				|| $field->id === 11 || $field->id === 12 || $field->id === 13 || $field->id === 14   ) { 

				$field->isRequired = false;  

			}   

			// if(  $upload_from_1 == 'comp_from_computer' ){ 

			// 	if ( $field->id === 8 ) { 

			// 		$field->isRequired = true;    

			// 	}   

			// } else 

			if( $upload_from_1 == 'comp_from_yoututbe' ){

				if ( $field->id === 12 ) {

					$field->isRequired = true;   

				}  

			}else if( $upload_from_1 == 'comp_from_soundcloud' ){

				if ( $field->id === 13 ) {

					$field->isRequired = true;  

				}  

			} else if( $upload_from_1 == 'comp_spotify' ){

				if ( $field->id === 14 ) {

					$field->isRequired = true;   

				}  

			} 

		} 

	}   

    return $form;

}

add_filter("gform_field_validation_6_29", "validate_chars_count_1", 10, 4);

function validate_chars_count_1($result, $value, $form, $field){

	// echo $field->isRequired; die;

	if($field->isRequired == true){ 

		if (strlen($value) < 30) { //Minimum number of characters

			$result["is_valid"] = false;

			$result["message"] = "Please enter at least 30 characters.";

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		} else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		} 

	} 

	return $result;

}

add_filter("gform_field_validation_6_30", "validate_chars_count_2", 10, 4);

function validate_chars_count_2($result, $value, $form, $field){

	if($field->isRequired == true){ 

		if (strlen($value) < 30) { //Minimum number of characters

			$result["is_valid"] = false;

			$result["message"] = "Please enter at least 30 characters.";

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}  

	}

	return $result;

}

add_filter("gform_field_validation_6_31", "validate_chars_count_3", 10, 4);

function validate_chars_count_3($result, $value, $form, $field){

	if($field->isRequired == true){ 

		if (strlen($value) < 30) { //Minimum number of characters

			$result["is_valid"] = false;

			$result["message"] = "Please enter at least 30 characters.";

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}  

	}

	return $result;

}

add_filter("gform_field_validation_6_32", "validate_chars_count_4", 10, 4);

function validate_chars_count_4($result, $value, $form, $field){

	if($field->isRequired == true){ 

		if (strlen($value) < 30) { //Minimum number of characters

			$result["is_valid"] = false;

			$result["message"] = "Please enter at least 30 characters.";

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}  

	}

	return $result;

}

add_filter("gform_field_validation_6_33", "validate_chars_count_5", 10, 4);

function validate_chars_count_5($result, $value, $form, $field){

	if($field->isRequired == true){ 

		if (strlen($value) < 30) { //Minimum number of characters

			$result["is_valid"] = false;

			$result["message"] = "Please enter at least 30 characters.";

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}  

	}

	return $result;

} 

add_filter( 'gform_field_validation_6_12', 'validate_youtubeURL_1', 10, 4 );

function validate_youtubeURL_1( $result, $value, $form, $field ) {

	// $pattern = "/^(?:https?:\/\/)?(?:www\/|m\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/";

	// $url_parsed_arr = parse_url($value); 

	$pattern = '~

	^(?:https?://)?                            

	 (?:www[.])?                             

	 (?:youtu\.be\/|youtube\.com/|m.youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))  

	 ([^&]{11})                                

	  ~x';

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) {  

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Youtube URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

} 

add_filter( 'gform_field_validation_6_20', 'validate_youtubeURL_2', 10, 4 );

function validate_youtubeURL_2( $result, $value, $form, $field ) {

	// $pattern = "/^(?:https?:\/\/)?(?:www\/|m\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/";

	// $url_parsed_arr = parse_url($value); 

	$pattern = '~

	^(?:https?://)?                            

	 (?:www[.])?                             

	 (?:youtu\.be\/|youtube\.com/|m.youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))  

	 ([^&]{11})                                

	  ~x';

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) {  

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Youtube URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}  

	}

    return $result;

}

add_filter( 'gform_field_validation_6_21', 'validate_youtubeURL_3', 10, 4 );

function validate_youtubeURL_3( $result, $value, $form, $field ) { 

	// $pattern = "/^(?:https?:\/\/)?(?:www\/|m\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/";

	// $url_parsed_arr = parse_url($value); 

	$pattern = '~

	^(?:https?://)?                            

	 (?:www[.])?                             

	 (?:youtu\.be\/|youtube\.com/|m.youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))  

	 ([^&]{11})                                

	  ~x';

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) {  

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Youtube URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

} 

add_filter( 'gform_field_validation_6_13', 'validate_soundcloud_1', 10, 4 );

function validate_soundcloud_1( $result, $value, $form, $field ) {

	$pattern = "/^https?:\/\/(soundcloud\.com|snd\.sc)\/(.*)$/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Soundcloud URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

}



add_filter( 'gform_field_validation_6_22', 'validate_soundcloud_2', 10, 4 );

function validate_soundcloud_2( $result, $value, $form, $field ) {

	$pattern = "/^https?:\/\/(soundcloud\.com|snd\.sc)\/(.*)$/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Soundcloud URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}  

	}

    return $result;

}

add_filter( 'gform_field_validation_6_23', 'validate_soundcloud_3', 10, 4 );

function validate_soundcloud_3( $result, $value, $form, $field ) {

	$pattern = "/^https?:\/\/(soundcloud\.com|snd\.sc)\/(.*)$/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Soundcloud URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}  

	} 

	return $result;

}



add_filter( 'gform_field_validation_6_14', 'validate_spotify_1', 10, 4 );

function validate_spotify_1( $result, $value, $form, $field ) {

	// $pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/embed\/)/"; 

	$pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/)/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Spotify URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

}



add_filter( 'gform_field_validation_6_24', 'validate_spotify_2', 10, 4 );

function validate_spotify_2( $result, $value, $form, $field ) {

	// $pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/embed\/)/"; 

	$pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/)/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Spotify URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}

	}  

    return $result;

}

add_filter( 'gform_field_validation_6_25', 'validate_spotify_3', 10, 4 );

function validate_spotify_3( $result, $value, $form, $field ) {

	// $pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/embed\/)/"; 

	$pattern = "/^(spotify:|https:\/\/[a-z]+\.spotify\.com\/)/"; 

	if($field->isRequired == true){ 

		if ( ! preg_match( $pattern, $value ) && !empty( $value ) ) { 

			$result['is_valid'] = false;

			$result['message']  = 'Please enter a valid Spotify URL.'; 

		}else if ( empty( $value )  ) { 

			$result['is_valid'] = false;

			$result['message']  = 'This field is required.';

		}else {  

			$result['is_valid'] = true;

			$result['message']  = '';

		}   

	}

    return $result;

} 

 

add_action( 'gform_post_submission_6', 'competition_registration', 10, 2 );

function competition_registration( $entry, $form ) {  

	if( isset( $_GET['comp_id'] ) && !empty($_GET['comp_id']) ){  

		$post_id=$_GET['comp_id'];     

		// Update curent User

		$user_data = wp_update_user( array( 'ID' => get_current_user_id(), 'user_email' => $entry['2'] ) );

		update_user_meta( get_current_user_id(), 'first_name', $entry['1.3'] );

		update_user_meta( get_current_user_id(), 'user_cust_str_address', $entry['3.1'] );

		update_user_meta( get_current_user_id(), 'user_cust_city', $entry['3.3'] );

		update_user_meta( get_current_user_id(), 'user_cust_postalcode', $entry['3.5'] );

		update_user_meta( get_current_user_id(), 'user_cust_country', $entry['3.6'] );

		// Update Post metas		  

		// echo count($uploaded_files);

		$vArray[] = array();   

		$uploaded_files = json_decode(rgpost("gform_uploaded_files"), true);



		$selected_plan = $entry['26'] ; 

		$freepaidplan = $entry['28'] ; 



		$upload_from_1 = $entry['9'];

		$upload_from_2 = $entry['35'];

		$upload_from_3 = $entry['34'];

		$uploaded_files = json_decode(rgpost("gform_uploaded_files"), true); 

		// $is_file_uploaded1 = !empty($_FILES["input_8"]["name"]) || isset($uploaded_files['input_8']);

		// $is_file_uploaded2 = !empty($_FILES["input_18"]["name"]) || isset($uploaded_files['input_18']);

		// $is_file_uploaded3 = !empty($_FILES["input_19"]["name"]) || isset($uploaded_files['input_19']);  

		

		if($freepaidplan == 'paid_plan' ){  



			// if(($selected_plan == 'pre_pack' && $upload_from_1 == 'comp_from_computer' && $is_file_uploaded1) ||

			// 	($selected_plan == 'standard_plan' && $upload_from_1 == 'comp_from_computer' && $is_file_uploaded1) ||

			// 	($selected_plan == 'starter_plan' && $upload_from_1 == 'comp_from_computer' && $is_file_uploaded1) ){   

			// 	if($is_file_uploaded1 == 1){

			// 		$jsonData = stripslashes(html_entity_decode(  $entry[ 8 ]  )); 

			// 		$jsonArray = json_decode( $jsonData, true );   

			// 		$video =  $jsonArray[0];  

			// 		$vArray[0]['url'] = $video ;

			// 		$vArray[0]['media_from'] = $upload_from_1 ;

			// 	}

			// }else

			if(($selected_plan == 'pre_pack' && $upload_from_1 == 'comp_from_yoututbe' ) ||

				($selected_plan == 'standard_plan' && $upload_from_1 == 'comp_from_yoututbe' ) ||

				($selected_plan == 'starter_plan' && $upload_from_1 == 'comp_from_yoututbe' ) ){  

				if(!empty($entry['12']) && isset($entry['12']) ){

					$vArray[0]['url'] = $entry['12'];

					$vArray[0]['media_from'] = $upload_from_1 ;

				}

			}else if(($selected_plan == 'pre_pack' && $upload_from_1 == 'comp_from_soundcloud' ) ||

				($selected_plan == 'standard_plan' && $upload_from_1 == 'comp_from_soundcloud' ) ||

				($selected_plan == 'starter_plan' && $upload_from_1 == 'comp_from_soundcloud' ) ){  

				if(!empty($entry['13']) && isset($entry['13']) ){

					$vArray[0]['url'] = $entry['13'];

					$vArray[0]['media_from'] = $upload_from_1 ;

				}

			} else if(($selected_plan == 'pre_pack' && $upload_from_1 == 'comp_spotify' ) ||

				($selected_plan == 'standard_plan' && $upload_from_1 == 'comp_spotify' ) ||

				($selected_plan == 'starter_plan' && $upload_from_1 == 'comp_spotify' ) ){  

				if(!empty($entry['14']) && isset($entry['14']) ){

					$vArray[0]['url'] = $entry['14'];

					$vArray[0]['media_from'] = $upload_from_1 ;

				}

			}



			// if(($selected_plan == 'pre_pack' && $upload_from_2 == 'comp_from_computer' && $is_file_uploaded2) ||

			// 	($selected_plan == 'standard_plan' && $upload_from_2 == 'comp_from_computer' && $is_file_uploaded2) ||

			// 	($selected_plan == 'starter_plan' && $upload_from_2 == 'comp_from_computer' && $is_file_uploaded2) ){   

			// 	if($is_file_uploaded2 == 1){

			// 		$jsonData = stripslashes(html_entity_decode( $entry[ 18 ] )); 

			// 		$jsonArray = json_decode( $jsonData, true );   

			// 		$video =  $jsonArray[0];  

			// 		$vArray[1]['url'] = $video ;

			// 		$vArray[1]['media_from'] = $upload_from_2 ;

			// 	}

			// }else 

			if(($selected_plan == 'pre_pack' && $upload_from_2 == 'comp_from_yoututbe' ) ||

				($selected_plan == 'standard_plan' && $upload_from_2 == 'comp_from_yoututbe' ) ||

				($selected_plan == 'starter_plan' && $upload_from_2 == 'comp_from_yoututbe' ) ){  

				if(!empty($entry['20']) && isset($entry['20']) ){

					$vArray[1]['url'] = $entry['20'];

					$vArray[1]['media_from'] = $upload_from_2 ;

				}

			}else if(($selected_plan == 'pre_pack' && $upload_from_2 == 'comp_from_soundcloud' ) ||

				($selected_plan == 'standard_plan' && $upload_from_2 == 'comp_from_soundcloud' ) ||

				($selected_plan == 'starter_plan' && $upload_from_2 == 'comp_from_soundcloud' ) ){  

				if(!empty($entry['22']) && isset($entry['22']) ){

					$vArray[1]['url'] = $entry['22'];

					$vArray[1]['media_from'] = $upload_from_2 ;

				}

			} else if(($selected_plan == 'pre_pack' && $upload_from_2 == 'comp_spotify' ) ||

				($selected_plan == 'standard_plan' && $upload_from_2 == 'comp_spotify' ) ||

				($selected_plan == 'starter_plan' && $upload_from_2 == 'comp_spotify' ) ){  

				if(!empty($entry['24']) && isset($entry['24']) ){

					$vArray[1]['url'] = $entry['24'];

					$vArray[1]['media_from'] = $upload_from_2 ;

				}

			}



			// if(($selected_plan == 'pre_pack' && $upload_from_3 == 'comp_from_computer' && $is_file_uploaded3) ||

			// 	($selected_plan == 'standard_plan' && $upload_from_3 == 'comp_from_computer' && $is_file_uploaded3) ||

			// 	($selected_plan == 'starter_plan' && $upload_from_3 == 'comp_from_computer' && $is_file_uploaded3) ){   

			// 	if($is_file_uploaded3 == 1){

			// 		$jsonData = stripslashes(html_entity_decode(  $entry[ 19 ]  )); 

			// 		$jsonArray = json_decode( $jsonData, true );   

			// 		$video =  $jsonArray[0];   

			// 		$vArray[2]['url'] = $video;

			// 		$vArray[2]['media_from'] = $upload_from_3 ;

			// 	} 

			// }else 

			if(($selected_plan == 'pre_pack' && $upload_from_3 == 'comp_from_yoututbe' ) ||

				($selected_plan == 'standard_plan' && $upload_from_3 == 'comp_from_yoututbe' ) ||

				($selected_plan == 'starter_plan' && $upload_from_3 == 'comp_from_yoututbe' ) ){  

				if(!empty($entry['21']) && isset($entry['21']) ){

					$vArray[2]['url'] = $entry['21'];

					$vArray[2]['media_from'] = $upload_from_3 ;

				}

			} else if(($selected_plan == 'pre_pack' && $upload_from_3 == 'comp_from_soundcloud' ) ||

				($selected_plan == 'standard_plan' && $upload_from_3 == 'comp_from_soundcloud' ) ||

				($selected_plan == 'starter_plan' && $upload_from_3 == 'comp_from_soundcloud' ) ){  

				if(!empty($entry['23']) && isset($entry['23']) ){

					$vArray[2]['url'] = $entry['23'];

					$vArray[2]['media_from'] = $upload_from_3 ;

				}

			} else if(($selected_plan == 'pre_pack' && $upload_from_3 == 'comp_spotify' ) ||

				($selected_plan == 'standard_plan' && $upload_from_3 == 'comp_spotify' ) ||

				($selected_plan == 'starter_plan' && $upload_from_3 == 'comp_spotify' ) ){  

				if(!empty($entry['25']) && isset($entry['25']) ){

					$vArray[2]['url'] = $entry['25'];

					$vArray[2]['media_from'] = $upload_from_3 ;

				}

			} 

		} else {

			// if(  $upload_from_1 == 'comp_from_computer' && $is_file_uploaded1  ){   

			// 	if($is_file_uploaded1 == 1){

			// 		$jsonData = stripslashes(html_entity_decode(  $entry[ 8 ]  )); 

			// 		$jsonArray = json_decode( $jsonData, true );   

			// 		$video =  $jsonArray[0];  

			// 		$vArray[0]['url'] = $video ;

			// 		$vArray[0]['media_from'] = $upload_from_1 ;

			// 	}

			// }else

			if( $upload_from_1 == 'comp_from_yoututbe' ){  

				if(!empty($entry['12']) && isset($entry['12']) ){

					$vArray[0]['url'] = $entry['12'];

					$vArray[0]['media_from'] = $upload_from_1 ;

				}

			}else if( $upload_from_1 == 'comp_from_soundcloud' ){  

				if(!empty($entry['13']) && isset($entry['13']) ){

					$vArray[0]['url'] = $entry['13'];

					$vArray[0]['media_from'] = $upload_from_1 ;

				}

			} else if( $upload_from_1 == 'comp_spotify' ){  

				if(!empty($entry['14']) && isset($entry['14']) ){

					$vArray[0]['url'] = $entry['14'];

					$vArray[0]['media_from'] = $upload_from_1 ;

				}

			}

		}

		

		foreach($vArray as $key => $value){ 

				//  echo 'I = '.  $i .'Key = ' . $key;

			// $dir = GFFormsModel::get_file_upload_path( 6, 'PLACEHOLDER' );

			// $dir['path'] = dirname( $dir['path'] );

			// $dir['url']  = dirname( $dir['url'] );   

		 

			// $path_parts = pathinfo($value['url'] );                      

			// $ffmpegpath = '';

			// $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 

			// if (strpos($link, 'localweb') !== false) {

			// 	$ffmpegpath = "C:/FFmpeg/bin/ffmpeg.exe"; 

			// }else{

			// 	$ffmpegpath = "/usr/bin/ffmpeg";    

			// } 

			// $img_path  =  $dir['path'] .'/'.$path_parts['filename'].'.jpg';

			$video_url = $value['url'];

			// $cmd =  $ffmpegpath .' -ss 00:00:15 -i '. $video_url .' -vf scale=800:-1 -vframes 1 ' . $img_path;

			// @exec($cmd, $output, $retval); 

			

			$arr = array();

			$userId = get_current_user_id();

			

			$cvideo_args = array(

				'post_title' => 'Competition Video' , 

				'post_status' => 'publish',

				'post_type' => 'competition_video',

				'comment_status' => 'open',

			);   

			$video_id = wp_insert_post( $cvideo_args );  

			update_post_meta( $video_id, "musicMedia_from", $value['media_from'] );

			update_post_meta( $video_id, "musicMedia_url", $video_url ); 

			update_post_meta( $video_id, 'compVideo_from_competition', $post_id );  

			update_post_meta( $video_id, 'compVideo_user', $userId );   

			

			update_post_meta( $video_id, "gf_entry_id", $entry['id'] );

			update_post_meta( $video_id, "post_total_points", 0 );

			update_post_meta( $video_id, "post_likes_count", 0 );

			update_post_meta( $video_id, "post_dislikes_count", 0 );

			update_post_meta( $video_id, "compVideo_plan_type",  $entry['28'] ); 

			wp_set_post_terms( $video_id, 69, 'competitionvideo_status' );

			$question_arr = array();

			if($freepaidplan == 'free_pack'){ 

				if(!empty($entry['29']) && isset($entry['29']) ){

					$question_arr[0] = $entry['29'];

				}

				if(!empty($entry['30']) && isset($entry['30']) ){

					$question_arr[1] = $entry['30'];

				}

				if(!empty($entry['31']) && isset($entry['31']) ){

					$question_arr[2] = $entry['31'];

				}

				if(!empty($entry['32']) && isset($entry['32']) ){

					$question_arr[3] = $entry['32'];

				}

				if(!empty($entry['33']) && isset($entry['33']) ){

					$question_arr[4] = $entry['33'];

				} 

				update_post_meta( $video_id, "compVideo_freevideo_answers", $question_arr );

			} else{

				update_post_meta( $video_id, "compVideo_selected_plan", $entry['26']  );

				if($key == 0){

					$arr[] = array(    

						'payment_status' => $entry['payment_status'],

						'payment_date' => $entry['payment_date'],

						'payment_amount' => $entry['payment_amount'], 

						'payment_method' => $entry['payment_method'],

						'transaction_id' => $entry['transaction_id']

					) ;  

					update_post_meta( $video_id, 'compVideo_paymentData', $arr );

				}

			} 

			// echo '<pre>';

			// 		print_r($arr);

			// 		echo '</pre>'; 

					//die;

			$args_video  = array( 

				'post_type' => 'competition_video',

				'posts_per_page' => -1,

				'meta_query' => array(

					array(

						'key'     => 'compVideo_from_competition',

						'value'   => $post_id,

						'compare' => '=',

					),

				),  

			);

			$query_video = new WP_Query($args_video);   

			$totalvideos_fromcomp = $query_video->found_posts; 

			update_post_meta( $post_id, "comp_totalvideos",  $totalvideos_fromcomp );

			

			$arrsum = array();

			if($query_video->have_posts()):  

				while ($query_video->have_posts()) : $query_video->the_post();

					$paymentdata = get_post_meta( get_the_ID(), 'compVideo_paymentData', true); 



					if($paymentdata){

						array_push($arrsum, $paymentdata[0]['payment_amount']);

					}                                                     

				endwhile; wp_reset_query();

			endif; 

			$total_videos_prizes = array_sum( $arrsum);

			update_post_meta( $post_id, "comp_totalvideos_prizes",  $total_videos_prizes ); 

			$winnerData = array();

			$winnner_1 = ($total_videos_prizes * 7) / 100;

			$winnner_2 = ($total_videos_prizes * 5.825) / 100;

			$winnner_3 = ($total_videos_prizes * 4.5) / 100;

			$winnner_4 = ($total_videos_prizes * 2.325) / 100;

			$winnner_5 = ($total_videos_prizes * 1.75) / 100;

			$winnner_6 = ($total_videos_prizes * 1.15) / 100;

			$winnner_7 = ($total_videos_prizes * 0.925) / 100;

			$winnner_8 = ($total_videos_prizes * 0.7) / 100;

			$winnner_9 = ($total_videos_prizes * 0.475) / 100;

			$winnner_10 = ($total_videos_prizes * 0.35) / 100;

			$winnerData[0] = $winnner_1;

			$winnerData[1] = $winnner_2;

			$winnerData[2] = $winnner_3;

			$winnerData[3] = $winnner_4;

			$winnerData[4] = $winnner_5;

			$winnerData[5] = $winnner_6;

			$winnerData[6] = $winnner_7;

			$winnerData[7] = $winnner_8;

			$winnerData[8] = $winnner_9;

			$winnerData[9] = $winnner_10;

			update_post_meta( $post_id, "comp_totalvideos_winnersprizes", $winnerData ); 

		}   

	} 

}



function custom_confirmation_edit( $confirmation, $form, $entry, $ajax ) {

	$user_info = wp_get_current_user();  

	$confirmation = array( 'redirect' =>  site_url()."/my-post" );

  

    return $confirmation;

}

add_filter( 'gform_confirmation_4', 'custom_confirmation_edit', 10, 4 );

add_filter( 'gform_confirmation_1', 'custom_confirmation', 10, 4 );

function custom_confirmation( $confirmation, $form, $entry, $ajax ) {

	$user_info = wp_get_current_user();  

	$confirmation = array( 'redirect' =>  site_url()."/members/".$user_info->user_login  );

  

    return $confirmation;

}

 

if( function_exists('acf_add_options_page') ) { 

	acf_add_options_page(array(

		'page_title' 	=> 'Theme General Settings',

		'menu_title'	=> 'Theme Options',

		'menu_slug' 	=> 'theme-general-settings',

		'capability'	=> 'edit_posts', 

	));  

} 

function edit_upload_user_image(){  

	$data = $_REQUEST['image'];   

	$item_id = $_REQUEST['userid'];   

	// $item_id = get_current_user_id();  

	$webcam_avatar = str_replace( array( 'data:image/png;base64,', ' ' ), array( '', '+' ), $data );

	$webcam_avatar = base64_decode( $webcam_avatar );  

	bp_avatar_handle_capture( $webcam_avatar, $item_id );  

	die;

}

add_action('wp_ajax_nopriv_edit_upload_user_image', 'edit_upload_user_image');

add_action('wp_ajax_edit_upload_user_image', 'edit_upload_user_image');





// Change User Profile Image Sizes

define ( 'BP_AVATAR_THUMB_WIDTH', 150 );

define ( 'BP_AVATAR_THUMB_HEIGHT', 150 );

define ( 'BP_AVATAR_FULL_WIDTH', 250 );

define ( 'BP_AVATAR_FULL_HEIGHT', 250 );

 

// Redirect To Loggedin Home Page After user loggedin



function my_login_redirect() {

	$redirect_to = site_url('/home/');

	return $redirect_to;     

} 

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

 

function remove_element(&$array,$value) {

 if(($key = array_search($value,$array)) !== false) {

       unset($array[$key]);

  }    

}

// New Post Like Ajax

/*function like_post_ajax(){    

	$p_id = $_REQUEST['postid'];

	$u_id = $_REQUEST['userid'];

	$postaction = $_REQUEST['postaction'];



	$likes_total = get_post_meta($p_id, 'post_likes_count', true);

	$likesData = get_post_meta($p_id, 'post_likes_data', true); 

	$likes_arr = array();

	$likes_arr[] =  $u_id ;    



	$dislikes_total = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData = get_post_meta($p_id, 'post_dislikes_data', true);

	$dislikes_arr = array();

	$dislikes_arr[] =  $u_id ;   

	// echo '<pre>';

	// print_r( $likesData);

	// echo '<pre>'; 

	//die;

	if($postaction == 'like'){

		if( !$likes_total  || $likes_total  === null || $likes_total  === 0 ){   

			update_post_meta($p_id, 'post_likes_count', 1);  

		}

		if(!empty($likesData) || $likesData != null ){  

			array_push($likesData, $u_id  );  

			if(in_array($u_id, $likesData )){

				$likesData = array_unique($likesData);   

				$likes_total++;  

				update_post_meta($p_id, 'post_likes_count', $likes_total); 

			} 

			update_post_meta($p_id, "post_likes_data", $likesData ); 

		}else{ 

			update_post_meta($p_id, "post_likes_data", $likes_arr); 

		}    

		if(!empty($dislikesData) || $dislikesData != null){   

			if(in_array($u_id, $dislikesData  )){ 

				if($dislikes_total > 0 ){

					remove_element($dislikesData, $u_id);	

					$dislikesData = array_values($dislikesData); 

					update_post_meta($p_id, "post_dislikes_data", $dislikesData ); 

					$dislikes_total--;  

					update_post_meta($p_id, 'post_dislikes_count', $dislikes_total); 	

				}

			}

		}  

	} elseif($postaction == 'unlike'){

		if(!empty($likesData) || $likesData != null  ){   

			if(in_array($u_id, $likesData  )){

				if($likes_total > 0 ){

					remove_element($likesData, $u_id); 

					$likesData = array_values($likesData); 

					update_post_meta($p_id, "post_likes_data", $likesData );  

					$likes_total--;  

					update_post_meta($p_id, 'post_likes_count', $likes_total);		

				}

			}

		}else{ 

			update_post_meta($p_id, "post_likes_data", $likes_arr); 

		} 

	} elseif($postaction == 'dislike'){

		if(!$dislikes_total || $dislikes_total  === null || $dislikes_total === 0  ){   

			update_post_meta($p_id, 'post_dislikes_count', 1);  

		}

		if(!empty($dislikesData) || $dislikesData != null ){  

			array_push($dislikesData, $u_id  );

			if( in_array($u_id, $dislikesData )){ 

				$dislikesData = array_unique($dislikesData);   

				$dislikes_total++;  

				update_post_meta($p_id, 'post_dislikes_count', $dislikes_total);  

			}   

			update_post_meta($p_id, "post_dislikes_data", $dislikesData ); 

		}else{ 

			update_post_meta($p_id, "post_dislikes_data", $dislikes_arr); 

		} 

		  

		if(!empty($likesData) || $likesData != null){   

			if(in_array($u_id, $likesData  )){ 	

				if($likes_total > 0 ){

					remove_element($likesData, $u_id);

					$likesData = array_values($likesData); 

					update_post_meta($p_id, "post_likes_data", $likesData );

					$likes_total--;  

					update_post_meta($p_id, 'post_likes_count', $likes_total);		

				}

			} 

		}  

	} elseif($postaction == 'remove_dislike'){

		if(!empty($dislikesData) || $dislikesData != null ){   

			if(in_array($u_id, $dislikesData )){  

				if($dislikes_total > 0 ){

					remove_element($dislikesData, $u_id);		

					$dislikesData = array_values($dislikesData); 

					update_post_meta($p_id, "post_dislikes_data", $dislikesData );  

					$dislikes_total--;  

					update_post_meta($p_id, 'post_dislikes_count', $dislikes_total);	

				}

			}

		}else{ 

			update_post_meta($p_id, "post_dislikes_data", $dislikes_arr); 

		} 

	}

	 

	$likes_total_updated = get_post_meta($p_id, 'post_likes_count', true);

	$likesData_updated = get_post_meta($p_id, 'post_likes_data', true);

	$dislikes_total_updated = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData_updated = get_post_meta($p_id, 'post_dislikes_data', true); 

	$points = count_total_point($p_id ); 

	$postData = array('like_count' => $likes_total_updated, 

					'like_data' => $likesData_updated, 

					'dislike_count' => $dislikes_total_updated, 

					'dislike_data' => $dislikesData_updated,

					'post_id' => $p_id,

					'points' => $points,

					'postaction' => $postaction 

				); 

	echo json_encode($postData, JSON_FORCE_OBJECT );

	die;

}

*/

function like_post_ajax(){    

	$p_id = $_REQUEST['postid'];

	$u_id = $_REQUEST['userid'];

	$likes_total = get_post_meta($p_id, 'post_likes_count', true);

	$likesData = get_post_meta($p_id, 'post_likes_data', true);



	$likes_arr = array();

	$likes_arr[] =  $u_id ;    



	if( !$likes_total  ||  $likes_total  === null  ){   

		update_post_meta($p_id, 'post_likes_count', 1);  

	}

	if(!empty($likesData) && $likesData != null){  

	 	array_push($likesData, $u_id  );  

		if(in_array($u_id, $likesData )){

			$likesData = array_unique($likesData);   

			$likes_total++;  

			update_post_meta($p_id, 'post_likes_count', $likes_total); 

		} 

		update_post_meta($p_id, "post_likes_data", $likesData ); 

	}else{ 

		update_post_meta($p_id, "post_likes_data", $likes_arr); 

	}   

	$dislikes_total = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData = get_post_meta($p_id, 'post_dislikes_data', true);

	if(!empty($dislikesData)){   

		if(in_array($u_id, $dislikesData  )){

			if (($key = array_search($u_id , $dislikesData)) !== false) {

				unset($dislikesData[$key]); 

			} 		

			$dislikesData = array_values($dislikesData); 

			update_post_meta($p_id, "post_dislikes_data", $dislikesData ); 

			$dislikes_total--;  

			update_post_meta($p_id, 'post_dislikes_count', $dislikes_total); 	

		}

	}  

	

	$likes_total_updated = get_post_meta($p_id, 'post_likes_count', true);

	$likesData_updated = get_post_meta($p_id, 'post_likes_data', true);

	$dislikes_total_updated = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData_updated = get_post_meta($p_id, 'post_dislikes_data', true);



	$posst = get_post($p_id); 

	$points = count_total_point($p_id );

	 

	$postData = array('like_count' => $likes_total_updated, 

					'like_data' => $likesData_updated, 

					'dislike_count' => $dislikes_total_updated, 

					'dislike_data' => $dislikesData_updated,

					'post_id' => $p_id,

					'points' => $points 

				); 

	echo json_encode($postData, JSON_FORCE_OBJECT );

	die;

}

add_action('wp_ajax_nopriv_like_post_ajax', 'like_post_ajax');

add_action('wp_ajax_like_post_ajax', 'like_post_ajax');



function remove_like_post_ajax(){    

	$p_id = $_REQUEST['postid'];

	$u_id = $_REQUEST['userid'];

	$likes_total = get_post_meta($p_id, 'post_likes_count', true);

	$likesData = get_post_meta($p_id, 'post_likes_data', true);

	$likes_arr = array();

	$likes_arr[] =  $u_id ;   

 

	if(!empty($likesData)){   

		if(in_array($u_id, $likesData  )){

			if (($key = array_search($u_id , $likesData)) !== false) {

				unset($likesData[$key]);

				

			} 	

			$likesData = array_values($likesData); 

			update_post_meta($p_id, "post_likes_data", $likesData );  

			$likes_total--;  

			update_post_meta($p_id, 'post_likes_count', $likes_total);		

		}

	}else{ 

		update_post_meta($p_id, "post_likes_data", $likes_arr); 

	} 

	$posst = get_post($p_id); 

	$points = count_total_point($p_id );

	$likes_total_updated = get_post_meta($p_id, 'post_likes_count', true);

	$likesData_updated = get_post_meta($p_id, 'post_likes_data', true); 

	$dislikes_total_updated = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData_updated = get_post_meta($p_id, 'post_dislikes_data', true);

	$postData = array('like_count' => $likes_total_updated, 

					'like_data' => $likesData_updated, 

					'dislike_count' => $dislikes_total_updated, 

					'dislike_data' => $dislikesData_updated,

					'post_id' => $p_id,

					'points' => $points 

				);

	echo json_encode($postData, JSON_FORCE_OBJECT);

	die;

}

add_action('wp_ajax_nopriv_remove_like_post_ajax', 'remove_like_post_ajax');

add_action('wp_ajax_remove_like_post_ajax', 'remove_like_post_ajax');



// Post Dislike Ajax

function dislike_post_ajax(){    

	$p_id = $_REQUEST['postid'];

	$u_id = $_REQUEST['userid'];

	$dislikes_total = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData = get_post_meta($p_id, 'post_dislikes_data', true); 

	$dislikes_arr = array();

	$dislikes_arr[] =  $u_id ;   

	if(!$dislikes_total || $dislikes_total  === null   ){   

		update_post_meta($p_id, 'post_dislikes_count', 1);  

	}

	if(!empty($dislikesData) && $dislikesData != null){  

		array_push($dislikesData, $u_id  );

		if( in_array($u_id, $dislikesData )){ 

			$dislikesData = array_unique($dislikesData);   

			$dislikes_total++;  

			update_post_meta($p_id, 'post_dislikes_count', $dislikes_total);  

		}   

		update_post_meta($p_id, "post_dislikes_data", $dislikesData ); 

	}else{ 

		update_post_meta($p_id, "post_dislikes_data", $dislikes_arr); 

	} 

	 

	$likes_total = get_post_meta($p_id, 'post_likes_count', true);

	$likesData = get_post_meta($p_id, 'post_likes_data', true);

	if(!empty($likesData)){   

		if(in_array($u_id, $likesData  )){

			if (($key = array_search($u_id , $likesData)) !== false) {

				unset($likesData[$key]); 

			}	

			$likesData = array_values($likesData); 

			update_post_meta($p_id, "post_likes_data", $likesData );

			$likes_total--;  

			update_post_meta($p_id, 'post_likes_count', $likes_total);		

		} 

	}  

	$posst = get_post($p_id); 

	$points = count_total_point($p_id );

	$likes_total_updated = get_post_meta($p_id, 'post_likes_count', true);

	$likesData_updated = get_post_meta($p_id, 'post_likes_data', true);

	$dislikes_total_updated = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData_updated = get_post_meta($p_id, 'post_dislikes_data', true);

	$postData = array('like_count' => $likes_total_updated, 

					'like_data' => $likesData_updated, 

					'dislike_count' => $dislikes_total_updated, 

					'dislike_data' => $dislikesData_updated,

					'post_id' => $p_id,

					'points' => $points 

				); 

	echo json_encode($postData, JSON_FORCE_OBJECT);

	die;

}

add_action('wp_ajax_nopriv_dislike_post_ajax', 'dislike_post_ajax');

add_action('wp_ajax_dislike_post_ajax', 'dislike_post_ajax');



function remove_dislike_post_ajax(){      

	$p_id = $_REQUEST['postid'];

	$u_id = $_REQUEST['userid'];

	$dislikes_total = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData = get_post_meta($p_id, 'post_dislikes_data', true);

	$dislikes_arr = array();

	$dislikes_arr[] =  $u_id ;   

	 

	if(!empty($dislikesData)){   

		if(in_array($u_id, $dislikesData )){

			if (($key = array_search($u_id , $dislikesData)) !== false) {

				unset($dislikesData[$key]); 

			} 		

			$dislikesData = array_values($dislikesData); 

			update_post_meta($p_id, "post_dislikes_data", $dislikesData );  

			$dislikes_total--;  

			update_post_meta($p_id, 'post_dislikes_count', $dislikes_total);	

		}

	}else{ 

		update_post_meta($p_id, "post_dislikes_data", $dislikes_arr); 

	} 

	$posst = get_post($p_id); 

	$points = count_total_point($p_id );

	$likes_total_updated = get_post_meta($p_id, 'post_likes_count', true);

	$likesData_updated = get_post_meta($p_id, 'post_likes_data', true);

	$dislikes_total_updated = get_post_meta($p_id, 'post_dislikes_count', true);

	$dislikesData_updated = get_post_meta($p_id, 'post_dislikes_data', true);

	$postData = array('like_count' => $likes_total_updated, 

					'like_data' => $likesData_updated, 

					'dislike_count' => $dislikes_total_updated, 

					'dislike_data' => $dislikesData_updated, 

					'post_id' => $p_id,

					'points' => $points  

				); 

	echo json_encode($postData, JSON_FORCE_OBJECT);

	die;

}

add_action('wp_ajax_nopriv_remove_dislike_post_ajax', 'remove_dislike_post_ajax');

add_action('wp_ajax_remove_dislike_post_ajax', 'remove_dislike_post_ajax');

  

add_filter( 'login_headerurl', 'custom_loginlogo_url' );



function custom_loginlogo_url($url) { 

	return site_url(); 

} 

add_filter("retrieve_password_message", "custom_password_reset", 99, 4);



function custom_password_reset($message, $key, $user_login, $user_data )    {

	$site_name = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

	$message = "";

	$message = "

Someone has requested a password reset for the following account: 



Site Name: ". $site_name ."



If this was a mistake, just ignore this email and nothing will happen.



To reset your password, visit the following address:



".network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login'); 



	return $message; 



}

function wpb_sender_email( $original_email_address ) {

	return 'info@dev.youtrenday.com';

   }

   

// Function to change sender name

function wpb_sender_name( $original_email_from ) {

return 'YouTrenDay';

}



// Hooking up our functions to WordPress filters 

add_filter( 'wp_mail_from', 'wpb_sender_email' );

add_filter( 'wp_mail_from_name', 'wpb_sender_name' );

 

function count_total_point($post_id ){  

 

	$like = get_post_meta($post_id, 'post_likes_count', true); 

	$dislikes = get_post_meta($post_id, 'post_dislikes_count', true);

	$total_likes = $like - $dislikes;

	// $comments = wp_count_comments( $post_id ) ;

	// $comments_total = (  $comments->total_comments ) * 2;

	// $total_points = $comments_total + $total_likes; 

	

	update_post_meta($post_id, "post_total_points", $total_likes); 

	$points = get_post_meta($post_id, "post_total_points", true );  

	return $points ;

} 

function showdata_in_modal_ajax(){    

	$post_id = $_REQUEST['postid']; 
	$user_id = $_REQUEST['userid'];  
	$post = get_post( $post_id );   
	$musicMedia_from = get_post_meta($post_id, 'musicMedia_from', true);   
	$musicMedia_url = get_post_meta($post_id, 'musicMedia_url', true);   
	$media_uploaded_types = wp_check_filetype($musicMedia_url); 
	$media_uploaded_type = $media_uploaded_types['type'];  
	$thumb = ''; 
	if( $musicMedia_from == 'media_system' || $musicMedia_from == 'comp_from_computer' ){

		if(  $media_uploaded_type == 'video/x-ms-asf' ||  

			$media_uploaded_type == 'video/x-ms-wmv' || 

			$media_uploaded_type == 'video/x-ms-wmx' || 

			$media_uploaded_type == 'video/x-ms-wm' || 

			$media_uploaded_type == 'video/avi' || 

			$media_uploaded_type == 'video/divx' || 

			$media_uploaded_type == 'video/x-flv' || 

			$media_uploaded_type == 'video/quicktime' || 

			$media_uploaded_type == 'video/mpeg' || 

			$media_uploaded_type == 'video/mp4' || 

			$media_uploaded_type == 'video/ogg' || 

			$media_uploaded_type == 'video/webm' || 

			$media_uploaded_type == 'video/x-matroska' || 

			$media_uploaded_type == 'video/3gpp' || 

			$media_uploaded_type == 'video/3gpp2' ){  

			$path_parts = pathinfo($musicMedia_url);

			$image = $path_parts['dirname'].'/'.$path_parts['filename'].'.jpg';

			$img_path = $image;   
			$thumb .=   $img_path ;    
		} elseif ($media_uploaded_type == 'audio/mp3' ||  

					$media_uploaded_type == 'audio/mpeg' || 

					$media_uploaded_type == 'audio/aac' || 

					$media_uploaded_type == 'audio/x-realaudio' || 

					$media_uploaded_type == 'audio/wav' ||  

					$media_uploaded_type == 'audio/ogg' || 

					$media_uploaded_type == 'audio/flac' || 

					$media_uploaded_type == 'audio/midi' || 

					$media_uploaded_type == 'audio/x-ms-wma' || 

					$media_uploaded_type == 'audio/x-ms-wax' || 

					$media_uploaded_type == 'audio/x-matroska' ){ 

			$thumb .=  $musicMedia_url ;

		} elseif ( $media_uploaded_type == 'image/jpeg' || 

						$media_uploaded_type == 'image/gif' || 

						$media_uploaded_type == 'image/png' || 

						$media_uploaded_type == 'image/bmp' || 

						$media_uploaded_type == 'image/tiff' || 

						$media_uploaded_type == 'image/x-icon'  ){ 

			$thumb .=  $musicMedia_url  ;

		}

	}elseif( $musicMedia_from == 'youtube' || $musicMedia_from == 'comp_from_yoututbe' ){ 

		preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $musicMedia_url, $match);

		$youtube_id = $match[1]; 

		// $thumb .= 'https://i.ytimg.com/vi/'. $youtube_id .'/maxresdefault.jpg';      
		$thumb .= 'https://img.youtube.com/vi/'. $youtube_id .'/hqdefault.jpg';  

	}elseif( $musicMedia_from == 'soundcloud' || $musicMedia_from == 'comp_from_soundcloud' ){ 

		$thumb .=   get_template_directory_uri(). '/assets/images/logo_soundcloud.png';

	}elseif( $musicMedia_from == 'spotify' ||  $musicMedia_from == 'comp_spotify' ){  
		$thumb .=   get_template_directory_uri(). '/assets/images/logo-spotify.png';

	}elseif(get_post_type( $post_id ) == 'competition'){

		$thumb .= get_the_post_thumbnail_url($post_id ,'full'); ;

	}

	$arrayData = array();

	$title = $post->post_title;

	$url = get_permalink($post_id);

	$desc = $post->post_content;

	$thumbnail = $thumb;   

	$like     = get_post_meta($post_id, 'post_likes_count', true); 

	$dislikes = get_post_meta($post_id, 'post_dislikes_count', true);

	// 'url' => urlencode($url),

	$postData = array(
					'post_id'=> $post_id,
					'likes'=> $like,
					'dislikes'=> $dislikes, 
					'title' => $title, 
					'url' => urlencode($url),
					'desc' => $desc, 
					'media_type' => $musicMedia_from, 
					'thumbnail' => $thumbnail 
				);  
	// $shortcode = do_shortcode('[miniorange_social_sharing shape="square" heading="Share with" color="#000000" fontcolor="blue" theme="customFont" space="14" size="30" url="'. $url .'"]');
	// $postData = array(  'data_posts' => $shortcode  );   
	
	echo json_encode($postData); 

	die;	

}  

add_action('wp_ajax_nopriv_showdata_in_modal_ajax', 'showdata_in_modal_ajax');

add_action('wp_ajax_showdata_in_modal_ajax', 'showdata_in_modal_ajax');

 

 

// Remove Forum Breadcrumb

function bm_bbp_no_breadcrumb ($param) { 

	return true; 

} 

add_filter ('bbp_no_breadcrumb', 'bm_bbp_no_breadcrumb');



add_post_type_support('forum', array('thumbnail')); 

 

// Remove Unneccessary Links form topics list

function change_reply_admin_links ($r) {

	$r['links'] = apply_filters( 'rw_reply_admin_links', array(

					'edit'  => bbp_get_reply_edit_link ( $r ),

					'reply'   => bbp_get_reply_to_link ( $r )

				), $r['id'] );

	return $r['links'] ;

}

add_filter ('bbp_reply_admin_links', 'change_reply_admin_links' ) ;



function change_topic_admin_links ($r) {

	$r['links'] = apply_filters( 'rw_topic_admin_links', array(

					'edit'  => bbp_get_topic_edit_link ( $r ),

					'reply'   => bbp_get_topic_reply_link ( $r )

				), $r['id'] );

	return $r['links'] ;

}

add_filter ('bbp_topic_admin_links', 'change_topic_admin_links' ) ;

 

add_action('save_post', 'custom_save_post');

function  custom_save_post( $post_id ) { 

	if(get_post_type($post_id) == 'competition'){ 

		$comp_start_date = get_field('comp_start_date', $post_id);		

		$comp_end_date = date('Y-m-d H:i:s', strtotime($comp_start_date. ' + 4 days')); 

		$comp_voting_date = date('Y-m-d H:i:s', strtotime($comp_end_date. ' + 3 days')); 

		update_field('comp_end_date', $comp_end_date); 

		update_field('comp_voting_date', $comp_voting_date);  

		$today_date = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) ); 

		if($comp_start_date > $today_date){

			// echo 'future'; 

			wp_set_post_terms( $post_id, 65, 'competition_status' );

			wp_remove_object_terms( $post_id, array('running', 'expired','voting'), 'competition_status' ); 

		}

		if( ( $comp_start_date <  $today_date) && ($comp_end_date  >  $today_date) ){ 

			// echo 'running';

			wp_set_post_terms( $post_id, 66, 'competition_status' );

			wp_remove_object_terms( $post_id, array('future', 'expired','voting'), 'competition_status' ); 

		} 

		if( ( $comp_end_date < $today_date) && ($comp_voting_date  >  $comp_end_date) ){ 

				// echo 'running';

			wp_set_post_terms( $post_id, 68, 'competition_status' );

			wp_remove_object_terms( $post_id, array('future', 'running', 'expired'), 'competition_status' ); 

		} 

		if($comp_voting_date < $today_date  ){

			// echo 'expired';

			wp_set_post_terms( $post_id, 67, 'competition_status' );

			wp_remove_object_terms( $post_id, array('future', 'running','voting'), 'competition_status' ); 

		}  

	} 

} 

// Registering custom post status

function wpb_custom_post_status(){  

	$args_comp = array( 

		'post_type' => 'competition',

		'posts_per_page' => -1  

	);

	$query_comp = new WP_Query($args_comp); 

	if($query_comp->have_posts()):  

		$i = 0;    

		while ($query_comp->have_posts()) : $query_comp->the_post();

			global $post;

			$competition = $post;  

			custom_save_post($post->ID);  

			$total_videos_prizes = get_post_meta( $post->ID, "comp_totalvideos_prizes", true); 

			if($total_videos_prizes){

				$winnerData = array();

				$winnner_1 = ($total_videos_prizes * 7) / 100;

				$winnner_2 = ($total_videos_prizes * 5.825) / 100;

				$winnner_3 = ($total_videos_prizes * 4.5) / 100;

				$winnner_4 = ($total_videos_prizes * 2.325) / 100;

				$winnner_5 = ($total_videos_prizes * 1.75) / 100;

				$winnner_6 = ($total_videos_prizes * 1.15) / 100;

				$winnner_7 = ($total_videos_prizes * 0.925) / 100;

				$winnner_8 = ($total_videos_prizes * 0.7) / 100;

				$winnner_9 = ($total_videos_prizes * 0.475) / 100;

				$winnner_10 = ($total_videos_prizes * 0.35) / 100;

				$winnerData[0] = $winnner_1;

				$winnerData[1] = $winnner_2;

				$winnerData[2] = $winnner_3;

				$winnerData[3] = $winnner_4;

				$winnerData[4] = $winnner_5;

				$winnerData[5] = $winnner_6;

				$winnerData[6] = $winnner_7;

				$winnerData[7] = $winnner_8;

				$winnerData[8] = $winnner_9;

				$winnerData[9] = $winnner_10;



				update_post_meta( $post->ID, "comp_totalvideos_winnersprizes", $winnerData ); 

			}

			$args_compvideo = array( 

				'post_type' => 'competition_video',

				'posts_per_page' => -1,

				'meta_query' => array(

					array(

						'key'     => 'compVideo_from_competition',

						'value'   => $post->ID,

						'compare' => '=',

					),

				),  

			);



			$query_compvideo = new WP_Query($args_compvideo); 

			if($query_compvideo->have_posts()):  

				$i = 0;    

				while ($query_compvideo->have_posts()) : $query_compvideo->the_post();

				global $post;

					$comp_start_date = get_field('comp_start_date', $competition->ID);		

					$comp_end_date = get_field('comp_end_date', $competition->ID);		

					$comp_voting_date = get_field('comp_voting_date', $competition->ID);	 

					$today_date = date( 'Y-m-d H:i:s', current_time( 'timestamp', 0 ) );  

					$comp_status= wp_get_post_terms($competition->ID, 'competition_status', array( 'fields' => 'names' ) );

					 

					if($comp_status[0]  == 'Future' || $comp_status[0] == 'Running'){

						// echo 'future'; 

						wp_set_post_terms( get_the_ID(), 69, 'competitionvideo_status' );

						wp_remove_object_terms( get_the_ID(), array('voting', 'expired'), 'competitionvideo_status' ); 

					}

					if( $comp_status[0] == 'Voting' ){ 

						// echo 'running';

						wp_set_post_terms(get_the_ID(), 70, 'competitionvideo_status' );

						wp_remove_object_terms(get_the_ID(), array('not-started', 'expired'), 'competitionvideo_status' ); 

					} 

					if( $comp_status[0] == 'Expired'){

						// echo 'expired';

						wp_set_post_terms( get_the_ID(), 71, 'competitionvideo_status' );

						wp_remove_object_terms( get_the_ID(), array('not-started', 'voting'), 'competitionvideo_status' ); 

					}  

				 

				endwhile;  

			endif;    

		endwhile; 

	endif;    

}

add_action( 'init', 'wpb_custom_post_status' );

	 

//Infinite Scroll

function wp_videos_load(){ 

	$offset = $_POST['offset'];

	$paged = $_POST['page_no']; 

	$arg = array(

		'post_type'  => 'competition_video',   

		'posts_per_page' => 2,  

		'offset' => $offset,

		'post_status' => 'publish',

		'order'   => 'DESC',

		'orderby' => 'ID', 

		'tax_query' => array( 

			array(

				'taxonomy' => 'competitionvideo_status',

				'field'    => 'slug',

				'terms'    => 'voting', 

			),

		),

	);

	$query = new WP_Query($arg);  

	$arr = array();

	$data = array();

	 if ($query->have_posts()) : 

		while ($query->have_posts()) : $query->the_post();  

			$data[] = array('media'=> show_home_postsdata( get_the_ID()) , 

						'postid'=> get_the_ID() );

		 endwhile;  

	endif;   

	$arr['result'] = $data; 

	echo json_encode($arr, JSON_FORCE_OBJECT); 

	exit;

}

add_action('wp_ajax_infinite_scroll_videos', 'wp_videos_load'); // for logged in user

add_action('wp_ajax_nopriv_infinite_scroll_videos', 'wp_videos_load');



function wp_allposts_load(){ 

	$offset = $_POST['offset']; 

	$arg = array(

		'post_type' => array('music', 'competition'),  

		'posts_per_page' => 2,  

		'offset' => $offset,

		'post_status' => 'publish',

		'order'   => 'DESC',

		'orderby' => 'ID',

		'tax_query' => array(

			'relation' => 'OR',

			array(

				'taxonomy' => 'competition_status',

				'field'    => 'slug',

				'terms'    => 'expired'

			),

			array(

				'taxonomy' => 'music_category', # default post category

				'operator' => 'EXISTS'

			)

		)

	);

	$query = new WP_Query($arg);  

	$arr = array();

	$data = array();

	if ($query->have_posts()) : 

		while ($query->have_posts()) : $query->the_post();  

			$data[] = array('media'=> show_home_postsdata( get_the_ID()) , 

						'postid'=> get_the_ID() );

		endwhile;  

	endif;  

	// echo '<pre>'; 

	// print_r($data);

	// echo '</pre>';

	$arr['result'] = $data; 

	echo json_encode($arr, JSON_FORCE_OBJECT); 

	exit;

}

add_action('wp_ajax_infinite_scroll_allposts', 'wp_allposts_load'); // for logged in user

add_action('wp_ajax_nopriv_infinite_scroll_allposts', 'wp_allposts_load');



// Load Category's Recent and Popular Posts



function wp_recenetposts_load(){ 

	$offset = $_POST['offset'];

	$term_id = $_POST['term_id'];

	$arg = array(  

		'post_type' => 'music', 

		'posts_per_page' => 2, 

		'order'   => 'DESC',

		'orderby' => 'ID',

		'offset' => $offset,

		'post_status' => 'publish',

		'tax_query' => array(

			array(

				'taxonomy' => 'music_category',

				'field'    => 'term_id',

				'terms'    => $term_id ,                                       

			),

		), 

	);

	$query = new WP_Query($arg);  

	$arr = array();

	$data = array();

	 if ($query->have_posts()) : 

		while ($query->have_posts()) : $query->the_post();  

			$data[] = array('media'=> show_home_postsdata( get_the_ID()) , 

						'postid'=> get_the_ID() );

		 endwhile;  

	endif;   

	$arr['result'] = $data; 

	echo json_encode($arr, JSON_FORCE_OBJECT); 

	exit;

}

add_action('wp_ajax_infinite_scroll_recentposts', 'wp_recenetposts_load'); // for logged in user

add_action('wp_ajax_nopriv_infinite_scroll_recentposts', 'wp_recenetposts_load');





function wp_popularposts_load(){ 

	$offset = $_POST['offset'];

	$term_id = $_POST['term_id'];

	$arg = array( 

		'post_type'  => 'music',

		'order'  => 'DESC',  

		'offset' => $offset,

		'posts_per_page'  => 2,  

		'meta_key' => 'post_total_points',

		'orderby' => 'meta_value_num', 

		'post_status' => 'publish', 

		'tax_query' => array(

			array(

				'taxonomy' => 'music_category',

				'field'    => 'term_id',

				'terms'    => $term_id ,                                       

			),

		), 

		'meta_query' => array(

			array(

				'key'     => 'post_total_points',

				'value'   => 0,

				'type'    => 'numeric',

				'compare' => '>',

			),

		), 

	);

	$query = new WP_Query($arg);  

	$arr = array();

	$data = array();

	 if ($query->have_posts()) : 

		while ($query->have_posts()) : $query->the_post();  

			$data[] = array('media'=> show_home_postsdata( get_the_ID()) , 

						'postid'=> get_the_ID() );

		 endwhile;  

	endif;   

	$arr['result'] = $data; 

	echo json_encode($arr, JSON_FORCE_OBJECT); 

	exit;

}

add_action('wp_ajax_infinite_scroll_popularposts', 'wp_popularposts_load'); // for logged in user

add_action('wp_ajax_nopriv_infinite_scroll_popularposts', 'wp_popularposts_load');





// function action_xprofile_data_before_save( $array ) { 

// 	$userid = $array->user_id; 

// 	$user_data = wp_update_user( array( 'ID' => $userid, 'user_email' => $_POST['email'] ) );

// 	// if($user_roles == 'administrator'){ 

// 	// 	update_option('admin_email', $_POST['email']);

// 	// }  

// };  

// add_action( 'xprofile_data_before_save', 'action_xprofile_data_before_save', 10, 1 );

function change_password_form() { ?>

	 

        <label for="current_password">Enter your current password:</label>

        <input id="current_password" type="password" name="current_password" title="current_password" placeholder="" required>

        <label for="new_password">New password:</label>

        <input id="new_password" type="password" name="new_password" title="new_password" placeholder="" required>

        <label for="confirm_new_password">Confirm new password:</label>

        <input id="confirm_new_password" type="password" name="confirm_new_password" title="confirm_new_password" placeholder="" required>

        <!-- <input type="submit" value="Change Password"> -->

     

<?php }



function change_password(){

	

	if(isset($_POST['current_password'])){

		$_POST = array_map('stripslashes_deep', $_POST);

		$current_password = sanitize_text_field($_POST['current_password']);

		$new_password = sanitize_text_field($_POST['new_password']);

		$confirm_new_password = sanitize_text_field($_POST['confirm_new_password']);

		$user_id = get_current_user_id();

		$errors = array();

		$current_user = get_user_by('id', $user_id);

		// Check for errors

		if (empty($current_password) && empty($new_password) && empty($confirm_new_password) ) {

		$errors[] = 'All fields are required';

		}

		if($current_user && wp_check_password($current_password, $current_user->data->user_pass, $current_user->ID)){

		//match

		} else {

			$errors[] = 'Password is incorrect';

		}

		if($new_password != $confirm_new_password){

			$errors[] = 'Password does not match';

		}

		if(strlen($new_password) < 6){

			$errors[] = 'Password is too short, minimum of 6 characters';

		}

		if(empty($errors)){

			wp_set_password( $new_password, $current_user->ID );

			echo '<h4>Password successfully changed!</h4>';

			 

		} else {  

			echo '<div class="custom_wp_errors">';

		    	// Loop error codes and display errors

				foreach($errors as $error){ 

					echo '<span class="error"> ' . $error . '</span><br/>';

				}

			echo '</div>';

		}



    }

}



function cp_form_shortcode(){

	    change_password();

        change_password_form();

}

add_shortcode('changepassword_form', 'cp_form_shortcode');



if(is_user_logged_in() && !empty($_POST['edit_delete_account']) && isset($_POST['edit_delete_account'])) {

	$user = wp_get_current_user();

	if (!in_array( 'administrator', (array) $user->roles ) ) {

		add_action('init', 'remove_logged_in_user'); 

	} 

} 

function remove_logged_in_user() {

    require_once(ABSPATH.'wp-admin/includes/user.php' );

    $current_user = wp_get_current_user();

	wp_delete_user( $current_user->ID );

	wp_redirect( home_url('/') );

    exit;

}

 

function edit_upload_user_custom(){  

	if(is_user_logged_in() && !empty($_POST['profile-group-edit-submit']) && isset($_POST['profile-group-edit-submit'])) {

		$userID = $_POST['edi_user_id'] ; 

		$f_name = $_POST['field_1'];

		$l_name = $_POST['field_13'];

		$phone = $_POST['field_40'];

		xprofile_set_field_data( 1, $userID, $f_name );

		xprofile_set_field_data( 13, $userID, $l_name );

		xprofile_set_field_data( 40, $userID, $phone );

	}

	if(is_user_logged_in() && !empty($_POST['profile-about-edit-submit']) && isset($_POST['profile-about-edit-submit'])) {

		$userID = $_POST['editabout_user_id'] ; 

		$f_name = $_POST['field_20']; 

		xprofile_set_field_data( 20, $userID, $f_name ); 

	}

}

add_action('init', 'edit_upload_user_custom');



function trend_leader_data($do_not_duplicate){ 

	foreach($do_not_duplicate as $key => $value){ 

		$args_posts = array( 

			'post_type' => array('music', 'competition_video' ),   
			'meta_key' => 'post_total_points',
			'orderby' => 'meta_value_num',
			'posts_per_page' => -1,  
			'post_status' => 'publish',   
			'author' => $value
		);

		$total_points_sum = array();

		$query_posts = new WP_Query($args_posts); 

		$sum_arr = array();

		$arra_points = array();

		$total_sum = '';

		if($query_posts->have_posts()):  

			while ($query_posts->have_posts()) : $query_posts->the_post(); 

				$author_id = $post->post_author;  

				$author_obj = get_user_by('id', $author_id);

				$total_points = get_post_meta(get_the_ID(), "post_total_points", true); 

				$trends_point = 0;

				if( $total_points){

					$total_points = $total_points;

				}  

				$arra_points[] =  $total_points;

				$sum_arr[0] =  $total_points; 

				$sum_arr[1] =  $value; 

				$total_sum = array_sum($arra_points  ) ;

					

			endwhile;  

		endif;  

		$total_points_sum['total_points']  =  $total_sum ;

		$total_points_sum['userid']   = $value ; 

		$arra_users[] =  $total_points_sum;  

	} 

	foreach ($arra_users as $key => $row) {

		$total_points1[$key]  = $row['total_points'];

		$userid1[$key] = $row['userid'];

	} 

	$total_points1  = array_column($arra_users, 'total_points');

	$userid1 = array_column($arra_users, 'userid'); 

	array_multisort($total_points1, SORT_DESC, $userid1, SORT_ASC, $arra_users) ;

	//  echo '<pre>';

	// print_r(  $arra_users );

	// echo '</pre>'; 

	// die;

	return  $arra_users ;

}