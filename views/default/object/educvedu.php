<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

global $CONFIG;

elgg_load_js('edujobsjs');

$full = elgg_extract('full_view', $vars, FALSE);
$cvedu = elgg_extract('entity', $vars, FALSE);

$user = elgg_get_logged_in_user_entity();

// set the default timezone to use
date_default_timezone_set('UTC');

if (!$cvedu) { 
    return;
}

$owner = $cvedu->getOwnerEntity();
//$owner_icon = elgg_view_entity_icon($owner, 'large');

$owner_link = elgg_view('output/url', array(
	'href' => "edujobs/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($cvedu->time_created);
$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'edujobs/job',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

$location = '';
if ($cvedu->cvedu_city) $location .= $cvedu->cvedu_city;
if ($cvedu->cvedu_country) $location .= ', ' . $cvedu->cvedu_country;

/// build content //
$content = '';
$content .= '<h4>'.$cvedu->cvedu_degree.'</h4>';

if ($cvedu->cvedu_school_name)	{
	$content .= '<div class="job-header">'.$cvedu->cvedu_school_name.'</div>';
}

$content .= '<div class="job-side">';
if ($user->guid == $cvedu->owner_guid)	{
	$ts = time();
	$token = generate_action_token($ts);
			
	$content .= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'edujobs/teachers/addeducation/'.$user->guid.'/'.$cvedu->guid,
		'text' => elgg_echo('edujobs:cv:we:edit'),
		'class' => 'elgg-button elgg-button-submit',
	));		
	$content .= '&nbsp;&nbsp;';
	$content .= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'action/edujobs/job/delete?guid='.$cvedu->guid,
		'text' => elgg_echo('edujobs:cv:we:delete'),
		'class' => 'elgg-button elgg-button-submit',
		'title' => elgg_echo('edujobs:delete:confirm'),
		'is_action' => true
	));		
}
$content .= '</div>';  


//
$content .= '<div class="job-footer">';
if ($cvedu->cvedu_time_from) {
	$period_from = explode('-',$cvedu->cvedu_time_from);
	$content .= elgg_echo('edujobs:add:cvedu_time_from:start').': '. date(DATE_FORMAT, mktime(0, 0, 0, $period_from[1], $period_from[2], $period_from[0])) . ' | ';
}
if ($cvedu->cvedu_time_to || $cvedu->cvedu_time_currently) {
	if ($cvedu->cvedu_time_to) {
		$content .= elgg_echo('edujobs:add:cvedu_time_from:end').': ';
		$period_to = explode('-',$cvedu->cvedu_time_to);
		$content .= date(DATE_FORMAT, mktime(0, 0, 0, $period_to[1], $period_to[2], $period_to[0])) . ' | ';
	}
	else $content .= elgg_echo('edujobs:add:cvedu_time_currently') . ' | ';
}
if ($location) $content .= $location;
$content .= '</div>';
	
if ($full) {
    //  do nothing
} 
else {
    // brief view
    $display_text = $url;
    
    $params = array(
            'entity' => $cvedu,
            //'metadata' => $metadata,
            //'subtitle' => $subtitle,
            'content' => $content,
            'tags' => false,
    );
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($owner_icon, $body);
}

