		</main>
	</div><!-- /site-content -->

<?php
$footer_class = '';
if(is_page_template('page-templates/contact.php')){
	$footer_class = 'small';
}
?>

<footer id="site-footer" class="site-footer <?php echo $footer_class; ?>" flex="none" data-onbg="bg-dark">
    <div class="wrapper">
        <div class="site-footer-layout" flex layout="column" layout-align="space-between start">

			<?php if (!is_page_template('page-templates/contact.php')){ ?>

            <div class="footer-top col-2" flex>
                
                <div class="footer-block-appear">
                    <?php 
                        $footer_title = get_field('footer_title', 'option');
                        $footer_title_link_part = get_field('footer_title_link_part', 'option');
                    ?>
                    <?php if ($footer_title){ ?>
                        <div class="footer-heading" flex="none">
                            <?php echo $footer_title; ?>
                            <?php 
                            if ($footer_title_link_part){
                                $link_url = $footer_title_link_part['url'];
                                $link_title = $footer_title_link_part['title'];
                                $link_target = $footer_title_link_part['target'] ? $footer_title_link_part['target'] : '_self';
                            ?> 
                            <a class="footer-heading-part" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php echo esc_html( $link_title ); ?>
                            </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    
                    <?php
                        $footer_description = get_field('footer_description', 'option');
                    ?>
                    <?php if ($footer_description) { ?>
                        <div class="footer-heading-desc">
                            <?php echo $footer_description; ?>
                        </div>
                    <?php } ?>
                </div>
                
                <div class="footer-middle" flex layout="row" layout-align="start start">
                    <div class="footer-menu footer-middle-block" flex="none">
                        <?php
                        $args = array( 
                            'theme_location' => 'bottom',
                            'container'=> false,
                            'menu_id' => 'bot-nav-ul',
                            'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
                            'menu_class' => 'bot-menu',	 
                            'depth' => '1',
                            'link_before' => '<span class="footer-menu-item-layout" flex layout="row" layout-align="start center"><span class="footer-menu-item-link link-arrow-text" flex="none">',
                            'link_after' => '</span><i class="footer-menu-icon icon-arrow-right" flex="none"></i>',
                            'add_li_class'  => 'footer-block-appear link-arrow' 		
                        );
                        wp_nav_menu($args);
                        ?>
                    </div>
                    <div class="footer-socials footer-socials-tablet footer-middle-block" flex="none" flex="none">
                        <?php 
                            $args = array(
                                'layout' => 'flex layout="row" layout-align="start center" layout-wrap layout-m="column" layout-align-m="start start"',
                                'class' => 'footer-block-appear',
                            );
                            get_template_part('inc/parts/socials', '', $args); 
                        ?>
                    </div>
                </div>
            </div><!-- /footer-top -->

			<?php } ?>

            <div class="footer-bot" flex layout="row" layout-m="column" layout-align="space-between end" layout-align-m="start stretch" layout-s="row" layout-align-s="space-between start" layout-wrap>

                <div class="footer-details col-2" flex="none" flex layout="row" layout-align="start start" layout-s="column" layout-wrap>
                    
                    <?php
                        $state = get_field('state', 'option');
                        $adress = get_field('adress', 'option');
                        $email = get_field('email', 'option');
                        $phone = get_field('phone', 'option');
                    ?>

                    <?php if ($state and $adress) { ?>
                        <div class="footer-detail-block footer-block-appear" flex="none">
                            <div class="footer-detail-title">
                                <?php echo esc_html( $state ); ?>
                            </div>
                            <div class="footer-detail-content">
                                <?php echo $adress; ?>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <?php 
                        if ($email and $phone){ 

                            $link_url = $email['url'];
                            $link_title = $email['title'];
                            $link_target = $email['target'] ? $email['target'] : '_self';
                    ?>
                        <div class="footer-detail-block footer-block-appear" flex="none">
                            <div class="footer-detail-title">
                                Contact
                            </div>
                            <div class="footer-detail-content">
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php echo esc_html( $link_title ); ?>
                            </a><br>
                                <?php echo esc_html( $phone ); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <?php 
                        $privacy_policy = get_field('privacy_policy', 'option');
                        if ($privacy_policy){ 

                            $link = $privacy_policy;
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <div class="footer-detail-block footer-block-appear" flex="none">
                            <div class="footer-detail-title">
                                More Info
                            </div>
                            <div class="footer-detail-content">
                                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $link_title ); ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>

                </div><!-- /footer-details -->
            
                <div class="footer-socials footer-socials-desc col-2" flex="none" flex="none">
                    <?php 
                        $args = array(
                            'layout' => 'flex layout="row" layout-align="start center" layout-wrap layout-s="column" layout-align-s="start start"',
                            'class' => 'footer-block-appear',
                        );
                        get_template_part('inc/parts/socials', '', $args); 
                    ?>
                </div>

            </div><!-- /footer-bot -->

        </div>
    </div>
</footer>

</div><!-- /site -->

<?php wp_footer(); ?>
</body>
</html>