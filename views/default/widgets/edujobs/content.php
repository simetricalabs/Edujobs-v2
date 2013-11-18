<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');

//the page owner
$owner = get_user($vars['entity']->owner_guid);

if (check_if_user_has_cv($owner))	{
	$cv = elgg_get_entities_from_metadata(array(
		'type' => 'object',
		'subtype' => 'educv',
		'limit' => 1,
		'full_view' => false,
		'count' => false,
		'pagination' => false,
		'owner_guid' => $owner->guid,
	));						
} 

//print_r($cv);	
// display the posts, if there are any
if (is_array($cv) && sizeof($cv) > 0) {

	$body = '<div style="width:100%;clear:both;margin-top:15px;">';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_name').':</div><div>'.$cv[0]->cv_name.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_last_name').':</div><div>'.$cv[0]->cv_last_name.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_description').':</div><div>'.$cv[0]->cv_description.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_gender').':</div><div>'.elgg_echo($cv[0]->cv_gender).'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_birth_date').':</div><div>'.$cv[0]->cv_birth_date.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_birth_country').':</div><div>'.$cv[0]->cv_birth_country.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_birth_city').':</div><div>'.$cv[0]->cv_birth_city.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_email').':</div><div>'.$cv[0]->cv_email.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_telephone').':</div><div>'.$cv[0]->cv_telephone.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleftw">'.elgg_echo('edujobs:add:cv_address').':</div><div>'.$cv[0]->cv_address.'</div></div>';
    $body .= '</div>';
    
    $allcv = elgg_view('output/url', array(
		'href' => "edujobs/teachers/cv/$owner->username",
		'text' => elgg_echo("edujobs:widget:cv:full"),
		'is_trusted' => true,
	));

    $body .= '<p style="float:right;">'.$allcv.'</p>';
    echo $body;
}
else {
	echo elgg_echo("edujobs:widget:cv:empty");
}

