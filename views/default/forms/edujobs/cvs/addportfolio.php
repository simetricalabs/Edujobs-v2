<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_js('edujobsjs');

// input names => defaults
$cvport_title = elgg_extract('cvport_title', $vars, '');
$cvport_type = elgg_extract('cvport_type', $vars, '');
$cvport_link = elgg_extract('cvport_link', $vars, '');
$cvport_file = elgg_extract('cvport_file', $vars, '');
$cvport_subject_math = elgg_extract('cvport_subject_math', $vars, '');
$cvport_subject_science = elgg_extract('cvport_subject_science', $vars, '');
$cvport_subject_socialstudies = elgg_extract('cvport_subject_socialstudies', $vars, '');
$cvport_subject_spanish = elgg_extract('cvport_subject_spanish', $vars, '');
$cvport_subject_english = elgg_extract('cvport_subject_english', $vars, '');
$cvport_subject_otherforeignlangs = elgg_extract('cvport_subject_otherforeignlangs', $vars, '');
$cvport_subject_technology = elgg_extract('cvport_subject_technology', $vars, '');
$cvport_subject_othersubjects = elgg_extract('cvport_subject_othersubjects', $vars, '');
$cvport_subject_othersubjects_text = elgg_extract('cvport_subject_othersubjects_text', $vars, '');
$cvport_grade_kindergarten = elgg_extract('cvport_grade_kindergarten', $vars, '');
$cvport_grade_earlyelementary = elgg_extract('cvport_grade_earlyelementary', $vars, '');
$cvport_grade_lateelementary = elgg_extract('cvport_grade_lateelementary', $vars, '');
$cvport_grade_middleschool = elgg_extract('cvport_grade_middleschool', $vars, '');
$cvport_grade_highschool = elgg_extract('cvport_grade_highschool', $vars, '');
$cvport_grade_othercategories = elgg_extract('cvport_grade_othercategories', $vars, '');
$cvport_grade_othercategories_text = elgg_extract('cvport_grade_othercategories_text', $vars, '');
$cvport_recommend = elgg_extract('cvport_recommend', $vars, '');
$tags = elgg_extract('tags', $vars, '');

$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);

$user = elgg_get_logged_in_user_entity();

// enable or disable other subject
$sost = true;
if (!empty($cvport_subject_othersubjects) || !empty($cvport_subject_othersubjects_text)) {
	$sost = false;	
}

if ($cvport_type == 'edujobs:cv:portfolio:link')	{
	$cvport_file_status = 'none';
	$cvport_link_status = 'inline';
}
else	{
	$cvport_file_status = 'inline';
	$cvport_link_status = 'none';
}

// enable or disable other grade
$goct = true;
if (!empty($cvport_grade_othercategories) || !empty($cvport_grade_othercategories_text)) {
	$goct = false;	
}

// get lists 
$porttypelist = get_portfolio_types();

?>

<p><?php echo elgg_echo('edujobs:add:requiredfields'); ?></p>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvport_title'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvport_title'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvport_title'>
			<?php echo elgg_echo('edujobs:add:cvport_title:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvport_title', 'value' => $cvport_title)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvport_type'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cvport_type'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvport_type'>
			<?php echo elgg_echo('edujobs:add:cvport_type:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cvport_type', 'id' => 'cvport_type', 'value' => $cvport_type, 'options_values' => $porttypelist, 'onchange' => 'ShowHideTextBox()')); ?> 
	</div>
</div>

<div class="form-wide" id ="cvport_link" style="display:<? echo $cvport_link_status; ?>;">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvport_link'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvport_link'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvport_link'>
			<?php echo elgg_echo('edujobs:add:cvport_link:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvport_link', 'value' => $cvport_link)); ?>
	</div>
</div>

