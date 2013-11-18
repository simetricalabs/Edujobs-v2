<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

class Jobappication extends ElggObject {
    const SUBTYPE = "jobappication";
    
    protected $meta_defaults = array(
        "user_guid" 		=> NULL,	// guid of user / teacher
        "job_guid"       	=> NULL,	// guid of job
        "application_date" 	=> NULL,    // date of application
        "status"       	=> NULL,	// state -> normal or favorite or rejected
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
}
