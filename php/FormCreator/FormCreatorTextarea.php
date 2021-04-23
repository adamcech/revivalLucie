<?php

class FormCreatorTextarea extends FormCreatorElement {

    public $label;
    public $name;
    public $text;
    public $placeholder;
    public $readonly;
    public $rows;
    public $id;
    public $class;
    public $style;

    /**
     * @param string $label
     * @param string $name
     * @param string $text
     * @param string $placeholder
     * @param bool $readonly
     * @param int $rows
     * @param string $id
     * @param string $class
     * @param string $style
     */
    public function __construct($label, $name, $text, $placeholder = "", $readonly = false, $rows = 10, $id = "", $class = "", $style = "")
    {
        $this->label = $label;
        $this->name = $name;
        $this->text = $text;
        $this->placeholder = $placeholder;
        $this->readonly = $readonly;
        $this->rows = $rows;
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
        $str .= "<textarea rows='$this->rows' name='$this->name' placeholder='$this->placeholder' ".($this->readonly ? "readonly" : "")."/>";
        $str .= $this->text;
        $str .= "</textarea>";
        $str .= "</div>";
        $str .= "</div>";

        return $str;
    }

}