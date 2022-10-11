<?php 
$row = get_sub_field('row'); 
?>
<div class="content-block content-block-plated-images">
    <div class="wrapper">
        <div class="content-block-container col">

            <?php 
                if( have_rows('row') ):
                    while ( have_rows('row') ) : the_row();

                        if( get_row_layout() == 'row_images' ):
                            get_template_part('inc/acf/content-blocks/parts/plated-images-item');

                        endif;

                    endwhile;
                else :
                // Do something...
                endif;
            ?>

        </div>
    </div>
</div>