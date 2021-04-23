<?php


class FormCreator
{
    /** @var string $header Header to form */
    public $header;

    /** @var FormCreatorElement[] $fields Fields to generate */
    public $fields;

    /** @var string $actionUrl */
    public $actionUrl;

    /** @var string | null $returnUrl */
    public $returnUrl;

    /** @var string $id */
    public $id;

    /** @var string $class */
    public $class;

    /** @var string $style */
    public $style;

    /** @var string $method */
    public $method;

    /** @var string $enctype */
    public $enctype;

    /** @var string $acceptedCharset */
    public $acceptedCharset;

    /** @var bool $lockSubmit */
    private $lockSubmit = false;

    /**
     * FormCreator constructor.
     * @param string $header
     * @param string $actionUrl
     * @param string | null $returnUrl
     * @param string $id
     * @param string $class
     * @param string $style
     * @param string $method
     * @param string $enctype
     * @param string $acceptCharset
     */
    public function __construct($header, $actionUrl, $returnUrl = null, $id = "", $class = "", $style = "", $method = "POST", $enctype = "multipart/form-data", $acceptCharset = "UTF-8") {
        $this->header = $header;
        $this->fields = [];
        $this->actionUrl = $actionUrl;
        $this->returnUrl = $returnUrl;
        $this->id = $id;
        $this->class = $class;
        $this->style = $style;
        $this->method = $method;
        $this->enctype = $enctype;
        $this->acceptedCharset = $acceptCharset;
    }

    /**
     * @param bool $lockSubmit
     */
    public function lockSubmit($lockSubmit) {
        $this->lockSubmit = $lockSubmit;
    }

    /**
     * @param FormCreatorElement $element
     */
    public function add($element) {
        $this->fields[] = $element;
    }

    /**
     * @return string HTML code for generated form
     */
    public function generateHtml() {
        if ($this->header !== null) {
            $code = "<h1>$this->header</h1>";
        }

        $code .= "<form onsubmit='disable_submit(\"submit-form-creator\")' id='$this->id' class='generated_form $this->class' style='$this->style' action='$this->actionUrl' method='$this->method' enctype='$this->enctype' accept-charset='$this->acceptedCharset'>";

        $code .= "<div class='generated_form_control'>";

        if ($this->lockSubmit) {
            $code .= "<input class='generated_form_submit' type='submit' value='Zablokováno' disabled>";
        } else {
            $code .= "<input id='submit-form-creator' class='generated_form_submit' type='submit' value='Uložit'>";
        }

        if ($this->returnUrl !== null) {
            $code .= "<a class='generated_form_return' href='$this->returnUrl'>Zpět</a>";
        }
        $code .= "</div>";

        $code .= "<div class='generated_form_fields'>";;
        foreach ($this->fields as $field) {
            $code .= $field->generateHtml();
        }
        $code .= "</div>";

        $code .= "<div id='file_picker'></div>";
        $code .= "</form>";
        return $code;
    }

}