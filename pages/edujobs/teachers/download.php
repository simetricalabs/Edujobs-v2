<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

elgg_load_library('elgg:edujobs');

$user = elgg_get_logged_in_user_entity();
$uguid = get_input('uguid');


$cvlang = get_entity($uguid);
if (!elgg_instanceof($cvlang, 'object', 'educvlang') && !elgg_instanceof($cvlang, 'object', 'educvport')) {
	register_error(elgg_echo('edujobs:cv:download:filenotexists'));
	forward();
}

$options = array(
	'type' => 'object',
	'subtype' => 'file',
	'limit' => 0,
	'metadata_name_value_pairs' => array(
		array('name' => 'cvlang_guid', 'value' => $cvlang->guid, 'operand' => '='),
		array('name' => 'cvport_guid', 'value' => $cvlang->guid, 'operand' => '='),
	),
	'metadata_name_value_pairs_operator' => 'OR',
);

$files = elgg_get_entities_from_metadata($options);

if (!$files) {
    register_error(elgg_echo('edujobs:cv:download:filenotexists'));
    forward(REFERER);
}

if (count($files) > 0) { 
	$file = get_entity($files[0]->guid);
}
else   {

	register_error(elgg_echo('edujobs:download:filenotexists'));
    forward(REFERER);
}



$mime = $file->getMimeType();
if (!$mime) {
	$mime = "application/octet-stream";
}

$filename = $file->originalfilename;

// fix for IE https issue
header("Pragma: public");

header("Content-type: $mime");
if (strpos($mime, "image/") !== false || $mime == "application/pdf") {
	header("Content-Disposition: inline; filename=\"$filename\"");
} else {
	header("Content-Disposition: attachment; filename=\"$filename\"");
}

ob_clean();
flush();
readfile($file->getFilenameOnFilestore());
exit;


