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

$user = elgg_get_logged_in_user_entity();
if (!$user) {	// if not user login
	$errmsg = elgg_echo('edujobs:view:job:apply:notvalidjob');
}

if ($errmsg)	{
	register_error($errmsg);
}
else if (check_if_user_has_apply($user->guid, $job->guid)) {
	register_error(elgg_echo('edujobs:view:job:apply:alreadyapplied'));
}

//if (check_if_job_expired($job->time_created, $job->published_until))  {
if ($job->published_until_final < time())  {	
	register_error(elgg_echo('edujobs:view:job:expired_simple'));
}
else
{
	$jobapply = new ElggObject;
	$jobapply->subtype = "jobappication";
	$jobapply->access_id = 2; // public access for this entry. Required for counting no of applies for sorting
	$jobapply->save();

	// set object metadata
	$jobapply->container_guid = $job->container_guid;
	//$jobapply->owner_guid = $job->owner_guid;	
	$jobapply->user_guid = $user->guid;
	$jobapply->job_guid = $job->guid;
	//$jobapply->job_guid = JOB_STATUS_NORMAL;
	
	if ($jobapply->save()) {
		system_message(elgg_echo("edujobs:view:job:apply:success"));
	}
	else {
		register_error(elgg_echo("edujobs:view:job:apply:failed"));
	}	
}


forward(REFERER);
