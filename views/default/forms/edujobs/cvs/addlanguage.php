<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_js('edujobsjs');

// input names => defaults
$cvlang_language = elgg_extract('cvlang_language', $vars, '');
$cvlang_level = elgg_extract('cvlang_level', $vars, '');
$cvlang_cert_institute = elgg_extract('cvlang_cert_institute', $vars, '');
$cvlang_reading_score = elgg_extract('cvlang_reading_score', $vars, '');
$cvlang_listening_score = elgg_extract('cvlang_listening_score', $vars, '');
$cvlang_speaking_score = elgg_extract('cvlang_speaking_score', $vars, '');
$cvlang_writing_score = elgg_extract('cvlang_writing_score', $vars, '');
$cvlang_total_score = elgg_extract('cvlang_total_score', $vars, '');
$cvlang_cert_document = elgg_extract('cvlang_cert_document', $vars, '');

$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);

$user = elgg_get_logged_in_user_entity();

// set default lang
if (empty($cvlang_language))   {
    $cvlang_language = DEFAULT_LANG;
}

// get lists 
$langslist = get_languages();
$langslevellist = get_lang_levels();

?>

<p><?php echo elgg_echo('edujobs:add:requiredfields'); ?></p>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_language'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cvlang_language'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_language'>
			<?php echo elgg_echo('edujobs:add:cvlang_language:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cvlang_language', 'value' => $cvlang_language, 'options_values' => $langslist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_level'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cvlang_level'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_level'>
			<?php echo elgg_echo('edujobs:add:cvlang_level:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cvlang_level', 'value' => $cvlang_level, 'options_values' => $langslevellist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_cert_institute'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvlang_cert_institute'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_cert_institute'>
			<?php echo elgg_echo('edujobs:add:cvlang_cert_institute:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvlang_cert_institute', 'value' => $cvlang_cert_institute)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_reading_score'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvlang_reading_score'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_reading_score'>
			<?php echo elgg_echo('edujobs:add:cvlang_reading_score:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvlang_reading_score', 'value' => $cvlang_reading_score)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_listening_score'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvlang_listening_score'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_listening_score'>
			<?php echo elgg_echo('edujobs:add:cvlang_listening_score:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvlang_listening_score', 'value' => $cvlang_listening_score)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_speaking_score'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvlang_speaking_score'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_speaking_score'>
			<?php echo elgg_echo('edujobs:add:cvlang_speaking_score:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvlang_speaking_score', 'value' => $cvlang_speaking_score)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_writing_score'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvlang_writing_score'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_writing_score'>
			<?php echo elgg_echo('edujobs:add:cvlang_writing_score:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvlang_writing_score', 'value' => $cvlang_writing_score)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_total_score'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvlang_total_score'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_total_score'>
			<?php echo elgg_echo('edujobs:add:cvlang_total_score:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvlang_total_score', 'value' => $cvlang_total_score)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvlang_cert_document'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvlang_cert_document'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvlang_cert_document'>
			<?php echo elgg_echo('edujobs:add:cvlang_cert_document:note'); ?>
		</span>  
	</div>
	<div class='form-right'>		
		<?php echo elgg_view('input/file', array('name' => 'cvlang_cert_document')); ?>
	</div>
</div>


<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('access'); ?></label><br />
	</div>
	<div class='form-right'>
		 <?php echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id, 'class' => 'access_selector')); ?>
	</div>
</div>	


<!------------------------------------------------------------------------------->
<div class="elgg-foot">
<?php

    if ($guid) {
		echo elgg_view('input/hidden', array('name' => 'object_guid', 'value' => $guid));
    }
    echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
    echo elgg_view('input/submit', array('value' => elgg_echo('edujobs:add:submit:save')));
?>
</div>
