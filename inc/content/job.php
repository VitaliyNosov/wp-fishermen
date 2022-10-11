<?php
$type = get_field('employment_type');
$time = get_field('employment_time');
$link = get_field('apply_link');
$apply_title = get_field('apply_title');
$id = get_the_ID();
?>
<section class="section-layout section-job-single">
    <div class="wrapper">
        <article class="job-single-article col">

            <?php
                $args = array(
                    'back_page_id' => wp_get_post_parent_id($id),
                    'text' => 'Back to Careers',
                );
                get_template_part('inc/parts/go-back', '', $args);
            ?>

            <header class="job-header">

                <?php if ($type and $time){ ?>
                    <div class="job-types">
                        <?php if ($type){ ?>
                            <?php echo $type; ?>
                        <?php } ?>
                        <?php if ($time){ ?>
                            - <?php echo $time; ?>
                        <?php } ?>
                    </div>
                <?php } ?>

                <h1 class="job-title h2">
                    <?php the_title(); ?>
                </h1>

                <?php if ($link){ ?>
                    <div class="job-actions" flex layout="row" layout-align="center center">
                        <?php
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <?php
                        $button_params = array(
                            'link'       => array(
                                'url'    => $link_url,
                                'title'  => $link_title,
                                'target' => $link_target
                            ),
                            'class'      => 'button button-dark',
                            'type'       => 'button button-dark',
                            'name'       => '',
                            'icon'       => false,
                            'icon_class' => 'icon-arrow-right',
                            'text'       => '',
                            'disabled'   => 0,
                            'data'       => '',
                        );
                        get_template_part('inc/elements/button', '', $button_params);
                        ?>
                    </div>
                <?php } ?>

            </header>
            
            <div class="post-content-holder">
                <div class="post-content styled">
                    <?php the_content(); ?>
                </div>
                <div class="post-content job-ready">
                    <h4><?php echo $apply_title; ?></h4>
                    <?php if ($link){ ?>
                        <div class="job-actions" flex layout="row" layout-align="start start">
                            <?php
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <?php
                            $button_params = array(
                                'link'       => array(
                                    'url'    => $link_url,
                                    'title'  => $link_title,
                                    'target' => $link_target
                                ),
                                'class'      => 'button button-dark',
                                'type'       => 'button button-dark',
                                'name'       => '',
                                'icon'       => false,
                                'icon_class' => 'icon-arrow-right',
                                'text'       => '',
                                'disabled'   => 0,
                                'data'       => '',
                            );
                            get_template_part('inc/elements/button', '', $button_params);
                            ?>
                        </div>
                    <?php } ?>
                </div>
            </div>


        </article>
    </div>
</section>