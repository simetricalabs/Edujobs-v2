<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');
$user = elgg_get_logged_in_user_entity();

if (check_if_user_is_teacher($user))   {
    // Get variables
    $cv_position_looking_for = get_input("cv_position_looking_for");
    $cv_work_experience_years = get_input("cv_work_experience_years");
    $cv_salary_min_acceptable = get_input("cv_salary_min_acceptable");
    $cv_salary_unit_of_time = get_input("cv_salary_unit_of_time");
    $cv_salary_currency = get_input("cv_salary_currency");
    $cv_availability_date = get_input("cv_availability_date");
    $cv_availability_date_specify = get_input("cv_availability_date_specify");
    $cv_desired_work_type = get_input("cv_desired_work_type");
    $cv_subject_math = get_input("cv_subject_math");
    $cv_subject_science = get_input("cv_subject_science");
    $cv_subject_socialstudies = get_input("cv_subject_socialstudies");
    $cv_subject_spanish = get_input("cv_subject_spanish");
    $cv_subject_english = get_input("cv_subject_english");
    $cv_subject_otherforeignlangs = get_input("cv_subject_otherforeignlangs");
    $cv_subject_technology = get_input("cv_subject_technology");
    $cv_subject_othersubjects = get_input("cv_subject_othersubjects");
    $cv_subject_othersubjects_text = get_input("cv_subject_othersubjects_text");
    $cv_grade_kindergarten = get_input("cv_grade_kindergarten");
    $cv_grade_earlyelementary = get_input("cv_grade_earlyelementary");
    $cv_grade_lateelementary = get_input("cv_grade_lateelementary");
    $cv_grade_middleschool = get_input("cv_grade_middleschool");
    $cv_grade_highschool = get_input("cv_grade_highschool");
    $cv_grade_othercategories = get_input("cv_grade_othercategories");
    $cv_grade_othercategories_text = get_input("cv_grade_othercategories_text");
    $cv_more_info = get_input("cv_more_info");
    $cv_name = get_input("cv_name");        
   
    $guid = (int) get_input('object_guid');
 
	elgg_make_sticky_form('educvpost');
	
	$error_fields_missing = false;
	if (!$cv_position_looking_for) {
		register_error(elgg_echo('edujobs:cv:missing:cv_position_looking_for'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_work_experience_years) {
		register_error(elgg_echo('edujobs:cv:missing:cv_work_experience_years'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_salary_min_acceptable) {
		register_error(elgg_echo('edujobs:cv:missing:cv_salary_min_acceptable'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_salary_unit_of_time) {
		register_error(elgg_echo('edujobs:cv:missing:cv_salary_unit_of_time'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_salary_currency) {
		register_error(elgg_echo('edujobs:cv:missing:cv_salary_currency'));
		$error_fields_missing = true;
    } 
    
	if (!$cv_availability_date && !$cv_availability_date_specify) {
		register_error(elgg_echo('edujobs:cv:missing:cv_availability_date'));
		$error_fields_missing = true;
    } 

	if (!$cv_subject_math && !$cv_subject_science && !$cv_subject_socialstudies && !$cv_subject_spanish && !$cv_subject_english && !$cv_subject_otherforeignlangs && !$cv_subject_technology && !$cv_subject_othersubjects) {
		register_error(elgg_echo('edujobs:add:missing:cv_subject'));
		$error_fields_missing = true;
    }  
    
	if ($cv_subject_othersubjects && !$cv_subject_othersubjects_text) {
		register_error(elgg_echo('edujobs:add:missing:cv_othersubject'));
		$error_fields_missing = true;
    }      

	if (!$cv_grade_kindergarten && !$cv_grade_earlyelementary && !$cv_grade_lateelementary && !$cv_grade_middleschool && !$cv_grade_highschool && !$cv_grade_othercategories) {
		register_error(elgg_echo('edujobs:add:missing:cv_grade'));
		$error_fields_missing = true;
    }    
    
	if ($cv_grade_othercategories && !$cv_grade_othercategories_text) {
		register_error(elgg_echo('edujobs:add:missing:cv_othergrade'));
		$error_fields_missing = true;
    } 
    
    if ($error_fields_missing)	{	
		register_error(elgg_echo('edujobs:cv:missing_fields'));
		forward(REFERER);
	}     
    
    if ($guid > 0) {
        $cv = get_entity($guid);
        if (!$cv->canEdit()) {
            system_message(elgg_echo('edujobs:cv:add:failed'));
            forward(REFERRER);
        }
    }  
    else {
		system_message(elgg_echo('edujobs:cv:add:failed'));
		forward(REFERRER);		
	}
	
    $cv->cv_position_looking_for = $cv_position_looking_for; 
    $cv->cv_work_experience_years = $cv_work_experience_years; 
    $cv->cv_salary_min_acceptable = $cv_salary_min_acceptable; 
    $cv->cv_salary_unit_of_time = $cv_salary_unit_of_time; 
    $cv->cv_salary_currency = $cv_salary_currency; 
    $cv->cv_availability_date = $cv_availability_date; 
    $cv->cv_availability_date_specify = $cv_availability_date_specify; 
    $cv->cv_desired_work_type = $cv_desired_work_type; 
    $cv->cv_subject_math = $cv_subject_math; 
    $cv->cv_subject_science = $cv_subject_science; 
    $cv->cv_subject_socialstudies = $cv_subject_socialstudies; 
    $cv->cv_subject_spanish = $cv_subject_spanish; 
    $cv->cv_subject_english = $cv_subject_english; 
    $cv->cv_subject_otherforeignlangs = $cv_subject_otherforeignlangs; 
    $cv->cv_subject_technology = $cv_subject_technology; 
    $cv->cv_subject_othersubjects = $cv_subject_othersubjects; 
    $cv->cv_subject_othersubjects_text = $cv_subject_othersubjects_text; 
    $cv->cv_grade_kindergarten = $cv_grade_kindergarten; 
    $cv->cv_grade_earlyelementary = $cv_grade_earlyelementary; 
    $cv->cv_grade_lateelementary = $cv_grade_lateelementary; 
    $cv->cv_grade_middleschool = $cv_grade_middleschool; 
    $cv->cv_grade_highschool = $cv_grade_highschool; 
    $cv->cv_grade_othercategories = $cv_grade_othercategories; 
    $cv->cv_grade_othercategories_text = $cv_grade_othercategories_text; 
    $cv->cv_more_info = $cv_more_info; 
            
    if ($cv->save()) {
        elgg_clear_sticky_form('educvpost');

        system_message(elgg_echo('edujobs:cv:add:success'));
    } else {
        register_error(elgg_echo('edujobs:cv:add:failed'));
    }   
    forward('edujobs/teachers/addcv3/'.$user->guid); 
    //forward('edujobs/teachers/mycv'); 
}
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward('edujobs/teachers/mycv'); 
}
