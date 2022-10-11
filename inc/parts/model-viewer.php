<?php
$filename = '';
if(key_exists('filename', $args)){
    $filename = $args['filename'];
}
$poster = '';
if(key_exists('poster', $args)){
    $poster = $args['poster'];
}
?>
<?php if ($filename){ ?>
    <?php $rand_id = rand(1, 1000); ?>

    <div class="model-viewer-holder">
        <div id="model-progress-bar-<?php echo $rand_id; ?>" class="progress-bar">
            <div id="model-progress-bar-inner-<?php echo $rand_id; ?>" class="progress-bar-inner">
                <div class="progress-bar-value"></div>
            </div>
        </div>
        <model-viewer 
        id="model-<?php echo $rand_id; ?>" 
        src="<?php echo get_template_directory_uri(); ?>/assets/3d/<?php echo $filename; ?>" 
        poster="<?php echo $poster; ?>" 
        auto-rotate auto-rotate-delay="1000" 
        loading="eager" 
        camera-controls 
        preload 
        shadow-intensity="0" 
        ar 
        ar-modes="webxr scene-viewer quick-look" 
        disable-zoom 
        interaction-prompt="none"></model-viewer>
        <script>
            function model_viewer(){
                let model = document.getElementById('model-<?php echo $rand_id; ?>');
                let modelProgressBar = document.getElementById('model-progress-bar-<?php echo $rand_id; ?>');
                let modelProgressBarInner = document.getElementById('model-progress-bar-inner-<?php echo $rand_id; ?>');

                model.addEventListener('preload', e => {
                    modelProgressBar.style.display = 'block';
                }, { once: true });

                model.addEventListener('load', e => {
                    modelProgressBar.style.display = 'none';
                }, { once: true });

                model.addEventListener('progress', e => {
                    let w = e.detail.totalProgress
                    w = w * 100;
                    modelProgressBarInner.style.width = w+'%';
                });
            }
            model_viewer();
        </script>
    </div>

<?php } ?>