<?php

class FormCreatorSelect extends FormCreatorElement {

    /** @var string $label */
    public $label;

    /** @var string $name */
    public $name;

    /** @var FormCreatorSelectOption[] $options */
    public $options;

    /** @var string $id */
    public $id;

    /** @var string $class */
    public $class;

    /** @var string $style */
    public $style;

    /**
     * @param string $label
     * @param string $name
     * @param FormCreatorSelectOption[] $options
     * @param string $id
     * @param string $class
     * @param string $style
     */
    public function __construct($label, $name, $options, $id = "", $class = "", $style = "")
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
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
        $str .= "<select name='$this->name'>";
        foreach ($this->options as $option) {
            $str .= $option->generateHtml();
        }
        $str .= "</select>";
        $str .= "</div>";
        $str .= "</div>";

        return $str;
    }

}