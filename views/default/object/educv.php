<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

global $CONFIG;

elgg_load_js('edujobsjs');

$full = elgg_extract('full_view', $vars, FALSE);
$mycv = elgg_extract('entity', $vars, FALSE);
$content_we = elgg_extract('content_we', $vars, FALSE);
$content_edu = elgg_extract('content_edu', $vars, FALSE);
$content_lang = elgg_extract('content_lang', $vars, FALSE);
$content_port = elgg_extract('content_port', $vars, FALSE);

$user = elgg_get_logged_in_user_entity();

// set the default timezone to use
date_default_timezone_set('UTC');

if (!$mycv) { 
    return;
}

$owner = $mycv->getOwnerEntity();
$owner_icon = elgg_view_entity_icon($owner, 'large');

$owner_link = elgg_view('output/url', array(
	'href' => "edujobs/owner/$owner->username",
	'text' => $owner->name,
	'is_trusted' => true,
));
$author_text = elgg_echo('byline', array($owner_link));

$date = elgg_view_friendly_time($mycv->time_created);
$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'edujobs/job',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

// comments is empty except if it change
$comments_link = '';

$subtitle = "$author_text $comments_link";

// build subject
$subject = '';
if ($mycv->cv_subject_math) { $subject .= elgg_echo('edujobs:add:cv_subject_math') . ', ';}
if ($mycv->cv_subject_science) { $subject .= elgg_echo('edujobs:add:cv_subject_science') . ', ';}
if ($mycv->cv_subject_socialstudies) { $subject .= elgg_echo('edujobs:add:cv_subject_socialstudies') . ', ';}
if ($mycv->cv_subject_spanish) { $subject .= elgg_echo('edujobs:add:cv_subject_spanish') . ', ';}
if ($mycv->cv_subject_english) { $subject .= elgg_echo('edujobs:add:cv_subject_english') . ', ';}
if ($mycv->cv_subject_otherforeignlangs) { $subject .= elgg_echo('edujobs:add:cv_subject_otherforeignlangs') . ', ';}
if ($mycv->cv_subject_technology) { $subject .= elgg_echo('edujobs:add:cv_subject_technology') . ', ';}
if ($mycv->cv_subject_othersubjects && $mycv->cv_subject_othersubjects_text) { $subject .= $mycv->cv_subject_othersubjects_text . ', ';}
$subject = substr_replace($subject ,"",-2);

// build grade
$grade = '';
if ($mycv->cv_grade_kindergarten) { $grade .= elgg_echo('edujobs:add:cv_grade_kindergarten') . ', ';}
if ($mycv->cv_grade_earlyelementary) { $grade .= elgg_echo('edujobs:add:cv_grade_earlyelementary') . ', ';}
if ($mycv->cv_grade_lateelementary) { $grade .= elgg_echo('edujobs:add:cv_grade_lateelementary') . ', ';}
if ($mycv->cv_grade_middleschool) { $grade .= elgg_echo('edujobs:add:cv_grade_middleschool') . ', ';}
if ($mycv->cv_grade_highschool) { $grade .= elgg_echo('edujobs:add:cv_grade_highschool') . ', ';}
if ($mycv->cv_grade_othercategories && $mycv->cv_grade_othercategories_text) { $grade .= $mycv->cv_grade_othercategories_text . ', ';}
$grade = substr_replace($grade ,"",-2);

//get flag
$flag = get_country_flag($mycv->cv_birth_country);

