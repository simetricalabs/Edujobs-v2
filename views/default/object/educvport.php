<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

global $CONFIG;

elgg_load_js('edujobsjs');

$full = elgg_extract('full_view', $vars, FALSE);
$cvport = elgg_extract('entity', $vars, FALSE);

$user = elgg_get_logged_in_user_entity();

// set the default timezone to use
date_default_timezone_set('UTC');

if (!$cvport) { 
    return;
}

$owner = $cvport->getOwnerEntity();
//$owner_icon = elgg_view_entity_icon($owner, 'large');

$owner_link = elgg_view('output/url', array(
	'href' => "edujobs/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($cvport->time_created);
$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'edujobs/job',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// build job subject
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

// build job grade
$grade = '';
if ($cvport->cvport_grade_kindergarten) { $grade .= elgg_echo('edujobs:add:cv_grade_kindergarten') . ', ';}
if ($cvport->cvport_grade_earlyelementary) { $grade .= elgg_echo('edujobs:add:cv_grade_earlyelementary') . ', ';}
if ($cvport->cvport_grade_lateelementary) { $grade .= elgg_echo('edujobs:add:cv_grade_lateelementary') . ', ';}
if ($cvport->cvport_grade_middleschool) { $grade .= elgg_echo('edujobs:add:cv_grade_middleschool') . ', ';}
if ($cvport->cvport_grade_highschool) { $grade .= elgg_echo('edujobs:add:cv_grade_highschool') . ', ';}
if ($cvport->cvport_grade_othercategories && $cvport->cvport_grade_othercategories_text) { $grade .= $cvport->cvport_grade_othercategories_text . ', ';}
$grade = substr_replace($grade ,"",-2);

/// build content //
$content = '';
$content .= '<div class="job-side">';
if ($user->guid == $cvport->owner_guid)	{
	$ts = time();
	$token = generate_action_token($ts);
			
	$content .= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'edujobs/teachers/addportfolio/'.$user->guid.'/'.$cvport->guid,
		'text' => elgg_echo('edujobs:cv:port:edit'),
		'class' => 'elgg-button elgg-button-submit',
	));		
	$content .= '&nbsp;&nbsp;';
	$content .= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'action/edujobs/job/delete?guid='.$cvport->guid,
		'text' => elgg_echo('edujobs:cv:port:delete'),
		'class' => 'elgg-button elgg-button-submit elgg-requires-confirmation',
		'rel' => elgg_echo('edujobs:delete:confirm'),
		'is_action' => true,
	));		
}
$content .= '</div>';  


$content .= '<h4>'.$cvport->cvport_title.'</h4>';
$content .= '<div class="job-header">';
$content .=  ''.elgg_echo('edujobs:add:cvport_type').': '.elgg_echo($cvport->cvport_type) . ' | '.elgg_echo('edujobs:add:subject').': '.$subject.'';
$content .=  '<br />'.elgg_echo('edujobs:add:grade').': '.$grade.'';
$content .=  '<br />'.elgg_echo('edujobs:cv:portfolio:whyrecommend').$cvport->cvport_recommend.'';

if ($cvport->cvport_type == 'edujobs:cv:portfolio:link')	{
	$content .= '<p>'.elgg_view('output/url', array(
		'name' => 'portfolio_link',
		'text' => elgg_echo($cvport->cvport_link),
		'href' => $cvport->cvport_link,
		'link_class' => 'elgg-button elgg-button-action',
		'target' => '_blank',
	)).'</p>';	
}
else if ($cvport->cvport_type == 'edujobs:cv:portfolio:file')	{
	$content .= '<p>'.elgg_view('output/url', array(
		'name' => 'portfolio_file',
		'text' => elgg_echo('edujobs:cv:download:portfile'),
		'href' => 'edujobs/teachers/download/'.$cvport->guid,
		'link_class' => 'elgg-button elgg-button-action',
		'target' => '_blank',
	)).'</p>';
}

if ($cvport->tags)	{
	$content .= '<div class="job-footer">'.elgg_echo('edujobs:add:tags').': '.implode(", ", $cvport->tags).'</div>';
}

$content .= '</div>';




if ($full) {
    //  do nothing
} 
else {
    // brief view
    $display_text = $url;
    
    $params = array(
            'entity' => $cvport,
            //'metadata' => $metadata,
            //'subtitle' => $subtitle,
            'content' => $content,
            'tags' => false,
    );
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($owner_icon, $body);
}

