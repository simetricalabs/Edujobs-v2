<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

// Load Elgg engine
require_once(dirname(dirname(dirname(__FILE__))) . "/engine/start.php");
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

echo '<div style="width:300px; height:100px;display:table-cell; vertical-align:middle;text-align:center;">';

if ($errmsg)	{
	echo $errmsg;
}
else if (check_if_user_has_apply($user->guid, $job->guid)) {
	echo '<h3>'.elgg_echo('edujobs:view:job:apply:alreadyapplied').'</h3>';
}
else
{
	$jobapply = new ElggObject;
	$jobapply->subtype = "jobappication";
	$jobapply->access_id = 0;
	$jobapply->save();

	// set object metadata
	//$jobapply->container_guid = $job->container_guid;
	//$jobapply->owner_guid = $job->owner_guid;	
	$jobapply->user_guid = $user->guid;
	$jobapply->job_guid = $job->guid;
	
	if ($jobapply->save()) {
		echo "<h3>".elgg_echo('edujobs:view:job:apply:success')."</h3>";
	}
	else {
		echo "<h3>".elgg_echo('edujobs:view:job:apply:failed')."</h3>";
	}
}

/*
$content = elgg_get_entities(array(
	'type' => 'object',
	'subtype' => 'jobappication',
	'limit' => 30,
	'full_view' => false
));	
foreach($content as $v)  {$v->delete();}
//foreach($content as $v)  {echo $v->user_guid.' - '.$v->job_guid.' - '.$v->time_created.'<br />';}
//print_r($content);
*/

echo '</div>';
forward('http://localhost/elgg/edujobs/jobs');
?>

