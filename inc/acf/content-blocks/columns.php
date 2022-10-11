<?php 
$type = get_sub_field('type');
$columns_text_content = get_sub_field('columns_text_content'); 
$columns_count_text_content = get_sub_field('columns_count_text_content');

$type_val = 'flex_box';
if ($type){
    $type_val = $type;
}
?>
<div class="content-block content-block-columns">
    <div class="wrapper">
        <div class="content-block-container col">

            <div class="content-block-inner width-large">

                <?php if ($type_val == 'flex_box'){ ?>
                    <div class="content-block-layout reveal-small_" flex layout="row" layout-align="space-between start" layout-m="column">
                        <?php 
                            if( have_rows('columns_text_content') ):
                                while ( have_rows('columns_text_content') ) : the_row();

                                    if( get_row_layout() == 'text_block' ):
                                        get_template_part('inc/acf/content-blocks/parts/text-block');

                                    endif;

                                endwhile;
                            else :
                            // Do something...
                            endif;
                        ?>
                    </div>
                <?php } ?>

                <?php if ($type_val == 'column_count'){ ?>
                    <?php if(is_array($columns_count_text_content)){ ?>
                        <?php
                        $data = array();
                        $data = $columns_count_text_content;
                        $container_data = '';

                        $title = $data['title'];
                        $colors_for_colored_elements = $data['colors_for_colored_elements'];

                        if($colors_for_colored_elements){
                            $container_data .= ' data-color-for-elements="'.$colors_for_colored_elements.'"';
                        }

                        $content = $data['content'];
                        ?>
                        <div class="column-count-container" <?php echo $container_data; ?>>
                            <?php if($title){ ?>
                                <div class="column-count-container-title h4">
                                    <?php echo $title; ?>
                                </div>
                            <?php } ?>
                            <?php if(is_array($content)){ ?>
                                <div class="column-count-container-blocks">
                                    <?php foreach($content as $content_item){ ?>
                                        <?php
                                        $args = $content_item;
                                        get_template_part('inc/acf/content-blocks/parts/column-count-text-block', '', $args);
                                        ?>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                        </div>
                    <?php } ?>
                <?php } ?>

            </div>

        </div>
    </div>
</div>