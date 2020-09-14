<?php
/**
 * Register a custom post type called "testimonial, Muusic, Blog". 
 */
function resgister_custom_postTypes_taxonomies() {
	// For Testimonial
    $labels_testimonial = array(
        'name'                  => _x( 'Testimonials', 'Post type general name', 'youtrenday' ),
        'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'youtrenday' ),
        'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'youtrenday' ),
        'name_admin_bar'        => _x( 'Testimonial', 'Add New on Toolbar', 'youtrenday' ),
        'add_new'               => __( 'Add New', 'youtrenday' ),
        'add_new_item'          => __( 'Add New Testimonial', 'youtrenday' ),
        'new_item'              => __( 'New Testimonial', 'youtrenday' ),
        'edit_item'             => __( 'Edit Testimonial', 'youtrenday' ),
        'view_item'             => __( 'View Testimonial', 'youtrenday' ),
        'all_items'             => __( 'All Testimonials', 'youtrenday' ),
        'search_items'          => __( 'Search Testimonials', 'youtrenday' ),
        'parent_item_colon'     => __( 'Parent Testimonials', 'youtrenday' ),
        'not_found'             => __( 'No testimonials found.', 'youtrenday' ),
        'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'youtrenday' ),
        'featured_image'        => _x( 'Testimonial Author Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'set_featured_image'    => _x( 'Set Author image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'remove_featured_image' => _x( 'Remove Author image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'use_featured_image'    => _x( 'Use as Author image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
    ); 
    $args_testimonial = array(
        'labels'             => $labels_testimonial,
        'public'             => true, 
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonial' ),
        'capability_type'    => 'post', 
		'menu_position'      => null, 
		'menu_icon'           => 'dashicons-testimonial',
        'supports'           =>  array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments'),
	); 
	// For Music
	$labels_music = array(
        'name'                  => _x( 'Musics', 'Post type general name', 'youtrenday' ),
        'singular_name'         => _x( 'Music', 'Post type singular name', 'youtrenday' ),
        'menu_name'             => _x( 'Musics', 'Admin Menu text', 'youtrenday' ),
        'name_admin_bar'        => _x( 'Music', 'Add New on Toolbar', 'youtrenday' ),
        'add_new'               => __( 'Add New', 'youtrenday' ),
        'add_new_item'          => __( 'Add New Music', 'youtrenday' ),
        'new_item'              => __( 'New Music', 'youtrenday' ),
        'edit_item'             => __( 'Edit Music', 'youtrenday' ),
        'view_item'             => __( 'View Music', 'youtrenday' ),
        'all_items'             => __( 'All Musics', 'youtrenday' ),
        'search_items'          => __( 'Search Musics', 'youtrenday' ),
        'parent_item_colon'     => __( 'Parent Musics', 'youtrenday' ),
        'not_found'             => __( 'No Musics found.', 'youtrenday' ),
        'not_found_in_trash'    => __( 'No Musics found in Trash.', 'youtrenday' ),
        'featured_image'        => _x( 'Music Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'set_featured_image'    => _x( 'Set Music image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'remove_featured_image' => _x( 'Remove Music image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'use_featured_image'    => _x( 'Use as Music image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
    ); 
    $args_music = array(
        'labels'             => $labels_music,
        'public'             => true, 
        'show_in_menu'       => true,
        'query_var'          => true,
        // 'rewrite'            => array( 'slug' => 'music' ),
        'capability_type'    => 'post', 
		'menu_position'      => null, 		
		'has_archive' => true,
		'menu_icon'           => 'dashicons-playlist-audio',
        'supports'           =>  array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments'),
	);
	
	// Add Music Category taxonomy
	$labels_music_tax = array(
		'name'                       => _x( 'Music Categories', 'taxonomy general name', 'youtrenday' ),
		'singular_name'              => _x( 'Music Category', 'taxonomy singular name', 'youtrenday' ),
		'search_items'               => __( 'Search Music Categories', 'youtrenday' ),
		'popular_items'              => __( 'Popular Music Categories', 'youtrenday' ),
		'all_items'                  => __( 'All Music Categories', 'youtrenday' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Music Category', 'youtrenday' ),
		'update_item'                => __( 'Update Music Category', 'youtrenday' ),
		'add_new_item'               => __( 'Add New Music Category', 'youtrenday' ),
		'new_item_name'              => __( 'New Music Category Name', 'youtrenday' ),
		'separate_items_with_commas' => __( 'Separate Music Categories with commas', 'youtrenday' ),
		'add_or_remove_items'        => __( 'Add or remove Music Categories', 'youtrenday' ),
		'choose_from_most_used'      => __( 'Choose from the most used Music Categories', 'youtrenday' ),
		'not_found'                  => __( 'No Music Categories found.', 'youtrenday' ),
		'menu_name'                  => __( 'Music Categories', 'youtrenday' ),
	); 
	
	$args_music_tax = array(
		'hierarchical'          => true,
		'labels'                => $labels_music_tax,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'music_category' ),
	); 
	 
	// For Blog
	$labels_blog = array(
        'name'                  => _x( 'Blogs', 'Post type general name', 'youtrenday' ),
        'singular_name'         => _x( 'Blog', 'Post type singular name', 'youtrenday' ),
        'menu_name'             => _x( 'Blogs', 'Admin Menu text', 'youtrenday' ),
        'name_admin_bar'        => _x( 'Blog', 'Add New on Toolbar', 'youtrenday' ),
        'add_new'               => __( 'Add New', 'youtrenday' ),
        'add_new_item'          => __( 'Add New Blog', 'youtrenday' ),
        'new_item'              => __( 'New Blog', 'youtrenday' ),
        'edit_item'             => __( 'Edit Blog', 'youtrenday' ),
        'view_item'             => __( 'View Blog', 'youtrenday' ),
        'all_items'             => __( 'All Blogs', 'youtrenday' ),
        'search_items'          => __( 'Search Blogs', 'youtrenday' ),
        'parent_item_colon'     => __( 'Parent Blogs', 'youtrenday' ),
        'not_found'             => __( 'No Blogs found.', 'youtrenday' ),
        'not_found_in_trash'    => __( 'No Blogs found in Trash.', 'youtrenday' ),
        'featured_image'        => _x( 'Blog Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'set_featured_image'    => _x( 'Set Blog image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'remove_featured_image' => _x( 'Remove Blog image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'use_featured_image'    => _x( 'Use as Blog image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
     
	);  
    $args_blog = array(
        'labels'             => $labels_blog,
		'public'             => true, 
		'show_ui'             => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'blog'),
        'capability_type'    => 'post', 
		'menu_position'      => null, 
		'with_front'         => true,
		'menu_icon'           => 'dashicons-welcome-write-blog',
        'supports'           =>  array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments'),
		'taxonomies'         => array( 'blog_category' ),
	);
	// Add Blog taxonomy
	$labels_blog_tax = array(
		'name'                       => _x( 'Blog Categories', 'taxonomy general name', 'youtrenday' ),
		'singular_name'              => _x( 'Blog Category', 'taxonomy singular name', 'youtrenday' ),
		'search_items'               => __( 'Search Blog Categories', 'youtrenday' ),
		'popular_items'              => __( 'Popular Blog Categories', 'youtrenday' ),
		'all_items'                  => __( 'All Blog Categories', 'youtrenday' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Blog Category', 'youtrenday' ),
		'update_item'                => __( 'Update Blog Category', 'youtrenday' ),
		'add_new_item'               => __( 'Add New Blog Category', 'youtrenday' ),
		'new_item_name'              => __( 'New Blog Category Name', 'youtrenday' ),
		'separate_items_with_commas' => __( 'Separate Blog Categories with commas', 'youtrenday' ),
		'add_or_remove_items'        => __( 'Add or remove Blog Categories', 'youtrenday' ),
		'choose_from_most_used'      => __( 'Choose from the most used Blog Categories', 'youtrenday' ),
		'not_found'                  => __( 'No Blog Categories found.', 'youtrenday' ),
		'menu_name'                  => __( 'Blog Categories', 'youtrenday' ),
	); 
	$args_blog_tax = array(
		'hierarchical'          => true,
		'labels'                => $labels_blog_tax,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'blog_category' ),
    );
    // For Competition
	$labels_competition = array(
        'name'                  => _x( 'Competitions', 'Post type general name', 'youtrenday' ),
        'singular_name'         => _x( 'Competition', 'Post type singular name', 'youtrenday' ),
        'menu_name'             => _x( 'Competitions', 'Admin Menu text', 'youtrenday' ),
        'name_admin_bar'        => _x( 'Competition', 'Add New on Toolbar', 'youtrenday' ),
        'add_new'               => __( 'Add New', 'youtrenday' ),
        'add_new_item'          => __( 'Add New Competition', 'youtrenday' ),
        'new_item'              => __( 'New Competition', 'youtrenday' ),
        'edit_item'             => __( 'Edit Competition', 'youtrenday' ),
        'view_item'             => __( 'View Competition', 'youtrenday' ),
        'all_items'             => __( 'All Competitions', 'youtrenday' ),
        'search_items'          => __( 'Search Competitions', 'youtrenday' ),
        'parent_item_colon'     => __( 'Parent Competitions', 'youtrenday' ),
        'not_found'             => __( 'No Competitions found.', 'youtrenday' ),
        'not_found_in_trash'    => __( 'No Competitions found in Trash.', 'youtrenday' ),
        'featured_image'        => _x( 'Competition Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'set_featured_image'    => _x( 'Set Competition image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'remove_featured_image' => _x( 'Remove Competition image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'use_featured_image'    => _x( 'Use as Competition image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
     
	);  
    $args_competition = array(
        'labels'             => $labels_competition,
		'public'             => true, 
		'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'competition'),
        'capability_type'    => 'post', 
		'menu_position'      => null, 
		'with_front'         => true, 
        'supports'           =>  array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'), 
        'taxonomies'         => array( 'competition_status' ),
    ); 
   
    // For Paid Videos
	$labels_competitionVideos = array(
        'name'                  => _x( 'Competition Videos', 'Post type general name', 'youtrenday' ),
        'singular_name'         => _x( 'Competition Video', 'Post type singular name', 'youtrenday' ),
        'menu_name'             => _x( 'Competition Videos', 'Admin Menu text', 'youtrenday' ),
        'name_admin_bar'        => _x( 'Competition Video', 'Add New on Toolbar', 'youtrenday' ),
        'add_new'               => __( 'Add New', 'youtrenday' ),
        'add_new_item'          => __( 'Add New Competition Video', 'youtrenday' ),
        'new_item'              => __( 'New Competition Video', 'youtrenday' ),
        'edit_item'             => __( 'Edit Competition Video', 'youtrenday' ),
        'view_item'             => __( 'View Competition Video', 'youtrenday' ),
        'all_items'             => __( 'All Competition Videos', 'youtrenday' ),
        'search_items'          => __( 'Search Competition Videos', 'youtrenday' ),
        'parent_item_colon'     => __( 'Parent Competition Videos', 'youtrenday' ),
        'not_found'             => __( 'No Competition Videos found.', 'youtrenday' ),
        'not_found_in_trash'    => __( 'No Competition Videos found in Trash.', 'youtrenday' ),
        'featured_image'        => _x( 'Competition Video Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'set_featured_image'    => _x( 'Set Competition Video image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'remove_featured_image' => _x( 'Remove Competition Video image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
        'use_featured_image'    => _x( 'Use as Competition Video image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'youtrenday' ),
     
	);  
    $args_competitionVideos = array(
        'labels'             => $labels_competitionVideos,
		'public'             => true, 
		'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'competition_video'),
        'capability_type'    => 'post', 
		// 'menu_position'      => null, 
        'with_front'         => true, 
        'show_in_nav_menus'  => true,
        'supports'           =>  array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'comments'), 
        'taxonomies'         => array( 'competition_status' ),
    ); 
    // For Faq
	$labels_faq = array(
        'name'                  => _x( 'FAQs', 'Post type general name', 'youtrenday' ),
        'singular_name'         => _x( 'FAQ', 'Post type singular name', 'youtrenday' ),
        'menu_name'             => _x( 'FAQ', 'Admin Menu text', 'youtrenday' ),
        'name_admin_bar'        => _x( 'FAQ', 'Add New on Toolbar', 'youtrenday' ),
        'add_new'               => __( 'Add New', 'youtrenday' ),
        'add_new_item'          => __( 'Add New FAQ', 'youtrenday' ),
        'new_item'              => __( 'New FAQ', 'youtrenday' ),
        'edit_item'             => __( 'Edit FAQ', 'youtrenday' ),
        'view_item'             => __( 'View FAQ', 'youtrenday' ),
        'all_items'             => __( 'All FAQs', 'youtrenday' ),
        'search_items'          => __( 'Search FAQs', 'youtrenday' ),
        'parent_item_colon'     => __( 'Parent FAQs', 'youtrenday' ),
        'not_found'             => __( 'No FAQs found.', 'youtrenday' ),
        'not_found_in_trash'    => __( 'No FAQs found in Trash.', 'youtrenday' ), 
     
	);  
    $args_faq = array(
        'labels'             => $labels_faq,
		'public'             => false, 
		'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'faq'),
        'capability_type'    => 'post', 
		// 'menu_position'      => null, 
        'with_front'         => false, 
        'show_in_nav_menus'  => true,
        'supports'           =>  array('title', 'editor'), 
    );

    // Taxonomy For Competition Status
    $labels_comp_status = array(
		'name'                       => _x( 'Competition Status', 'taxonomy general name', 'youtrenday' ),
		'singular_name'              => _x( 'Competition Status', 'taxonomy singular name', 'youtrenday' ),
		'search_items'               => __( 'Search Competition Status', 'youtrenday' ),
		'popular_items'              => __( 'Popular Competition Status', 'youtrenday' ),
		'all_items'                  => __( 'All Competition Status', 'youtrenday' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Competition Status', 'youtrenday' ),
		'update_item'                => __( 'Update Competition Status', 'youtrenday' ),
		'add_new_item'               => __( 'Add New Competition Status', 'youtrenday' ),
		'new_item_name'              => __( 'New Competition Status Name', 'youtrenday' ),
		'separate_items_with_commas' => __( 'Separate Competition Status with commas', 'youtrenday' ),
		'add_or_remove_items'        => __( 'Add or remove Competition Status', 'youtrenday' ),
		'choose_from_most_used'      => __( 'Choose from the most used Competition Status', 'youtrenday' ),
		'not_found'                  => __( 'No Competition Status found.', 'youtrenday' ),
		'menu_name'                  => __( 'Competition Status', 'youtrenday' ),
	); 
    $args_comp_status = array(
		'hierarchical'          => true,
		'labels'                => $labels_comp_status,
		'show_ui'               => true,
		'show_admin_column'     => true, 
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'competition_status' ),
    );
 
    // Taxonomy For Competition Video Status
    $labels_compVideo_status = array(
		'name'                       => _x( 'Video Voting Status', 'taxonomy general name', 'youtrenday' ),
		'singular_name'              => _x( 'Video Voting Status', 'taxonomy singular name', 'youtrenday' ),
		'search_items'               => __( 'Search Video Voting Status', 'youtrenday' ),
		'popular_items'              => __( 'Popular Video Voting  Status', 'youtrenday' ),
		'all_items'                  => __( 'All Video Voting Status', 'youtrenday' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Video Voting Status', 'youtrenday' ),
		'update_item'                => __( 'Update Video Voting Status', 'youtrenday' ),
		'add_new_item'               => __( 'Add New Video Voting  Status', 'youtrenday' ),
		'new_item_name'              => __( 'New Video Voting tatus Name', 'youtrenday' ),
		'separate_items_with_commas' => __( 'Separate Video Voting Status with commas', 'youtrenday' ),
		'add_or_remove_items'        => __( 'Add or remove Video Voting Status', 'youtrenday' ),
		'choose_from_most_used'      => __( 'Choose from the most used Video Voting Status', 'youtrenday' ),
		'not_found'                  => __( 'No Video Voting Status found.', 'youtrenday' ),
		'menu_name'                  => __( 'Video Voting Status', 'youtrenday' ),
	); 
    $args_compVideo_status = array(
		'hierarchical'          => true,
		'labels'                => $labels_compVideo_status,
		'show_ui'               => true,
		'show_admin_column'     => true, 
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'competitionvideo_status' ),
    );
    // Post types
	register_post_type( 'testimonial', $args_testimonial );
	register_post_type( 'music', $args_music );
    register_post_type( 'blog', $args_blog ); 
    register_post_type( 'competition', $args_competition );  
    register_post_type( 'competition_video', $args_competitionVideos );
    register_post_type( 'faq', $args_faq );
    // register_post_type( 'team_member', $args_team_member );
    // Taxonomies
	register_taxonomy( 'blog_category', 'blog', $args_blog_tax );
    register_taxonomy( 'music_category', 'music', $args_music_tax ); 
    register_taxonomy( 'competition_status', 'competition' , $args_comp_status );
    register_taxonomy( 'competitionvideo_status', 'competition_video' , $args_compVideo_status );
    // register_taxonomy( 'competition_status', 'competition', $args_comp_status ); 
} 
add_action( 'init', 'resgister_custom_postTypes_taxonomies' ); 
 
?>