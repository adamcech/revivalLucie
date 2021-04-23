<?php

class FormCreatorDate extends FormCreatorElement {

    public $label;
    public $name;
    public $value;
    public $placeholder;
    public $readonly;
    public $autocomplete;
    public $id;
    public $class;
    public $style;

    /**
     * @param string $label
     * @param string $name
     * @param string $value
     * @param string $placeholder
     * @param bool $readonly
     * @param bool $autocomplete
     * @param string $id
     * @param string $class
     * @param string $style
     */
    public function __construct($label, $name, $value,
                                $placeholder = "", $readonly = false, $autocomplete = false,
                                $id = "", $class = "", $style = "")
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->readonly = $readonly;
        $this->autocomplete = $autocomplete;
        $this->id = $id;
        $this->class = $class;
        $this->style = $style;
    }

    /**
     * @return string HTML code for generated form
     */
    public function generateHtml() {
        $str = "";
        $str .= "<div id='$this->id' class='$this->class' style='$this->style'>";
        $str .= "<div><label>$this->label:</label></div>";
        $str .= "<div>";
        $str .= "<input type='date' name='$this->name' value='$this->value' placeholder='$this->placeholder' autocomplete='".($this->autocomplete ? "on" : "off")."' ".($this->readonly ? "readonly" : "")."/>";
        $str .= "</div>";
        $str .= "</div>";

        return $str;
    }

}