<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

// check if user is loggedin
if (!elgg_is_logged_in()) forward();

$guid = get_input('job_guid');
$job = get_entity($guid);

if (elgg_instanceof($job, 'object', 'edujobs') && $job->canEdit()) {
    $job->access_id = ACCESS_PRIVATE;
    
    if ($job->save()) {
        system_message(elgg_echo("edujobs:unpublish:job:success"));
    }
	else {
		register_error(elgg_echo("edujobs:unpublish:job:failed"));
	}    
}
else {
	register_error(elgg_echo("edujobs:unpublish:job:failed"));
}

forward(REFERER);
