<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

$tabs = array(
		'myjobs' => array(
				'title' => elgg_echo('edujobs:label:myjobs'),
				'url' => 'edujobs/teachers/myjobs',
				'selected' => $vars['selected'] == 'teachers/myjobs',
		),          
		'mycv' => array(
				'title' => elgg_echo('edujobs:label:mycv'),
				'url' => 'edujobs/teachers/mycv',
				'selected' => $vars['selected'] == 'teachers/mycv',
		),          
		'jobsmaylike' => array(
				'title' => elgg_echo('edujobs:label:jobsmaylike'),
				'url' => 'edujobs/teachers/jobsmaylike',
				'selected' => $vars['selected'] == 'teachers/jobsmaylike',
		),
		'jobs' => array(
				'title' => elgg_echo('edujobs:label:jobs'),
				'url' => 'edujobs/jobs',
				'selected' => $vars['selected'] == 'jobs',
		),
);

echo elgg_view('navigation/tabs', array('tabs' => $tabs));
