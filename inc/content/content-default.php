<?php
$type = get_field('employment_type');
$time = get_field('employment_time');
$link = get_field('apply_link');
$apply_title = get_field('apply_title');
$id = get_the_ID();
?>
<section class="section-layout section-default-page">
    <div class="wrapper">
        <article class="default-page-article col">
            
            <div class="post-content-holder">
                <div class="post-content styled">
                    <?php the_content(); ?>
                </div>
            </div>

        </article>
    </div>
</section>