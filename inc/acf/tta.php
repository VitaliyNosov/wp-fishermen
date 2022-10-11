<?php 
/**
 * Titles Text Action Data
 */
$tta_data = get_sub_field('titles_text_actions');
?>
<section class="section-layout section-tta tta">

    <?php 
    $section_top_args = array(
        'data' => $tta_data,
        'settings_data' => '',
    );
    get_template_part('inc/parts/section-top', '', $section_top_args); 
    ?>

</section>