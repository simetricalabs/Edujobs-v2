<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_js('edujobsjs');

// input names => defaults
$title = elgg_extract('title', $vars, '');
$subject_math = elgg_extract('subject_math', $vars, '');
$subject_science = elgg_extract('subject_science', $vars, '');
$subject_socialstudies = elgg_extract('subject_socialstudies', $vars, '');
$subject_spanish = elgg_extract('subject_spanish', $vars, '');
$subject_english = elgg_extract('subject_english', $vars, '');
$subject_otherforeignlangs = elgg_extract('subject_otherforeignlangs', $vars, '');
$subject_technology = elgg_extract('subject_technology', $vars, '');
$subject_othersubjects = elgg_extract('subject_othersubjects', $vars, '');
$subject_othersubjects_text = elgg_extract('subject_othersubjects_text', $vars, '');
$subject = elgg_extract('subject', $vars, '');
$grade_kindergarten = elgg_extract('grade_kindergarten', $vars, '');
$grade_earlyelementary = elgg_extract('grade_earlyelementary', $vars, '');
$grade_lateelementary = elgg_extract('grade_lateelementary', $vars, '');
$grade_middleschool = elgg_extract('grade_middleschool', $vars, '');
$grade_highschool = elgg_extract('grade_highschool', $vars, '');
$grade_othercategories = elgg_extract('grade_othercategories', $vars, '');
$grade_othercategories_text = elgg_extract('grade_othercategories_text', $vars, '');
$description = elgg_extract('description', $vars, 0);
$country = elgg_extract('country', $vars, 0);
$city = elgg_extract('city', $vars, 0);
$published_until = elgg_extract('published_until', $vars, 0);
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);



// set default publish period
if (empty($published_until))   {
    $published_until = DEFAULT_PUBLISH_PERIOD;
}
// get publish periods
$publish_periods = get_publish_periods();

// set default city
$user = elgg_get_logged_in_user_entity();
if (empty($city))   {
    if (!empty($user))
		$city = $user->location;
}

// set default country
if (empty($country) && !empty($user))   {
	$country = $user->country;
}
if (empty($country))   {
    $country = DEFAULT_COUNTRY;
}
// get countries list
$countrieslist = get_countries_list();

// enable or disable other subject
$sost = true;
if (!empty($subject_othersubjects) || !empty($subject_othersubjects_text)) {
	$sost = false;	
}

// enable or disable other grade
$goct = true;
if (!empty($grade_othercategories) || !empty($grade_othercategories_text)) {
	$goct = false;	
}


/*
$comments_input = elgg_view('input/dropdown', array(
	'name' => 'comments_on',
	'id' => 'edujobs_comments_on',
	'value' => elgg_extract('comments_on', $vars, ''),
	'options_values' => array('On' => elgg_echo('on'), 'Off' => elgg_echo('off'))
));
*/

?>

<p><?php echo elgg_echo('edujobs:add:requiredfields'); ?></p>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:title'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_title'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_title'>
			<?php echo elgg_echo('edujobs:add:title:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left' style="height: 260px;">
		<label><?php echo elgg_echo('edujobs:add:subject'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_subject'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_subject'>
			<?php echo elgg_echo('edujobs:add:subject:note'); ?>
		</span>
	</div>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'subject_math', 'id' => 'subject_math', 'value' => $subject_math, 'options' => array(elgg_echo('edujobs:add:subject:math')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'subject_science', 'id' => 'subject_science', 'value' => $subject_science, 'options' => array(elgg_echo('edujobs:add:subject:science')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'subject_socialstudies', 'id' => 'subject_socialstudies', 'value' => $subject_socialstudies, 'options' => array(elgg_echo('edujobs:add:subject:socialstudies')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'subject_spanish', 'id' => 'subject_spanish', 'value' => $subject_spanish, 'options' => array(elgg_echo('edujobs:add:subject:spanish')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'subject_english', 'id' => 'subject_english', 'value' => $subject_english, 'options' => array(elgg_echo('edujobs:add:subject:english')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'subject_otherforeignlangs', 'id' => 'subject_otherforeignlangs', 'value' => $subject_otherforeignlangs, 'options' => array(elgg_echo('edujobs:add:subject:otherforeignlangs')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'subject_technology', 'id' => 'subject_technology', 'value' => $subject_technology, 'options' => array(elgg_echo('edujobs:add:subject:technology')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'subject_othersubjects', 'id' => 'subject_othersubjects', 'value' => $subject_othersubjects, 'options' => array(elgg_echo('edujobs:add:subject:othersubjects')=>'1'), 'onclick' => 'enable_othersubjects_text_text(this.checked)'));
		?>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'subject_othersubjects_text', 'value' => $subject_othersubjects_text, 'disabled' => $sost)); ?>
	</div>	
</div>

<div class="form-wide">
	<div class='form-left' style="height: 200px;">
		<label><?php echo elgg_echo('edujobs:add:grade'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_grade'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_grade'>
			<?php echo elgg_echo('edujobs:add:grade:note'); ?>
		</span>
	</div>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'grade_kindergarten', 'id' => 'grade_kindergarten', 'value' => $grade_kindergarten, 'options' => array(elgg_echo('edujobs:add:grade:kindergarten')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'grade_earlyelementary', 'id' => 'grade_earlyelementary', 'value' => $grade_earlyelementary, 'options' => array(elgg_echo('edujobs:add:grade:earlyelementary')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'grade_lateelementary', 'id' => 'grade_lateelementary', 'value' => $grade_lateelementary, 'options' => array(elgg_echo('edujobs:add:grade:lateelementary')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'grade_middleschool', 'id' => 'grade_middleschool', 'value' => $grade_middleschool, 'options' => array(elgg_echo('edujobs:add:grade:middleschool')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'grade_highschool', 'id' => 'grade_highschool', 'value' => $grade_highschool, 'options' => array(elgg_echo('edujobs:add:grade:highschool')=>'1')));
			echo elgg_view('input/checkboxes', array('name' => 'grade_othercategories', 'id' => 'grade_othercategories', 'value' => $grade_othercategories, 'options' => array(elgg_echo('edujobs:add:grade:othercategories')=>'1'), 'onclick' => 'enable_othergrades_text_text(this.checked)'));
		?>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'grade_othercategories_text', 'value' => $grade_othercategories_text, 'disabled' => $goct)); ?>
	</div>		
</div>

<div class="form-wide">
	<div style='width:100%; clear:both;'>
		<label><?php echo elgg_echo('edujobs:add:description'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_description'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_description'>
			<?php echo elgg_echo('edujobs:add:description:note'); ?>
		</span>
	</div>
	<div style='width:100%; clear:both;'>
		<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $description, 'class' => 'description')); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:country'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_country'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_country'>
			<?php echo elgg_echo('edujobs:add:country:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'country', 'value' => $country, 'options_values' => $countrieslist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:city'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_city'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_city'>
			<?php echo elgg_echo('edujobs:add:city:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'city', 'value' => $city)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:published_until'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_published_until'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_published_until'>
			<?php echo elgg_echo('edujobs:add:published_until:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'published_until', 'value' => $published_until, 'options_values' => $publish_periods)); ?> 
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

<div class="elgg-foot">
<?php

    if ($guid) {
            echo elgg_view('input/hidden', array('name' => 'object_guid', 'value' => $guid));
    }
    echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
    echo elgg_view('input/submit', array('value' => elgg_echo('edujobs:add:submit')));
?>
</div>
