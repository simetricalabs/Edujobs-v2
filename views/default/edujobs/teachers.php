<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

// obsolette

$teachers = $vars['teachers'];
$icon_size = $vars['icon_size'];

print_r($teachers);
foreach($teachers as $t)	{
	if (check_if_user_has_cv($t))	{
		$daskalos = elgg_get_entities_from_metadata(array(
			'type' => 'object',
			'subtype' => 'educv',
			'limit' => 1,
			'full_view' => false,
			'count' => false,
			'pagination' => false,
			'owner_guid' => $t->guid,
		));		
				
		$title_url = elgg_view('output/url', array(
			'href' => "edujobs/teachers/cv/$t->username",
			'text' => $daskalos[0]->cv_name.' '.$daskalos[0]->cv_last_name,
			'is_trusted' => true,
		));			
		
		echo '<div class="custom-profile">';
		echo elgg_view_entity_icon($t, $icon_size, array('class' => 'profile-icon', 'url' => 'edujobs/teachers/cv/'.$t->username));
		echo '<p style="float:right;">'. elgg_view('output/url', array(
			'href' => "edujobs/teachers/cv/$t->username",
			'text' => elgg_echo('edujobs:widget:cv:more'),
			'class' => 'elgg-button elgg-button-submit',
		)).'</p>';				
		echo '<h3>'.$title_url.'</h3>';
		echo '<p>'.$daskalos[0]->cv_position_looking_for.'</p>';
		echo '<p>'.$daskalos[0]->cv_description.'</p>';
		echo '<p>';
		echo $daskalos[0]->cv_birth_country.' | '.$daskalos[0]->cv_birth_city.' | '.elgg_echo('edujobs:add:cv_salary_min_acceptable').': '.$daskalos[0]->cv_salary_min_acceptable.' '.$daskalos[0]->cv_salary_currency.elgg_echo('edujobs:cv:currency:per').elgg_echo($daskalos[0]->cv_salary_unit_of_time);
		echo '</p>';
		
		
		echo '</div>';
	}
}

?>