<div class="form-wide" id ="cvport_file" style="display:<? echo $cvport_file_status; ?>;">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvport_file'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvport_file'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvport_file'>
			<?php echo elgg_echo('edujobs:add:cvport_file:note'); ?>
		</span>  
	</div>
	<div class='form-right'>		
		<?php echo elgg_view('input/file', array('name' => 'cvport_file')); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left' style="height: 200px;">
		<label><?php echo elgg_echo('edujobs:add:grade'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_grade'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_grade'>
			<?php echo elgg_echo('edujobs:add:cv_grade:note'); ?>
		</span>
	</div>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'cvport_grade_kindergarten', 'id' => 'cvport_grade_kindergarten', 'value' => $cvport_grade_kindergarten, 'options' => array(elgg_echo('edujobs:add:cv_grade_kindergarten')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_grade_earlyelementary', 'id' => 'cvport_grade_earlyelementary', 'value' => $cvport_grade_earlyelementary, 'options' => array(elgg_echo('edujobs:add:cv_grade_earlyelementary')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_grade_lateelementary', 'id' => 'cvport_grade_lateelementary', 'value' => $cvport_grade_lateelementary, 'options' => array(elgg_echo('edujobs:add:cv_grade_lateelementary')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_grade_middleschool', 'id' => 'cvport_grade_middleschool', 'value' => $cvport_grade_middleschool, 'options' => array(elgg_echo('edujobs:add:cv_grade_middleschool')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_grade_highschool', 'id' => 'cvport_grade_highschool', 'value' => $cvport_grade_highschool, 'options' => array(elgg_echo('edujobs:add:cv_grade_highschool')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_grade_othercategories', 'id' => 'cvport_grade_othercategories', 'value' => $cvport_grade_othercategories, 'options' => array(elgg_echo('edujobs:add:cv_grade_othercategories')=>'1'), 'onclick' => 'enable_cvport_othergrades_text_text(this.checked)'));
		?>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvport_grade_othercategories_text', 'value' => $cvport_grade_othercategories_text, 'disabled' => $goct)); ?>
	</div>		
</div>

<div class="form-wide">
	<div class='form-left' style="height: 260px;">
		<label><?php echo elgg_echo('edujobs:add:cv_subject'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_subject'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_subject'>
			<?php echo elgg_echo('edujobs:add:cv_subject:note'); ?>
		</span>
	</div>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'cvport_subject_math', 'id' => 'cvport_subject_math', 'value' => $cvport_subject_math, 'options' => array(elgg_echo('edujobs:add:cv_subject_math')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_subject_science', 'id' => 'cvport_subject_science', 'value' => $cvport_subject_science, 'options' => array(elgg_echo('edujobs:add:cv_subject_science')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_subject_socialstudies', 'id' => 'cvport_subject_socialstudies', 'value' => $cvport_subject_socialstudies, 'options' => array(elgg_echo('edujobs:add:cv_subject_socialstudies')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_subject_spanish', 'id' => 'cvport_subject_spanish', 'value' => $cvport_subject_spanish, 'options' => array(elgg_echo('edujobs:add:cv_subject_spanish')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_subject_english', 'id' => 'cvport_subject_english', 'value' => $cvport_subject_english, 'options' => array(elgg_echo('edujobs:add:cv_subject_english')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_subject_otherforeignlangs', 'id' => 'cvport_subject_otherforeignlangs', 'value' => $cvport_subject_otherforeignlangs, 'options' => array(elgg_echo('edujobs:add:cv_subject_otherforeignlangs')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_subject_technology', 'id' => 'cvport_subject_technology', 'value' => $cvport_subject_technology, 'options' => array(elgg_echo('edujobs:add:cv_subject_technology')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvport_subject_othersubjects', 'id' => 'cvport_subject_othersubjects', 'value' => $cvport_subject_othersubjects, 'options' => array(elgg_echo('edujobs:add:cv_subject_othersubjects')=>'1'), 'onclick' => 'enable_cvport_othersubjects_text_text(this.checked)'));
		?>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvport_subject_othersubjects_text', 'value' => $cvport_subject_othersubjects_text, 'disabled' => $sost)); ?>
	</div>	
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvport_recommend'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvport_recommend'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvport_recommend'>
			<?php echo elgg_echo('edujobs:add:cvport_recommend:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvport_recommend', 'value' => $cvport_recommend)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:tags'); ?></label>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
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
