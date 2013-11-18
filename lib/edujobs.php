<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

//add post job form parameters
function jobs_prepare_form_vars($job = null) {
       
	// input names => defaults
	$values = array(
		'title' => '',
		'subject_math' => '',
		'subject_science' => '',
		'subject_socialstudies' => '',
		'subject_spanish' => '',
		'subject_english' => '',
		'subject_otherforeignlangs' => '',
		'subject_technology' => '',
		'subject_othersubjects' => '',
		'subject_othersubjects_text' => '',
		'grade_kindergarten' => '',
		'grade_earlyelementary' => '',
		'grade_lateelementary' => '',
		'grade_middleschool' => '',
		'grade_highschool' => '',
		'grade_othercategories' => '',
		'grade_othercategories_text' => '',
		'description' => '',
		'country' => '',
		'city' => '',
		'published_until' => '',
		'noofapplicants' => '',
		'access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'entity' => $job,
		'tags' => '',
		'guid' => null,
		'comments_on' => NULL,
	);          

	if ($job) {
		foreach (array_keys($values) as $field) {
			if (isset($job->$field)) {
					$values[$field] = $job->$field;
			}
		}
	}

	if (elgg_is_sticky_form('edujobspost')) {
		$sticky_values = elgg_get_sticky_values('edujobspost');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('edujobspost');

	return $values;
	
	return false; 
}

//add post cv form parameters
function cv_prepare_form_vars($cv = null) {
       
	$values = array(
		'cv_name' => '',		
		'cv_last_name' => '',	
		'cv_description' => '',
		'cv_gender' => '',
		'cv_birth_date' => '',
		'cv_birth_country' => '',
		'cv_birth_city' => '',
		'cv_email' => '',
		'cv_telephone' => '',	
		'cv_address' => '',
		'cv_position_looking_for' => '',
		'cv_work_experience_years' => '',
		'cv_salary_min_acceptable' => '',
		'cv_salary_unit_of_time' => '',
		'cv_salary_currency' => '',
		'cv_availability_date' => '',	
		'cv_availability_date_specify' => '',
		'cv_desired_work_type' => '',
		'cv_subject_math' => '',	
		'cv_subject_science' => '',		
		'cv_subject_socialstudies' => '',	
		'cv_subject_spanish' => '',
		'cv_subject_english' => '',	
		'cv_subject_otherforeignlangs' => '',
		'cv_subject_technology' => '',
		'cv_subject_othersubjects' => '',
		'cv_subject_othersubjects_text' => '',
		'cv_grade_kindergarten' => '',
		'cv_grade_earlyelementary' => '',
		'cv_grade_lateelementary' => '',
		'cv_grade_middleschool' => '',
		'cv_grade_highschool' => '',
		'cv_grade_othercategories' => '',	        
		'cv_grade_othercategories_text' => '',
		'cv_more_info' => '',
		'cv_paste_cv' => '',
		'access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'entity' => $cv,
		'tags' => '',
		'guid' => null,
		'comments_on' => NULL,
	);          

	if ($cv) {
		foreach (array_keys($values) as $field) {
			if (isset($cv->$field)) {
					$values[$field] = $cv->$field;
			}
		}
	}

	if (elgg_is_sticky_form('educvpost')) {
		$sticky_values = elgg_get_sticky_values('educvpost');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('educvpost');

	return $values;
	
	return false; 
}

//add post cv work experience form parameters
function cv_work_experience_prepare_form_vars($cvwe = null) {

	// input names => defaults
	$values = array(
		'cvwe_job_title' => '',
		'cvwe_organization' => '',
		'cvwe_country' => '',
		'cvwe_city' => '',
		'cvwe_period_from' => '',
		'cvwe_period_to' => '',
		'cvwe_period_now' => '',
		'cvwe_salary_starting' => '',
		'cvwe_salary_ending' => '',
		'cvwe_salary_unit_time' => '',
		'cvwe_salary_currency' => '',
		'cvwe_reasons_go' => '',
		'cvwe_subject_math' => '',	
		'cvwe_subject_science' => '',		
		'cvwe_subject_socialstudies' => '',	
		'cvwe_subject_spanish' => '',
		'cvwe_subject_english' => '',	
		'cvwe_subject_otherforeignlangs' => '',
		'cvwe_subject_technology' => '',
		'cvwe_subject_othersubjects' => '',
		'cvwe_subject_othersubjects_text' => '',
		'cvwe_grade_kindergarten' => '',
		'cvwe_grade_earlyelementary' => '',
		'cvwe_grade_lateelementary' => '',
		'cvwe_grade_middleschool' => '',
		'cvwe_grade_highschool' => '',
		'cvwe_grade_othercategories' => '',	        
		'cvwe_grade_othercategories_text' => '',	
		'tags' => '',	
		'cvwe_comments' => '',
		'access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'entity' => $cvwe,
		'guid' => null,
	);          

	if ($cvwe) {
		foreach (array_keys($values) as $field) {
			if (isset($cvwe->$field)) {
					$values[$field] = $cvwe->$field;
			}
		}
	}

	if (elgg_is_sticky_form('educvwepost')) {
		$sticky_values = elgg_get_sticky_values('educvwepost');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('educvwepost');

	return $values;
	
	return false; 
}

//add post cv education form parameters
function cv_education_prepare_form_vars($cvedu = null) {

	// input names => defaults
	$values = array(
		'cvedu_degree' => '',
		'cvedu_school_name' => '',
		'cvedu_country' => '',
		'cvedu_city' => '',
		'cvedu_time_currently' => '',
		'cvedu_time_from' => '',
		'cvedu_time_to' => '',
		'access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'entity' => $cvedu,
		'guid' => null,
	);          

	if ($cvedu) {
		foreach (array_keys($values) as $field) {
			if (isset($cvedu->$field)) {
					$values[$field] = $cvedu->$field;
			}
		}
	}

	if (elgg_is_sticky_form('educvedupost')) {
		$sticky_values = elgg_get_sticky_values('educvedupost');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('educvedupost');

	return $values;
	
	return false; 
}

//add post cv language form parameters
function cv_language_prepare_form_vars($cvlang = null) {

	// input names => defaults
	$values = array(
		'cvlang_language' => '',
		'cvlang_level' => '',
		'cvlang_cert_institute' => '',
		'cvlang_reading_score' => '',
		'cvlang_listening_score' => '',
		'cvlang_speaking_score' => '',
		'cvlang_writing_score' => '',
		'cvlang_total_score' => '',
		'cvlang_cert_document' => '',

		'access_id' => ACCESS_DEFAULT,
		'container_guid' => elgg_get_page_owner_guid(),
		'entity' => $cvlang,
		'guid' => null,
	);          

	if ($cvlang) {
		foreach (array_keys($values) as $field) {
			if (isset($cvlang->$field)) {
					$values[$field] = $cvlang->$field;
			}
		}
	}

	if (elgg_is_sticky_form('educvlangpost')) {
		$sticky_values = elgg_get_sticky_values('educvlangpost');
		foreach ($sticky_values as $key => $value) {
			$values[$key] = $value;
		}
	}

	elgg_clear_sticky_form('educvlangpost');

	return $values;
	
	return false; 
}

// get the profile type of current user
function get_profile_type($user = null) {
	// check if user belongs to Docente or Colegio profile
	if($user && $profile_type_guid = $user->custom_profile_type){
		if(($profile_type = get_entity($profile_type_guid)) && ($profile_type instanceof ProfileManagerCustomProfileType)){
			if ($profile_type->getTitle()=='Docente') {
				return 'Docente';
			}
			else if ($profile_type->getTitle()=='Colegio') {
				return 'Colegio';
			}
			 
		}
	}

	return 'Default';
}

// check if user can post post (Colegio)
function check_if_user_can_post_jobs($user = null) {
	if($user && $profile_type_guid = $user->custom_profile_type){
		if(($profile_type = get_entity($profile_type_guid)) && ($profile_type instanceof ProfileManagerCustomProfileType)){
			if ($profile_type->getTitle()=='Colegio') {
				return true;
			}
		}
	}
    
    return false;
}

// check if user is teacher
function check_if_user_is_teacher($user = null) {
	if($user && $profile_type_guid = $user->custom_profile_type){
		if(($profile_type = get_entity($profile_type_guid)) && ($profile_type instanceof ProfileManagerCustomProfileType)){
			if ($profile_type->getTitle()=='Docente') {
				return true;
			}
		}
	}
    
    return false;
}

// check if user is school
function check_if_user_is_school($user = null) {
	if($user && $profile_type_guid = $user->custom_profile_type){
		if(($profile_type = get_entity($profile_type_guid)) && ($profile_type instanceof ProfileManagerCustomProfileType)){
			if ($profile_type->getTitle()=='Colegio') {
				return true;
			}
		}
	}
    
    return false;
}

// check if job expired
function check_if_job_expired($time_created, $published_period) {
	if (time() - $time_created > $published_period)
		return true;
	
	return false;	    
}

// check if user is teacher has upload CV
function check_if_user_has_cv($user = null) {
	if ($user != null && $user->custom_profile_type == DOCENTE_PROFILE_TYPE_GUID)	{
		$cv = elgg_get_entities(array(
			'type' => 'object',
			'subtype' => 'educv',
			'limit' => 0,
			'full_view' => false,
			'count' => false,
			'owner_guid' => $user->guid,
		));	

		if ($cv) 
			return $cv[0]->guid;
	}
	
	return false;	    
}

// check if user is teacher has apply on this job
function check_if_user_has_apply($user_guid = null, $job_guid = null) {
	$options = array(
		'type' => 'object',
		'subtype' => 'jobappication',
		'limit' => 0,
		'metadata_name_value_pairs' => array(
			array('name' => 'user_guid','value' => $user_guid, 'operand' => '='),
			array('name' => 'job_guid', 'value' => $job_guid, 'operand' => '='),
		),
		'metadata_name_value_pairs_operator' => 'AND',
	);		
	$apply = elgg_get_entities_from_metadata($options);	
    
    if ($apply) {
		foreach ($apply as $ap)	{
			return $ap->time_created;
		}
		
		//return true;
	}
    
	return false;
}

// get list of publish periods
function get_publish_periods() {
    $periods = array(
		'86400'=>elgg_echo('86400'),
		'172800'=>elgg_echo('172800'),
		'259200'=>elgg_echo('259200'),
		'604800'=>elgg_echo('604800'),
		'1296000'=>elgg_echo('1296000'),
		'2592000'=>elgg_echo('2592000'),
		'5184000'=>elgg_echo('5184000'),
		'7776000'=>elgg_echo('7776000'),
    );
    
    return $periods;
}

// get list of publish periods
function get_publish_periods_obs() {
    $periods = array(
		'edujobs:add:pp1'=>elgg_echo('edujobs:add:pp1'),
		'edujobs:add:pp2'=>elgg_echo('edujobs:add:pp2'),
		'edujobs:add:pp3'=>elgg_echo('edujobs:add:pp3'),
		'edujobs:add:pp7'=>elgg_echo('edujobs:add:pp7'),
		'edujobs:add:pp15'=>elgg_echo('edujobs:add:pp15'),
		'edujobs:add:pp30'=>elgg_echo('edujobs:add:pp30'),
		'edujobs:add:pp60'=>elgg_echo('edujobs:add:pp60'),
		'edujobs:add:pp90'=>elgg_echo('edujobs:add:pp90'),
    );
    
    return $periods;
}

// get list of available languages
function get_languages() {
    $langs = array(
		'Akan'=>elgg_echo('edujobs:langs:Akan'),
		'Amharic'=>elgg_echo('edujobs:langs:Amharic'),
		'Arabic'=>elgg_echo('edujobs:langs:Arabic'),
		'Assamese'=>elgg_echo('edujobs:langs:Assamese'),
		'Awadhi'=>elgg_echo('edujobs:langs:Awadhi'),
		'Azerbaijani'=>elgg_echo('edujobs:langs:Azerbaijani'),
		'Balochi'=>elgg_echo('edujobs:langs:Balochi'),
		'Belarusian'=>elgg_echo('edujobs:langs:Belarusian'),
		'Bengali'=>elgg_echo('edujobs:langs:Bengali'),
		'Bhojpuri'=>elgg_echo('edujobs:langs:Bhojpuri'),
		'Burmese'=>elgg_echo('edujobs:langs:Burmese'),
		'Cantonese'=>elgg_echo('edujobs:langs:Cantonese'),
		'Cebuano'=>elgg_echo('edujobs:langs:Cebuano'),
		'Chewa'=>elgg_echo('edujobs:langs:Chewa'),
		'Chhattisgarhi'=>elgg_echo('edujobs:langs:Chhattisgarhi'),
		'Chittagonian'=>elgg_echo('edujobs:langs:Chittagonian'),
		'Czech'=>elgg_echo('edujobs:langs:Czech'),
		'Deccan'=>elgg_echo('edujobs:langs:Deccan'),
		'Dhundhari'=>elgg_echo('edujobs:langs:Dhundhari'),
		'Dutch'=>elgg_echo('edujobs:langs:Dutch'),
		'English'=>elgg_echo('edujobs:langs:English'),
		'French'=>elgg_echo('edujobs:langs:French'),
		'Fula'=>elgg_echo('edujobs:langs:Fula'),
		'Gan'=>elgg_echo('edujobs:langs:Gan'),
		'German'=>elgg_echo('edujobs:langs:German'),
		'Greek'=>elgg_echo('edujobs:langs:Greek'),
		'Gujarati'=>elgg_echo('edujobs:langs:Gujarati'),
		'Hakka'=>elgg_echo('edujobs:langs:Hakka'),
		'Haryanvi'=>elgg_echo('edujobs:langs:Haryanvi'),
		'Hausa'=>elgg_echo('edujobs:langs:Hausa'),
		'Hiligaynon'=>elgg_echo('edujobs:langs:Hiligaynon'),
		'Hindi'=>elgg_echo('edujobs:langs:Hindi'),
		'Hmong'=>elgg_echo('edujobs:langs:Hmong'),
		'Hungarian'=>elgg_echo('edujobs:langs:Hungarian'),
		'Igbo'=>elgg_echo('edujobs:langs:Igbo'),
		'Ilokano'=>elgg_echo('edujobs:langs:Ilokano'),
		'Italian'=>elgg_echo('edujobs:langs:Italian'),
		'Japanese'=>elgg_echo('edujobs:langs:Japanese'),
		'Javanese'=>elgg_echo('edujobs:langs:Javanese'),
		'Jin'=>elgg_echo('edujobs:langs:Jin'),
		'Kannada'=>elgg_echo('edujobs:langs:Kannada'),
		'Kazakh'=>elgg_echo('edujobs:langs:Kazakh'),
		'Khmer'=>elgg_echo('edujobs:langs:Khmer'),
		'Kinyarwanda'=>elgg_echo('edujobs:langs:Kinyarwanda'),
		'Kirundi'=>elgg_echo('edujobs:langs:Kirundi'),
		'Konkani'=>elgg_echo('edujobs:langs:Konkani'),
		'Korean'=>elgg_echo('edujobs:langs:Korean'),
		'Kurdish'=>elgg_echo('edujobs:langs:Kurdish'),
		'Madurese'=>elgg_echo('edujobs:langs:Madurese'),
		'Magahi'=>elgg_echo('edujobs:langs:Magahi'),
		'Maithili'=>elgg_echo('edujobs:langs:Maithili'),
		'Malagasy'=>elgg_echo('edujobs:langs:Malagasy'),
		'Malay/Indonesian'=>elgg_echo('edujobs:langs:Malay/Indonesian'),
		'Malayalam'=>elgg_echo('edujobs:langs:Malayalam'),
		'Mandarin'=>elgg_echo('edujobs:langs:Mandarin'),
		'Marathi'=>elgg_echo('edujobs:langs:Marathi'),
		'Marwari'=>elgg_echo('edujobs:langs:Marwari'),
		'Mossi'=>elgg_echo('edujobs:langs:Mossi'),
		'Nepali'=>elgg_echo('edujobs:langs:Nepali'),
		'Oriya'=>elgg_echo('edujobs:langs:Oriya'),
		'Oromo'=>elgg_echo('edujobs:langs:Oromo'),
		'Pashto'=>elgg_echo('edujobs:langs:Pashto'),
		'Persian'=>elgg_echo('edujobs:langs:Persian'),
		'Polish'=>elgg_echo('edujobs:langs:Polish'),
		'Portuguese'=>elgg_echo('edujobs:langs:Portuguese'),
		'Punjabi'=>elgg_echo('edujobs:langs:Punjabi'),
		'Quechua'=>elgg_echo('edujobs:langs:Quechua'),
		'Romanian'=>elgg_echo('edujobs:langs:Romanian'),
		'Russian'=>elgg_echo('edujobs:langs:Russian'),
		'Saraiki'=>elgg_echo('edujobs:langs:Saraiki'),
		'Serbo-Croatian'=>elgg_echo('edujobs:langs:Serbo-Croatian'),
		'Shona'=>elgg_echo('edujobs:langs:Shona'),
		'Sindhi'=>elgg_echo('edujobs:langs:Sindhi'),
		'Sinhalese'=>elgg_echo('Sinhalese'),
		'Somali'=>elgg_echo('edujobs:langs:Somali'),
		'Spanish'=>elgg_echo('edujobs:langs:Spanish'),
		'Sundanese'=>elgg_echo('edujobs:langs:Sundanese'),
		'Swahili'=>elgg_echo('edujobs:langs:Swahili'),
		'Swedish'=>elgg_echo('edujobs:langs:Swedish'),
		'Sylheti'=>elgg_echo('edujobs:langs:Sylheti'),
		'Tagalog'=>elgg_echo('edujobs:langs:Tagalog'),
		'Tamil'=>elgg_echo('edujobs:langs:Tamil'),
		'Telugu'=>elgg_echo('edujobs:langs:Telugu'),
		'Thai'=>elgg_echo('edujobs:langs:Thai'),
		'Turkish'=>elgg_echo('edujobs:langs:Turkish'),
		'Ukrainian'=>elgg_echo('edujobs:langs:Ukrainian'),
		'Urdu'=>elgg_echo('edujobs:langs:Urdu'),
		'Uyghur'=>elgg_echo('edujobs:langs:Uyghur'),
		'Uzbek'=>elgg_echo('edujobs:langs:Uzbek'),
		'Vietnamese'=>elgg_echo('edujobs:langs:Vietnamese'),
		'Wu'=>elgg_echo('edujobs:langs:Wu'),
		'Xhosa'=>elgg_echo('edujobs:langs:Xhosa'),
		'Xiang'=>elgg_echo('edujobs:langs:Xiang'),
		'Yoruba'=>elgg_echo('edujobs:langs:Yoruba'),
		'Zhuang'=>elgg_echo('edujobs:langs:Zhuang'),
		'Zulu'=>elgg_echo('edujobs:langs:Zulu'),
    );
    
    return $langs;
}

// get list of lang levels
function get_lang_levels() {
    $lang_level = array(
		'edujobs:langs:level:mother'=>elgg_echo('edujobs:langs:level:mother'),
		'edujobs:langs:level:native'=>elgg_echo('edujobs:langs:level:native'),
		'edujobs:langs:level:advanced'=>elgg_echo('edujobs:langs:level:advanced'),
		'edujobs:langs:level:intermediate'=>elgg_echo('edujobs:langs:level:intermediate'),
		'edujobs:langs:level:basic'=>elgg_echo('edujobs:langs:level:basic'),
		'edujobs:langs:level:none'=>elgg_echo('edujobs:langs:level:none'),
    );
    
    return $lang_level;
}

// get list of publish periods
function get_genders() {
    $genders = array(
		'edujobs:add:male'=>elgg_echo('edujobs:add:male'),
		'edujobs:add:female'=>elgg_echo('edujobs:add:female'),
    );
    
    return $genders;
}

// get list of years
function get_years() {
	$years = array();
	//$years[zero] = 0;
	for ($i = 0; $i <= 60; $i++) {
		$years[$i] = $i;
	}
   
    return $years;
}

// get list of start working for search
function get_start_working_search() {
    $start_working = array(
		'0' => elgg_echo('edujobs:search:select'),
		'edujobs:add:month01' => elgg_echo('edujobs:search:month01'),
		'edujobs:add:month13' => elgg_echo('edujobs:search:month13'),
		'edujobs:add:month49' => elgg_echo('edujobs:search:month49'),
    );
    
    return $start_working;
}

// get list of start working
function get_start_working() {
    $start_working = array(
		'edujobs:add:month01' => elgg_echo('edujobs:add:month01'),
		'edujobs:add:month13' => elgg_echo('edujobs:add:month13'),
		'edujobs:add:month49' => elgg_echo('edujobs:add:month49'),
    );
    
    return $start_working;
}

// get list of work desired
function get_work_desired_search() {
    $work_desired = array(
		'0' => elgg_echo('edujobs:search:select'),
		'edujobs:add:fulltime'=>elgg_echo('edujobs:add:fulltime'),
		'edujobs:add:parttime'=>elgg_echo('edujobs:add:parttime'),
    );
    
    return $work_desired;
}

// get list of work desired
function get_work_desired() {
    $work_desired = array(
		'edujobs:add:fulltime'=>elgg_echo('edujobs:add:fulltime'),
		'edujobs:add:parttime'=>elgg_echo('edujobs:add:parttime'),
    );
    
    return $work_desired;
}

// get list of salary time
function get_salary_time() {
    $salary_time = array(
		'edujobs:add:year'=>elgg_echo('edujobs:add:year'),
		'edujobs:add:month'=>elgg_echo('edujobs:add:month'),
		'edujobs:add:hour'=>elgg_echo('edujobs:add:hour'),
    );
    
    return $salary_time;
}

// get list of publish periods
function get_sort_by_selector($current_url, $current_orderby = null, $teachers = false) {
	$datepostedrecent_selected = "";
	$datepostedlatest_selected = "";
	$noofapplicandslow_selected = "";
	$noofapplicandshigh_selected = "";
	//print_r($current_orderby);
	if ($current_orderby != null)	{
		if ($current_orderby == "datepostedrecent") $datepostedrecent_selected = " selected ";
		if ($current_orderby == "datepostedlatest") $datepostedlatest_selected = " selected ";
		if ($current_orderby == "noofapplicandslow") $noofapplicandslow_selected = " selected ";
		if ($current_orderby == "noofapplicandshigh") $noofapplicandshigh_selected = " selected ";
		if ($current_orderby == "dateappliedlatest") $dateappliedlatest_selected = " selected ";
		if ($current_orderby == "dateappliedrecent") $dateappliedrecent_selected = " selected ";
	}
	
	$selector = '<div style="float:right; margin:10px 0;">';
	$selector .= '<select onchange="gotopage(this)">';
	$selector .= '<option value="'.$current_url.'?orderby=datepostedrecent" '.$datepostedrecent_selected.'>'.elgg_echo('edujobs:view:job:sort:datepostedrecent').'</option>';
	$selector .= '<option value="'.$current_url.'?orderby=datepostedlatest" '.$datepostedlatest_selected.'>'.elgg_echo('edujobs:view:job:sort:datepostedlatest').'</option>';
	if ($teachers) {
		$selector .= '<option value="'.$current_url.'?orderby=dateappliedrecent" '.$dateappliedrecent_selected.'>'.elgg_echo('edujobs:view:job:sort:dateappliedrecent').'</option>';
		$selector .= '<option value="'.$current_url.'?orderby=dateappliedlatest" '.$dateappliedlatest_selected.'>'.elgg_echo('edujobs:view:job:sort:dateappliedlatest').'</option>';
	}
	$selector .= '<option value="'.$current_url.'?orderby=noofapplicandslow" '.$noofapplicandslow_selected.'>'.elgg_echo('edujobs:view:job:sort:noofapplicandslow').'</option>';
	$selector .= '<option value="'.$current_url.'?orderby=noofapplicandshigh" '.$noofapplicandshigh_selected.'>'.elgg_echo('edujobs:view:job:sort:noofapplicandshigh').'</option>';
	$selector .= '</select>';
	$selector .= '</div>';
	
	return $selector;
}

function elgg_list_entities_from_metadata_edujobs($options, $viewer = 'elgg_view_entity_list', $orderby = '', $user_guid = null) {
	return elgg_list_entities_edujobs($options, 'elgg_get_entities_from_metadata', $viewer, $orderby, $user_guid);
}


// special edition of elgg_list_entities for more flexible sorting for edujobs
function elgg_list_entities_edujobs(array $options = array(), $getter = 'elgg_get_entities', $viewer = 'elgg_view_entity_list', $orderby = '', $user_guid = null) {
 
	 global $autofeed;
	 $autofeed = true;
	 $entities = array();

	 $offset_key = isset($options['offset_key']) ? $options['offset_key'] : 'offset';

	 $defaults = array(
		 'offset' => (int) max(get_input($offset_key, 0), 0),
		 'limit' => (int) max(get_input('limit', 10), 0),
		 'full_view' => TRUE,
		 'list_type_toggle' => FALSE,
		 'pagination' => TRUE,
	 );
	 
	 $options = array_merge($defaults, $options);

	 //backwards compatibility
	 if (isset($options['view_type_toggle'])) {
		 $options['list_type_toggle'] = $options['view_type_toggle'];
	 }

	 if ($orderby === 'noofapplicandslow' || $orderby === 'noofapplicandshigh' 
		|| $orderby === 'dateappliedrecent' || $orderby === 'dateappliedlatest') {
		 $options['limit'] = 0;
		 $options['full_view'] = false;
		 $options['protected'] = false;
	 }
	 $options['count'] = TRUE;
	 $count = $getter($options);
	 $options['count'] = FALSE;	 
	 
	 $entities = $getter($options);
	 $options['count'] = $count;

	if ($orderby === 'noofapplicandslow' || $orderby === 'noofapplicandshigh') {
		foreach ($entities as $item )	{
			$noofapplicants = get_number_of_applicants($item->guid);
			$item->noofapplicants = $noofapplicants;
			//print_r('<br /> ->'.$item->noofapplicants)	;
		}
			
		if ($orderby === 'noofapplicandshigh')
			usort($entities, 'noofapplicandshigh_sorter');
		else if ($orderby === 'noofapplicandslow')
			usort($entities, 'noofapplicandslow_sorter');
			
		$options['limit'] = (int) max(get_input('limit', 10), 0);
		$options['count'] = TRUE;
		$count = $getter($options);
	}
	else if ($orderby === 'dateappliedrecent' || $orderby === 'dateappliedlatest') {
		foreach ($entities as $item )	{
			$date_applied = get_date_of_application($item->guid, $user_guid);
			$item->date_applied = $date_applied;
		}
	//print_r('skata')	;
		if ($orderby === 'dateappliedrecent')
			usort($entities, 'dateappliedrecent_sorter');
		else if ($orderby === 'dateappliedlatest')
			usort($entities, 'dateappliedlatest_sorter');
			
		$options['limit'] = (int) max(get_input('limit', 10), 0);
		$options['count'] = TRUE;
		$count = $getter($options);
	}	
	
//print_r('---> '.$options['limit']);
	return $viewer($entities, $options);
}

// Date applied (recent) sorter
function dateappliedrecent_sorter($a, $b){
	if ($a->date_applied == $b->date_applied) {
		return 0;
	}
	return ($a->date_applied < $b->date_applied) ? 1 : -1;
}

// Date applied (latest) sorter
function dateappliedlatest_sorter($a, $b){
	if ($a->date_applied == $b->date_applied) {
		return 0;
	}
	return ($a->date_applied > $b->date_applied) ? 1 : -1;
}

// No of Applicants (high) sorter
function noofapplicandshigh_sorter($a, $b){
	if ($a->noofapplicants == $b->noofapplicants) {
		return 0;
	}
	return ($a->noofapplicants < $b->noofapplicants) ? 1 : -1;
}

// No of Applicants (low) sorter
function noofapplicandslow_sorter($a, $b){
	if ($a->noofapplicants == $b->noofapplicants) {
		return 0;
	}
	return ($a->noofapplicants > $b->noofapplicants) ? 1 : -1;
}

// get no of applicants for a specific job
function get_number_of_applicants($job_guid = null) {
	if ($job_guid != null && is_numeric($job_guid))	{
		//print_r($job_guid.' - ');
		$noofapplies = elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'jobappication',
			'limit' => 0,
			'full_view' => false,
			'count'  => true,
			'metadata_name_value_pairs' => array(array('name' => 'job_guid','value' => $job_guid, 'operand' => '=')),
		));	
	
		if ($noofapplies>0) 
			return $noofapplies;
	}
	
	return 0;	
}

// get date of user application for a specific job
function get_date_of_application($job_guid = null, $user_guid = null) {
	if ($job_guid != null && is_numeric($job_guid) && $user_guid != null && is_numeric($user_guid))	{
		
		$applies = elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'jobappication',
			'limit' => 1,
			'full_view' => false,
			'metadata_name_value_pairs' => array(array('name' => 'user_guid','value' => $user_guid, 'operand' => '=')),
			'metadata_name_value_pairs' => array(array('name' => 'job_guid','value' => $job_guid, 'operand' => '=')),
			'metadata_name_value_pairs_operator' => 'AND',
			'count'  => false,
		));	
		
		if ($applies) 
			return $applies[0]->time_created;
	}
	
	return 0;	
}


