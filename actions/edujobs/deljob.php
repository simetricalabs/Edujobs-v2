<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

// check if user is loggedin
if (!elgg_is_logged_in()) forward();

$guid = get_input('guid');
$job = get_entity($guid);

if ((elgg_instanceof($job, 'object', 'edujobs')) && $job->canEdit()) {
    $container = $job->getContainerEntity();

    if ($job->delete()) {
        system_message(elgg_echo("edujobs:delete:job:success"));
        if (elgg_instanceof($container, 'group')) {
                forward("edujobs/group/$container->guid/all");
        } else {
                forward("edujobs/owner/$container->username");
        }
    }
}
else if ((elgg_instanceof($job, 'object', 'educv')) && $job->canEdit()) {
    $container = $job->getContainerEntity();

    if ($job->delete()) {
        system_message(elgg_echo("edujobs:delete:cv:success"));
        if (elgg_instanceof($container, 'group')) {
                forward("edujobs/teachers/view");
        } else {
                forward("edujobs/teachers/view");
        }
    }
}
else if ((elgg_instanceof($job, 'object', 'educvwe')) && $job->canEdit()) {
    $container = $job->getContainerEntity();

    if ($job->delete()) {
        system_message(elgg_echo("edujobs:delete:cvwe:success"));
        forward("edujobs/teachers/addcv3/".$container->guid);
    }
}
else if ((elgg_instanceof($job, 'object', 'educvedu')) && $job->canEdit()) {
    $container = $job->getContainerEntity();

    if ($job->delete()) {
        system_message(elgg_echo("edujobs:delete:cvedu:success"));
        forward("edujobs/teachers/addcv4/".$container->guid);
    }
}
else if ((elgg_instanceof($job, 'object', 'educvlang')) && $job->canEdit()) {
    $container = $job->getContainerEntity();

    if ($job->delete()) {
        system_message(elgg_echo("edujobs:delete:cvlang:success"));
        forward("edujobs/teachers/addcv5/".$container->guid);
    }
}
else if ((elgg_instanceof($job, 'object', 'educvport')) && $job->canEdit()) {
    $container = $job->getContainerEntity();

    if ($job->delete()) {
        system_message(elgg_echo("edujobs:delete:cvport:success"));
        forward("edujobs/teachers/addcv7/".$container->guid);
    }
}


register_error(elgg_echo("edujobs:delete:job:failed"));
forward(REFERER);
