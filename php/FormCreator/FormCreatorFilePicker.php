<?php

class FormCreatorFilePicker extends FormCreatorElement {

    /** @var string $name */
    public $name;


    /**
     * @param string $name
     * @param string $value
     */
    public function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string HTML code for generated form
     */
    public function generateHtml() {
        return "<input type='hidden' name='$this->name' value='$this->value' style='display: none'/>";
    }
}