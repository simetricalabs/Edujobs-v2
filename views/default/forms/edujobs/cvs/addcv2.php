<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_js('edujobsjs');

// input names => defaults
$cv_position_looking_for = elgg_extract('cv_position_looking_for', $vars, '');
$cv_work_experience_years = elgg_extract('cv_work_experience_years', $vars, '');
$cv_salary_min_acceptable = elgg_extract('cv_salary_min_acceptable', $vars, '');
$cv_salary_min_acceptable = elgg_extract('cv_salary_min_acceptable', $vars, '');
$cv_salary_unit_of_time = elgg_extract('cv_salary_unit_of_time', $vars, '');
$cv_salary_currency = elgg_extract('cv_salary_currency', $vars, '');
$cv_availability_date = elgg_extract('cv_availability_date', $vars, '');
$cv_availability_date_specify = elgg_extract('cv_availability_date_specify', $vars, '');
$cv_desired_work_type = elgg_extract('cv_desired_work_type', $vars, '');
$cv_subject_math = elgg_extract('cv_subject_math', $vars, '');
$cv_subject_science = elgg_extract('cv_subject_science', $vars, '');
$cv_subject_socialstudies = elgg_extract('cv_subject_socialstudies', $vars, '');
$cv_subject_spanish = elgg_extract('cv_subject_spanish', $vars, '');
$cv_subject_english = elgg_extract('cv_subject_english', $vars, '');
$cv_subject_otherforeignlangs = elgg_extract('cv_subject_otherforeignlangs', $vars, '');
$cv_subject_technology = elgg_extract('cv_subject_technology', $vars, '');
$cv_subject_othersubjects = elgg_extract('cv_subject_othersubjects', $vars, '');
$cv_subject_othersubjects_text = elgg_extract('cv_subject_othersubjects_text', $vars, '');
$cv_grade_kindergarten = elgg_extract('cv_grade_kindergarten', $vars, '');
$cv_grade_earlyelementary = elgg_extract('cv_grade_earlyelementary', $vars, '');
$cv_grade_lateelementary = elgg_extract('cv_grade_lateelementary', $vars, '');
$cv_grade_middleschool = elgg_extract('cv_grade_middleschool', $vars, '');
$cv_grade_highschool = elgg_extract('cv_grade_highschool', $vars, '');
$cv_grade_othercategories = elgg_extract('cv_grade_othercategories', $vars, '');
$cv_grade_othercategories_text = elgg_extract('cv_grade_othercategories_text', $vars, '');
$cv_more_info = elgg_extract('cv_more_info', $vars, '');

$tags = elgg_extract('tags', $vars, '');
$guid = elgg_extract('guid', $vars, null);

$user = elgg_get_logged_in_user_entity();

// get lists 
$yearslist = get_years();
$salary_timelist = get_salary_time();
$start_working = get_start_working();
$work_desired = get_work_desired();
$currency_list = get_edujobs_currency_list();

// enable or disable other subject
$sost = true;
if (!empty($cv_subject_othersubjects) || !empty($cv_subject_othersubjects_text)) {
	$sost = false;	
}

// enable or disable other grade
$goct = true;
if (!empty($cv_grade_othercategories) || !empty($cv_grade_othercategories_text)) {
	$goct = false;	
}

?>

