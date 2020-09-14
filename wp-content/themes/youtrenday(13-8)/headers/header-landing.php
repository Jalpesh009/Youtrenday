<div class="container"> 
    <div class="footer-logo">
        <div class="row">
            <div class="col-md-12 text-center">
                <?php  // Logo 1 
                if( have_rows('header_options', 'option') ): 
                    while ( have_rows('header_options', 'option') ) : the_row();  
                        $header_circle_logo = get_sub_field('header_circle_logo', 'option');
                        $header_logo = get_sub_field('header_logo', 'option'); ?>
                        <a class="d-inline" href="<?php echo site_url(); ?>"> 
                            <img width="90" height="90" src="<?php echo $header_circle_logo['url']; ?>" class="custom-logo d-inline ">	
                        </a>
                        <?php // Logo 2 ?> 
                        <a class="header-logo-link d-inline" href="<?php echo site_url(); ?>"> 
                            <img width="230" height="102" src="<?php echo $header_logo['url']; ?>" class="loggedin-header-logo d-inline">	
                        </a> 	 
                        <?php  
                    endwhile; 
                endif; ?> 
            </div>
        </div> 
    </div>
</div>   