<?php 
$row = get_sub_field('row'); 
?>
<div class="content-block content-block-previews">
    <div class="wrapper">
        <div class="content-block-container col">

            <?php 
                if( have_rows('row') ):
                    while ( have_rows('row') ) : the_row();

                        if( get_row_layout() == 'item' ):
                            get_template_part('inc/acf/content-blocks/parts/previews-item');

                        endif;

                    endwhile;
                else :
                // Do something...
                endif;
            ?>

        </div>
    </div>
</div>