if ($full) {
    $params = array(
            'entity' => $mycv,
            'title' => false,
            'metadata' => $metadata,
            'subtitle' => $subtitle,
    );
    $params = $params + $vars;
    $summary = elgg_view('object/elements/summary', $params);

	
    $body = '<div class="cvsection">';
    //$body .= '<div id="accordion">';
    $body .= '<div><h3>'.elgg_echo('edujobs:cv:add1:simple').'</h3></div>';
	$body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_name').':</div><div class="cvright">'.$mycv->cv_name.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_last_name').':</div><div class="cvright">'.$mycv->cv_last_name.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_description').':</div><div class="cvright">'.$mycv->cv_description.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_gender').':</div><div class="cvright">'.elgg_echo($mycv->cv_gender).'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_birth_date').':</div><div class="cvright">'.$mycv->cv_birth_date.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_birth_country').':</div><div class="cvright">'.$mycv->cv_birth_country.'';
    if ($flag) $body .= '&nbsp;<img src="'.elgg_get_site_url().'mod/edujobs/assets/flags/'.$flag.'" width="20" height="12" alt="'.$mycv->cv_birth_country.'" />';
    $body .= '</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_birth_city').':</div><div class="cvright">'.$mycv->cv_birth_city.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_email').':</div><div class="cvright">'.$mycv->cv_email.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_telephone').':</div><div class="cvright">'.$mycv->cv_telephone.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_address').':</div><div class="cvright">'.$mycv->cv_address.'</div></div>';
	$body .= '</div>';

	$body .= '<div class="cvsection">';
    $body .= '<div><h3>'.elgg_echo('edujobs:cv:add2:simple').'</h3></div>';
	$body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_position_looking_for').':</div><div class="cvright">'.$mycv->cv_position_looking_for.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_work_experience_years').':</div><div class="cvright">'.$mycv->cv_work_experience_years.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_salary_min_acceptable').':</div><div class="cvright">'.$mycv->cv_salary_min_acceptable.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_salary_unit_of_time').':</div><div class="cvright">'.elgg_echo($mycv->cv_salary_unit_of_time).'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_salary_currency').':</div><div class="cvright">'.$mycv->cv_salary_currency.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_availability_date').':</div><div class="cvright">'.elgg_echo($mycv->cv_availability_date).'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_availability_date_specify').':</div><div class="cvright">'.$mycv->cv_availability_date_specify.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_desired_work_type').':</div><div class="cvright">'.elgg_echo($mycv->cv_desired_work_type).'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_subject').':</div><div class="cvright">'.$subject.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_grade:one').':</div><div class="cvright">'.$grade.'</div></div>';
    $body .= '<div class="cvmaster"><div class="cvleft">'.elgg_echo('edujobs:add:cv_more_info').':</div><div class="cvright">'.$mycv->cv_more_info.'</div></div>';
    $body .= '</div>';

	if ($content_we)	{
		$body .= '<div class="cvsection">';
		$body .= '<div><h3>'.elgg_echo('edujobs:cv:add3:simple').'</h3></div>';
		$body .= $content_we;
		$body .= '</div>';
	}
	
	if ($content_edu)	{
		$body .= '<div class="cvsection">';
		$body .= '<div><h3>'.elgg_echo('edujobs:cv:add4:simple').'</h3></div>';
		$body .= $content_edu;
		$body .= '</div>';
	}	
	
	if ($content_lang)	{
		$body .= '<div class="cvsection">';
		$body .= '<div><h3>'.elgg_echo('edujobs:cv:add5:simple').'</h3></div>';
		$body .= $content_lang;
		$body .= '</div>';
	}
	
	if ($mycv->cv_paste_cv)	{
		$body .= '<div class="cvsection">';
		$body .= '<div><h3>'.elgg_echo('edujobs:cv:add6:title').'</h3></div>';
		$body .= $mycv->cv_paste_cv;
		$body .= '</div>';
	}
	if ($content_port)	{
		$body .= '<div class="cvsection" id="tportfolio">';
		$body .= '<div><h3>'.elgg_echo('edujobs:cv:add7:simple').'</h3></div>';
		$body .= $content_port;
		$body .= '</div>';
	}	
	
    echo elgg_view('object/elements/full', array(
            'entity' => $mycv,
            //'icon' => $owner_icon,
            //'summary' => $summary,
            'body' => $body,
    ));

} 
else {
    // brief view
    //$display_text = $url;
	$elgg_user = elgg_get_entities_from_metadata(array(
		'type' => 'user',
		'limit' => 1,
		'full_view' => false,
		'count' => false,
		'pagination' => false,
		'guid' => $mycv->owner_guid,
	));    
	
	//get user language
	$content_lang = elgg_get_entities(array(
		'type' => 'object',
		'subtype' => 'educvlang',
		'limit' => 0,
		'full_view' => false,
		'count' => false,
		'pagination' => false,
		'owner_guid' => $mycv->owner_guid,
	));	   
	if ($content_lang) {
		$languages = elgg_echo('edujobs:cv:add5:simple').': ';
		foreach ($content_lang as $lng)	{
			$languages .= $lng->cvlang_language .' ('.elgg_echo($lng->cvlang_level).'), ';
		}
		$languages = substr_replace($languages ,"",-2);
	} 
	
	$title_url = elgg_view('output/url', array(
		'href' => 'edujobs/teachers/cv/'.$elgg_user[0]->username,
		'text' => $mycv->cv_name.' '.$mycv->cv_last_name,
		'is_trusted' => true,
	));	 
	$portfolio_url = elgg_view('output/url', array(
		'href' => 'edujobs/teachers/cv/'.$elgg_user[0]->username.'#tportfolio',
		'text' => elgg_echo('edujobs:cv:portfolio'),
		'is_trusted' => true,
	));
	$content =  '<h3>'.$title_url.'</h3>';
	
	$content .=  '<p>'.$mycv->cv_position_looking_for.'</p>';
	$content .=  '<p>'.$mycv->cv_description.'</p>';
	$content .=  '<p>';
	if ($flag) $content .= '<img src="'.elgg_get_site_url().'mod/edujobs/assets/flags/'.$flag.'" width="20" height="12" alt="'.$mycv->cv_birth_country.'" />&nbsp;';
	$content .= $mycv->cv_birth_country.' | '.$mycv->cv_birth_city.' | '.elgg_echo('edujobs:add:cv_salary_min_acceptable').': '.$mycv->cv_salary_min_acceptable.' '.$mycv->cv_salary_currency.elgg_echo('edujobs:cv:currency:per').elgg_echo($mycv->cv_salary_unit_of_time);
	$content .= '</p>';
	if ($languages) $content .=  '<p>'.$languages.'</p>';
	$content .=  '<p>'.$portfolio_url.'  |  '.elgg_echo('edujobs:add:subject').': '.$subject.'  '.elgg_echo('edujobs:add:grade').': '.$grade.'  '.'</p>';
	  
    $params = array(
            'entity' => $mycv,
            //'metadata' => $metadata,
            //'subtitle' => $subtitle,
            'content' => $content,
    );
    $params = $params + $vars;
    $body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($owner_icon, $body);
}

