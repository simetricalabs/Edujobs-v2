<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */
 
$curl = elgg_extract('curl', $vars, 'edujobs/jobs');
$country = elgg_extract('country', $vars, 0);
$city = elgg_extract('city', $vars,  '');
$grade_kindergarten = elgg_extract('grade_kindergarten', $vars,  '');
$grade_earlyelementary = elgg_extract('grade_earlyelementary', $vars,  '');
$grade_lateelementary = elgg_extract('grade_lateelementary', $vars,  '');
$grade_middleschool = elgg_extract('grade_middleschool', $vars,  '');
$grade_highschool = elgg_extract('grade_highschool', $vars,  '');
$grade_othercategories = elgg_extract('grade_othercategories', $vars,  '');
$subject_math = elgg_extract('subject_math', $vars,  '');
$subject_science = elgg_extract('subject_science', $vars,  '');
$subject_socialstudies = elgg_extract('subject_socialstudies', $vars,  '');
$subject_spanish = elgg_extract('subject_spanish', $vars,  '');
$subject_english = elgg_extract('subject_english', $vars,  '');
$subject_otherforeignlangs = elgg_extract('subject_otherforeignlangs', $vars,  '');
$subject_technology = elgg_extract('subject_technology', $vars,  '');
$subject_othersubjects = elgg_extract('subject_othersubjects', $vars,  '');
//$jobstart = elgg_extract('jobstart', $vars,  '');
$jobposts = elgg_extract('jobposts', $vars,  '');
$tags = elgg_extract('tags', $vars,  '');

// get countries list
$countrieslist = get_countries_list();
array_unshift($countrieslist, elgg_echo('edujobs:search:allcountries'));

?>

<form method="post" action="<?php echo elgg_get_site_url().$curl;?>" name="edujobspost" enctype="multipart/form-data" class="elgg-form">

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:country'); ?></label>
	<?php echo elgg_view('input/dropdown', array('name' => 'country', 'value' => $country, 'options_values' => $countrieslist, 'options_values' => $countrieslist, 'onchange' => 'this.form.submit()')); ?> 
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:city'); ?></label>
	<?php echo elgg_view('input/text', array('name' => 'city', 'value' => $city, 'onchange' => 'this.form.submit()')); ?>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:grades'); ?></label>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'grade_kindergarten', 'id' => 'grade_kindergarten', 'value' => $grade_kindergarten, 'options' => array(elgg_echo('edujobs:add:grade:kindergarten')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'grade_earlyelementary', 'id' => 'grade_earlyelementary', 'value' => $grade_earlyelementary, 'options' => array(elgg_echo('edujobs:add:grade:earlyelementary')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'grade_lateelementary', 'id' => 'grade_lateelementary', 'value' => $grade_lateelementary, 'options' => array(elgg_echo('edujobs:add:grade:lateelementary')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'grade_middleschool', 'id' => 'grade_middleschool', 'value' => $grade_middleschool, 'options' => array(elgg_echo('edujobs:add:grade:middleschool')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'grade_highschool', 'id' => 'grade_highschool', 'value' => $grade_highschool, 'options' => array(elgg_echo('edujobs:add:grade:highschool')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'grade_othercategories', 'id' => 'grade_othercategories', 'value' => $grade_othercategories, 'options' => array(elgg_echo('edujobs:search:grades:othercategories')=>'1'), 'onclick' => 'this.form.submit()'));
		?>
	</div>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:subjects'); ?></label>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/checkboxes', array('name' => 'subject_math', 'id' => 'subject_math', 'value' => $subject_math, 'options' => array(elgg_echo('edujobs:add:subject:math')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'subject_science', 'id' => 'subject_science', 'value' => $subject_science, 'options' => array(elgg_echo('edujobs:add:subject:science')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'subject_socialstudies', 'id' => 'subject_socialstudies', 'value' => $subject_socialstudies, 'options' => array(elgg_echo('edujobs:add:subject:socialstudies')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'subject_spanish', 'id' => 'subject_spanish', 'value' => $subject_spanish, 'options' => array(elgg_echo('edujobs:add:subject:spanish')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'subject_english', 'id' => 'subject_english', 'value' => $subject_english, 'options' => array(elgg_echo('edujobs:add:subject:english')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'subject_otherforeignlangs', 'id' => 'subject_otherforeignlangs', 'value' => $subject_otherforeignlangs, 'options' => array(elgg_echo('edujobs:add:subject:otherforeignlangs')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'subject_technology', 'id' => 'subject_technology', 'value' => $subject_technology, 'options' => array(elgg_echo('edujobs:add:subject:technology')=>'1'), 'onclick' => 'this.form.submit()'));
			echo elgg_view('input/checkboxes', array('name' => 'subject_othersubjects', 'id' => 'subject_othersubjects', 'value' => $subject_othersubjects, 'options' => array(elgg_echo('edujobs:search:subject:othersubjects')=>'1'), 'onclick' => 'this.form.submit()'));
		?>
	</div>
</div>

<!--
<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:jobstart'); ?></label>
	<?php echo elgg_view('input/date', array('name' => 'jobstart', 'value' => $jobstart)); ?>
</div>
-->
<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:jobposts'); ?></label>
	<div class='form-right-checkbox'>
		<?php 
			echo elgg_view('input/radio', array('name' => 'jobposts', 'value' => $jobposts, 'options' => array(elgg_echo('edujobs:search:86400')=>'86400',elgg_echo('edujobs:search:259200')=>'259200',elgg_echo('edujobs:search:604800')=>'604800'), 'onchange' => 'this.form.submit()'));
		?>
	</div>
</div>

<div class="form-wide">
	<label><?php echo elgg_echo('edujobs:search:tags'); ?></label>
	<?php echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags, 'onchange' => 'this.form.submit()')); ?>
</div>	

<?php 
	echo elgg_view('input/hidden', array('name' => 'searchformsubmitted', 'value' => '1')); 
	//echo elgg_view('input/submit', array('value' => elgg_echo('edujobs:search:submit')));
?>

</form>
