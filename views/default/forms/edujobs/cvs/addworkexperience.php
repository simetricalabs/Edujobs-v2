<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_js('edujobsjs');

// input names => defaults
$cvwe_job_title = elgg_extract('cvwe_job_title', $vars, '');
$cvwe_organization = elgg_extract('cvwe_organization', $vars, '');
$cvwe_country = elgg_extract('cvwe_country', $vars, '');
$cvwe_city = elgg_extract('cvwe_city', $vars, '');
$cvwe_period_from = elgg_extract('cvwe_period_from', $vars, '');
$cvwe_period_to = elgg_extract('cvwe_period_to', $vars, '');
$cvwe_period_now = elgg_extract('cvwe_period_now', $vars, '');
$cvwe_salary_starting = elgg_extract('cvwe_salary_starting', $vars, '');
$cvwe_salary_ending = elgg_extract('cvwe_salary_ending', $vars, '');
$cvwe_salary_unit_time = elgg_extract('cvwe_salary_unit_time', $vars, '');
$cvwe_salary_currency = elgg_extract('cvwe_salary_currency', $vars, '');
$cvwe_reasons_go = elgg_extract('cvwe_reasons_go', $vars, '');
$cvwe_subject_math = elgg_extract('cvwe_subject_math', $vars, '');
$cvwe_subject_science = elgg_extract('cvwe_subject_science', $vars, '');
$cvwe_subject_socialstudies = elgg_extract('cvwe_subject_socialstudies', $vars, '');
$cvwe_subject_spanish = elgg_extract('cvwe_subject_spanish', $vars, '');
$cvwe_subject_english = elgg_extract('cvwe_subject_english', $vars, '');
$cvwe_subject_otherforeignlangs = elgg_extract('cvwe_subject_otherforeignlangs', $vars, '');
$cvwe_subject_technology = elgg_extract('cvwe_subject_technology', $vars, '');
$cvwe_subject_othersubjects = elgg_extract('cvwe_subject_othersubjects', $vars, '');
$cvwe_subject_othersubjects_text = elgg_extract('cvwe_subject_othersubjects_text', $vars, '');
$cvwe_grade_kindergarten = elgg_extract('cvwe_grade_kindergarten', $vars, '');
$cvwe_grade_earlyelementary = elgg_extract('cvwe_grade_earlyelementary', $vars, '');
$cvwe_grade_lateelementary = elgg_extract('cvwe_grade_lateelementary', $vars, '');
$cvwe_grade_middleschool = elgg_extract('cvwe_grade_middleschool', $vars, '');
$cvwe_grade_highschool = elgg_extract('cvwe_grade_highschool', $vars, '');
$cvwe_grade_othercategories = elgg_extract('cvwe_grade_othercategories', $vars, '');
$cvwe_grade_othercategories_text = elgg_extract('cvwe_grade_othercategories_text', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$cvwe_comments = elgg_extract('cvwe_comments', $vars, '');

$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);

$user = elgg_get_logged_in_user_entity();

// set default country
if (empty($cvwe_country) && !empty($user))   {
	$cvwe_country = $user->country;
}
if (empty($cvwe_country))   {
    $cvwe_country = DEFAULT_COUNTRY;
}

// set default currency
if (empty($cvwe_salary_currency))   {
    $cvwe_salary_currency = DEFAULT_CURRENCY;
}

// set default city
if (empty($cvwe_city))   {
    if (!empty($user))
		$cvwe_city = $user->location;
}

// get lists 
$countrieslist = get_countries_list();
$currency_list = get_edujobs_currency_list();
$salary_timelist = get_salary_time();

// enable or disable other subject
$sost = true;
if (!empty($cvwe_subject_othersubjects) || !empty($cvwe_subject_othersubjects_text)) {
	$sost = false;	
}

// enable or disable other grade
$goct = true;
if (!empty($cvwe_grade_othercategories) || !empty($cvwe_grade_othercategories_text)) {
	$goct = false;	
}


?>

