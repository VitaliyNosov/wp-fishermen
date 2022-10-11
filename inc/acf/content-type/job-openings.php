<?php
$posts = get_sub_field('jobs');
?>
<?php if( $posts ): ?>
    <div class="job-openings-loop-layout" flex layout="column" layout-align="start start" layout-wrap>
        <?php foreach( $posts as $post ): ?>
            <?php 
                $args = array();
                get_template_part('inc/loop/job-openings-loop-item', '', $args); 
            ?>
        <?php endforeach; ?>
        <?php wp_reset_postdata(); ?>
    </div>
<?php endif; ?>