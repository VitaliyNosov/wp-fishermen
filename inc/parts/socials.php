<?php
    $socials = get_field('socials', 'option');
    $class = '';
    if (array_key_exists('class', $args)){
        $class = $args['class'];
    }
?>
<?php if ($socials){ ?>
<ul <?php echo $args['layout']; ?>>
    <?php foreach($socials as $soc){ ?>
        <?php 
        $link = $soc['social_link'];
        if( $link ) {
        ?>
            <li class="<?php echo $class; ?>" flex="none">
                <?php 
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
            </li>
        <?php } ?>
    <?php } ?>
</ul>
<?php } ?>