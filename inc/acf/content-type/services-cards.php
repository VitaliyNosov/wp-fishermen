<?php
$posts = get_sub_field('services_list');
?>
<?php if( $posts ): ?>

    <div class="swiper-cards">
        <div class="swiper-wrapper services-cards-layout" flex layout="row" layout-align="start stretch" layout-wrap="nowrap">
            <?php foreach( $posts as $post ): ?>
                <?php 
                $args = array(
                    'class' => 'swiper-slide',
                );   
                get_template_part('inc/loop/services-cards-loop-item', '', $args); ?>
            <?php endforeach; ?>
        </div>
        <div class="swiper-scrollbar swiper-scrollbar-cards"></div>
    </div>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>