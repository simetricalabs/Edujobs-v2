<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');
$user = elgg_get_logged_in_user_entity();

if (check_if_user_is_teacher($user))   {
    // Get variables
    $cvwe_job_title = get_input("cvwe_job_title");
    $cvwe_organization = get_input("cvwe_organization");
    $cvwe_country = get_input("cvwe_country");
    $cvwe_city = get_input("cvwe_city");
    $cvwe_period_from = get_input("cvwe_period_from");
    $cvwe_period_to = get_input("cvwe_period_to");
    $cvwe_period_now = get_input("cvwe_period_now");
    $cvwe_salary_starting = get_input("cvwe_salary_starting");
    $cvwe_salary_ending = get_input("cvwe_salary_ending");
    $cvwe_salary_unit_time = get_input("cvwe_salary_unit_time");
    $cvwe_salary_currency = get_input("cvwe_salary_currency");
    $cvwe_reasons_go = get_input("cvwe_reasons_go");
    $cvwe_subject_math = get_input("cvwe_subject_math");
    $cvwe_subject_science = get_input("cvwe_subject_science");
    $cvwe_subject_socialstudies = get_input("cvwe_subject_socialstudies");
    $cvwe_subject_spanish = get_input("cvwe_subject_spanish");
    $cvwe_subject_english = get_input("cvwe_subject_english");
    $cvwe_subject_otherforeignlangs = get_input("cvwe_subject_otherforeignlangs");
    $cvwe_subject_technology = get_input("cvwe_subject_technology");
    $cvwe_subject_othersubjects = get_input("cvwe_subject_othersubjects");
    $cvwe_subject_othersubjects_text = get_input("cvwe_subject_othersubjects_text");
    $cvwe_grade_kindergarten = get_input("cvwe_grade_kindergarten");
    $cvwe_grade_earlyelementary = get_input("cvwe_grade_earlyelementary");
    $cvwe_grade_lateelementary = get_input("cvwe_grade_lateelementary");
    $cvwe_grade_middleschool = get_input("cvwe_grade_middleschool");
    $cvwe_grade_highschool = get_input("cvwe_grade_highschool");
    $cvwe_grade_othercategories = get_input("cvwe_grade_othercategories");
    $cvwe_grade_othercategories_text = get_input("cvwe_grade_othercategories_text");
    $tags = get_input("tags");    
    $cvwe_comments = get_input("cvwe_comments");
   
    $access_id = (int) get_input("access_id");
    $guid = (int) get_input('object_guid');
    $container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
    
	elgg_make_sticky_form('educvwepost');
	
	$error_fields_missing = false;
	if (!$cvwe_job_title) {
		register_error(elgg_echo('edujobs:cv:missing:cvwe_job_title'));
		$error_fields_missing = true;
    } 
    
	if (!$cvwe_organization) {
		register_error(elgg_echo('edujobs:cv:missing:cvwe_organization'));
		$error_fields_missing = true;
    } 
    
	if (!$cvwe_country) {
		register_error(elgg_echo('edujobs:cv:missing:cvwe_country'));
		$error_fields_missing = true;
    } 
    
	if (!$cvwe_city) {
		register_error(elgg_echo('edujobs:cv:missing:cvwe_city'));
		$error_fields_missing = true;
    } 
    
	if (!$cvwe_period_from) {
		register_error(elgg_echo('edujobs:cv:missing:cvwe_period_from'));
		$error_fields_missing = true;
    } 
    
	if (!$cvwe_period_to && !$cvwe_period_now) {
		register_error(elgg_echo('edujobs:cv:missing:cvwe_period_to'));
		$error_fields_missing = true;
    } 
    
	if ($error_fields_missing)	{	
		register_error(elgg_echo('edujobs:cv:missing_fields'));
		forward(REFERER);
	}     
    
    if ($guid == 0) {
        $cvwe = new ElggObject;
        $cvwe->subtype = "educvwe";        
        $cvwe->container_guid = $container_guid;
        
        // Set its owner to the current user
		$cvwe->owner_guid = elgg_get_logged_in_user_guid();
    } else {
        $cvwe = get_entity($guid);
        if (!$cvwe->canEdit()) {
            system_message(elgg_echo('edujobs:cv:add:we:failed'));
            forward(REFERRER);
        }
        
    }    
    
    
    $cvwe->cvwe_job_title = $cvwe_job_title; 
    $cvwe->cvwe_organization = $cvwe_organization; 
    $cvwe->cvwe_country = $cvwe_country; 
    $cvwe->cvwe_city = $cvwe_city; 
    $cvwe->cvwe_period_from = $cvwe_period_from; 
    $cvwe->cvwe_period_to = $cvwe_period_to; 
    $cvwe->cvwe_period_now = $cvwe_period_now; 
    $cvwe->cvwe_salary_starting = $cvwe_salary_starting; 
    $cvwe->cvwe_salary_ending = $cvwe_salary_ending; 
    $cvwe->cvwe_salary_unit_time = $cvwe_salary_unit_time; 
    $cvwe->cvwe_salary_currency = $cvwe_salary_currency; 
    $cvwe->cvwe_reasons_go = $cvwe_reasons_go; 
    $cvwe->cvwe_comments = $cvwe_comments; 
    $cvwe->cvwe_subject_math = $cvwe_subject_math; 
    $cvwe->cvwe_subject_science = $cvwe_subject_science; 
    $cvwe->cvwe_subject_socialstudies = $cvwe_subject_socialstudies; 
    $cvwe->cvwe_subject_spanish = $cvwe_subject_spanish; 
    $cvwe->cvwe_subject_english = $cvwe_subject_english; 
    $cvwe->cvwe_subject_otherforeignlangs = $cvwe_subject_otherforeignlangs; 
    $cvwe->cvwe_subject_technology = $cvwe_subject_technology; 
    $cvwe->cvwe_subject_othersubjects = $cvwe_subject_othersubjects; 
    $cvwe->cvwe_subject_othersubjects_text = $cvwe_subject_othersubjects_text; 
    $cvwe->cvwe_grade_kindergarten = $cvwe_grade_kindergarten; 
    $cvwe->cvwe_grade_earlyelementary = $cvwe_grade_earlyelementary; 
    $cvwe->cvwe_grade_lateelementary = $cvwe_grade_lateelementary; 
    $cvwe->cvwe_grade_middleschool = $cvwe_grade_middleschool; 
    $cvwe->cvwe_grade_highschool = $cvwe_grade_highschool; 
    $cvwe->cvwe_grade_othercategories = $cvwe_grade_othercategories; 
    $cvwe->cvwe_grade_othercategories_text = $cvwe_grade_othercategories_text; 
    //$tagarray = string_to_tag_array($tags); 
    $cvwe->tags = $tags;     
    $cvwe->access_id = $access_id;
    
    if ($cvwe->save()) {
        elgg_clear_sticky_form('educvwepost');

        system_message(elgg_echo('edujobs:cv:add::we:success'));
    } else {
        register_error(elgg_echo('edujobs:cv:add:we:failed'));
    }   
    
    forward('edujobs/teachers/addcv3/'.$user->guid); 
}
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward('edujobs/teachers/mycv'); 
}
