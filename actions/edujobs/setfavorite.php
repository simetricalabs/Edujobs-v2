<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

//register_error(elgg_echo('edujobs:jobapply:voted'));

elgg_load_library('elgg:edujobs');

$job_guid = get_input('job_guid');
if (!$job_guid) {	// if not job guid
	$errmsg = elgg_echo('edujobs:view:job:apply:notvalidjob');
}

$job = get_entity($job_guid);
if (!$job) {	// if not job entity
	$errmsg = elgg_echo('edujobs:view:job:apply:notvalidjob');
}

$user_guid = get_input('user_guid');
if (!$user_guid) {	// if not job guid
	$errmsg = elgg_echo('edujobs:view:job:applicants:notvalidpermissions');
}

if (!$job->canEdit()) {
	$errmsg = elgg_echo('edujobs:view:job:setfavorite:notvalidpermissions');
}

if ($errmsg)	{
	register_error($errmsg);
}
else {
	$options = array(
		'type' => 'object',
		'subtype' => 'jobappication',
		'limit' => 1,
		'metadata_name_value_pairs' => array(
			array('name' => 'user_guid','value' => $user_guid, 'operand' => '='),
			array('name' => 'job_guid', 'value' => $job_guid, 'operand' => '='),
		),
		'metadata_name_value_pairs_operator' => 'AND',
	);
	
	$jobapply = elgg_get_entities_from_metadata($options);
	
//print_r($jobapply);	
//system_message('---> '.count($jobapply));	
//system_message('---> '.$jobapply->guid);	

	if ($jobapply)	{
		foreach ($jobapply as $ja) {
			//$job = get_entity($jobapply->guid);
			//system_message('---> '.$job->guid);
			
			$ja->status = JOB_STATUS_FAVORITE;
			if ($ja->save()) {
				system_message(elgg_echo("edujobs:view:job:favorite:success"));
			}
			else {
				register_error(elgg_echo("edujobs:view:job:favorite:failed"));
			}				
		}
	}
	else {
		register_error(elgg_echo("edujobs:view:job:favorite:failed"));
	}	

}


forward(REFERER);
