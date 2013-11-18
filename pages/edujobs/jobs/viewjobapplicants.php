<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');


//get entity
$job = get_entity(get_input('guid'));
if (!$job) {
	register_error(elgg_echo('noaccess'));
	$_SESSION['last_forward_from'] = current_page_url();
	forward('');
}

if ($job->canEdit()) {
	$title = elgg_echo('edujobs:view:job:applicants:title', array($job->title));

	$page_owner =$job->getOwnerEntity();
	$selected = 'job/applicants/'.$page[2];

	// generate breadcrumbs
	elgg_push_breadcrumb(elgg_echo('edujobs'), 'edujobs/jobs');  

	elgg_push_breadcrumb($job->title, $job->getURL());
	elgg_push_breadcrumb(elgg_echo('edujobs:view:job:applicants'));

	$sidebar = '';

	// basic search options
	$options = array(
		'type' => 'object',
		'subtype' => 'jobappication',
		'limit' => 0,
		'full_view' => false,
	);

	$what = get_input('what');
	if ($what === 'favorites') {
		$options['metadata_name_value_pairs'] = array(
			array('name' => 'status','value' => JOB_STATUS_FAVORITE, 'operand' => '='),
			array('name' => 'job_guid','value' => $job->guid, 'operand' => '='),
		);
		$options['metadata_name_value_pairs_operator'] = 'AND';
		$empty_msg = '<p>'.elgg_echo('edujobs:view:job:applicants:favorites:none').'</p>';
	}
	else if ($what === 'rejected') {
		$options['metadata_name_value_pairs'] = array(
			array('name' => 'status','value' => JOB_STATUS_REJECTED, 'operand' => '='),
			array('name' => 'job_guid','value' => $job->guid, 'operand' => '='),
		);
		$options['metadata_name_value_pairs_operator'] = 'AND';
		$empty_msg = '<p>'.elgg_echo('edujobs:view:job:applicants:rejected:none').'</p>';
	}
	else {
		$what = 'all';	
		$options['metadata_name_value_pairs'] = array(array('name' => 'job_guid','value' => $job->guid, 'operand' => '='));
		$empty_msg = '<p>'.elgg_echo('edujobs:view:job:applicants:none').'</p>';
	}

	// get the applicants
	$applies = elgg_get_entities_from_metadata($options);	

	//default view
	$content = elgg_view('edujobs/applicants', array(
			'job' => $job,
			'what' => $what,
			'applies' => $applies,
			'empty_msg' => $empty_msg,
			'icon_size' => 'large',
		)
	);

	$options = array(
		'content' => $content,
		'title' => $title,
		'sidebar' => $sidebar,
		'filter_override' => elgg_view('edujobs/nav-applicants', array('guid' => $job->guid, 'selected' => $selected))
	);

	$body = elgg_view_layout('content', $options);

	echo elgg_view_page($title, $body);
}
else    {  
    register_error(elgg_echo('edujobs:view:job:applicants:noaccess'));  
    forward(REFERER);    
}







