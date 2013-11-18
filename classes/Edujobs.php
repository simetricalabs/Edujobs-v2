<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

class Edujobs extends ElggObject {
    const SUBTYPE = "edujobs";
    
    protected $meta_defaults = array(
        "title" 			=> NULL,
        "subject_math"				=> NULL,
        "subject_science"			=> NULL,
        "subject_socialstudies"		=> NULL,
        "subject_spanish"			=> NULL,
        "subject_english"			=> NULL,
        "subject_otherforeignlangs"	=> NULL,
        "subject_technology"		=> NULL,
        "subject_othersubjects"		=> NULL,
        "subject_othersubjects_text"	=> NULL,
		"grade_kindergarten"		=> NULL,
		"grade_earlyelementary"		=> NULL,
		"grade_lateelementary"		=> NULL,
		"grade_middleschool"		=> NULL,
		"grade_highschool"			=> NULL,
		"grade_othercategories"		=> NULL,
		"grade_othercategories_text"	=> NULL, 
		"description" 		=> NULL,
		"country" 			=> NULL,
		"city" 				=> NULL,
		"noofapplicants"	=> NULL,
		"published_until"	=> NULL,
		"published_until_final"	=> NULL,
        "tags" 				=> NULL,
        "comments_on" 		=> NULL,
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }

}
