<?php 
$rows = get_sub_field('item');

$bg_class = '';
$bg = get_sub_field('background');
if ($bg){
    if ($bg == 'dark'){
        $bg_class = 'bg-dark';
    }
}

$i = 0;
if( $rows ) {
?>
    <section class="section-case-studies <?php echo $bg_class; ?>">
      <div class="wrapper container">

          <?php foreach( $rows as $row ) { $i++; ?>
            <?php if ($row){ ?>
                <?php 
                    
                    $item_class = '';
                    if ($i % 2 != 1){
                        $item_class = 'case-studies-item-right';
                    }

                    $image = $row['image'];
                    $category = $row['category'];
                    $title = $row['title'];
                    $text = $row['text'];
                    $link = $row['link'];
                ?>
                <div class="case-studies-item <?php echo $item_class; ?>" flex layout="row" layout-align="start center" layout-wrap>

                    <?php if( !empty( $image and $i % 2 == 1 ) ): ?>
                        <div class="case-studies-item-image" flex="none">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                    <?php endif; ?>

                    <div class="case-studies-item-content" flex>

                        <?php if ($category){ ?>
                            <div class="case-studies-item-category">
                                <?php echo esc_html($category); ?>
                            </div>
                        <?php } ?>

                        <?php if ($title){ ?>
                            <h3 class="case-studies-item-title">
                                <?php echo esc_html($title); ?>
                            </h3>
                        <?php } ?>

                        <?php if ($text){ ?>
                            <div class="case-studies-item-text">
                                <?php echo esc_html($text); ?>
                            </div>
                        <?php } ?>

                        <?php if ($link){ ?>
                            <div class="case-studies-item-link">
                                <?php
                                    $link_url = $link['url'];
                                    $link_title = $link['title'];
                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
                                <?php
                                $button_params = array(
                                    'link'       => array(
                                        'url'    => $link_url,
                                        'title'  => $link_title,
                                        'target' => $link_target
                                    ),
                                    'class'      => 'button',
                                    'type'       => 'button',
                                    'name'       => '',
                                    'icon'       => false,
                                    'icon_class' => '',
                                    'text'       => '',
                                    'disabled'   => 0,
                                    'data'       => '',
                                );
                                get_template_part('inc/elements/button', '', $button_params);
                                ?>
                            </div>
                        <?php } ?>

                    </div>

                    <?php if( !empty( $image and $i % 2 != 1 ) ): ?>
                        <div class="case-studies-item-image" flex="none">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        </div>
                    <?php endif; ?>
          
                </div>
              
            <?php } ?>
          <?php } ?>

        </div>
    </section>
<?php } ?>