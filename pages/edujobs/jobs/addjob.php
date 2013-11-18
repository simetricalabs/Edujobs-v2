<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');

$user = elgg_get_logged_in_user_entity();

// check if user can post jobs
if (check_if_user_can_post_jobs($user)) { 

    $title = elgg_echo('edujobs:add');
    
    elgg_push_breadcrumb(elgg_echo('edujobs'), 'edujobs/jobs'); 
    elgg_push_breadcrumb($title);

    // build sidebar 
    $sidebar = '';

    // create form
    $form_vars = array('name' => 'edujobspost', 'enctype' => 'multipart/form-data');
    
    $vars = jobs_prepare_form_vars();
    $content = elgg_view_form('edujobs/jobs/add', $form_vars, $vars);

    $body = elgg_view_layout('content', array(
        'content' => $content,
        'title' => $title,
        'sidebar' => $sidebar,
        'filter' => '',
    ));

    echo elgg_view_page($title, $body);
} 
else    {  
    register_error(elgg_echo('edujobs:add:noaccessforpost'));  
    forward(REFERER);    
}





