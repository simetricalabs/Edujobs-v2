<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

require_once(dirname(__FILE__) . "/lib/run_once.php"); 

elgg_register_event_handler('init', 'system', 'edujobs_init');

// edujobs plugin initialization functions.
function edujobs_init() {
	// set default values
	define('DEFAULT_COUNTRY', 'Colombia');	// set default country
	define('DEFAULT_PUBLISH_PERIOD', 'pp15');	// set published period
	define('DATE_FORMAT', 'M j, Y');	// set default date format
	define('JOB_STATUS_NORMAL', 'normal');	// set applicant job status to normal
	define('JOB_STATUS_FAVORITE', 'favorite');	// set applicant job status to favorite
	define('JOB_STATUS_REJECTED', 'rejected');	// set applicant job status to rejected
	define('DEFAULT_LANG', 'Spanish');	// set default language
	define('DEFAULT_CURRENCY', 'COP');	// set default currency
	
	$current_site = elgg_get_site_entity();
	$temp = array();
	$temp = explode(".", get_site_domain($current_site->guid));
	if (in_array("sandbox", $temp)) {
		define('COLEGIO_PROFILE_TYPE_GUID', 77);	// set colegio guid from profile manager
		define('DOCENTE_PROFILE_TYPE_GUID', 75);	// set colegio guid from profile manager
	}	
	else if (in_array("edufolium", $temp)) {
		define('COLEGIO_PROFILE_TYPE_GUID', 77);	// set colegio guid from profile manager
		define('DOCENTE_PROFILE_TYPE_GUID', 75);	// set colegio guid from profile manager
	}
	else {
		define('COLEGIO_PROFILE_TYPE_GUID', 287);	// set colegio guid from profile manager
		define('DOCENTE_PROFILE_TYPE_GUID', 288);	// set colegio guid from profile manager	
	}	

	
    // register a library of helper functions
    elgg_register_library('elgg:edujobs', elgg_get_plugins_path() . 'edujobs/lib/edujobs.php');
    
    // register plugin js
    elgg_register_js('edujobsjs', elgg_get_site_url() . 'mod/edujobs/assets/edujobs.js');
    
    // Register subtype
    run_function_once('edujobs_run_once_subtypes');
                
    // Register entity_type for search
    elgg_register_entity_type('object', Edujobs::SUBTYPE);
                
    // Site navigation
    $item = new ElggMenuItem('edujobs', elgg_echo('edujobs:menu'), 'edujobs/jobs');
    elgg_register_menu_item('site', $item); 
    

    // Extend CSS
    elgg_extend_view('css/elgg', 'edujobs/css');
    elgg_extend_view('css/elgg', 'edujobs/jquery-ui');

    // Register a page handler, so we can have nice URLs
    elgg_register_page_handler('edujobs', 'edujobs_page_handler');
    
    // Register a URL handler for jobs
    elgg_register_entity_url_handler('object', 'edujobs', 'edujobs_url');  
    
    // Add cv widget
	elgg_register_widget_type('edujobs',	elgg_echo('edujobs:widget:cv'),	elgg_echo('edujobs:widget:cv:description'));

    // Register actions
    $action_path = elgg_get_plugins_path() . 'edujobs/actions/edujobs';
    elgg_register_action("edujobs/jobs/add", "$action_path/addjob.php");  
    elgg_register_action("edujobs/job/delete", "$action_path/deljob.php"); 
    elgg_register_action("edujobs/job/unpublish", "$action_path/jobunpublish.php"); 
    elgg_register_action("edujobs/job/apply", "$action_path/jobapply.php");
    elgg_register_action("edujobs/job/setfavorite", "$action_path/setfavorite.php");
	elgg_register_action("edujobs/job/setrejected", "$action_path/setrejected.php");
	elgg_register_action("edujobs/cvs/addcv1", "$action_path/goaddcv1.php");  
	elgg_register_action("edujobs/cvs/addcv2", "$action_path/goaddcv2.php");  
	elgg_register_action("edujobs/cvs/addworkexperience", "$action_path/goaddworkexperience.php");  
	elgg_register_action("edujobs/cvs/addeducation", "$action_path/goaddeducation.php");  
	elgg_register_action("edujobs/cvs/addlanguage", "$action_path/goaddlanguage.php");  
	elgg_register_action("edujobs/cvs/addcv6", "$action_path/goaddcv6.php");
	elgg_register_action("edujobs/cvs/addportfolio", "$action_path/goaddportfolio.php");
}

