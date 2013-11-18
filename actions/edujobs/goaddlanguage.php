<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');
$user = elgg_get_logged_in_user_entity();

if (check_if_user_is_teacher($user))   {
    // Get variables
    $cvlang_language = get_input("cvlang_language");
    $cvlang_level = get_input("cvlang_level");
    $cvlang_cert_institute = get_input("cvlang_cert_institute");
    $cvlang_reading_score = get_input("cvlang_reading_score");
    $cvlang_listening_score = get_input("cvlang_listening_score");
    $cvlang_speaking_score = get_input("cvlang_speaking_score");
    $cvlang_writing_score = get_input("cvlang_writing_score");
    $cvlang_total_score = get_input("cvlang_total_score");
    $cvlang_cert_document = get_input("cvlang_cert_document");

    $access_id = (int) get_input("access_id");
    $guid = (int) get_input('object_guid');
    $container_guid = get_input('container_guid', elgg_get_logged_in_user_guid());
    
	elgg_make_sticky_form('educvlangpost');
	
	$error_fields_missing = false;
	if (!$cvlang_language) {
		register_error(elgg_echo('edujobs:cv:missing:cvlang_language'));
		$error_fields_missing = true;
    } 
    
	if (!$cvlang_level) {
		register_error(elgg_echo('edujobs:cv:missing:cvlang_level'));
		$error_fields_missing = true;
    }     
    
	// Check if work file uploaded and if it is valid file
	$cvlang_cert_document_file = false;
	if ($_FILES["cvlang_cert_document"]["error"] != 4) {
		$allowedExts = array("jpg", "JPG", "jpeg", "JPEG", "pdf", "PDF");
		$temp = explode(".", $_FILES["cvlang_cert_document"]["name"]);
		$extension = end($temp);
		
		if (!in_array($extension, $allowedExts)) {
			register_error(elgg_echo('edujobs:lang:cvlang_cert_document:wrong_type'));  
			$error_fields_missing = true;		
		}
		else
		{
			$cvlang_cert_document_file = true;
		}
	}     
    
	if ($error_fields_missing)	{	
		register_error(elgg_echo('edujobs:cv:missing_fields'));
		forward(REFERER);
	}     
    
    if ($guid == 0) {
        $cvlang = new ElggObject;
        $cvlang->subtype = "educvlang";        
        $cvlang->container_guid = $container_guid;
        
        // Set its owner to the current user
		$cvlang->owner_guid = elgg_get_logged_in_user_guid();
    } else {
        $cvlang = get_entity($guid);
        if (!$cvlang->canEdit()) {
            system_message(elgg_echo('edujobs:cv:add:lang:failed'));
            forward(REFERRER);
        }
        
    }    

    $cvlang->cvlang_language = $cvlang_language; 
    $cvlang->cvlang_level = $cvlang_level; 
    $cvlang->cvlang_cert_institute = $cvlang_cert_institute; 
    $cvlang->cvlang_reading_score = $cvlang_reading_score; 
    $cvlang->cvlang_listening_score = $cvlang_listening_score; 
    $cvlang->cvlang_speaking_score = $cvlang_speaking_score; 
    $cvlang->cvlang_writing_score = $cvlang_writing_score; 
    $cvlang->cvlang_total_score = $cvlang_total_score; 
    //$cvlang->cvlang_cert_document = $cvlang_cert_document; 
    $cvlang->access_id = $access_id;
    
    if ($cvlang->save()) {
		if ($cvlang_cert_document_file) {	
			$prefix = "cvlang-".$cvlang->guid;
			$filehandler = new ElggFile();
            $mime_type = $filehandler->detectMimeType($_FILES['cvlang_cert_document']['tmp_name'], $_FILES['cvlang_cert_document']['type']);
            
            $filehandler->owner_guid = $cvlang->owner_guid;
            $filehandler->container_guid = $cvlang->container_guid;
            $filehandler->cvlang_guid = $cvlang->guid;
            $filehandler->originalfilename = $_FILES['cvlang_cert_document']['name'];
            $filehandler->setMimeType($mime_type);
			$filehandler->simpletype = file_get_simple_type($mime_type);
			$filehandler->setFilename($prefix . ".".$extension);
			$filehandler->title = $cvlang_language .' - '. elgg_echo('edujobs:add:cvlang_cert_document:title');
			//$filehandler->setFilename($_FILES['cvlang_cert_document']['name']);
			
            $filehandler->open("write");
            $filehandler->write(get_uploaded_file('cvlang_cert_document'));
            $filehandler->close();
            move_uploaded_file($_FILES['cvlang_cert_document']['tmp_name'], $filehandler->getFilenameOnFilestore());
            $filehandler->save();
		} 		
		
		
        elgg_clear_sticky_form('educvlangpost');

        system_message(elgg_echo('edujobs:cv:add:lang:success'));
    } else {
        register_error(elgg_echo('edujobs:cv:add:lang:failed'));
    }   
    
    forward('edujobs/teachers/addcv5/'.$user->guid); 
}
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward('edujobs/teachers/mycv'); 
}
