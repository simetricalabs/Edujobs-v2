<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

global $CONFIG;

elgg_load_js('edujobsjs');

$full = elgg_extract('full_view', $vars, FALSE);
$cvlang = elgg_extract('entity', $vars, FALSE);

$user = elgg_get_logged_in_user_entity();

// set the default timezone to use
date_default_timezone_set('UTC');

if (!$cvlang) { 
    return;
}

$owner = $cvlang->getOwnerEntity();
//$owner_icon = elgg_view_entity_icon($owner, 'large');

$owner_link = elgg_view('output/url', array(
	'href' => "edujobs/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($cvlang->time_created);
$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'edujobs/job',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));


/// build content //
$content = '';

$content .= '<div class="job-header">';
$content .= '<p>';
$content .= '<div style="width:20%; float:left;">'.$cvlang->cvlang_language.'</div>';
$content .=  elgg_echo($cvlang->cvlang_level) . ' | ';
if ($cvlang->cvlang_cert_institute) $content .= $cvlang->cvlang_cert_institute . ' | ';
if ($cvlang->cvlang_total_score) {
	$content .= elgg_echo('edujobs:cv:lang:score'). ' ' . $cvlang->cvlang_total_score ;
}
else   {
	$content = substr_replace($content ,"",-3);
}

$content .= '</p>';
$content .= '</div>';

$content .= '<div class="job-side">';
if ($user->guid == $cvlang->owner_guid)	{
	$ts = time();
	$token = generate_action_token($ts);
			
	$content .= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'edujobs/teachers/addlanguage/'.$user->guid.'/'.$cvlang->guid,
		'text' => elgg_echo('edujobs:cv:we:edit'),
		'class' => 'elgg-button elgg-button-submit',
	));		
	$content .= '&nbsp;&nbsp;';
	$content .= elgg_view('output/url', array(
		'href' => elgg_get_site_url().'action/edujobs/job/delete?guid='.$cvlang->guid,
		'text' => elgg_echo('edujobs:cv:we:delete'),
		'class' => 'elgg-button elgg-button-submit',
		'title' => elgg_echo('edujobs:delete:confirm'),
		'is_action' => true
	));		
}
$content .= '</div>';  



if ($full) {
    //  do nothing
} 
else {
    // brief view
    $display_text = $url;
    
    $params = array(
            'entity' => $cvlang,
            //'metadata' => $metadata,
            //'subtitle' => $subtitle,
            'content' => $content,
            'tags' => false,
    );
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($owner_icon, $body);
}

