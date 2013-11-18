<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');
$user = elgg_get_logged_in_user_entity();

if (check_if_user_is_teacher($user))   {
    // Get variables
    $cv_name = get_input("cv_name");
    $cv_last_name = get_input("cv_last_name");
    $cv_description = get_input("cv_description");
    $cv_gender = get_input("cv_gender");
    $cv_birth_date = get_input("cv_birth_date");
    $cv_birth_country = get_input("cv_birth_country");
    $cv_birth_city = get_input("cv_birth_city");
    $cv_email = get_input("cv_email");
    $cv_telephone = get_input("cv_telephone");
    $cv_address = get_input("cv_address");
   
    $tags = get_input("tags");
    $access_id = (int) get_input("access_id");
    $guid = (int) get_input('object_guid');
    $container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
    //$comments_on = get_input("comments_on");    
 
	elgg_make_sticky_form('educvpost');
	
	$error_fields_missing = false;
	if (!$cv_name) {
		register_error(elgg_echo('edujobs:cv:missing:cv_name'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_last_name) {
		register_error(elgg_echo('edujobs:cv:missing:cv_last_name'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_description) {
		register_error(elgg_echo('edujobs:cv:missing:cv_description'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_gender) {
		register_error(elgg_echo('edujobs:cv:missing:cv_gender'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_birth_date) {
		register_error(elgg_echo('edujobs:cv:missing:cv_birth_date'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_birth_country) {
		register_error(elgg_echo('edujobs:cv:missing:cv_birth_country'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_birth_city) {
		register_error(elgg_echo('edujobs:cv:missing:cv_birth_city'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_email) {
		register_error(elgg_echo('edujobs:cv:missing:cv_email'));
		$error_fields_missing = true;
    } 
        
    
    if ($error_fields_missing)	{	
		register_error(elgg_echo('edujobs:cv:missing_fields'));
		forward(REFERER);
	}     
    
	// check whether this is a new cv or an edit
    $new_cv = true;
    if ($guid > 0) {
		$new_cv = false;
    }    
    
    if ($guid == 0) {
        $cv = new ElggObject;
        $cv->subtype = "educv";        
        $cv->container_guid = $container_guid;
        
        // Set its owner to the current user
		$cv->owner_guid = elgg_get_logged_in_user_guid();
    } else {
        $cv = get_entity($guid);
        if (!$cv->canEdit()) {
            system_message(elgg_echo('edujobs:cv:add:failed'));
            forward(REFERRER);
        }
        
    }    
    
    $tagarray = string_to_tag_array($tags);   
  
    $cv->cv_name = $cv_name; 
    $cv->cv_last_name = $cv_last_name; 
    $cv->cv_description = $cv_description; 
    $cv->cv_gender = $cv_gender; 
    $cv->cv_birth_date = $cv_birth_date; 
    $cv->cv_birth_country = $cv_birth_country; 
    $cv->cv_birth_city = $cv_birth_city; 
    $cv->cv_email = $cv_email; 
    $cv->cv_telephone = $cv_telephone; 
    $cv->cv_address = $cv_address; 
    
    $cv->access_id = $access_id;
    $cv->tags = $tagarray;
    $cv->comments_on = 'Off';
    
    if ($cv->save()) {
        elgg_clear_sticky_form('educvpost');

        system_message(elgg_echo('edujobs:cv:add:success'));
    } else {
        register_error(elgg_echo('edujobs:cv:add:failed'));
    }   
    
    forward('edujobs/teachers/addcv2/'.$user->guid); 
    //forward('edujobs/teachers/addcv2/'.$user->guid); 
}
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward('edujobs/teachers/mycv'); 
}
