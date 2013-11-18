<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

global $CONFIG;

elgg_load_js('edujobsjs');

$full = elgg_extract('full_view', $vars, FALSE);
$mycvwe = elgg_extract('entity', $vars, FALSE);

$user = elgg_get_logged_in_user_entity();

// set the default timezone to use
date_default_timezone_set('UTC');

if (!$mycvwe) { 
    return;
}

$owner = $mycvwe->getOwnerEntity();
//$owner_icon = elgg_view_entity_icon($owner, 'large');

$owner_link = elgg_view('output/url', array(
	'href' => "edujobs/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($mycvwe->time_created);
$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'edujobs/job',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// build job subject
$subject = '';
$subject .= elgg_echo('edujobs:add:subject:one') . ': ';
if ($mycvwe->cvwe_subject_math) { $subject .= elgg_echo('edujobs:add:subject:math') . ', ';}
if ($mycvwe->cvwe_subject_science) { $subject .= elgg_echo('edujobs:add:subject:science') . ', ';}
if ($mycvwe->cvwe_subject_socialstudies) { $subject .= elgg_echo('edujobs:add:subject:socialstudies') . ', ';}
if ($mycvwe->cvwe_subject_spanish) { $subject .= elgg_echo('edujobs:add:subject:spanish') . ', ';}
if ($mycvwe->cvwe_subject_english) { $subject .= elgg_echo('edujobs:add:subject:english') . ', ';}
if ($mycvwe->cvwe_subject_otherforeignlangs) { $subject .= elgg_echo('edujobs:add:subject:otherforeignlangs') . ', ';}
if ($mycvwe->cvwe_subject_technology) { $subject .= elgg_echo('edujobs:add:subject:technology') . ', ';}
if ($mycvwe->cvwe_subject_othersubjects && $mycvwe->cvwe_subject_othersubjects_text) { $subject .= $mycvwe->cvwe_subject_othersubjects_text . ', ';}
$subject = substr_replace($subject ,"",-2);

// build job grade
$grade = '';
$grade .= elgg_echo('edujobs:add:grade:one') . ': ';
if ($mycvwe->cvwe_grade_kindergarten) { $grade .= elgg_echo('edujobs:add:grade:kindergarten') . ', ';}
if ($mycvwe->cvwe_grade_earlyelementary) { $grade .= elgg_echo('edujobs:add:grade:earlyelementary') . ', ';}
if ($mycvwe->cvwe_grade_lateelementary) { $grade .= elgg_echo('edujobs:add:grade:lateelementary') . ', ';}
if ($mycvwe->cvwe_grade_middleschool) { $grade .= elgg_echo('edujobs:add:grade:middleschool') . ', ';}
if ($mycvwe->cvwe_grade_highschool) { $grade .= elgg_echo('edujobs:add:grade:highschool') . ', ';}
if ($mycvwe->cvwe_grade_othercategories && $mycvwe->cvwe_grade_othercategories_text) { $grade .= $mycvwe->cvwe_grade_othercategories_text . ', ';}
$grade = substr_replace($grade ,"",-2);

$location = '';
if ($mycvwe->cvwe_city) $location .= $mycvwe->cvwe_city;
if ($mycvwe->cvwe_country) $location .= ', ' . $mycvwe->cvwe_country;

/// build content //
$content = '';
$content .= '<h4>'.$mycvwe->cvwe_job_title.'</h4>';

if ($mycvwe->cvwe_organization)	{
	$content .= '<div class="job-header">'.$mycvwe->cvwe_organization.' | ';
}
if ($subject || $grade)	{
	if ($subject) {
		$content .= $subject;
		if ($grade) $content .= ' | ';
	}
	if ($grade) $content .= $grade;
}
$content .= '</div>';
$content .= '<div class="job-main">';
$content .= $mycvwe->cvwe_comments;
$content .= '</div>';

$content .= '<div class="job-side">';
//if ($mycvwe->canEdit())  {
if ($user->guid == $mycvwe->owner_guid)	{
	$ts = time();
	$token = generate_action_token($ts);
			
	$content .= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'edujobs/teachers/addworkexperience/'.$user->guid.'/'.$mycvwe->guid,
		'text' => elgg_echo('edujobs:cv:we:edit'),
		'class' => 'elgg-button elgg-button-submit',
	));		
	$content .= '<br /><br />';
	$content .= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'action/edujobs/job/delete?guid='.$mycvwe->guid,
		'text' => elgg_echo('edujobs:cv:we:delete'),
		'class' => 'elgg-button elgg-button-submit elgg-requires-confirmation',
		'rel' => elgg_echo('edujobs:delete:confirm'),
		'is_action' => true
	));		
}
$content .= '</div>';  


//
$content .= '<div class="job-footer">';
if ($mycvwe->cvwe_period_from) {
	//$date = new DateTime($mycvwe->cvwe_period_from);
	$period_from = explode('-',$mycvwe->cvwe_period_from);
	$content .= elgg_echo('edujobs:add:cvwe_period_from:start').': '. date(DATE_FORMAT, mktime(0, 0, 0, $period_from[1], $period_from[2], $period_from[0])) . ' | ';
	//$content .= elgg_echo('edujobs:add:cvwe_period_from:start').': '. $mycvwe->cvwe_period_to . ' | ';
}
if ($mycvwe->cvwe_period_to || $mycvwe->cvwe_period_now) {
	if ($mycvwe->cvwe_period_to) {
		$content .= elgg_echo('edujobs:add:cvwe_period_from:end').': ';
		//$date = new DateTime($mycvwe->cvwe_period_to);
		$period_to = explode('-',$mycvwe->cvwe_period_to);
		$content .= date(DATE_FORMAT, mktime(0, 0, 0, $period_to[1], $period_to[2], $period_to[0])) . ' | ';
	}
	else $content .= elgg_echo('edujobs:add:cvwe_period_now') . ' | ';
}
if ($location) $content .= $location;
$content .= '</div>';
if ($mycvwe->tags)	{
	$content .= '<div class="job-footer">'.elgg_echo('edujobs:add:tags').': '.implode(", ", $mycvwe->tags).'</div>';
}
	
if ($full) {
    //  do nothing
} 
else {
    // brief view
    $display_text = $url;
    
    $params = array(
            'entity' => $mycvwe,
            //'metadata' => $metadata,
            //'subtitle' => $subtitle,
            'content' => $content,
            'tags' => false,
    );
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($owner_icon, $body);
}

