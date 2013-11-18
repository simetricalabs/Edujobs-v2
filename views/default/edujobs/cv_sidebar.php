<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

$user_guid = elgg_extract('user_guid', $vars, FALSE);
$selected = elgg_extract('selected', $vars, FALSE);

$sel_cv1 = '';
$sel_cv2 = '';
$sel_cv3 = '';
$sel_cv4 = '';
$sel_cv5 = '';
$sel_cv6 = '';
$sel_cv7 = '';
//elgg-state-selected

switch ($selected) {
	case 'cv1':
		$sel_cv1 = 'elgg-state-selected';
		break;
	case 'cv2':
		$sel_cv2 = 'elgg-state-selected';
		break;
	case 'cv3':
		$sel_cv3 = 'elgg-state-selected';
		break;
	case 'cv4':
		$sel_cv4 = 'elgg-state-selected';
		break;
	case 'cv5':
		$sel_cv5 = 'elgg-state-selected';
		break;
	case 'cv6':
		$sel_cv6 = 'elgg-state-selected';
		break;
	case 'cv7':
		$sel_cv7 = 'elgg-state-selected';
		break;						
}

if ($user_guid) {
	echo '<div class="elgg-module elgg-module-aside">';
	echo '<div class="elgg-head"><h3>'.elgg_echo('edujobs:cv:sections').'</h3></div>';
	echo '<div class="elgg-body" id="elgg-module elgg-module-aside">';
	echo '<ul class="elgg-menu elgg-menu-page elgg-menu-page-default">';	
	echo '<li class="'.$sel_cv1.'"><a class="elgg-menu-item" href="'.elgg_get_site_url().'edujobs/teachers/addcv1/'.$user_guid.'" title="">'.elgg_echo('edujobs:cv:add1:simple').'</a></li>';
	echo '<li class="'.$sel_cv2.'"><a class="elgg-menu-item" href="'.elgg_get_site_url().'edujobs/teachers/addcv2/'.$user_guid.'" title="">'.elgg_echo('edujobs:cv:add2:simple').'</a></li>';
	echo '<li class="'.$sel_cv3.'"><a class="elgg-menu-item" href="'.elgg_get_site_url().'edujobs/teachers/addcv3/'.$user_guid.'" title="">'.elgg_echo('edujobs:cv:add3:simple').'</a></li>';
	echo '<li class="'.$sel_cv4.'"><a class="elgg-menu-item" href="'.elgg_get_site_url().'edujobs/teachers/addcv4/'.$user_guid.'" title="">'.elgg_echo('edujobs:cv:add4:simple').'</a></li>';
	echo '<li class="'.$sel_cv5.'"><a class="elgg-menu-item" href="'.elgg_get_site_url().'edujobs/teachers/addcv5/'.$user_guid.'" title="">'.elgg_echo('edujobs:cv:add5:simple').'</a></li>';
	echo '<li class="'.$sel_cv6.'"><a class="elgg-menu-item" href="'.elgg_get_site_url().'edujobs/teachers/addcv6/'.$user_guid.'" title="">'.elgg_echo('edujobs:cv:add6:simple').'</a></li>';
	echo '<li class="'.$sel_cv7.'"><a class="elgg-menu-item" href="'.elgg_get_site_url().'edujobs/teachers/addcv7/'.$user_guid.'" title="">'.elgg_echo('edujobs:cv:add7:simple').'</a></li>';
	echo '</ul>';
	echo '</div>';
	echo '</div>';
}
