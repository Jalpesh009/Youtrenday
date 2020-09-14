<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package You_Tren_Day
 */

get_header();
?>

	<main id="primary" class="site-main"> 
		<article class='pb-5'>  
			<header class="entry-header has-text-align-center pt-3">
				<div class="container">
					<h1 class="entry-title mb-4"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'youtrenday' ); ?></h1>
				</div><!-- .entry-header-inner -->
			</header><!-- .entry-header -->
			<div class="entry-content container">
				<div class="page-content text-center">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'youtrenday' ); ?></p>
	
				</div><!-- .page-content -->
			</div>
		</article>
	</main><!-- #main -->

<?php
get_footer();
