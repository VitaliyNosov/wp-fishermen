<?php
$button_class = 'link-arrow';

$link = [];
if (isset($args['link'])){
  $link = $args['link'];
}

$name = '';
if (isset($args['name'])){
  $name = 'name="'.$args['name'].'"';
};
$data = '';
if (isset($args['data'])){
  $data = $args['data'];
};
$disabled = '';
if (isset($args['disabled'])){
  $disabled = $args['disabled'];
};

$class = '';
if(empty($args['text']) and empty($link['title'])){
  $class = 'button-only-icon';
};

$icon_class = '';
if(isset($args['icon_class'])){
  $icon_class = $args['icon_class'];
};

if(!empty($args['icon']) and (!empty($args['text']) or !empty($link['title']))){
  $class = 'button-icon-and-text';
};

$icon_pos = 'right';
if (key_exists('icon_position', $args)){
  $icon_pos = $args['icon_position'];
}

$custom = false;
if (key_exists('custom', $args)){
  $custom = $args['custom'];
  if ($custom == true){
    $button_class = '';
  }
}
?>
<?php if ($link){ ?>
  <a
  class="<?php echo $args['class']; ?> <?php echo $class; ?> link-object <?php echo $button_class; ?>"
  href="<?php echo esc_url( $link['url'] ); ?>" 
  target="<?php echo esc_attr( $link['target'] ); ?>"
  <?php echo $data; ?>
  >
<?php } else { ?>
  <button 
    type="<?php echo $args['type']; ?>" 
    <?php echo $name; ?> 
    class="<?php echo $args['class']; ?> <?php echo $class; ?>" 
    <?php if ($disabled == '1'){ echo 'disabled'; } ?> 
    <?php echo $data; ?>
  >
<?php } ?>

  <strong class="button-layout" flex layout="row" layout-align="center center">
    <?php 
    $class_arrow = '';
    if ($args['icon'] === true and $custom != true){
      $class_arrow = 'link-arrow-text';
    }

    if($args['icon'] === true and $icon_pos == 'left'){ echo '<span class="button-icon '.$icon_class.'"></span>'; }

    if(!empty($args['text']) and empty($link['title'])){ 
      echo '<span class="button-text-holder '.$class_arrow.'">';
      echo '<span class="button-text">'.$args['text'].'</span>'; 
      echo '<span class="button-text button-text-colored">'.$args['text'].'</span>'; 
      echo '</span>';
    } else if (!empty($link['title'])){
      echo '<span class="button-text-holder '.$class_arrow.'">';
      echo '<span class="button-text">'.$link['title'].'</span>';  
      echo '<span class="button-text button-text-colored">'.$link['title'].'</span>'; 
      echo '</span>';
    }
    ?>

    <?php if($args['icon'] === true and $icon_pos == 'right'){ echo '<span class="button-icon '.$icon_class.'"></span>'; } ?>

  </strong>

<?php if ($link){ ?>
  </a>
<?php } else { ?>
  </button>
<?php } ?>