// get list of countries
function get_countries_list() {
    $countries = array(
		'Afghanistan'=>'Afghanistan',
		'Åland Islands'=>'Åland Islands',
		'Albania'=>'Albania',
		'Algeria'=>'Algeria',
		'American Samoa'=>'American Samoa',
		'Andorra'=>'Andorra',
		'Angola'=>'Angola',
		'Anguilla'=>'Anguilla',
		'Antarctica'=>'Antarctica',
		'Antigua and Barbuda'=>'Antigua and Barbuda',
		'Argentina'=>'Argentina',
		'Armenia'=>'Armenia',
		'Aruba'=>'Aruba',
		'Australia'=>'Australia',
		'Austria'=>'Austria',
		'Azerbaijan'=>'Azerbaijan',
		'Bahamas'=>'Bahamas',
		'Bahrain'=>'Bahrain',
		'Bangladesh'=>'Bangladesh',
		'Barbados'=>'Barbados',
		'Belarus'=>'Belarus',
		'Belgium'=>'Belgium',
		'Belize'=>'Belize',
		'Benin'=>'Benin',
		'Bermuda'=>'Bermuda',
		'Bhutan'=>'Bhutan',
		'Bolivia'=>'Bolivia',
		'Bosnia and Herzegovina'=>'Bosnia and Herzegovina',
		'Botswana'=>'Botswana',
		'Bouvet Island'=>'Bouvet Island',
		'Brazil'=>'Brazil',
		'British Indian Ocean Territory'=>'British Indian Ocean Territory',
		'Brunei Darussalam'=>'Brunei Darussalam',
		'Bulgaria'=>'Bulgaria',
		'Burkina Faso'=>'Burkina Faso',
		'Burundi'=>'Burundi',
		'Cambodia'=>'Cambodia',
		'Cameroon'=>'Cameroon',
		'Canada'=>'Canada',
		'Cape Verde'=>'Cape Verde',
		'Cayman Islands'=>'Cayman Islands',
		'Central African Republi'=>'Central African Republic',
		'Chad'=>'Chad',
		'Chile'=>'Chile',
		'China'=>'China',
		'Christmas Island'=>'Christmas Island',
		'Cocos (Keeling) Islands'=>'Cocos (Keeling) Islands',
		'Colombia'=>'Colombia',
		'Comoros'=>'Comoros',
		'Congo'=>'Congo',
		'Congo The Democratic Republic of The'=>'Congo The Democratic Republic of The',
		'Cook Islands'=>'Cook Islands',
		'Costa Rica'=>'Costa Rica',
		'Cote D\'ivoire'=>'Cote D\'ivoire',
		'Croatia'=>'Croatia',
		'Cuba'=>'Cuba',
		'Cyprus'=>'Cyprus',
		'Czech Republic'=>'Czech Republic',
		'Denmark'=>'Denmark',
		'Djibouti'=>'Djibouti',
		'Dominica'=>'Dominica',
		'Dominican Republic'=>'Dominican Republic',
		'Ecuador'=>'Ecuador',
		'Egypt'=>'Egypt',
		'El Salvador'=>'El Salvador',
		'Equatorial Guinea'=>'Equatorial Guinea',
		'Eritrea'=>'Eritrea',
		'Estonia'=>'Estonia',
		'Ethiopia'=>'Ethiopia',
		'Falkland Islands (Malvinas)'=>'Falkland Islands (Malvinas)',
		'Faroe Islands'=>'Faroe Islands',
		'Fiji'=>'Fiji',
		'Finland'=>'Finland',
		'France'=>'France',
		'French Guiana'=>'French Guiana',
		'French Polynesia'=>'French Polynesia',
		'French Southern Territories'=>'French Southern Territories',
		'Gabon'=>'Gabon',
		'Gambia'=>'Gambia',
		'Georgia'=>'Georgia',
		'Germany'=>'Germany',
		'Ghana'=>'Ghana',
		'Gibraltar'=>'Gibraltar',
		'Greece'=>'Greece',
		'Greenland'=>'Greenland',
		'Grenada'=>'Grenada',
		'Guadeloupe'=>'Guadeloupe',
		'Guam'=>'Guam',
		'Guatemala'=>'Guatemala',
		'Guernsey'=>'Guernsey',
		'Guinea'=>'Guinea',
		'Guinea-bissau'=>'Guinea-bissau',
		'Guyana'=>'Guyana',
		'Haiti'=>'Haiti',
		'Heard Island and Mcdonald Islands'=>'Heard Island and Mcdonald Islands',
		'Holy See (Vatican City State)'=>'Holy See (Vatican City State)',
		'Honduras'=>'Honduras',
		'Hong Kong'=>'Hong Kong',
		'Hungary'=>'Hungary',
		'Iceland'=>'Iceland',
		'India'=>'India',
		'Indonesia'=>'Indonesia',
		'Iran Islamic Republic of'=>'Iran Islamic Republic of',
		'Iraq'=>'Iraq',
		'Ireland'=>'Ireland',
		'Isle of Man'=>'Isle of Man',
		'Israel'=>'Israel',
		'Italy'=>'Italy',
		'Jamaica'=>'Jamaica',
		'Japan'=>'Japan',
		'Jersey'=>'Jersey',
		'Jordan'=>'Jordan',
		'Kazakhstan'=>'Kazakhstan',
		'Kenya'=>'Kenya',
		'Kiribati'=>'Kiribati',
		'Korea Democratic People\'s Republic of'=>'Korea Democratic People\'s Republic of',
		'Korea Republic of'=>'Korea Republic of',
		'Kuwait'=>'Kuwait',
		'Kyrgyzstan'=>'Kyrgyzstan',
		'Lao People\'s Democratic Republic'=>'Lao People\'s Democratic Republic',
		'Latvia'=>'Latvia',
		'Lebanon'=>'Lebanon',
		'Lesotho'=>'Lesotho',
		'Liberia'=>'Liberia',
		'Libyan Arab Jamahiriya'=>'Libyan Arab Jamahiriya',
		'Liechtenstein'=>'Liechtenstein',
		'Lithuania'=>'Lithuania',
		'Luxembourg'=>'Luxembourg',
		'Macao'=>'Macao',
		'Macedonia The Former Yugoslav Republic of'=>'Macedonia The Former Yugoslav Republic of',
		'Madagascar'=>'Madagascar',
		'Malawi'=>'Malawi',
		'Malaysia'=>'Malaysia',
		'Maldives'=>'Maldives',
		'Mali'=>'Mali',
		'Malta'=>'Malta',
		'Marshall Islands'=>'Marshall Islands',
		'Martinique'=>'Martinique',
		'Mauritania'=>'Mauritania',
		'Mauritius'=>'Mauritius',
		'Mayotte'=>'Mayotte',
		'Mexico'=>'Mexico',
		'Micronesia Federated States of'=>'Micronesia Federated States of',
		'Moldova Republic of'=>'Moldova Republic of',
		'Monaco'=>'Monaco',
		'Mongolia'=>'Mongolia',
		'Montenegro'=>'Montenegro',
		'Montserrat'=>'Montserrat',
		'Morocco'=>'Morocco',
		'Mozambique'=>'Mozambique',
		'Myanmar'=>'Myanmar',
		'Namibia'=>'Namibia',
		'Nauru'=>'Nauru',
		'Nepal'=>'Nepal',
		'Netherlands'=>'Netherlands',
		'Netherlands Antilles'=>'Netherlands Antilles',
		'New Caledonia'=>'New Caledonia',
		'New Zealand'=>'New Zealand',
		'Nicaragua'=>'Nicaragua',
		'Niger'=>'Niger',
		'Nigeria'=>'Nigeria',
		'Niue'=>'Niue',
		'Norfolk Island'=>'Norfolk Island',
		'Northern Mariana Islands'=>'Northern Mariana Islands',
		'Norway'=>'Norway',
		'Oman'=>'Oman',
		'Pakistan'=>'Pakistan',
		'Palau'=>'Palau',
		'Palestinian Territory Occupied'=>'Palestinian Territory Occupied',
		'Panama'=>'Panama',
		'Papua New Guinea'=>'Papua New Guinea',
		'Paraguay'=>'Paraguay',
		'Peru'=>'Peru',
		'Philippines'=>'Philippines',
		'Pitcairn'=>'Pitcairn',
		'Poland'=>'Poland',
		'Portugal'=>'Portugal',
		'Puerto Rico'=>'Puerto Rico',
		'Qatar'=>'Qatar',
		'Reunion'=>'Reunion',
		'Romania'=>'Romania',
		'Russian Federation'=>'Russian Federation',
		'Rwanda'=>'Rwanda',
		'Saint Helena'=>'Saint Helena',
		'Saint Kitts and Nevis'=>'Saint Kitts and Nevis',
		'Saint Lucia'=>'Saint Lucia',
		'Saint Pierre and Miquelon'=>'Saint Pierre and Miquelon',
		'Saint Vincent and The Grenadines'=>'Saint Vincent and The Grenadines',
		'Samoa'=>'Samoa',
		'San Marino'=>'San Marino',
		'Sao Tome and Princip'=>'Sao Tome and Principe',
		'Saudi Arabi'=>'Saudi Arabia',
		'Senegal'=>'Senegal',
		'Serbia'=>'Serbia',
		'Seychelles'=>'Seychelles',
		'Sierra Leone'=>'Sierra Leone',
		'Singapore'=>'Singapore',
		'Slovakia'=>'Slovakia',
		'Slovenia'=>'Slovenia',
		'Solomon Islands'=>'Solomon Islands',
		'Somalia'=>'Somalia',
		'South Africa'=>'South Africa',
		'South Georgia and The South Sandwich Islands'=>'South Georgia and The South Sandwich Islands',
		'Spain'=>'Spain',
		'Sri Lanka'=>'Sri Lanka',
		'Sudan'=>'Sudan',
		'Suriname'=>'Suriname',
		'Svalbard and Jan Mayen'=>'Svalbard and Jan Mayen',
		'Swaziland'=>'Swaziland',
		'Sweden'=>'Sweden',
		'Switzerland'=>'Switzerland',
		'Syrian Arab Republic'=>'Syrian Arab Republic',
		'Taiwan Province of China'=>'Taiwan Province of China',
		'Tajikistan'=>'Tajikistan',
		'Tanzania United Republic of'=>'Tanzania United Republic of',
		'Thailand'=>'Thailand',
		'Timor-leste'=>'Timor-leste',
		'Togo'=>'Togo',
		'Tokelau'=>'Tokelau',
		'Tonga'=>'Tonga',
		'Trinidad and Tobago'=>'Trinidad and Tobago',
		'Tunisia'=>'Tunisia',
		'Turkey'=>'Turkey',
		'Turkmenistan'=>'Turkmenistan',
		'Turks and Caicos Islands'=>'Turks and Caicos Islands',
		'Tuvalu'=>'Tuvalu',
		'Uganda'=>'Uganda',
		'Ukraine'=>'Ukraine',
		'United Arab Emirates'=>'United Arab Emirates',
		'United Kingdom'=>'United Kingdom',
		'United States'=>'United States',
		'United States Minor Outlying Islands'=>'United States Minor Outlying Islands',
		'Uruguay'=>'Uruguay',
		'Uzbekistan'=>'Uzbekistan',
		'Vanuatu'=>'Vanuatu',
		'Venezuela'=>'Venezuela',
		'Viet Nam'=>'Viet Nam',
		'Virgin Islands British'=>'Virgin Islands British',
		'Virgin Islands U.S.'=>'Virgin Islands U.S.',
		'Wallis and Futuna'=>'Wallis and Futuna',
		'Western Sahar'=>'Western Sahara',
		'Yemen'=>'Yemen',
		'Zambia'=>'Zambia',
		'Zimbabwe'=>'Zimbabwe',		
    );
    
    return $countries;
}

