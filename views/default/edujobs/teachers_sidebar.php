<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */
 
$curl = elgg_extract('curl', $vars, 'edujobs/teachers/view');
$cv_birth_country = elgg_extract('cv_birth_country', $vars,  DEFAULT_COUNTRY);
$cv_birth_city = elgg_extract('cv_birth_city', $vars,  '');
$cv_grade_kindergarten = elgg_extract('cv_grade_kindergarten', $vars,  '');
$cv_grade_earlyelementary = elgg_extract('cv_grade_earlyelementary', $vars,  '');
$cv_grade_lateelementary = elgg_extract('cv_grade_lateelementary', $vars,  '');
$cv_grade_middleschool = elgg_extract('cv_grade_middleschool', $vars,  '');
$cv_grade_highschool = elgg_extract('cv_grade_highschool', $vars,  '');
$cv_grade_othercategories = elgg_extract('cv_grade_othercategories', $vars,  '');
$cv_subject_math = elgg_extract('cv_subject_math', $vars,  '');
$cv_subject_science = elgg_extract('cv_subject_science', $vars,  '');
$cv_subject_socialstudies = elgg_extract('cv_subject_socialstudies', $vars,  '');
$cv_subject_spanish = elgg_extract('cv_subject_spanish', $vars,  '');
$cv_subject_english = elgg_extract('cv_subject_english', $vars,  '');
$cv_subject_otherforeignlangs = elgg_extract('cv_subject_otherforeignlangs', $vars,  '');
$cv_subject_technology = elgg_extract('cv_subject_technology', $vars,  '');
$cv_subject_othersubjects = elgg_extract('cv_subject_othersubjects', $vars,  '');
$cv_wey0 = elgg_extract('cv_wey0', $vars,  '');
$cv_wey1 = elgg_extract('cv_wey1', $vars,  '');
$cv_wey2 = elgg_extract('cv_wey2', $vars,  '');
$cv_wey5 = elgg_extract('cv_wey5', $vars,  '');
$cv_wey10 = elgg_extract('cv_wey10', $vars,  '');
$cv_availability_date = elgg_extract('cv_availability_date', $vars,  '');
$cv_desired_work_type = elgg_extract('cv_desired_work_type', $vars,  '');
$tags = elgg_extract('tags', $vars,  '');

// get lists
$countrieslist = get_countries_list();
$yearslist = get_years();
$start_working = get_start_working_search();
$work_desired = get_work_desired_search();
?>

<form method="post" action="<?php echo elgg_get_site_url().$curl;?>" name="edujobspost" enctype="multipart/form-data" class="elgg-form">

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:country'); ?></label>
	<?php echo elgg_view('input/dropdown', array('name' => 'cv_birth_country', 'value' => $cv_birth_country, 'options_values' => $countrieslist, 'onchange' => 'this.form.submit()')); ?> 
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:city'); ?></label>
	<?php echo elgg_view('input/text', array('name' => 'cv_birth_city', 'value' => $cv_birth_city)); ?>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:cv_work_experience_years'); ?></label>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'cv_wey0', 'id' => 'cv_wey0', 'value' => $cv_wey0, 'options' => array(elgg_echo('edujobs:search:cv_wey0')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_wey1', 'id' => 'cv_wey1', 'value' => $cv_wey1, 'options' => array(elgg_echo('edujobs:search:cv_wey1')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_wey2', 'id' => 'cv_wey2', 'value' => $cv_wey2, 'options' => array(elgg_echo('edujobs:search:cv_wey2')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_wey5', 'id' => 'cv_wey5', 'value' => $cv_wey5, 'options' => array(elgg_echo('edujobs:search:cv_wey5')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_wey10', 'id' => 'cv_wey10', 'value' => $cv_wey10, 'options' => array(elgg_echo('edujobs:search:cv_wey10')=>'1'), 'onclick' => 'this.form.submit()'));
		?>
	</div>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:add:cv_availability_date'); ?></label>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_availability_date', 'value' => $cv_availability_date, 'options_values' => $start_working)); ?> 
	</div>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:add:cv_desired_work_type'); ?></label>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_desired_work_type', 'value' => $cv_desired_work_type, 'options_values' => $work_desired)); ?> 
	</div>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:grades'); ?></label>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_kindergarten', 'id' => 'cv_grade_kindergarten', 'value' => $cv_grade_kindergarten, 'options' => array(elgg_echo('edujobs:add:grade:kindergarten')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_earlyelementary', 'id' => 'cv_grade_earlyelementary', 'value' => $cv_grade_earlyelementary, 'options' => array(elgg_echo('edujobs:add:grade:earlyelementary')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_lateelementary', 'id' => 'cv_grade_lateelementary', 'value' => $cv_grade_lateelementary, 'options' => array(elgg_echo('edujobs:add:grade:lateelementary')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_middleschool', 'id' => 'cv_grade_middleschool', 'value' => $cv_grade_middleschool, 'options' => array(elgg_echo('edujobs:add:grade:middleschool')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_highschool', 'id' => 'cv_grade_highschool', 'value' => $cv_grade_highschool, 'options' => array(elgg_echo('edujobs:add:grade:highschool')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_grade_othercategories', 'id' => 'cv_grade_othercategories', 'value' => $cv_grade_othercategories, 'options' => array(elgg_echo('edujobs:search:grades:othercategories')=>'1'), 'onclick' => 'this.form.submit()'));
		?>
	</div>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:subjects'); ?></label>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_math', 'id' => 'cv_subject_math', 'value' => $cv_subject_math, 'options' => array(elgg_echo('edujobs:add:subject:math')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_science', 'id' => 'cv_subject_science', 'value' => $cv_subject_science, 'options' => array(elgg_echo('edujobs:add:subject:science')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_socialstudies', 'id' => 'cv_subject_socialstudies', 'value' => $cv_subject_socialstudies, 'options' => array(elgg_echo('edujobs:add:subject:socialstudies')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_spanish', 'id' => 'cv_subject_spanish', 'value' => $cv_subject_spanish, 'options' => array(elgg_echo('edujobs:add:subject:spanish')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_english', 'id' => 'cv_subject_english', 'value' => $cv_subject_english, 'options' => array(elgg_echo('edujobs:add:subject:english')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_otherforeignlangs', 'id' => 'cv_subject_otherforeignlangs', 'value' => $cv_subject_otherforeignlangs, 'options' => array(elgg_echo('edujobs:add:subject:otherforeignlangs')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_technology', 'id' => 'cv_subject_technology', 'value' => $cv_subject_technology, 'options' => array(elgg_echo('edujobs:add:subject:technology')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'cv_subject_othersubjects', 'id' => 'cv_subject_othersubjects', 'value' => $cv_subject_othersubjects, 'options' => array(elgg_echo('edujobs:search:subject:othersubjects')=>'1'), 'onclick' => 'this.form.submit()'));
		?>
	</div>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:tags'); ?></label>
	<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags, 'onchange' => 'this.form.submit()')); ?>
</div>	

<?php 
	echo elgg_view('input/hidden', array('name' => 'searchformsubmitted', 'value' => '1')); 
	//echo elgg_view('input/submit', array('value' => elgg_echo('edujobs:search:teachers:submit')));
?>

</form>
