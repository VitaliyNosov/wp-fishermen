<?php
/**
 * Template name: Test Page
 */
?>
<?php get_header(); ?>
<div class="test-block">
    <div class="wrapper">
        <div class="col">
            <h3>Button Bold</h3>
            <?php
            $link_url = get_permalink($id);
            $link_title = 'See Case Study';
            $link_target = '_self';

            $button_params = array(
                'link'       => array(
                    'url'    => $link_url,
                    'title'  => $link_title,
                    'target' => $link_target,
                ),
                'class'      => 'button button-bold',
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
            <br><br>
            <h3>Button 500</h3>
            <?php
            $link_url = get_permalink($id);
            $link_title = 'See Case Study';
            $link_target = '_self';

            $button_params = array(
                'link'       => array(
                    'url'    => $link_url,
                    'title'  => $link_title,
                    'target' => $link_target,
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
            <br><br>
            <h3>Button 400</h3>
            <?php
            $link_url = get_permalink($id);
            $link_title = 'See Case Study';
            $link_target = '_self';

            $button_params = array(
                'link'       => array(
                    'url'    => $link_url,
                    'title'  => $link_title,
                    'target' => $link_target,
                ),
                'class'      => 'button button-400',
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
    </div>
</div>

<?php get_footer(); ?>