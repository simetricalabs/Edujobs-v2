<?php
/**
 * Elgg edujobs plugin
 * @package EduFolium
 */

class Educvlang extends ElggObject {
    const SUBTYPE = "educvlang";
    
    protected $meta_defaults = array(
        "cvlang_language"	=> NULL,
        "cvlang_level"	=> NULL,
        "cvlang_cert_institute"	=> NULL,
        "cvlang_reading_score"	=> NULL,
        "cvlang_listening_score"	=> NULL,
        "cvlang_speaking_score"	=> NULL,
        "cvlang_writing_score"	=> NULL,
        "cvlang_total_score"	=> NULL,
        "cvlang_cert_document"	=> NULL,
    );    

    protected function initializeAttributes() {
        parent::initializeAttributes();

        $this->attributes["subtype"] = self::SUBTYPE;
    }
    
}
