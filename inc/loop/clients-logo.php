<?php
    $id = $args['id'];
    $link = get_field('link', $id); 
    $size = 'full';
?>
<div class="logos-slide-item" flex="none" layout="row" layout-align="center center">
<?php 
    if ($link){
        $link_url = $link['url'];
        $link_title = $link['title'];
        $link_target = $link['target'] ? $link['target'] : '_self';
    ?>
    <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
    <?php echo wp_get_attachment_image( $id, $size, false, [
        'class' => 'your-class-here', 
        'loading' => 'eager'
        ] ); 
    ?>
    </a>
    <?php } else { ?>
        <?php echo wp_get_attachment_image( $id, $size, false, [
            'class' => 'your-class-here', 
            'loading' => 'eager'
            ] ); 
        ?>
    <?php } ?>
</div>