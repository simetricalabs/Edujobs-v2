<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');
$user = elgg_get_logged_in_user_entity();

if (check_if_user_is_teacher($user))   {
    // Get variables
    $cvedu_degree = get_input("cvedu_degree");
    $cvedu_school_name = get_input("cvedu_school_name");
    $cvedu_country = get_input("cvedu_country");
    $cvedu_city = get_input("cvedu_city");
    $cvedu_time_currently = get_input("cvedu_time_currently");
    $cvedu_time_from = get_input("cvedu_time_from");
    $cvedu_time_to = get_input("cvedu_time_to");
    $access_id = (int) get_input("access_id");
    $guid = (int) get_input('object_guid');
    $container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
    
	elgg_make_sticky_form('educvedupost');
	
	$error_fields_missing = false;
	if (!$cvedu_degree) {
		register_error(elgg_echo('edujobs:cv:missing:cvedu_degree'));
		$error_fields_missing = true;
    } 
    
	if (!$cvedu_school_name) {
		register_error(elgg_echo('edujobs:cv:missing:cvedu_school_name'));
		$error_fields_missing = true;
    } 
    
	if (!$cvedu_country) {
		register_error(elgg_echo('edujobs:cv:missing:cvedu_country'));
		$error_fields_missing = true;
    } 
    
	if (!$cvedu_city) {
		register_error(elgg_echo('edujobs:cv:missing:cvedu_city'));
		$error_fields_missing = true;
    } 
    
	if (!$cvedu_time_from) {
		register_error(elgg_echo('edujobs:cv:missing:cvedu_time_from'));
		$error_fields_missing = true;
    } 
    
	if (!$cvedu_time_to && !$cvedu_time_currently) {
		register_error(elgg_echo('edujobs:cv:missing:cvedu_time_to'));
		$error_fields_missing = true;
    } 
    
	if ($error_fields_missing)	{	
		register_error(elgg_echo('edujobs:cv:missing_fields'));
		forward(REFERER);
	}     
    
    if ($guid == 0) {
        $cvedu = new ElggObject;
        $cvedu->subtype = "educvedu";        
        $cvedu->container_guid = $container_guid;
        
        // Set its owner to the current user
		$cvedu->owner_guid = elgg_get_logged_in_user_guid();
    } else {
        $cvedu = get_entity($guid);
        if (!$cvedu->canEdit()) {
            system_message(elgg_echo('edujobs:cv:add:edu:failed'));
            forward(REFERRER);
        }
        
    }    
    
    $cvedu->cvedu_degree = $cvedu_degree; 
    $cvedu->cvedu_school_name = $cvedu_school_name; 
    $cvedu->cvedu_country = $cvedu_country; 
    $cvedu->cvedu_city = $cvedu_city; 
    $cvedu->cvedu_time_currently = $cvedu_time_currently; 
    $cvedu->cvedu_time_from = $cvedu_time_from; 
    $cvedu->cvedu_time_to = $cvedu_time_to; 
  
    $cvedu->access_id = $access_id;
    
    if ($cvedu->save()) {
        elgg_clear_sticky_form('educvedupost');

        system_message(elgg_echo('edujobs:cv:add:edu:success'));
    } else {
        register_error(elgg_echo('edujobs:cv:add:edu:failed'));
    }   
    
    forward('edujobs/teachers/addcv4/'.$user->guid); 
}
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward('edujobs/teachers/mycv'); 
}
