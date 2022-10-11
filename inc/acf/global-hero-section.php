<?php
$type = get_sub_field('type');
$args_data = array();
?>
<?php if ($type){ ?>
    
    <?php if ($type == 'home'){ ?>
        <?php
            $args_data = get_sub_field('homepage_hero');
            if(is_array($args_data)){
                $args = $args_data;
                get_template_part('inc/acf/heros/hero-home', '', $args);
            }
        ?>
    <?php } ?>

    <?php if ($type == 'pages'){ ?>
        <?php
            $args_data = get_sub_field('pages_hero');
            if(is_array($args_data)){
                $args = $args_data;
                get_template_part('inc/acf/heros/hero-pages', '', $args);
            }
        ?>
    <?php } ?>

    <?php if ($type == 'landing'){ ?>
        <?php
            $args_data = get_sub_field('landing_hero');
            if(is_array($args_data)){
                $args = $args_data;
                get_template_part('inc/acf/heros/hero-landing', '', $args);
            }
        ?>
    <?php } ?>

<?php } ?>
