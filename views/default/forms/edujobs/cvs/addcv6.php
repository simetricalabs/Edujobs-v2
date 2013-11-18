<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_js('edujobsjs');

// input names => defaults
$cv_paste_cv = elgg_extract('cv_paste_cv', $vars, '');
$guid = elgg_extract('guid', $vars, null);

$user = elgg_get_logged_in_user_entity();

?>

<div class="form-wide">
	<div style='width:100%; clear:both;'>
		<label><?php echo elgg_echo('edujobs:add:cv_paste_cv'); ?></label>
	</div>
	<div style='width:100%; clear:both;'>
		<?php echo elgg_view('input/longtext', array('name' => 'cv_paste_cv', 'value' => $cv_paste_cv, 'class' => 'cv_paste_cv')); ?>
	</div>
</div>


<!------------------------------------------------------------------------------->
<div class="elgg-foot">
<?php

    if ($guid) {
            echo elgg_view('input/hidden', array('name' => 'object_guid', 'value' => $guid));
    }
    echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
    echo elgg_view('input/submit', array('value' => elgg_echo('edujobs:add:submit:next')));
    //echo elgg_view('input/submit', array('value' => elgg_echo('edujobs:add:submit')));
?>
</div>