function get_edujobs_currency_list() {
    // Currencies list according paypal api
    $CurrOptions = array(
		'ARS'=>'Argentine peso',
        'AUD'=>'Australian Dollar',
        'BOB'=>'Bolivian boliviano',
        'BRL'=>'Brazilian Real',
        'CAD'=>'Canadian Dollar',
        'CLP'=>'Chilean peso',
        'CNY'=>'Chinese yuan',
        'COP'=>'Colombian peso',
        'CRC'=>'Costa Rican colón',
        'CUP'=>'Cuban peso',
        'CZK'=>'Czech Koruna',
        'DKK'=>'Danish Krone',
        'DOP'=>'Dominican peso',
        'EUR'=>'Euro',
        'GTQ'=>'Guatemalan quetzal',
        'HTG'=>'Haitian gourde',
        'HKD'=>'Hong Kong Dollar',
        'HUF'=>'Hungarian Forint',
        'ILS'=>'Israeli New Sheqel',
        'JMD'=>'Jamaican dollar',
        'JPY'=>'Japanese Yen',
        'MYR'=>'Malaysian Ringgit',
        'MXN'=>'Mexican Peso',
        'NIO'=>'Nicaraguan córdoba',
        'NOK'=>'Norwegian Krone',
        'NZD'=>'New Zealand Dollar',
        'PAB'=>'Panamanian balboa',
        'PYG'=>'Paraguayan guaraní',
        'PEN'=>'Peruvian nuevo sol',
        'PHP'=>'Philippine Peso',
        'PLN'=>'Polish Zloty',
        'GBP'=>'Pound Sterling',
        'SVC'=>'Salvadoran colón',
        'SGD'=>'Singapore Dollar',
        'SEK'=>'Swedish Krona',
        'CHF'=>'Swiss Franc',
        'TWD'=>'Taiwan New Dollar',
        'THB'=>'Thai Baht',
        'TRY'=>'Turkish Lira',
        'UYU'=>'Uruguayan peso',
        'USD'=>'U.S. Dollar',
        'VEF'=>'Venezuelan bolívar',
    );
    
    return $CurrOptions;
}










