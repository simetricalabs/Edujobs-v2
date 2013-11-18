<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

class Educvport extends ElggObject {
    const SUBTYPE = "educvport";
    
    protected $meta_defaults = array(
        "cvport_title"	=> NULL,
        "cvport_type"	=> NULL,
        "cvport_link"	=> NULL,
        "cvport_file"	=> NULL,
        "cvport_subject_math"				=> NULL,
        "cvport_subject_science"			=> NULL,
        "cvport_subject_socialstudies"		=> NULL,
        "cvport_subject_spanish"			=> NULL,
        "cvport_subject_english"			=> NULL,
        "cvport_subject_otherforeignlangs"	=> NULL,
        "cvport_subject_technology"			=> NULL,
        "cvport_subject_othersubjects"		=> NULL,
        "cvport_subject_othersubjects_text"	=> NULL,
		"cvport_grade_kindergarten"			=> NULL,
		"cvport_grade_earlyelementary"		=> NULL,
		"cvport_grade_lateelementary"		=> NULL,
		"cvport_grade_middleschool"			=> NULL,
		"cvport_grade_highschool"			=> NULL,
		"cvport_grade_othercategories"		=> NULL,        
        "cvport_grade_othercategories_text"	=> NULL, 
        "cvport_recommend"	=> NULL, 
        "tags" 				=> NULL,          
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
    
}
