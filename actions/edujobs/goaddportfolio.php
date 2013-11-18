<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');
$user = elgg_get_logged_in_user_entity();

if (check_if_user_is_teacher($user))   {
    // Get variables
    $cvport_title = get_input("cvport_title");
    $cvport_type = get_input("cvport_type");
    $cvport_link = get_input("cvport_link");
    //$cvport_file = get_input("cvport_file");
    $cvport_subject_math = get_input("cvport_subject_math");
    $cvport_subject_science = get_input("cvport_subject_science");
    $cvport_subject_socialstudies = get_input("cvport_subject_socialstudies");
    $cvport_subject_spanish = get_input("cvport_subject_spanish");
    $cvport_subject_english = get_input("cvport_subject_english");
    $cvport_subject_otherforeignlangs = get_input("cvport_subject_otherforeignlangs");
    $cvport_subject_technology = get_input("cvport_subject_technology");
    $cvport_subject_othersubjects = get_input("cvport_subject_othersubjects");
    $cvport_subject_othersubjects_text = get_input("cvport_subject_othersubjects_text");
    $cvport_grade_kindergarten = get_input("cvport_grade_kindergarten");
    $cvport_grade_earlyelementary = get_input("cvport_grade_earlyelementary");
    $cvport_grade_lateelementary = get_input("cvport_grade_lateelementary");
    $cvport_grade_middleschool = get_input("cvport_grade_middleschool");
    $cvport_grade_highschool = get_input("cvport_grade_highschool");
    $cvport_grade_othercategories = get_input("cvport_grade_othercategories");
    $cvport_grade_othercategories_text = get_input("cvport_grade_othercategories_text");
    $cvport_recommend = get_input("cvport_recommend");
            
    $tags = get_input("tags");
    $access_id = (int) get_input("access_id");
    $guid = (int) get_input('object_guid');
    $container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
    
	elgg_make_sticky_form('educvportpost');
	
	$error_fields_missing = false;
	if (!$cvport_title) {
		register_error(elgg_echo('edujobs:cv:missing:cvport_title'));
		$error_fields_missing = true;
    } 
    
    // check if not or file for new entities
	if (!$cvport_link && $_FILES["cvport_file"]["error"] == 4 && $guid == 0) {
		register_error(elgg_echo('edujobs:cv:missing:cvport_type'));
		$error_fields_missing = true;
    }    
    
	if (!$cvport_recommend) {
		register_error(elgg_echo('edujobs:cv:missing:cvport_recommend'));
		$error_fields_missing = true;
    } 
    
    if ($cvport_link)	{
		// don't use elgg_normalize_url() because we don't want
		// relative links resolved to this site.
		if ($cvport_link && !preg_match("#^((ht|f)tps?:)?//#i", $cvport_link)) {
				$cvport_link = "http://$cvport_link";
		}  
		
		$validated = false;
		if ($php_5_2_13_and_below || $php_5_3_0_to_5_3_2) {
				$tmp_address = str_replace("-", "", $cvport_link);
				$validated = filter_var($tmp_address, FILTER_VALIDATE_URL);
		} else {
				$validated = filter_var($cvport_link, FILTER_VALIDATE_URL);
		}
		if (!$validated) {
				register_error(elgg_echo('edujobs:cv:novalid_cvport_link'));
				$error_fields_missing = true;
		}     
	}
	
	if (!$cvport_subject_math && !$cvport_subject_science && !$cvport_subject_socialstudies && !$cvport_subject_spanish && !$cvport_subject_english && !$cvport_subject_otherforeignlangs && !$cvport_subject_technology && !$cvport_subject_othersubjects) {
		register_error(elgg_echo('edujobs:add:missing:cv_subject'));
		$error_fields_missing = true;
    }  
    
	if ($cvport_subject_othersubjects && !$cvport_subject_othersubjects_text) {
		register_error(elgg_echo('edujobs:add:missing:cv_othersubject'));
		$error_fields_missing = true;
    }      

	if (!$cvport_grade_kindergarten && !$cvport_grade_earlyelementary && !$cvport_grade_lateelementary && !$cvport_grade_middleschool && !$cvport_grade_highschool && !$cvport_grade_othercategories) {
		register_error(elgg_echo('edujobs:add:missing:cv_grade'));
		$error_fields_missing = true;
    }    
    
	if ($cvport_grade_othercategories && !$cvport_grade_othercategories_text) {
		register_error(elgg_echo('edujobs:add:missing:cv_othergrade'));
		$error_fields_missing = true;
    }     
    
	// Check if work file uploaded and if it is valid file
	$cvport_file_file = false;
	if ($_FILES["cvport_file"]["error"] != 4) {
		$allowedExts = array("jpg", "JPG", "jpeg", "JPEG", "pdf", "PDF");
		$temp = explode(".", $_FILES["cvport_file"]["name"]);
		$extension = end($temp);
		
		if (!in_array($extension, $allowedExts)) {
			register_error(elgg_echo('edujobs:portfolio:cvport_file:wrong_type'));  
			$error_fields_missing = true;		
		}
		else
		{
			$cvport_file_file = true;
		}
	}     
    
	if ($error_fields_missing)	{	
		register_error(elgg_echo('edujobs:cv:missing_fields'));
		forward(REFERER);
	}     
    
    if ($guid == 0) {
        $cvport = new ElggObject;
        $cvport->subtype = "educvport";        
        $cvport->container_guid = $container_guid;
        
        // Set its owner to the current user
		$cvport->owner_guid = elgg_get_logged_in_user_guid();
    } else {
        $cvport = get_entity($guid);
        if (!$cvport->canEdit()) {
            system_message(elgg_echo('edujobs:cv:add:portfolio:failed'));
            forward(REFERRER);
        }
        
    }    

	$tagarray = string_to_tag_array($tags);   
    $cvport->cvport_title = $cvport_title; 
    $cvport->cvport_type = $cvport_type; 
    $cvport->cvport_link = $cvport_link; 
    $cvport->cvport_subject_math = $cvport_subject_math; 
    $cvport->cvport_subject_science = $cvport_subject_science; 
    $cvport->cvport_subject_socialstudies = $cvport_subject_socialstudies; 
    $cvport->cvport_subject_spanish = $cvport_subject_spanish; 
    $cvport->cvport_subject_english = $cvport_subject_english; 
    $cvport->cvport_subject_otherforeignlangs = $cvport_subject_otherforeignlangs; 
    $cvport->cvport_subject_technology = $cvport_subject_technology; 
    $cvport->cvport_subject_othersubjects = $cvport_subject_othersubjects; 
    $cvport->cvport_subject_othersubjects_text = $cvport_subject_othersubjects_text; 
    $cvport->cvport_grade_kindergarten = $cvport_grade_kindergarten; 
    $cvport->cvport_grade_earlyelementary = $cvport_grade_earlyelementary; 
    $cvport->cvport_grade_lateelementary = $cvport_grade_lateelementary; 
    $cvport->cvport_grade_middleschool = $cvport_grade_middleschool; 
    $cvport->cvport_grade_highschool = $cvport_grade_highschool; 
    $cvport->cvport_grade_othercategories = $cvport_grade_othercategories; 
    $cvport->cvport_grade_othercategories_text = $cvport_grade_othercategories_text; 
    $cvport->cvport_recommend = $cvport_recommend; 
    $cvport->tags = $tagarray;

    $cvport->access_id = $access_id;    
    
    if ($cvport->save()) {
		if ($cvport_file_file) {	
			$prefix = "cvport-".$cvport->guid;
			$filehandler = new ElggFile();
            $mime_type = $filehandler->detectMimeType($_FILES['cvport_file']['tmp_name'], $_FILES['cvport_file']['type']);
            
            $filehandler->owner_guid = $cvport->owner_guid;
            $filehandler->container_guid = $cvport->container_guid;
            $filehandler->cvport_guid = $cvport->guid;
            $filehandler->originalfilename = $_FILES['cvport_file']['name'];
            $filehandler->setMimeType($mime_type);
			$filehandler->simpletype = file_get_simple_type($mime_type);
			$filehandler->setFilename($prefix . ".".$extension);
			$filehandler->title = $cvport_title .' - '. elgg_echo('edujobs:add:cvport_file:title');
			$filehandler->access_id = $cvport->access_id;
			//$filehandler->setFilename($_FILES['cvport_file']['name']);

			// build file description 
			// subject
			$subject = '';
			if ($cvport->cvport_subject_math) { $subject .= elgg_echo('edujobs:add:cv_subject_math') . ', ';}
			if ($cvport->cvport_subject_science) { $subject .= elgg_echo('edujobs:add:cv_subject_science') . ', ';}
			if ($cvport->cvport_subject_socialstudies) { $subject .= elgg_echo('edujobs:add:cv_subject_socialstudies') . ', ';}
			if ($cvport->cvport_subject_spanish) { $subject .= elgg_echo('edujobs:add:cv_subject_spanish') . ', ';}
			if ($cvport->cvport_subject_english) { $subject .= elgg_echo('edujobs:add:cv_subject_english') . ', ';}
			if ($cvport->cvport_subject_otherforeignlangs) { $subject .= elgg_echo('edujobs:add:cv_subject_otherforeignlangs') . ', ';}
			if ($cvport->cvport_subject_technology) { $subject .= elgg_echo('edujobs:add:cv_subject_technology') . ', ';}
			if ($cvport->cvport_subject_othersubjects && $cvport->cvport_subject_othersubjects_text) { $subject .= $cvport->cvport_subject_othersubjects_text . ', ';}
			$subject = substr_replace($subject ,"",-2);
			// grade
			$grade = '';
			if ($cvport->cvport_grade_kindergarten) { $grade .= elgg_echo('edujobs:add:cv_grade_kindergarten') . ', ';}
			if ($cvport->cvport_grade_earlyelementary) { $grade .= elgg_echo('edujobs:add:cv_grade_earlyelementary') . ', ';}
			if ($cvport->cvport_grade_lateelementary) { $grade .= elgg_echo('edujobs:add:cv_grade_lateelementary') . ', ';}
			if ($cvport->cvport_grade_middleschool) { $grade .= elgg_echo('edujobs:add:cv_grade_middleschool') . ', ';}
			if ($cvport->cvport_grade_highschool) { $grade .= elgg_echo('edujobs:add:cv_grade_highschool') . ', ';}
			if ($cvport->cvport_grade_othercategories && $cvport->cvport_grade_othercategories_text) { $grade .= $cvport->cvport_grade_othercategories_text . ', ';}
			$grade = substr_replace($grade ,"",-2);

			$description =  ''.elgg_echo('edujobs:add:subject').': '.$subject.'';
			$description .=  '<br />'.elgg_echo('edujobs:add:grade').': '.$grade.'';
			if ($cvport->cvport_recommend) $description .=  '<br />'.elgg_echo('edujobs:cv:portfolio:whyrecommend').$cvport->cvport_recommend.'';	
			$filehandler->description = $description;		
			
            $filehandler->open("write");
            $filehandler->write(get_uploaded_file('cvport_file'));
            $filehandler->close();
            move_uploaded_file($_FILES['cvport_file']['tmp_name'], $filehandler->getFilenameOnFilestore());
            $filehandler->save();
		} 		
		
		
        elgg_clear_sticky_form('educvportpost');

        system_message(elgg_echo('edujobs:cv:add:portfolio:success'));
    } else {
        register_error(elgg_echo('edujobs:cv:add:portfolio:failed'));
    }   
    
    forward('edujobs/teachers/addcv7/'.$user->guid); 
}
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward('edujobs/teachers/mycv'); 
}
