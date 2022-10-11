<?php
$logos = get_field('logos', 'option');
$i = 0;
?>
<?php if (is_array($logos)){ ?>
    <?php foreach($logos as $l){ $i++; ?>
        
        <?php
            $gallery = $l['gallery'];
        ?>
        <?php if (is_array($gallery)){ ?>
            <?php
                $layout = 'flex layout="row" layout-align="center center"';

                $slider_inner_class = 'ltr';
                if ($i % 2 == 0){
                    $slider_inner_class = 'rtl';
                }
                
                $gallery_length = count($gallery);
                $to_fit_number = '15';
                $for_loop_number = ceil($to_fit_number / $gallery_length);

                $width = (($gallery_length * $for_loop_number * 2) * (200 + 80));
                $width_half = $width / 2;
            ?>
            <div id="logos-slider-<?php echo $i; ?>" class="logos-slider" style="width: 100%;">

                <div class="logos-slider-inner <?php echo $slider_inner_class; ?>" flex layout="row" layout-align="space-between center" style="width: <?php echo $width; ?>px" data-width="<?php echo $width; ?>" data-width-half="<?php echo $width_half; ?>">

                    <?php for($k = 1; $k <= $for_loop_number; $k++ ){ ?>
                        <?php foreach($gallery as $logo){ ?>
                            <?php 
                                $args = array(
                                    'id' => $logo['id'],
                                );
                                get_template_part('inc/loop/clients-logo', '', $args); 
                            ?>
                        <?php } ?>
                    <?php } ?>    
                    <?php for($k = 1; $k <= $for_loop_number; $k++ ){ ?>
                        <?php foreach($gallery as $logo){ ?>
                            <?php 
                                $args = array(
                                    'id' => $logo['id'],
                                );
                                get_template_part('inc/loop/clients-logo', '', $args); 
                            ?>
                        <?php } ?>
                    <?php } ?> 
                    
                    
                </div>

            </div><!-- /logos-slider -->
        <?php } ?>

    <?php } ?>
<?php } ?>