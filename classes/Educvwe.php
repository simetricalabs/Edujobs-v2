<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

class Educvwe extends ElggObject {
    const SUBTYPE = "educvwe";
    
    protected $meta_defaults = array(
        "cvwe_job_title"	=> NULL,
        "cvwe_organization"	=> NULL,
        "cvwe_country"		=> NULL,
        "cvwe_city"			=> NULL,
        "cvwe_period_from"	=> NULL,
        "cvwe_period_to"	=> NULL,
        "cvwe_period_now"	=> NULL,
        "cvwe_salary_starting"	=> NULL,
        "cvwe_salary_ending"	=> NULL,
        "cvwe_salary_unit_time"	=> NULL,
        "cvwe_salary_currency"	=> NULL,
        "cvwe_reasons_go"		=> NULL,
        "cvwe_comments"			=> NULL,
        "cvwe_subject_math"				=> NULL,
        "cvwe_subject_science"			=> NULL,
        "cvwe_subject_socialstudies"		=> NULL,
        "cvwe_subject_spanish"			=> NULL,
        "cvwe_subject_english"			=> NULL,
        "cvwe_subject_otherforeignlangs"	=> NULL,
        "cvwe_subject_technology"			=> NULL,
        "cvwe_subject_othersubjects"		=> NULL,
        "cvwe_subject_othersubjects_text"	=> NULL,
		"cvwe_grade_kindergarten"			=> NULL,
		"cvwe_grade_earlyelementary"		=> NULL,
		"cvwe_grade_lateelementary"		=> NULL,
		"cvwe_grade_middleschool"			=> NULL,
		"cvwe_grade_highschool"			=> NULL,
		"cvwe_grade_othercategories"		=> NULL,        
        "cvwe_grade_othercategories_text"	=> NULL, 
        "tags" 				=> NULL,        
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
    
}
