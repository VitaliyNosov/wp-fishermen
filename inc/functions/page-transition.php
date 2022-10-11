<?php
add_action('wp_body_open', 'add_code_on_body_open');
function add_code_on_body_open() {
if ( is_single() || is_page() || is_front_page() || is_home() ) { ?> 

<style>
    .page-transition-screen {
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        background: #B6DAB4;
        z-index: 400;
        pointer-events: none;
    }

    .transition-fade {
        transition: 0.4s;
        opacity: 1;
    }
    html.is-animating .transition-fade {
        opacity: 0;
    }

</style>

<div id="page-transition-screen" class="page-transition-screen"></div>

<?php }} ?>
