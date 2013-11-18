<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_js('edujobsjs');

// input names => defaults
$cvedu_degree = elgg_extract('cvedu_degree', $vars, '');
$cvedu_school_name = elgg_extract('cvedu_school_name', $vars, '');
$cvedu_country = elgg_extract('cvedu_country', $vars, '');
$cvedu_city = elgg_extract('cvedu_city', $vars, '');
$cvedu_time_currently = elgg_extract('cvedu_time_currently', $vars, '');
$cvedu_time_from = elgg_extract('cvedu_time_from', $vars, '');
$cvedu_time_to = elgg_extract('cvedu_time_to', $vars, '');

$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);

$user = elgg_get_logged_in_user_entity();

// set default country
if (empty($cvedu_country) && !empty($user))   {
	$cvedu_country = $user->country;
}
if (empty($cvedu_country))   {
    $cvedu_country = DEFAULT_COUNTRY;
}

// set default city
if (empty($cvedu_city))   {
    if (!empty($user))
		$cvedu_city = $user->location;
}

// get lists 
$countrieslist = get_countries_list();

?>

<p><?php echo elgg_echo('edujobs:add:requiredfields'); ?></p>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvedu_degree'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvedu_degree'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvedu_degree'>
			<?php echo elgg_echo('edujobs:add:cvedu_degree:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvedu_degree', 'value' => $cvedu_degree)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvedu_school_name'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvedu_school_name'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvedu_school_name'>
			<?php echo elgg_echo('edujobs:add:cvedu_school_name:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvedu_school_name', 'value' => $cvedu_school_name)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvedu_country'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cvedu_country'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvedu_country'>
			<?php echo elgg_echo('edujobs:add:cvedu_country:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cvedu_country', 'value' => $cvedu_country, 'options_values' => $countrieslist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cvedu_city'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cvedu_city'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvedu_city'>
			<?php echo elgg_echo('edujobs:add:cvedu_city:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cvedu_city', 'value' => $cvedu_city)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left' style="height:130px;">
		<label><?php echo elgg_echo('edujobs:add:cvedu_time_from'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cvedu_time_from'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cvedu_time_from'>
			<?php echo elgg_echo('edujobs:add:cvedu_time_from:note'); ?>
		</span>
	</div>
	<div class='form-right-checkbox'>
		<?php echo elgg_view('input/checkboxes', array('name' => 'cvedu_time_currently', 'id' => 'cvedu_time_currently', 'value' => $cvedu_time_currently, 'options' => array(elgg_echo('edujobs:add:cvedu_time_currently')=>'1')));?>
	</div>	
	<div class='form-right'>
		<?php 
			echo elgg_view('input/date', array('name' => 'cvedu_time_from', 'value' => $cvedu_time_from)); 
			echo '<br/>'.elgg_echo('edujobs:add:cvedu_time_to').'<br/>'; 
			echo elgg_view('input/date', array('name' => 'cvedu_time_to', 'value' => $cvedu_time_to)); 
		?>
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
