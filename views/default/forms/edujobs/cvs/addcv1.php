<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_js('edujobsjs');

// input names => defaults
$cv_name = elgg_extract('cv_name', $vars, '');
$cv_last_name = elgg_extract('cv_last_name', $vars, '');
$cv_description = elgg_extract('cv_description', $vars, '');
$cv_gender = elgg_extract('cv_gender', $vars, '');
$cv_birth_date = elgg_extract('cv_birth_date', $vars, '');
$cv_birth_country = elgg_extract('cv_birth_country', $vars, '');
$cv_birth_city = elgg_extract('cv_birth_city', $vars, '');
$cv_email = elgg_extract('cv_email', $vars, '');
$cv_telephone = elgg_extract('cv_telephone', $vars, '');
$cv_address = elgg_extract('cv_address', $vars, '');

$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_DEFAULT);
$container_guid = elgg_extract('container_guid', $vars);
if (!$container_guid) {
	$container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);

$user = elgg_get_logged_in_user_entity();

// get genders list
$genderlist = get_genders();

// set default country
if (empty($cv_birth_country) && !empty($user))   {
	$cv_birth_country = $user->country;
}
if (empty($cv_birth_country))   {
    $cv_birth_country = DEFAULT_COUNTRY;
}
// get countries list
$countrieslist = get_countries_list();

// set default city
if (empty($cv_birth_city))   {
    if (!empty($user))
		$cv_birth_city = $user->location;
}

// set default email
if (empty($cv_email))   {
    if (!empty($user))
		$cv_email = $user->email;
}

// set default telephone
if (empty($cv_telephone))   {
    if (!empty($user))
		$cv_telephone = $user->phone;
}

// set default description
if (empty($cv_description))   {
    if (!empty($user))
		$cv_description = $user->briefdescription;
}

?>

<p><?php echo elgg_echo('edujobs:add:requiredfields'); ?></p>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_name'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_name'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_name'>
			<?php echo elgg_echo('edujobs:add:cv_name:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_name', 'value' => $cv_name)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_last_name'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_last_name'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_last_name'>
			<?php echo elgg_echo('edujobs:add:cv_last_name:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_last_name', 'value' => $cv_last_name)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_description'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_description'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_description'>
			<?php echo elgg_echo('edujobs:add:cv_description:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_description', 'value' => $cv_description)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_gender'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cv_gender'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_gender'>
			<?php echo elgg_echo('edujobs:add:cv_gender:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_gender', 'value' => $cv_gender, 'options_values' => $genderlist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_birth_date'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_birth_date'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_birth_date'>
			<?php echo elgg_echo('edujobs:add:cv_birth_date:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/date', array('name' => 'cv_birth_date', 'value' => $cv_birth_date)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_birth_country'); ?></label> <span style="color:red;">(*)</span>
		<span class='custom_fields_more_info' id='more_info_cv_birth_country'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_birth_country'>
			<?php echo elgg_echo('edujobs:add:cv_birth_country:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/dropdown', array('name' => 'cv_birth_country', 'value' => $cv_birth_country, 'options_values' => $countrieslist)); ?> 
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_birth_city'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_birth_city'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_birth_city'>
			<?php echo elgg_echo('edujobs:add:cv_birth_city:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_birth_city', 'value' => $cv_birth_city)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_email'); ?></label> <span style="color:red;">*</span>
		<span class='custom_fields_more_info' id='more_info_cv_email'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_email'>
			<?php echo elgg_echo('edujobs:add:cv_email:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_email', 'value' => $cv_email)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_telephone'); ?></label> 
		<span class='custom_fields_more_info' id='more_info_cv_telephone'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_telephone'>
			<?php echo elgg_echo('edujobs:add:cv_telephone:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_telephone', 'value' => $cv_telephone)); ?>
	</div>
</div>

<div class="form-wide">
	<div class='form-left'>
		<label><?php echo elgg_echo('edujobs:add:cv_address'); ?></label>
		<span class='custom_fields_more_info' id='more_info_cv_address'></span>
		<span class='custom_fields_more_info_text' id='text_more_info_cv_address'>
			<?php echo elgg_echo('edujobs:add:cv_address:note'); ?>
		</span>
	</div>
	<div class='form-right'>
		<?php echo elgg_view('input/text', array('name' => 'cv_address', 'value' => $cv_address)); ?>
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
    echo elgg_view('input/submit', array('value' => elgg_echo('edujobs:add:submit:next')));
?>
</div>
