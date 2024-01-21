<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();}
    
 class article {

    private $code;
    private $title;
    private $editor;
    private $date;

    private $sections = array();

    public function __construct($code, $title, $editor, $date){
        $this->code = $code;
        $this->title = $title;
        $this->editor = $editor;
        $this->date = $date;
    
    }

    public function getCode() {
        return $this->code;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getEditor() {
        return $this->editor;
    }

    public function getDate() {
        return $this->date;
    }

    public function getSections() {
        return $this->sections;
    }

    

    public function addSection(section $newSection) {
        $this->sections[] = $newSection;
    }
    public function setTitle($title) {
        $this->title = $title;
    }

    public function setEditor($editor) {
        $this->editor = $editor;
    }
    public function setCode($code) {
        $this->code = $code;
    }

    public function setDate($date) {
        $this->date = $date;
    }
    public function setSections($sections) {
        $this->sections = $sections;
    }
    
}

class section {

    private $code;
    private $section_title;
    private $text;

    public function __construct($code, $section_title, $text){
        $this->code = $code;
        $this->section_title = $section_title;
        $this->text = $text;
    }

    public function getCode(){
        return $this->code;
    }

    public function getSection(){
        return $this->section_title;
    }

    public function getText(){
        return $this->text;
    }
}
?>
