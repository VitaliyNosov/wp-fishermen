<div id="header-menu" class="header-menu">
    <div id="header-menu-layout" class="header-menu-layout" flex layout="column" layout-align="stretch start">

        <div class="header-menu-close header-block-appear" flex="none">
            <div id="header-menu-close-button" class="header-menu-close-button active-element">
                <div class="close-cross"></div>
            </div>
        </div>

        <div id="header-menu-content" class="wrapper header-menu-content" flex layout="row" layout-align="space-between stretch" layout-m="column" layout-align-m="stretch start">
            <?php 
                $header_title = get_field('header_title', 'option');
                $header_link = get_field('header_link', 'option');
            ?>
            <div class="header-menu-content-layout" flex="none" layout="column" layout-align="space-between start" layout-align-m="center center">

                <div class="header-menu-content-top header-block-appear col" flex="none">
                    <?php if ($header_title){ ?>
                        <div class="header-menu-content-title">
                            <?php echo esc_html($header_title); ?>
                        </div>
                    <?php } ?>

                    <?php if ($header_link){ ?>
                        <?php
                            $link = $header_link;
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <div class="header-menu-content-link-title">
                            <a class="link-object" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $link_title ); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <div class="header-menu-content-bot col" flex="none">
                    <?php 
                        $args = array(
                            'layout' => 'flex layout="row" layout-align="start center" layout-align-m="space-between center" layout-align-s="center center" layout-wrap',
                            'class' => 'header-block-appear',
                        );
                        get_template_part('inc/parts/socials', '', $args); 
                    ?>
                </div>
            </div><!-- /header-menu-content-layout -->

            <div id="header-menu-nav" class="header-menu-nav col" flex="none">
                <div class="header-menu-nav-inner">
                    <?php
                    $args = array( 
                        'theme_location' => 'main',
                        'container'=> false,
                        'menu_id' => 'header-menu-nav-ul',
                        'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
                        'menu_class' => 'header-menu-nav-menu',	 
                        'depth' => '1', 
                        'add_li_class'  => 'swup-preload header-block-appear'		
                    );
                    wp_nav_menu($args);
                    ?>
                </div>
            </div>

        </div><!-- /header-menu-content -->

    </div>
</div>