<p><?php echo elgg_echo('edujobs:add:requiredfields'); ?></p>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_job_title'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvwe_job_title'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_job_title'>
			<?php echo elgg_echo('edujobs:add:cvwe_job_title:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_job_title', 'value' => $cvwe_job_title)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_organization'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvwe_organization'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_organization'>
			<?php echo elgg_echo('edujobs:add:cvwe_organization:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_organization', 'value' => $cvwe_organization)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_country'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cvwe_country'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_country'>
			<?php echo elgg_echo('edujobs:add:cvwe_country:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cvwe_country', 'value' => $cvwe_country, 'options_values' => $countrieslist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_city'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvwe_city'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_city'>
			<?php echo elgg_echo('edujobs:add:cvwe_city:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_city', 'value' => $cvwe_city)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left' style="height:130px;">
		<label><?php echo elgg_echo('edujobs:add:cvwe_period_from'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvwe_period_from'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_period_from'>
			<?php echo elgg_echo('edujobs:add:cvwe_period_from:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php 
			echo elgg_view('input/date', array('name' => 'cvwe_period_from', 'value' => $cvwe_period_from)); 
			echo '<br/>'.elgg_echo('edujobs:add:cvwe_period_to').'<br/>'; 
			echo elgg_view('input/date', array('name' => 'cvwe_period_to', 'value' => $cvwe_period_to)); 
		?>
	</div>
	<div class='form-right-checkbox'>
		<?php echo elgg_view('input/checkboxes', array('name' => 'cvwe_period_now', 'id' => 'cvwe_period_now', 'value' => $cvwe_period_now, 'options' => array(elgg_echo('edujobs:add:cvwe_period_now')=>'1')));?>
	</div>	
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_salary_starting'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvwe_salary_starting'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_salary_starting'>
			<?php echo elgg_echo('edujobs:add:cvwe_salary_starting:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_salary_starting', 'value' => $cvwe_salary_starting)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_salary_ending'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvwe_salary_ending'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_salary_ending'>
			<?php echo elgg_echo('edujobs:add:cvwe_salary_ending:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_salary_ending', 'value' => $cvwe_salary_ending)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_salary_unit_time'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvwe_salary_unit_time'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_salary_unit_time'>
			<?php echo elgg_echo('edujobs:add:cvwe_salary_unit_time:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cvwe_salary_unit_time', 'value' => $cvwe_salary_unit_time, 'options_values' => $salary_timelist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_salary_currency'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvwe_salary_currency'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_salary_currency'>
			<?php echo elgg_echo('edujobs:add:cvwe_salary_currency:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cvwe_salary_currency', 'value' => $cvwe_salary_currency, 'options_values' => $currency_list)); ?> 
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
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_subject_math', 'id' => 'cvwe_subject_math', 'value' => $cvwe_subject_math, 'options' => array(elgg_echo('edujobs:add:cv_subject_math')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_subject_science', 'id' => 'cvwe_subject_science', 'value' => $cvwe_subject_science, 'options' => array(elgg_echo('edujobs:add:cv_subject_science')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_subject_socialstudies', 'id' => 'cvwe_subject_socialstudies', 'value' => $cvwe_subject_socialstudies, 'options' => array(elgg_echo('edujobs:add:cv_subject_socialstudies')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_subject_spanish', 'id' => 'cvwe_subject_spanish', 'value' => $cvwe_subject_spanish, 'options' => array(elgg_echo('edujobs:add:cv_subject_spanish')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_subject_english', 'id' => 'cvwe_subject_english', 'value' => $cvwe_subject_english, 'options' => array(elgg_echo('edujobs:add:cv_subject_english')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_subject_otherforeignlangs', 'id' => 'cvwe_subject_otherforeignlangs', 'value' => $cvwe_subject_otherforeignlangs, 'options' => array(elgg_echo('edujobs:add:cv_subject_otherforeignlangs')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_subject_technology', 'id' => 'cvwe_subject_technology', 'value' => $cvwe_subject_technology, 'options' => array(elgg_echo('edujobs:add:cv_subject_technology')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_subject_othersubjects', 'id' => 'cvwe_subject_othersubjects', 'value' => $cvwe_subject_othersubjects, 'options' => array(elgg_echo('edujobs:add:cv_subject_othersubjects')=>'1'), 'onclick' => 'enable_cvwe_othersubjects_text_text(this.checked)'));
		?>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_subject_othersubjects_text', 'value' => $cvwe_subject_othersubjects_text, 'disabled' => $sost)); ?>
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
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_grade_kindergarten', 'id' => 'cvwe_grade_kindergarten', 'value' => $cvwe_grade_kindergarten, 'options' => array(elgg_echo('edujobs:add:cv_grade_kindergarten')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_grade_earlyelementary', 'id' => 'cvwe_grade_earlyelementary', 'value' => $cvwe_grade_earlyelementary, 'options' => array(elgg_echo('edujobs:add:cv_grade_earlyelementary')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_grade_lateelementary', 'id' => 'cvwe_grade_lateelementary', 'value' => $cvwe_grade_lateelementary, 'options' => array(elgg_echo('edujobs:add:cv_grade_lateelementary')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_grade_middleschool', 'id' => 'cvwe_grade_middleschool', 'value' => $cvwe_grade_middleschool, 'options' => array(elgg_echo('edujobs:add:cv_grade_middleschool')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_grade_highschool', 'id' => 'cvwe_grade_highschool', 'value' => $cvwe_grade_highschool, 'options' => array(elgg_echo('edujobs:add:cv_grade_highschool')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'cvwe_grade_othercategories', 'id' => 'cvwe_grade_othercategories', 'value' => $cvwe_grade_othercategories, 'options' => array(elgg_echo('edujobs:add:cv_grade_othercategories')=>'1'), 'onclick' => 'enable_cvwe_othergrades_text_text(this.checked)'));
		?>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_grade_othercategories_text', 'value' => $cvwe_grade_othercategories_text, 'disabled' => $goct)); ?>
	</div>		
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_reasons_go'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvwe_reasons_go'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_reasons_go'>
			<?php echo elgg_echo('edujobs:add:cvwe_reasons_go:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_reasons_go', 'value' => $cvwe_reasons_go, 'class' => 'cvwe_reasons_go')); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvwe_comments'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cvwe_comments'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvwe_comments'>
			<?php echo elgg_echo('edujobs:add:cvwe_comments:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvwe_comments', 'value' => $cvwe_comments, 'class' => 'cvwe_comments')); ?>
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
