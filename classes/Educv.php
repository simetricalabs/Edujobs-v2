<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

class Educv extends ElggObject {
    const SUBTYPE = "educv";
    
    protected $meta_defaults = array(
        "cv_name" 			=> NULL,	// CV 1
        "cv_last_name"		=> NULL,
        "cv_description"	=> NULL,
        "cv_gender" 		=> NULL,
        "cv_birth_date" 	=> NULL,
        "cv_birth_country" 	=> NULL,
        "cv_birth_city" 	=> NULL,
        "cv_email" 			=> NULL,
        "cv_telephone" 		=> NULL,
        "cv_address" 		=> NULL, 
        "cv_position_looking_for" 		=> NULL,	// CV 2
        "cv_work_experience_years" 		=> NULL,
        "cv_salary_min_acceptable" 		=> NULL,
        "cv_salary_unit_of_time" 		=> NULL,
        "cv_salary_currency" 			=> NULL,
        "cv_availability_date" 			=> NULL,
        "cv_availability_date_specify" 	=> NULL,
        "cv_desired_work_type" 			=> NULL,
        "cv_subject_math"				=> NULL,
        "cv_subject_science"			=> NULL,
        "cv_subject_socialstudies"		=> NULL,
        "cv_subject_spanish"			=> NULL,
        "cv_subject_english"			=> NULL,
        "cv_subject_otherforeignlangs"	=> NULL,
        "cv_subject_technology"			=> NULL,
        "cv_subject_othersubjects"		=> NULL,
        "cv_subject_othersubjects_text"	=> NULL,
		"cv_grade_kindergarten"			=> NULL,
		"cv_grade_earlyelementary"		=> NULL,
		"cv_grade_lateelementary"		=> NULL,
		"cv_grade_middleschool"			=> NULL,
		"cv_grade_highschool"			=> NULL,
		"cv_grade_othercategories"		=> NULL,        
        "cv_grade_othercategories_text"	=> NULL, 
        "cv_more_info" 					=> NULL,
        "cv_paste_cv" 					=> NULL,
        "tags" 				=> NULL,
        "comments_on" 		=> NULL,
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
    
}
