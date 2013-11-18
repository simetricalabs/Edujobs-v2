<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

function edujobs_run_once_subtypes()	{
    add_subtype('object', Edujobs::SUBTYPE, "edujobs");
    add_subtype('object', Jobappication::SUBTYPE, "jobappication");
    add_subtype('object', Educv::SUBTYPE, "educv");
    add_subtype('object', Educvwe::SUBTYPE, "educvwe");
    add_subtype('object', Educvedu::SUBTYPE, "educvedu");
    add_subtype('object', Educvlang::SUBTYPE, "educvlang");
}
