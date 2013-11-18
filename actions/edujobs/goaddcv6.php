<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');
$user = elgg_get_logged_in_user_entity();

if (check_if_user_is_teacher($user))   {
    // Get variables
    $cv_paste_cv = get_input("cv_paste_cv");
    $guid = (int) get_input('object_guid');
 
	elgg_make_sticky_form('educvpost');
	
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
		
    $cv->cv_paste_cv = $cv_paste_cv; 
               
    if ($cv->save()) {
        elgg_clear_sticky_form('educvpost');

        system_message(elgg_echo('edujobs:cv:add:success'));
    } else {
        register_error(elgg_echo('edujobs:cv:add:failed'));
    }   
    //forward('edujobs/teachers/addcv3/'.$user->guid); 
    forward('edujobs/teachers/mycv'); 
}
else    {  
    register_error(elgg_echo('edujobs:cv:noaccessforpost'));  
    forward('edujobs/teachers/mycv'); 
}
