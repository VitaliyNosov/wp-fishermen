<?php

// Check value exists.
if( have_rows('content') ):

    // Loop through rows.
    while ( have_rows('content') ) : the_row();

        if( get_row_layout() == 'global_hero_section' ): 
            get_template_part('inc/acf/global-hero-section');

        elseif( get_row_layout() == 'card' ): 
            get_template_part('inc/acf/card');

        elseif( get_row_layout() == 'text_blocks_section' ): 
            get_template_part('inc/acf/text-blocks-section');

        elseif( get_row_layout() == 'main_content_section' ): 
            get_template_part('inc/acf/main-content-section');

        elseif( get_row_layout() == 'titles_text_action' ): 
            get_template_part('inc/acf/tta');

        elseif( get_row_layout() == 'global_section' ): 
            get_template_part('inc/acf/global-section');
                                                    
        endif;

    // End loop.
    endwhile;

// No value.
else :
    // Do something...
endif;
?>