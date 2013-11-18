<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

class Educvedu extends ElggObject {
    const SUBTYPE = "educvedu";
    
    protected $meta_defaults = array(
        "cvedu_degree"	=> NULL,
        "cvedu_school_name"	=> NULL,
        "cvedu_country"	=> NULL,
        "cvedu_city"	=> NULL,
        "cvedu_time_currently"	=> NULL,
        "cvedu_time_from"	=> NULL,
        "cvedu_time_to"	=> NULL,
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
    
}
