<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

$tabs = array(
		'all' => array(
				'title' => elgg_echo('edujobs:view:job:applicants:all'),
				'url' => 'edujobs/job/applicants/all/'.$vars['guid'],
				'selected' => $vars['selected'] == 'job/applicants/all',
		),          
		'favorites' => array(
				'title' => elgg_echo('edujobs:view:job:applicants:favorites'),
				'url' => 'edujobs/job/applicants/favorites/'.$vars['guid'],
				'selected' => $vars['selected'] == 'job/applicants/favorites',
		),          
		'rejected' => array(
				'title' => elgg_echo('edujobs:view:job:applicants:rejected'),
				'url' => 'edujobs/job/applicants/rejected/'.$vars['guid'],
				'selected' => $vars['selected'] == 'job/applicants/rejected',
		),
);

echo elgg_view('navigation/tabs', array('tabs' => $tabs));
