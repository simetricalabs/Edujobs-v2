<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

//gatekeeper();
elgg_load_library('elgg:edujobs');

$user = elgg_get_logged_in_user_entity();

elgg_push_breadcrumb(elgg_echo('edujobs'),'edujobs/jobs');

$selected = $page[0].'/'.$page[1];

elgg_push_breadcrumb(elgg_echo('edujobs:label:teachers'));
$title = elgg_echo('edujobs:label:teachers');

$search_options = array();
$sidebar_options = array();
$options = array(
	'type' => 'object',
	'subtype' => 'educv',
	'limit' => (int) max(get_input('limit', 10), 0),
	'full_view' => false,
	'list_type_toggle' => false,
	'count' => false,
	'pagination' => true,
);

//$profile_type_frm = array('name' => 'custom_profile_type','value' => DOCENTE_PROFILE_TYPE_GUID, 'operand' => '=');
//array_push($search_options,$profile_type_frm);
	 
//$options['count'] = true;
//$count = elgg_get_entities_from_metadata($options);
//$options['count'] = false;
//$options['offset'] = max(get_input('offset'));
//$options['count'] = $count;

///// get search option if any ///////
if (get_input("searchformsubmitted"))	{
	$cv_birth_country = get_input("cv_birth_country");
	$cv_birth_city = get_input("cv_birth_city");
	$cv_grade_kindergarten = get_input("cv_grade_kindergarten");
	$cv_grade_earlyelementary = get_input("cv_grade_earlyelementary");
	$cv_grade_lateelementary = get_input("cv_grade_lateelementary");
	$cv_grade_middleschool = get_input("cv_grade_middleschool");
	$cv_grade_highschool = get_input("cv_grade_highschool");
	$cv_grade_othercategories = get_input("cv_grade_othercategories");
	$cv_subject_math = get_input("cv_subject_math");
	$cv_subject_science = get_input("cv_subject_science");
	$cv_subject_socialstudies = get_input("cv_subject_socialstudies");
	$cv_subject_spanish = get_input("cv_subject_spanish");
	$cv_subject_english = get_input("cv_subject_english");
	$cv_subject_otherforeignlangs = get_input("cv_subject_otherforeignlangs");
	$cv_subject_technology = get_input("cv_subject_technology");
	$cv_subject_othersubjects = get_input("cv_subject_othersubjects");
	$cv_wey0 = get_input("cv_wey0");
	$cv_wey1 = get_input("cv_wey1");
	$cv_wey2 = get_input("cv_wey2");
	$cv_wey5 = get_input("cv_wey5");
	$cv_wey10 = get_input("cv_wey10");
	$cv_availability_date = get_input("cv_availability_date");
	$cv_desired_work_type = get_input("cv_desired_work_type");
	$tags = get_input("tags");
	
	if ($cv_birth_country) {
		$cv_birth_country_frm = array('name' => 'cv_birth_country','value' => $cv_birth_country, 'operand' => '=');
		array_push($search_options,$cv_birth_country_frm);
		$sidebar_options[cv_birth_country] = $cv_birth_country;
	}
	if ($cv_birth_city) {
		$cv_birth_city_frm = array('name' => 'cv_birth_city','value' => $cv_birth_city, 'operand' => '=');
		array_push($search_options,$cv_birth_city_frm);
		$sidebar_options[cv_birth_city] = $cv_birth_city;
	}
	
	$grade_joins = '';
	$grade_wheres = '';
	if ($cv_grade_kindergarten) {
		$sidebar_options[cv_grade_kindergarten] = $cv_grade_kindergarten;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade1 on e.guid = n_grade1.entity_guid JOIN elgg_metastrings msgraden1 on n_grade1.name_id = msgraden1.id JOIN elgg_metastrings msgradev1 on n_grade1.value_id = msgradev1.id ';
		$grade_wheres .= '(msgraden1.string = \'cv_grade_kindergarten\' AND BINARY msgradev1.string IN (1) AND ( (1 = 1) and n_grade1.enabled=\'yes\')) OR ';
	}	
	if ($cv_grade_earlyelementary) {
		$sidebar_options[cv_grade_earlyelementary] = $cv_grade_earlyelementary;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade2 on e.guid = n_grade2.entity_guid JOIN elgg_metastrings msgraden2 on n_grade2.name_id = msgraden2.id JOIN elgg_metastrings msgradev2 on n_grade2.value_id = msgradev2.id ';
		$grade_wheres .= '(msgraden2.string = \'cv_grade_earlyelementary\' AND BINARY msgradev2.string IN (1) AND ( (1 = 1) and n_grade2.enabled=\'yes\')) OR ';
	}		
	if ($cv_grade_lateelementary) {
		$sidebar_options[cv_grade_lateelementary] = $cv_grade_lateelementary;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade3 on e.guid = n_grade3.entity_guid JOIN elgg_metastrings msgraden3 on n_grade3.name_id = msgraden3.id JOIN elgg_metastrings msgradev3 on n_grade3.value_id = msgradev3.id ';
		$grade_wheres .= '(msgraden3.string = \'cv_grade_lateelementary\' AND BINARY msgradev3.string IN (1) AND ( (1 = 1) and n_grade3.enabled=\'yes\')) OR ';
	}	
	if ($cv_grade_middleschool) {
		$sidebar_options[cv_grade_middleschool] = $cv_grade_middleschool;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade4 on e.guid = n_grade4.entity_guid JOIN elgg_metastrings msgraden4 on n_grade4.name_id = msgraden4.id JOIN elgg_metastrings msgradev4 on n_grade4.value_id = msgradev4.id ';
		$grade_wheres .= '(msgraden4.string = \'cv_grade_middleschool\' AND BINARY msgradev4.string IN (1) AND ( (1 = 1) and n_grade4.enabled=\'yes\')) OR ';
	}		
	if ($cv_grade_highschool) {
		$sidebar_options[cv_grade_highschool] = $cv_grade_highschool;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade5 on e.guid = n_grade5.entity_guid JOIN elgg_metastrings msgraden5 on n_grade5.name_id = msgraden5.id JOIN elgg_metastrings msgradev5 on n_grade5.value_id = msgradev5.id ';
		$grade_wheres .= '(msgraden5.string = \'cv_grade_highschool\' AND BINARY msgradev5.string IN (1) AND ( (1 = 1) and n_grade5.enabled=\'yes\')) OR ';
	}
	if ($cv_grade_othercategories) {
		$sidebar_options[cv_grade_othercategories] = $cv_grade_othercategories;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade6 on e.guid = n_grade6.entity_guid JOIN elgg_metastrings msgraden6 on n_grade6.name_id = msgraden6.id JOIN elgg_metastrings msgradev6 on n_grade6.value_id = msgradev6.id ';
		$grade_wheres .= '(msgraden6.string = \'cv_grade_othercategories\' AND BINARY msgradev6.string IN (1) AND ( (1 = 1) and n_grade6.enabled=\'yes\')) OR ';
	}	
	if ($grade_wheres)  {
		$grade_wheres = '( '.substr_replace($grade_wheres ,"",-3).' )';
	}		
	
	$subject_joins = '';
	$subject_wheres = '';	
	if ($cv_subject_math) {
		$sidebar_options['cv_subject_math'] = $cv_subject_math;
	
		$subject_joins .= ' JOIN elgg_metadata n_subj1 on e.guid = n_subj1.entity_guid JOIN elgg_metastrings mssubjn1 on n_subj1.name_id = mssubjn1.id JOIN elgg_metastrings mssubjv1 on n_subj1.value_id = mssubjv1.id ';
		$subject_wheres .= '(mssubjn1.string = \'cv_subject_math\' AND BINARY mssubjv1.string IN (1) AND ( (1 = 1) and n_subj1.enabled=\'yes\')) OR ';
	}
	if ($cv_subject_science) {
		$sidebar_options['cv_subject_science'] = $cv_subject_science;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj2 on e.guid = n_subj2.entity_guid JOIN elgg_metastrings mssubjn2 on n_subj2.name_id = mssubjn2.id JOIN elgg_metastrings mssubjv2 on n_subj2.value_id = mssubjv2.id ';
		$subject_wheres .= '(mssubjn2.string = \'cv_subject_science\' AND BINARY mssubjv2.string IN (1) AND ( (1 = 1) and n_subj2.enabled=\'yes\')) OR ';
	}	
	if ($cv_subject_socialstudies) {
		$sidebar_options['cv_subject_socialstudies'] = $cv_subject_socialstudies;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj3 on e.guid = n_subj3.entity_guid JOIN elgg_metastrings mssubjn3 on n_subj3.name_id = mssubjn3.id JOIN elgg_metastrings mssubjv3 on n_subj3.value_id = mssubjv3.id ';
		$subject_wheres .= '(mssubjn3.string = \'cv_subject_socialstudies\' AND BINARY mssubjv3.string IN (1) AND ( (1 = 1) and n_subj3.enabled=\'yes\')) OR ';
	}	
	if ($cv_subject_spanish) {
		$sidebar_options[cv_subject_spanish] = $cv_subject_spanish;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj4 on e.guid = n_subj4.entity_guid JOIN elgg_metastrings mssubjn4 on n_subj4.name_id = mssubjn4.id JOIN elgg_metastrings mssubjv4 on n_subj4.value_id = mssubjv4.id ';
		$subject_wheres .= '(mssubjn4.string = \'cv_subject_spanish\' AND BINARY mssubjv4.string IN (1) AND ( (1 = 1) and n_subj4.enabled=\'yes\')) OR ';
	}	
	if ($cv_subject_english) {
		$sidebar_options[cv_subject_english] = $cv_subject_english;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj5 on e.guid = n_subj5.entity_guid JOIN elgg_metastrings mssubjn5 on n_subj5.name_id = mssubjn5.id JOIN elgg_metastrings mssubjv5 on n_subj5.value_id = mssubjv5.id ';
		$subject_wheres .= '(mssubjn5.string = \'cv_subject_english\' AND BINARY mssubjv5.string IN (1) AND ( (1 = 1) and n_subj5.enabled=\'yes\')) OR ';
	}	
	if ($cv_subject_otherforeignlangs) {
		$sidebar_options[cv_subject_otherforeignlangs] = $cv_subject_otherforeignlangs;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj6 on e.guid = n_subj6.entity_guid JOIN elgg_metastrings mssubjn6 on n_subj6.name_id = mssubjn6.id JOIN elgg_metastrings mssubjv6 on n_subj6.value_id = mssubjv6.id ';
		$subject_wheres .= '(mssubjn6.string = \'cv_subject_otherforeignlangs\' AND BINARY mssubjv6.string IN (1) AND ( (1 = 1) and n_subj6.enabled=\'yes\')) OR ';
	}
	if ($cv_subject_technology) {
		$sidebar_options[cv_subject_technology] = $cv_subject_technology;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj7 on e.guid = n_subj7.entity_guid JOIN elgg_metastrings mssubjn7 on n_subj7.name_id = mssubjn7.id JOIN elgg_metastrings mssubjv7 on n_subj7.value_id = mssubjv7.id ';
		$subject_wheres .= '(mssubjn7.string = \'cv_subject_technology\' AND BINARY mssubjv7.string IN (1) AND ( (1 = 1) and n_subj7.enabled=\'yes\')) OR ';
	}	
	if ($cv_subject_othersubjects) {
		$sidebar_options[cv_subject_othersubjects] = $cv_subject_othersubjects;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj8 on e.guid = n_subj8.entity_guid JOIN elgg_metastrings mssubjn8 on n_subj8.name_id = mssubjn8.id JOIN elgg_metastrings mssubjv8 on n_subj8.value_id = mssubjv8.id ';
		$subject_wheres .= '(mssubjn8.string = \'cv_subject_othersubjects\' AND BINARY mssubjv8.string IN (1) AND ( (1 = 1) and n_subj8.enabled=\'yes\')) OR ';
	}
	if ($subject_wheres)  {
		$subject_wheres = '( '.substr_replace($subject_wheres ,"",-3).' )';
	}	
	
	if (($subject_joins && $subject_wheres) || ($grade_joins && $grade_wheres))  {
		$options['joins'] = $subject_joins.' '.$grade_joins;
		
		if ($subject_wheres && $grade_wheres)	$options['wheres'] = ' ('.$subject_wheres.') AND ('.$grade_wheres.') ';
		else if ($subject_wheres)	$options['wheres'] = ' ('.$subject_wheres.') ';
		else if ($grade_wheres)	$options['wheres'] = ' ('.$grade_wheres.') ';
	}	
	
	if ($cv_wey0 || $cv_wey1 || $cv_wey2 || $cv_wey5 || $cv_wey10) {
		$limit_low = -1;
		$limit_up = -1;
		if ($cv_wey0) { $limit_low = 0; $limit_up =0;}
		if ($cv_wey0 && $cv_wey1) { $limit_low = 0; $limit_up = 2;}
		if ($cv_wey0 && $cv_wey1 && $cv_wey2) { $limit_low = 0; $limit_up = 5;}
		if ($cv_wey0 && $cv_wey1 && $cv_wey2 && $cv_wey5) { $limit_low = 0; $limit_up = 10;}
		if ($cv_wey0 && $cv_wey1 && $cv_wey2 && $cv_wey5 && $cv_wey10) { $limit_low = 0; $limit_up = 100;}
		if ($cv_wey1) { $limit_low = 1; $limit_up = 2;}
		if ($cv_wey1 && $cv_wey2) { $limit_low = 1; $limit_up = 5;}
		if ($cv_wey1 && $cv_wey2 && $cv_wey5) { $limit_low = 1; $limit_up = 10;}
		if ($cv_wey1 && $cv_wey2 && $cv_wey5 && $cv_wey10) { $limit_low = 1; $limit_up = 100;}
		if ($cv_wey2) { $limit_low = 2; $limit_up = 5;}
		if ($cv_wey2 && $cv_wey5) { $limit_low = 2; $limit_up = 10;}
		if ($cv_wey2 && $cv_wey5 && $cv_wey10) { $limit_low = 2; $limit_up = 100;}
		if ($cv_wey5) { $limit_low = 5; $limit_up = 10;}
		if ($cv_wey5 && $cv_wey10) { $limit_low = 5; $limit_up = 100;}
		$cv_wey_low_frm = array('name' => 'cv_work_experience_years','value' => $limit_low, 'operand' => '>=');
		$cv_wey_up_frm = array('name' => 'cv_work_experience_years','value' => $limit_up, 'operand' => '<=');
		array_push($search_options,$cv_wey_low_frm);
		array_push($search_options,$cv_wey_up_frm);
		$sidebar_options[cv_wey0] = $cv_wey0;
		$sidebar_options[cv_wey1] = $cv_wey1;
		$sidebar_options[cv_wey2] = $cv_wey2;
		$sidebar_options[cv_wey5] = $cv_wey5;
		$sidebar_options[cv_wey10] = $cv_wey10;
	}	
	if ($cv_availability_date) {
		$cv_availability_date_frm = array('name' => 'cv_availability_date','value' => $cv_availability_date, 'operand' => '=');
		array_push($search_options,$cv_availability_date_frm);
		$sidebar_options[cv_availability_date] = $cv_availability_date;
	}	
	if ($cv_desired_work_type) {
		$cv_desired_work_type_frm = array('name' => 'cv_desired_work_type','value' => $cv_desired_work_type, 'operand' => '=');
		array_push($search_options,$cv_desired_work_type_frm);
		$sidebar_options[cv_desired_work_type] = $cv_desired_work_type;
	}	
	if ($tags) {
		$tags_frm = array('name' => 'tags','value' => $tags, 'operand' => ' like ');
		array_push($search_options,$tags_frm);
		$sidebar_options[tags] = $tags;
	}
	
}
/////////////////////////////////////

$sidebar_options[curl] = 'edujobs/teachers/view';
$sidebar = elgg_view('edujobs/teachers_sidebar', $sidebar_options);

if($search_options){
	$options['metadata_name_value_pairs'] = $search_options;
	$options['metadata_name_value_pairs_operator'] = 'AND';
}
$teachers = elgg_list_entities_from_metadata($options);	

//$content = elgg_view('edujobs/teachers', array(
//	'teachers'=>$teachers,
//	'icon_size' => 'large',
//	)
//);

if (!$teachers) {
	$teachers = elgg_echo('edujobs:teachers:none');
} 

$options = array(
	'filter_context' => 'all',
	'content' => $teachers,
	'title' => $title,
	'sidebar' => $sidebar,
	'filter_override' => elgg_view('edujobs/nav-school', array('selected' => $selected))
);

$body = elgg_view_layout('content', $options);

echo elgg_view_page($title, $body);







