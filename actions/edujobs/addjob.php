<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');

date_default_timezone_set('UTC');
$user = elgg_get_logged_in_user_entity();

if (check_if_user_can_post_jobs($user))   {
    // Get variables
    $title = get_input("title");	
    $subject_math = get_input("subject_math");
    $subject_science = get_input("subject_science");
    $subject_socialstudies = get_input("subject_socialstudies");
    $subject_spanish = get_input("subject_spanish");
    $subject_english = get_input("subject_english");
    $subject_otherforeignlangs = get_input("subject_otherforeignlangs");
    $subject_technology = get_input("subject_technology");
    $subject_othersubjects = get_input("subject_othersubjects");
    $subject_othersubjects_text = get_input("subject_othersubjects_text");
    $grade_kindergarten = get_input("grade_kindergarten");
    $grade_earlyelementary = get_input("grade_earlyelementary");
    $grade_lateelementary = get_input("grade_lateelementary");
    $grade_middleschool = get_input("grade_middleschool");
    $grade_highschool = get_input("grade_highschool");
    $grade_othercategories = get_input("grade_othercategories");
    $grade_othercategories_text = get_input("grade_othercategories_text");
    $description = get_input("description");
    $country = get_input("country");
    $city = get_input("city");
    $published_until = get_input("published_until");
    $tags = get_input("tags");
    $access_id = (int) get_input("access_id");
    $guid = (int) get_input('object_guid');
    $container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
    //$comments_on = get_input("comments_on");    
 
	elgg_make_sticky_form('edujobspost');
	
	$error_fields_missing = false;
	if (!$title) {
		register_error(elgg_echo('edujobs:add:missing:title'));
		$error_fields_missing = true;
    } 
    
	if (!$subject_math && !$subject_science && !$subject_socialstudies && !$subject_spanish && !$subject_english && !$subject_otherforeignlangs && !$subject_technology && !$subject_othersubjects) {
		register_error(elgg_echo('edujobs:add:missing:subject'));
		$error_fields_missing = true;
    }  
    
	if ($subject_othersubjects && !$subject_othersubjects_text) {
		register_error(elgg_echo('edujobs:add:missing:othersubject'));
		$error_fields_missing = true;
    }      
    
	if (!$grade_kindergarten && !$grade_earlyelementary && !$grade_lateelementary && !$grade_middleschool && !$grade_highschool && !$grade_othercategories) {
		register_error(elgg_echo('edujobs:add:missing:grade'));
		$error_fields_missing = true;
    }    
    
	if ($grade_othercategories && !$grade_othercategories_text) {
		register_error(elgg_echo('edujobs:add:missing:othergrade'));
		$error_fields_missing = true;
    }      
    
	if (!$description) {
		register_error(elgg_echo('edujobs:add:missing:description'));
		$error_fields_missing = true;
    }   
    
	if (!$country) {
		register_error(elgg_echo('edujobs:add:missing:country'));
		$error_fields_missing = true;
    }   
    
	if (!$city) {
		register_error(elgg_echo('edujobs:add:missing:city'));
		$error_fields_missing = true;
    }
    
	if (!$published_until) {
		register_error(elgg_echo('edujobs:add:missing:published_until'));
		$error_fields_missing = true;
    }
    
    if ($error_fields_missing)	{	
		register_error(elgg_echo('edujobs:add:job:missing_fields'));
		forward(REFERER);
	}    
    
    // check whether this is a new job or an edit
    $new_job = true;
    if ($guid > 0) {
            $new_job = false;
    }    
    
    if ($guid == 0) {
        $job = new ElggObject;
        $job->subtype = "edujobs";        
        $job->container_guid = $container_guid;
        $new = true;
        $start_time = time();
        
        // Set its owner to the current user
		$job->owner_guid = elgg_get_logged_in_user_guid();
    } else {
        $job = get_entity($guid);
        if (!$job->canEdit()) {
            system_message(elgg_echo('edujobs:add:job:failed'));
            forward(REFERRER);
        }
        
        $start_time = $job->time_created;
        if (!$title) {
            // user blanked title, but we need one
            $title = $job->title;
        }    
        
    }    
    
    $tagarray = string_to_tag_array($tags);   
  
    $job->title = $title; 
    $job->subject_math = $subject_math; 
    $job->subject_science = $subject_science; 
    $job->subject_socialstudies = $subject_socialstudies; 
    $job->subject_spanish = $subject_spanish; 
    $job->subject_english = $subject_english; 
    $job->subject_otherforeignlangs = $subject_otherforeignlangs; 
    $job->subject_technology = $subject_technology; 
    $job->subject_othersubjects = $subject_othersubjects; 
    $job->subject_othersubjects_text = $subject_othersubjects_text; 
    $job->grade_kindergarten = $grade_kindergarten; 
    $job->grade_earlyelementary = $grade_earlyelementary; 
    $job->grade_lateelementary = $grade_lateelementary; 
    $job->grade_middleschool = $grade_middleschool; 
    $job->grade_highschool = $grade_highschool; 
    $job->grade_othercategories = $grade_othercategories; 
    $job->grade_othercategories_text = $grade_othercategories_text;
    $job->description = $description; 
    $job->country = $country; 
    $job->city = $city; 
    $job->published_until = $published_until; 
    $job->published_until_final = $start_time + $published_until;  //unixtime that job stop published
    $job->noofapplicants = 0; 
    $job->access_id = $access_id;
    $job->tags = $tagarray;
    $job->comments_on = 'Off';

    if ($job->save()) {
		elgg_clear_sticky_form('edujobspost');

        system_message(elgg_echo('edujobs:add:job:success'));
        
        //add to river only if new
        if ($new) {
            add_to_river('river/object/edujobs/create','create', elgg_get_logged_in_user_guid(), $job->getGUID());
        }        

        forward($job->getURL());
    } else {
        register_error(elgg_echo('edujobs:add:job:failed'));
        forward("edujobs/jobs");
    }    
}
else    {  
    register_error(elgg_echo('edujobs:add:noaccessforpost'));  
    forward(REFERER);    
}
