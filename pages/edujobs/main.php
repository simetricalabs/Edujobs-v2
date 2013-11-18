<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

//gatekeeper();
elgg_load_library('elgg:edujobs');

// set the default timezone to use
date_default_timezone_set('UTC');

$user = elgg_get_logged_in_user_entity();
// check if user can post jobs
if (check_if_user_can_post_jobs($user))   {
    elgg_register_title_button('edujobs','job/add');
}

// build sidebar 
$sidebar = '';

// build sort by combo box
$orderby = get_input('orderby');
$orderby_reverse = false; // default order by most recent date posted
if ($orderby === 'datepostedlatest') $orderby_reverse = true;

$current_url = explode("?", current_page_url());

$options = array(
	'type' => 'object', 
	'subtype' => 'edujobs', 
	'limit' => 10, 
	'view_toggle_type' => true, 
	'full_view' => false, 
	'reverse_order_by' => $orderby_reverse,
);

$search_options = array();
$sidebar_options = array();
	
///// get search option if any ///////
if (get_input("searchformsubmitted"))	{
	$country = get_input("country");
	$city = get_input("city");
	$grade_kindergarten = get_input("grade_kindergarten");
	$grade_earlyelementary = get_input("grade_earlyelementary");
	$grade_lateelementary = get_input("grade_lateelementary");
	$grade_middleschool = get_input("grade_middleschool");
	$grade_highschool = get_input("grade_highschool");
	$grade_othercategories = get_input("grade_othercategories");
	$subject_math = get_input("subject_math");
	$subject_science = get_input("subject_science");
	$subject_socialstudies = get_input("subject_socialstudies");
	$subject_spanish = get_input("subject_spanish");
	$subject_english = get_input("subject_english");
	$subject_otherforeignlangs = get_input("subject_otherforeignlangs");
	$subject_technology = get_input("subject_technology");
	$subject_othersubjects = get_input("subject_othersubjects");
	$jobposts = get_input("jobposts");
	$tags = get_input("tags");

	if ($country) {
		$country_frm = array('name' => 'country','value' => $country, 'operand' => '=');
		array_push($search_options,$country_frm);
		$sidebar_options[country] = $country;
	}
	if ($city) {
		$city_frm = array('name' => 'city','value' => $city, 'operand' => '=');
		array_push($search_options,$city_frm);
		$sidebar_options[city] = $city;
	}
	
	$grade_joins = '';
	$grade_wheres = '';
	if ($grade_kindergarten) {
		$sidebar_options[grade_kindergarten] = $grade_kindergarten;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade1 on e.guid = n_grade1.entity_guid JOIN elgg_metastrings msgraden1 on n_grade1.name_id = msgraden1.id JOIN elgg_metastrings msgradev1 on n_grade1.value_id = msgradev1.id ';
		$grade_wheres .= '(msgraden1.string = \'grade_kindergarten\' AND BINARY msgradev1.string IN (1) AND ( (1 = 1) and n_grade1.enabled=\'yes\')) OR ';
	}
	if ($grade_earlyelementary) {
		$sidebar_options[grade_earlyelementary] = $grade_earlyelementary;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade2 on e.guid = n_grade2.entity_guid JOIN elgg_metastrings msgraden2 on n_grade2.name_id = msgraden2.id JOIN elgg_metastrings msgradev2 on n_grade2.value_id = msgradev2.id ';
		$grade_wheres .= '(msgraden2.string = \'grade_earlyelementary\' AND BINARY msgradev2.string IN (1) AND ( (1 = 1) and n_grade2.enabled=\'yes\')) OR ';
	}	
	if ($grade_lateelementary) {
		$sidebar_options[grade_lateelementary] = $grade_lateelementary;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade3 on e.guid = n_grade3.entity_guid JOIN elgg_metastrings msgraden3 on n_grade3.name_id = msgraden3.id JOIN elgg_metastrings msgradev3 on n_grade3.value_id = msgradev3.id ';
		$grade_wheres .= '(msgraden3.string = \'grade_lateelementary\' AND BINARY msgradev3.string IN (1) AND ( (1 = 1) and n_grade3.enabled=\'yes\')) OR ';
	}	
	if ($grade_middleschool) {
		$sidebar_options[grade_middleschool] = $grade_middleschool;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade4 on e.guid = n_grade4.entity_guid JOIN elgg_metastrings msgraden4 on n_grade4.name_id = msgraden4.id JOIN elgg_metastrings msgradev4 on n_grade4.value_id = msgradev4.id ';
		$grade_wheres .= '(msgraden4.string = \'grade_middleschool\' AND BINARY msgradev4.string IN (1) AND ( (1 = 1) and n_grade4.enabled=\'yes\')) OR ';
	}	
	if ($grade_highschool) {
		$sidebar_options[grade_highschool] = $grade_highschool;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade5 on e.guid = n_grade5.entity_guid JOIN elgg_metastrings msgraden5 on n_grade5.name_id = msgraden5.id JOIN elgg_metastrings msgradev5 on n_grade5.value_id = msgradev5.id ';
		$grade_wheres .= '(msgraden5.string = \'grade_highschool\' AND BINARY msgradev5.string IN (1) AND ( (1 = 1) and n_grade5.enabled=\'yes\')) OR ';
	}
	if ($grade_othercategories) {
		$sidebar_options[grade_othercategories] = $grade_othercategories;
		
		$grade_joins .= ' JOIN elgg_metadata n_grade6 on e.guid = n_grade6.entity_guid JOIN elgg_metastrings msgraden6 on n_grade6.name_id = msgraden6.id JOIN elgg_metastrings msgradev6 on n_grade6.value_id = msgradev6.id ';
		$grade_wheres .= '(msgraden6.string = \'grade_othercategories\' AND BINARY msgradev6.string IN (1) AND ( (1 = 1) and n_grade6.enabled=\'yes\')) OR ';
	}	
	if ($grade_wheres)  {
		$grade_wheres = '( '.substr_replace($grade_wheres ,"",-3).' )';
	}		
	
	$subject_joins = '';
	$subject_wheres = '';
	if ($subject_math) {
		$sidebar_options[subject_math] = $subject_math;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj1 on e.guid = n_subj1.entity_guid JOIN elgg_metastrings mssubjn1 on n_subj1.name_id = mssubjn1.id JOIN elgg_metastrings mssubjv1 on n_subj1.value_id = mssubjv1.id ';
		$subject_wheres .= '(mssubjn1.string = \'subject_math\' AND BINARY mssubjv1.string IN (1) AND ( (1 = 1) and n_subj1.enabled=\'yes\')) OR ';
	}
	if ($subject_science) {
		$sidebar_options[subject_science] = $subject_science;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj2 on e.guid = n_subj2.entity_guid JOIN elgg_metastrings mssubjn2 on n_subj2.name_id = mssubjn2.id JOIN elgg_metastrings mssubjv2 on n_subj2.value_id = mssubjv2.id ';
		$subject_wheres .= '(mssubjn2.string = \'subject_science\' AND BINARY mssubjv2.string IN (1) AND ( (1 = 1) and n_subj2.enabled=\'yes\')) OR ';
	}
	if ($subject_socialstudies) {
		$sidebar_options[subject_socialstudies] = $subject_socialstudies;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj3 on e.guid = n_subj3.entity_guid JOIN elgg_metastrings mssubjn3 on n_subj3.name_id = mssubjn3.id JOIN elgg_metastrings mssubjv3 on n_subj3.value_id = mssubjv3.id ';
		$subject_wheres .= '(mssubjn3.string = \'subject_socialstudies\' AND BINARY mssubjv3.string IN (1) AND ( (1 = 1) and n_subj3.enabled=\'yes\')) OR ';
	}	
	if ($subject_spanish) {
		$sidebar_options[subject_spanish] = $subject_spanish;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj4 on e.guid = n_subj4.entity_guid JOIN elgg_metastrings mssubjn4 on n_subj4.name_id = mssubjn4.id JOIN elgg_metastrings mssubjv4 on n_subj4.value_id = mssubjv4.id ';
		$subject_wheres .= '(mssubjn4.string = \'subject_spanish\' AND BINARY mssubjv4.string IN (1) AND ( (1 = 1) and n_subj4.enabled=\'yes\')) OR ';
	}	
	if ($subject_english) {
		$sidebar_options[subject_english] = $subject_english;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj5 on e.guid = n_subj5.entity_guid JOIN elgg_metastrings mssubjn5 on n_subj5.name_id = mssubjn5.id JOIN elgg_metastrings mssubjv5 on n_subj5.value_id = mssubjv5.id ';
		$subject_wheres .= '(mssubjn5.string = \'subject_english\' AND BINARY mssubjv5.string IN (1) AND ( (1 = 1) and n_subj5.enabled=\'yes\')) OR ';
	}	
	if ($subject_otherforeignlangs) {
		$sidebar_options[subject_otherforeignlangs] = $subject_otherforeignlangs;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj6 on e.guid = n_subj6.entity_guid JOIN elgg_metastrings mssubjn6 on n_subj6.name_id = mssubjn6.id JOIN elgg_metastrings mssubjv6 on n_subj6.value_id = mssubjv6.id ';
		$subject_wheres .= '(mssubjn6.string = \'subject_otherforeignlangs\' AND BINARY mssubjv6.string IN (1) AND ( (1 = 1) and n_subj6.enabled=\'yes\')) OR ';
	}	
	if ($subject_technology) {
		$sidebar_options[subject_technology] = $subject_technology;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj7 on e.guid = n_subj7.entity_guid JOIN elgg_metastrings mssubjn7 on n_subj7.name_id = mssubjn7.id JOIN elgg_metastrings mssubjv7 on n_subj7.value_id = mssubjv7.id ';
		$subject_wheres .= '(mssubjn7.string = \'subject_technology\' AND BINARY mssubjv7.string IN (1) AND ( (1 = 1) and n_subj7.enabled=\'yes\')) OR ';
	}
	if ($subject_othersubjects) {
		$sidebar_options[subject_othersubjects] = $subject_othersubjects;
		
		$subject_joins .= ' JOIN elgg_metadata n_subj8 on e.guid = n_subj8.entity_guid JOIN elgg_metastrings mssubjn8 on n_subj8.name_id = mssubjn8.id JOIN elgg_metastrings mssubjv8 on n_subj8.value_id = mssubjv8.id ';
		$subject_wheres .= '(mssubjn8.string = \'subject_othersubjects\' AND BINARY mssubjv8.string IN (1) AND ( (1 = 1) and n_subj8.enabled=\'yes\')) OR ';
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
	
	if ($jobposts) {
		$diff = time() - $jobposts;
		$options['wheres'] = elgg_get_entity_time_where_sql('e', time(),$diff);
		$sidebar_options[jobposts] = $jobposts;
	}
	if ($tags) {
		$tags_frm = array('name' => 'tags','value' => $tags, 'operand' => ' like ');
		array_push($search_options,$tags_frm);
		//$options['wheres'] = 'city LIKE \'%'.$tags.'%\'';
		$sidebar_options[tags] = $tags;
	}
/*	
	if ($tags) {
		$xxx_frm = array('name' => 'title','value' => '%'.$tags.'%', 'operand' => 'LIKE');
		array_push($search_options,$xxx_frm);
		//$options['wheres'] = 'n_table.title LIKE \'%'.$tags.'%\'';
	}		
*/
//http://community.elgg.org/discussion/view/207083/no-way-to-retrieve-an-entity-based-on-type-subtype-and-title
//http://community.elgg.org/discussion/view/837400/doing-a-like-query-in-elgg-get-entities-from-metadata
//http://docs.elgg.org/wiki/DatabaseSchema
}
//////////////////////////


switch ($page[0]) {
	case 'teachers':
		elgg_push_breadcrumb(elgg_echo('edujobs'),'edujobs/jobs');
		$selected = $page[0].'/'.$page[1];
		switch ($page[1]) {
			case 'myjobs':
				elgg_push_breadcrumb(elgg_echo('edujobs:label:myjobs'));
				$sortby = get_sort_by_selector($current_url[0], $orderby, true);
				$emptymessage = elgg_echo('edujobs:teachers:myjobs:empty');
				$title = elgg_echo('edujobs:label:myjobs');
				$sidebar_options['curl'] = 'edujobs/teachers/myjobs';
				$sidebar = elgg_view('edujobs/jobs_sidebar', $sidebar_options);
				$applies = elgg_get_entities_from_metadata(array(
					'type' => 'object',
					'subtype' => 'jobappication',
					'limit' => 0,
					'full_view' => false,
					'metadata_name_value_pairs' => array(array('name' => 'user_guid','value' => $user->guid, 'operand' => '=')),
				));	
				
				// generate a guids array
				$in = array();
				if(is_array($applies) && count($applies) > 0){
					foreach ($applies as $ap) {
					  $in[] = $ap->job_guid;
					}
				}
				$in = implode(',', $in);
				unset($applies);				
			
				if (!empty($in)) $options['wheres'] = array("guid IN ($in)"); 
				else  $options['wheres'] = array("guid IN (0)"); // hack for not displaying jobs if never applied
				
				if($search_options){
					$options['metadata_name_value_pairs'] = $search_options;
					$options['metadata_name_value_pairs_operator'] = 'AND';
					//$content = elgg_list_entities_from_metadata($options);
					$content = elgg_list_entities_from_metadata_edujobs($options, 'elgg_view_entity_list',$orderby);
				}
				else {
					$content = elgg_list_entities_edujobs($options, 'elgg_get_entities', 'elgg_view_entity_list',$orderby, $user->guid);
				}	
				//$content = elgg_list_entities_edujobs($options, 'elgg_get_entities', 'elgg_view_entity_list',$orderby, $user->guid);
				break;
			case 'mycv':
				elgg_push_breadcrumb(elgg_echo('edujobs:label:mycv'));
				elgg_register_title_button('edujobs','teachers/addcv1');
				$title = elgg_echo('edujobs:label:mycv');
				$sortby = '';	// we don't want sort selector on this selection at the moment
				if (check_if_user_has_cv($user))	{
					//get user experience
					$content_we = elgg_list_entities_from_metadata(array(
						'type' => 'object',
						'subtype' => 'educvwe',
						'limit' => 0,
						'full_view' => false,
						'count' => false,
						'pagination' => false,
						'owner_guid' => $user->guid,
					));	
					
					//get user education
					$content_edu = elgg_list_entities_from_metadata(array(
						'type' => 'object',
						'subtype' => 'educvedu',
						'limit' => 0,
						'full_view' => false,
						'count' => false,
						'pagination' => false,
						'owner_guid' => $user->guid,
					));	
					
					//get user language
					$content_lang = elgg_list_entities_from_metadata(array(
						'type' => 'object',
						'subtype' => 'educvlang',
						'limit' => 0,
						'full_view' => false,
						'count' => false,
						'pagination' => false,
						'owner_guid' => $user->guid,
					));	
									
					$content = elgg_list_entities_from_metadata(array(
						'type' => 'object',
						'subtype' => 'educv',
						'limit' => 1,
						'full_view' => true,
						'count' => false,
						'pagination' => false,
						'owner_guid' => $user->guid,
						'content_we' => $content_we,
						'content_edu' => $content_edu,
						'content_lang' => $content_lang,
					));						
				} 
				else {
					$emptymessage = '<h4>'.elgg_echo('edujobs:cv:empty', array(elgg_get_site_url().'edujobs/teachers/addcv1/'.$user->guid)).'</h4>';
				}
				
				break;
			case 'jobsmaylike':
				$sortby = '';	// we don't want sort selector on this selection at the moment
				$emptymessage = elgg_echo('edujobs:teachers:jobsmaylike:empty');
				break;				
		}
		break;
	case 'schools':
		elgg_push_breadcrumb(elgg_echo('edujobs'),'edujobs/jobs');
		$selected = $page[0].'/'.$page[1];			
		switch ($page[1]) {
			case 'myjobposts':
				elgg_push_breadcrumb(elgg_echo('edujobs:label:myjobposts'));
				$sortby = get_sort_by_selector($current_url[0], $orderby);
				$title = elgg_echo('edujobs:label:myjobposts');
				$sidebar_options['curl'] = 'edujobs/schools/myjobposts';
				$sidebar = elgg_view('edujobs/jobs_sidebar', $sidebar_options);
				$options['owner_guid'] = $user->guid;
				if($search_options){
					$options['metadata_name_value_pairs'] = $search_options;
					$options['metadata_name_value_pairs_operator'] = 'AND';
					//$content = elgg_list_entities_from_metadata($options);
					$content = elgg_list_entities_from_metadata_edujobs($options, 'elgg_view_entity_list',$orderby);
				}
				else {
					$content = elgg_list_entities_edujobs($options, 'elgg_get_entities', 'elgg_view_entity_list',$orderby);
				}
				//$content = elgg_list_entities_edujobs($options, 'elgg_get_entities', 'elgg_view_entity_list',$orderby);
				break;
			case 'teachers':
				elgg_push_breadcrumb(elgg_echo('edujobs:label:teachers'));
				$title = elgg_echo('edujobs:label:teachers');
				$sortby = '';	// we don't want sort selector on teacher at the moment
				$options_users = array('type' => 'user', 'full_view' => false);
				$content = elgg_list_entities($options_users);
				break;				
		}		
		break;
	default:
		elgg_push_breadcrumb(elgg_echo('edujobs'));
		$sortby = get_sort_by_selector($current_url[0], $orderby);
		$selected = $page[0];
		$emptymessage = elgg_echo('edujobs:none');
		$sidebar_options[curl] = 'edujobs/jobs';
		$sidebar = elgg_view('edujobs/jobs_sidebar', $sidebar_options);
		$title = elgg_echo('edujobs');
		$subject_published_until_final = array('name' => 'published_until_final','value' => time(), 'operand' => '>=');
		array_push($search_options,$subject_published_until_final);
		//if($search_options){
			$options['metadata_name_value_pairs'] = $search_options;
			$options['metadata_name_value_pairs_operator'] = 'AND';
			//$content = elgg_list_entities_from_metadata($options);
			$content = elgg_list_entities_from_metadata_edujobs($options, 'elgg_view_entity_list',$orderby);
		//}
		//else {
		//	$content = elgg_list_entities_edujobs($options, 'elgg_get_entities', 'elgg_view_entity_list',$orderby);
		//}		
		break;
}
	
if (!$content) {
	$content = $emptymessage;
} 

$content = $sortby . $content;
$options = array(
	'filter_context' => 'all',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar
);

if (elgg_is_logged_in()) {	
	if (get_profile_type($user) === 'Docente')	{
		$options['filter_override'] = elgg_view('edujobs/nav-teacher', array('selected' => $selected));
	}
	else if (get_profile_type($user) === 'Colegio')	 {
		$options['filter_override'] = elgg_view('edujobs/nav-school', array('selected' => $selected));
	}
	else  {
		$options['filter_override'] = elgg_view('edujobs/nav', array('selected' => $vars['page']));
	}
}	

$body = elgg_view_layout('content', $options);

echo elgg_view_page($title, $body);











