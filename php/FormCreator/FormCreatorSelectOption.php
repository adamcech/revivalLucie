<?php

class FormCreatorSelectOption extends FormCreatorElement {

    /** @var string $label */
    public $label;

    /** @var string $value */
    public $value;

    /** @var bool $selected */
    public $selected;

    /**
     * FormCreatorSelectOption constructor.
     * @param string $label
     * @param string $value
     * @param bool $selected
     */
    public function __construct($label, $value, $selected = false) {
        $this->label = $label;
        $this->value = $value;
        $this->selected = $selected;
    }

    /**
     * @return string HTML code for generated form
     */
    public function generateHtml() {
        return "<option value='$this->value' ".($this->selected ? "selected" : "").">$this->label</option>";
    }

}