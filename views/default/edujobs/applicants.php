<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */
 
$job = $vars['job'];
$applies = $vars['applies'];
$what = $vars['what'];
$empty_msg = $vars['empty_msg'];
$icon_size = $vars['icon_size'];

if ($applies)	{
	foreach ($applies as $ap) {
		//echo $ap->user_guid;
		$applicant = get_user($ap->user_guid);
		$daskalos = elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'educv',
			'limit' => 1,
			'full_view' => false,
			'count' => false,
			'pagination' => false,
			'owner_guid' => $ap->user_guid,
		));	
		
		//get flag
		$flag = get_country_flag($daskalos[0]->cv_birth_country);		
		
		$cv_url = elgg_view('output/url', array(
			'href' => 'edujobs/teachers/cv/'.$applicant->username,
			'text' => elgg_echo("edujobs:widget:cv:full"),
			'is_trusted' => true,
		));	
		
		$title_url = elgg_view('output/url', array(
			'href' => 'edujobs/teachers/cv/'.$applicant->username,
			'text' => $daskalos[0]->cv_name.' '.$daskalos[0]->cv_last_name,
			'is_trusted' => true,
		));				
				
		echo '<div class="custom-profile">';
		echo elgg_view_entity_icon($applicant, $icon_size, array('class' => 'profile-icon', 'url' => ''));
		if ($job->canEdit()) {
			echo '<div class="job-side">';
			echo '<p>'. elgg_view('output/url', array(
				'href' => 'edujobs/teachers/cv/'.$applicant->username,
				'text' => elgg_echo('edujobs:widget:cv:more'),
				'class' => 'elgg-button elgg-button-submit',
			)).'</p>';
			if ($what != 'favorites' && $ap->status != 'favorite') {
				echo '<p>'. elgg_view('output/url', array(
					'href' => 'action/edujobs/job/setfavorite?job_guid='.$job->guid.'&user_guid='.$ap->user_guid,
					'text' => elgg_echo('edujobs:view:job:applicants:markasfavorite'),
					'class' => 'elgg-button elgg-button-submit',
					'is_action' => true
				)).'</p>';
			}
			if ($what != 'rejected' && $ap->status != 'rejected') {
				echo '<p>'. elgg_view('output/url', array(
					'href' => 'action/edujobs/job/setrejected?job_guid='.$job->guid.'&user_guid='.$ap->user_guid,
					'text' => elgg_echo('edujobs:view:job:applicants:markasrejected'),
					'class' => 'elgg-button elgg-button-submit',
					'is_action' => true
				)).'</p>';				
			}

			echo '</div>';    
		}			
		echo '<h3>'.$title_url.'</h3>';
		echo '<p>'.$daskalos[0]->cv_position_looking_for.'</p>';
		echo '<p>'.$daskalos[0]->cv_description.'</p>';
		echo '<p>';
		if ($flag) echo '<img src="'.elgg_get_site_url().'mod/edujobs/assets/flags/'.$flag.'" width="20" height="12" alt="'.$daskalos[0]->cv_birth_country.'" />&nbsp;';
		echo $daskalos[0]->cv_birth_country.' | '.$daskalos[0]->cv_birth_city.' | '.elgg_echo('edujobs:add:cv_salary_min_acceptable').': '.$daskalos[0]->cv_salary_min_acceptable.' '.$daskalos[0]->cv_salary_currency.elgg_echo('edujobs:cv:currency:per').elgg_echo($daskalos[0]->cv_salary_unit_of_time);
		echo '</p>';
		
		echo '</div>';	
		
	

	}
}
else {
	echo $empty_msg;
}

?>