<p><?php echo elgg_echo('edujobs:add:requiredfields'); ?></p>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_position_looking_for'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_position_looking_for'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_position_looking_for'>
			<?php echo elgg_echo('edujobs:add:cv_position_looking_for:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_position_looking_for', 'value' => $cv_position_looking_for)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_work_experience_years'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cv_work_experience_years'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_work_experience_years'>
			<?php echo elgg_echo('edujobs:add:cv_work_experience_years:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_work_experience_years', 'value' => $cv_work_experience_years, 'options_values' => $yearslist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_salary_min_acceptable'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_salary_min_acceptable'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_salary_min_acceptable'>
			<?php echo elgg_echo('edujobs:add:cv_salary_min_acceptable:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_salary_min_acceptable', 'value' => $cv_salary_min_acceptable)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_salary_unit_of_time'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cv_salary_unit_of_time'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_salary_unit_of_time'>
			<?php echo elgg_echo('edujobs:add:cv_salary_unit_of_time:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_salary_unit_of_time', 'value' => $cv_salary_unit_of_time, 'options_values' => $salary_timelist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_salary_currency'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cv_salary_currency'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_salary_currency'>
			<?php echo elgg_echo('edujobs:add:cv_salary_currency:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_salary_currency', 'value' => $cv_salary_currency, 'options_values' => $currency_list)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_availability_date'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cv_availability_date'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_availability_date'>
			<?php echo elgg_echo('edujobs:add:cv_availability_date:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_availability_date', 'value' => $cv_availability_date, 'options_values' => $start_working)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_availability_date_specify'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cv_availability_date_specify'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_availability_date_specify'>
			<?php echo elgg_echo('edujobs:add:cv_availability_date_specify:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/date', array('name' => 'cv_availability_date_specify', 'value' => $cv_availability_date_specify)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_desired_work_type'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cv_desired_work_type'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_desired_work_type'>
			<?php echo elgg_echo('edujobs:add:cv_desired_work_type:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_desired_work_type', 'value' => $cv_desired_work_type, 'options_values' => $work_desired)); ?> 
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
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_math', 'id' => 'cv_subject_math', 'value' => $cv_subject_math, 'options' => array(elgg_echo('edujobs:add:cv_subject_math')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_science', 'id' => 'cv_subject_science', 'value' => $cv_subject_science, 'options' => array(elgg_echo('edujobs:add:cv_subject_science')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_socialstudies', 'id' => 'cv_subject_socialstudies', 'value' => $cv_subject_socialstudies, 'options' => array(elgg_echo('edujobs:add:cv_subject_socialstudies')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_spanish', 'id' => 'cv_subject_spanish', 'value' => $cv_subject_spanish, 'options' => array(elgg_echo('edujobs:add:cv_subject_spanish')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_english', 'id' => 'cv_subject_english', 'value' => $cv_subject_english, 'options' => array(elgg_echo('edujobs:add:cv_subject_english')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_otherforeignlangs', 'id' => 'cv_subject_otherforeignlangs', 'value' => $cv_subject_otherforeignlangs, 'options' => array(elgg_echo('edujobs:add:cv_subject_otherforeignlangs')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_technology', 'id' => 'cv_subject_technology', 'value' => $cv_subject_technology, 'options' => array(elgg_echo('edujobs:add:cv_subject_technology')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_othersubjects', 'id' => 'cv_subject_othersubjects', 'value' => $cv_subject_othersubjects, 'options' => array(elgg_echo('edujobs:add:cv_subject_othersubjects')=>'1'), 'onclick' => 'enable_cv_othersubjects_text_text(this.checked)'));
		?>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_subject_othersubjects_text', 'value' => $cv_subject_othersubjects_text, 'disabled' => $sost)); ?>
	</div>	
</div>

<div class="form-wide">
	<div class='form-left' style="height: 200px;">
		<label><?php echo elgg_echo('edujobs:add:cv_grade'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_grade'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_grade'>
			<?php echo elgg_echo('edujobs:add:cv_grade:note'); ?>
		</span>
	</div>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_kindergarten', 'id' => 'cv_grade_kindergarten', 'value' => $cv_grade_kindergarten, 'options' => array(elgg_echo('edujobs:add:cv_grade_kindergarten')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_earlyelementary', 'id' => 'cv_grade_earlyelementary', 'value' => $cv_grade_earlyelementary, 'options' => array(elgg_echo('edujobs:add:cv_grade_earlyelementary')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_lateelementary', 'id' => 'cv_grade_lateelementary', 'value' => $cv_grade_lateelementary, 'options' => array(elgg_echo('edujobs:add:cv_grade_lateelementary')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_middleschool', 'id' => 'cv_grade_middleschool', 'value' => $cv_grade_middleschool, 'options' => array(elgg_echo('edujobs:add:cv_grade_middleschool')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_highschool', 'id' => 'cv_grade_highschool', 'value' => $cv_grade_highschool, 'options' => array(elgg_echo('edujobs:add:cv_grade_highschool')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_othercategories', 'id' => 'cv_grade_othercategories', 'value' => $cv_grade_othercategories, 'options' => array(elgg_echo('edujobs:add:cv_grade_othercategories')=>'1'), 'onclick' => 'enable_cv_othergrades_text_text(this.checked)'));
		?>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_grade_othercategories_text', 'value' => $cv_grade_othercategories_text, 'disabled' => $goct)); ?>
	</div>		
</div>

<div class="form-wide">
	<div style='width:100%; clear:both;'>
		<label><?php echo elgg_echo('edujobs:add:cv_more_info'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cv_more_info'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_more_info'>
			<?php echo elgg_echo('edujobs:add:cv_more_info:note'); ?>
		</span>
	</div>
	<div style='width:100%; clear:both;'>
		<?php echo elgg_view('input/longtext', array('name' => 'cv_more_info', 'value' => $cv_more_info, 'class' => 'cv_more_info')); ?>
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
