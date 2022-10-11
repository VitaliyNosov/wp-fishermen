<?php
$id = get_the_ID();
$title = get_the_title();
$text = get_field('description');

$type = get_field('employment_type');
$time = get_field('employment_time');
?>
<div class="job-openings-loop-item reveal col">
    <div class="job-openings-loop-item-top" flex layout="row" layout-s="column" layout-align="space-between center" layout-align-s="start start" layout-wrap>
        <?php if ($title){ ?>
            <div class="job-openings-loop-item-title" flex="none">
                <?php echo $title; ?>
            </div>
        <?php } ?>
        <div class="job-openings-loop-item-types" flex="none">
            <?php if ($type){ ?>
                <?php echo $type; ?>
            <?php } ?>
            <?php if ($time){ ?>
                - <?php echo $time; ?>
            <?php } ?>
        </div>
    </div>

    <?php if ($text){ ?>
        <div class="job-openings-loop-item-text">
            <?php echo $text; ?>
        </div>
    <?php } ?>

    <div class="job-openings-loop-item-link-holder" flex layout="row" layout-align="start start">
        <a class="job-openings-loop-item-link colored-element link-arrow" href="<?php the_permalink(); ?>" flex="none" layout="row" layout-align="start center">
            <span class="job-openings-loop-item-link-text link-arrow-text" flex="none">
                Learn More
            </span>
            <i class="job-openings-loop-item-link-icon icon-arrow-right"></i>
        </a>
    </div>
</div>