<?php 
$posts = get_sub_field('case_studies_list');
$i = 1;
?>
<?php if( $posts ): ?>
    <?php foreach( $posts as $post ): ?>
        <?php 
            $args = array(
                'counter_i' => $i,
            );
            get_template_part('inc/loop/case-studies-loop-item', '', $args); 
            $i++;
        ?>
    <?php endforeach; ?>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>