/**
 *  Dispatches edujobs pages.
 *
 * @param array $page
 * @return bool
 */

function edujobs_page_handler($page) {
	$base = elgg_get_plugins_path() . 'edujobs/pages/edujobs';

	if (!isset($page[0])) {
		$page[0] = 'all';
	}

	$vars = array();
	$vars['page'] = $page[0];

    switch ($page[0]) {
		 case "job":
			switch($page[1]) {
				case 'add':
					require_once "$base/jobs/addjob.php";
					break;
				case 'edit':
					if(!empty($page[2])) {
						set_input('guid', $page[2]);
					}
					require_once "$base/jobs/editjob.php";
					break;
				case 'view':
					if(!empty($page[2])) {
						set_input('guid', $page[2]);
					}
					include "$base/jobs/viewjob.php";
					break;
				case 'applicants':
					if(!empty($page[2])) set_input('what', $page[2]);
					if(!empty($page[3])) set_input('guid', $page[3]);
					
					include "$base/jobs/viewjobapplicants.php";
					break;						
				default:
					include "$base/main.php";
					return false;									
			}
			break;
			
		 case "teachers":
			switch($page[1]) {
				case 'view':
					if(!empty($page[2])) {
						set_input('guid', $page[2]);
					}
					include "$base/teachers/view.php";
					break;	
				case 'cv':
					if(!empty($page[2])) {
						set_input('uname', $page[2]);
					}
					include "$base/teachers/cvview.php";
					break;						
				case 'addcv1':
					if(!empty($page[2])) {
						set_input('uguid', $page[2]);
					}				
					require_once "$base/teachers/addcv1.php";
					break;		
				case 'addcv2':
					if(!empty($page[2])) {
						set_input('uguid', $page[2]);
					}				
					require_once "$base/teachers/addcv2.php";
					break;
				case 'addcv3':
					if(!empty($page[2])) {
						set_input('uguid', $page[2]);
					}				
					require_once "$base/teachers/addcv3.php";
					break;
				case 'addworkexperience':
					if(!empty($page[2])) {	set_input('uguid', $page[2]);	}
					if(!empty($page[3])) {	set_input('guid', $page[3]);	}
					require_once "$base/teachers/addworkexperience.php";
					break;	
				case 'addcv4':
					if(!empty($page[2])) {
						set_input('uguid', $page[2]);
					}				
					require_once "$base/teachers/addcv4.php";
					break;
				case 'addeducation':
					if(!empty($page[2])) {	set_input('uguid', $page[2]);	}
					if(!empty($page[3])) {	set_input('guid', $page[3]);	}
					require_once "$base/teachers/addeducation.php";
					break;						
				case 'addcv5':
					if(!empty($page[2])) {
						set_input('uguid', $page[2]);
					}				
					require_once "$base/teachers/addcv5.php";
					break;
				case 'addlanguage':
					if(!empty($page[2])) {	set_input('uguid', $page[2]);	}
					if(!empty($page[3])) {	set_input('guid', $page[3]);	}
					require_once "$base/teachers/addlanguage.php";
					break;		
				case 'addcv6':
					if(!empty($page[2])) {
						set_input('uguid', $page[2]);
					}				
					require_once "$base/teachers/addcv6.php";
					break;
				case 'download':
					if(!empty($page[2])) {
						set_input('uguid', $page[2]);
					}				
					require_once "$base/teachers/download.php";
					break;	
				case 'addcv7':
					if(!empty($page[2])) {
						set_input('uguid', $page[2]);
					}				
					require_once "$base/teachers/addcv7.php";
					break;
				case 'addportfolio':
					if(!empty($page[2])) {	set_input('uguid', $page[2]);	}
					if(!empty($page[3])) {	set_input('guid', $page[3]);	}
					require_once "$base/teachers/addportfolio.php";
					break;						
				default:
					include "$base/main.php";
					return false;						
			}
			break;			

        default:
            include "$base/main.php";
            return false;
    }     
  
    elgg_pop_context();
	return true;
}

/**
 * Populates the ->getUrl() method for edujobs objects
 */
function edujobs_url($entity) {
	global $CONFIG;

	$title = $entity->title;
	$title = elgg_get_friendly_title($title);

	return $CONFIG->url . "edujobs/job/view/" . $entity->getGUID() . "/" . $title;
}

