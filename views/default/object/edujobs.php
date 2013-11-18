<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

global $CONFIG;

elgg_load_js('edujobsjs');
//elgg_load_js('lightbox');
//elgg_load_css('lightbox');

$full = elgg_extract('full_view', $vars, FALSE);
$jobs = elgg_extract('entity', $vars, FALSE);

$user = elgg_get_logged_in_user_entity();

// set the default timezone to use
date_default_timezone_set('UTC');

if (!$jobs) { 
    return;
}

$owner = $jobs->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'small');

$owner_link = elgg_view('output/url', array(
	'href' => "edujobs/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($jobs->time_created);
$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'edujobs/job',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// comments is empty except if it change
$comments_link = '';

//$subtitle = "$author_text $date $comments_link";
$subtitle = "$author_text $comments_link";

// build job subject
$subject = '';
$subject .= elgg_echo('edujobs:add:subject:one') . ': ';
if ($jobs->subject_math) { $subject .= elgg_echo('edujobs:add:subject:math') . ', ';}
if ($jobs->subject_science) { $subject .= elgg_echo('edujobs:add:subject:science') . ', ';}
if ($jobs->subject_socialstudies) { $subject .= elgg_echo('edujobs:add:subject:socialstudies') . ', ';}
if ($jobs->subject_spanish) { $subject .= elgg_echo('edujobs:add:subject:spanish') . ', ';}
if ($jobs->subject_english) { $subject .= elgg_echo('edujobs:add:subject:english') . ', ';}
if ($jobs->subject_otherforeignlangs) { $subject .= elgg_echo('edujobs:add:subject:otherforeignlangs') . ', ';}
if ($jobs->subject_technology) { $subject .= elgg_echo('edujobs:add:subject:technology') . ', ';}
if ($jobs->subject_othersubjects && $jobs->subject_othersubjects_text) { $subject .= $jobs->subject_othersubjects_text . ', ';}
$subject = substr_replace($subject ,"",-2);

// build job grade
$grade = '';
$grade .= elgg_echo('edujobs:add:grade:one') . ': ';
if ($jobs->grade_kindergarten) { $grade .= elgg_echo('edujobs:add:grade:kindergarten') . ', ';}
if ($jobs->grade_earlyelementary) { $grade .= elgg_echo('edujobs:add:grade:earlyelementary') . ', ';}
if ($jobs->grade_lateelementary) { $grade .= elgg_echo('edujobs:add:grade:lateelementary') . ', ';}
if ($jobs->grade_middleschool) { $grade .= elgg_echo('edujobs:add:grade:middleschool') . ', ';}
if ($jobs->grade_highschool) { $grade .= elgg_echo('edujobs:add:grade:highschool') . ', ';}
if ($jobs->grade_othercategories && $jobs->grade_othercategories_text) { $grade .= $jobs->grade_othercategories_text . ', ';}
$grade = substr_replace($grade ,"",-2);

$location = '';
if ($jobs->city) $location .= $jobs->city;
if ($jobs->country) $location .= ', ' . $jobs->country;

/// build content //
$content = '';
if ($subject || $grade)	{
	$content .= '<div class="job-header">';
	if ($subject) {
		$content .= $subject;
		if ($grade) $content .= ' | ';
	}
	if ($grade) $content .= $grade;
	$content .= '</div>';
}
$content .= '<div class="job-main">';
$content .= $jobs->description;

//$content .= '<br />'.$jobs->access_id;

$content .= '</div>';

if ($jobs->canEdit()) {
	$content .= '<div class="job-side">';
	$content .= '<p><a class="elgg-button elgg-button-submit" href="'. elgg_get_site_url().'edujobs/job/edit/'.$jobs->guid.'">'.elgg_echo('edujobs:view:job:update').'</a></p>';
	$content .= '<p><a class="elgg-button elgg-button-submit" href="'. elgg_get_site_url().'edujobs/job/applicants/all/'.$jobs->guid.'">'.elgg_echo('edujobs:view:job:applicants').'</a></p>';
	if ($jobs->access_id != 0) {
		$ts = time();
		$token = generate_action_token($ts);		
		$content .= '<p>'.elgg_view('output/url', array(
			'href' => 'action/edujobs/job/unpublish?job_guid='.$jobs->guid,
			'text' => elgg_echo('edujobs:view:job:publish'),
			'class' => 'elgg-button elgg-button-submit',
			'is_action' => true
		)).'</p>';	
	}

	$content .= '</div>';    
}
else if ($user->custom_profile_type == DOCENTE_PROFILE_TYPE_GUID)	{
	$content .= '<div class="job-side">';
	$apply = check_if_user_has_apply($user->guid, $jobs->guid);
	if ($apply) {
		$content .= '<p class="applied">'.elgg_echo('edujobs:view:job:applied', array(date(DATE_FORMAT, $apply))).'</p>';
	}
	else if ($jobs->published_until_final > time())  {
		if (check_if_user_has_cv($user)) {
			$ts = time();
			$token = generate_action_token($ts);
			
			$content .= elgg_view('output/url', array(
				'href' => 'action/edujobs/job/apply?job_guid='.$jobs->guid,
				'text' => elgg_echo('edujobs:view:job:apply'),
				'class' => 'elgg-button elgg-button-submit',
				'is_action' => true
			));
		}
		else {
			$content .= elgg_view('output/url', array(
				'href' => elgg_get_site_url().'edujobs/teachers/addcv1/'.$user->guid,
				'text' => elgg_echo('edujobs:cv:create'),
				'class' => 'elgg-button elgg-button-submit',
				'is_action' => true
			));		
		}
	}
	$content .= '</div>';    
}    

$content .= '<div class="job-footer">';
if ($location) $content .= $location . ' | ';
$content .= elgg_echo('edujobs:view:job:date') . date(DATE_FORMAT, $jobs->time_created);
if ($jobs->published_until_final < time())  {
	$content .= ' | '.elgg_echo('edujobs:view:job:expired');
}
else  {
	$content .= ' | '.elgg_echo('edujobs:view:job:ends').date(DATE_FORMAT, $jobs->published_until_final);
}

$content .= '</div>';
/////////////////////////////    
    
    
if ($full && !elgg_in_context('gallery')) {
    $params = array(
            'entity' => $jobs,
            'title' => false,
            'metadata' => $metadata,
            'subtitle' => $subtitle,
    );
    $params = $params + $vars;
    $summary = elgg_view('object/elements/summary', $params);

    $body = $content;
       
    echo elgg_view('object/elements/full', array(
            'entity' => $jobs,
            'icon' => $owner_icon,
            'summary' => $summary,
            'body' => $body,
    ));

} 
else {
    // brief view
    $display_text = $url;
    
    $params = array(
            'entity' => $jobs,
            'metadata' => $metadata,
            'subtitle' => $subtitle,
            'content' => $content,
    );
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($owner_icon, $body);
}
