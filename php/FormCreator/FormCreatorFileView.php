<?php

class FormCreatorFileView extends FormCreatorElement {

    /** @var string $id id to use for html elements */
    public $id;

    /** @var string $name name to use in form POST */
    public $name;

    /** @var Files $file file details */
    public $file;

    /** @var string $label Optional label */
    public $label;

    /** @var bool $imageOnly */
    private $imageOnly;

    /**
     * FormCreatorFileView constructor.
     * @param string $id
     * @param string $name
     * @param Files $file
     * @param string $label;
     * @param bool $imageOnly
     */
    public function __construct($id, $name, $file, $label = null, $imageOnly = false)
    {
        if ($file === null) {
            $file = new Files();
        }

        $this->id = $id;
        $this->name = $name;
        $this->file = $file;
        $this->label = $label;
        $this->imageOnly = $imageOnly;
    }

    /**
     * @return string HTML code for generated form
     */
    public function generateHtml() {
        $str = "<div id='$this->id'>";

        if ($this->label !== null) {
            $str .= "<div><label>$this->label:</label></div>";
        }

        $str .= "<div id='$this->id-preview'  class='file_item'>";

        $str .= "<a class='item_box' ";
        if ($this->file->hasValidLink()) {
            $str .= " target='_blank'";
        }
        $str .= " href='".$this->file->getAdminLink()."'>";

        $str .= "<span class='helper'></span>";
        $str .= $this->getFilePreview();
        $str .= "</a>";

        $str .= "<a href='".$this->file->getAdminLink()."'";
        if ($this->file->hasValidLink()) {
            $str .= " target='_blank'";
        }
        $str .= ">";

        $str .= "<div class='file_name'>".$this->file->name."</div>";
        $str .= "</a>";

        $str .= "</div>";

        $str .= "<input type='hidden' id='$this->id-hidden' name='$this->name' value='".$this->file->id."'/>";

        $str .= "</div>";



        $str .= "<div>";

        if ($this->label !== null) {
            $str .= "<div></div>";
        }

        $str .= "<div>";
        $str .= "<input type='button' value='Změnit' onclick='openFilePicker(\"$this->id-hidden\", \"$this->id-preview\", ".($this->imageOnly ? "true" : "false").")'/>";
        $str .= "</div>";

        $str .= "</div>";

        return $str;
    }

    /**
     * @return string
     */
    private function getFilePreview() {
        $ft = $this->file->shortcut;

        if ($ft == "jpg" || $ft == "jpeg" || $ft == "png" || $ft == "gif" || $ft == "bmp") {
            return "<img src='".$this->file->getLink()."' alt='".$this->file->name."'>";
        } else if ($ft == "pdf" || $ft == "xps") {
            return "<i class='fa fa-file-pdf-o files-icon'></i>";
        } else if ($ft == "doc" || $ft == "docx" || $ft == "odt") {
            return "<i class='fa fa-file-word-o files-icon'></i>";
        } else if ($ft == "xls" || $ft == "xlsx" || $ft == "ods") {
            return "<i class='fa fa-file-excel-o files-icon'></i>";
        } else if ($ft == "ppt" || $ft == "pptx" || $ft == "pps" || $ft == "ppsx" || $ft == "odp") {
            return "<i class='fa fa-file-powerpoint-o files-icon'></i>";
        } else if ($ft == "zip" || $ft == "rar") {
            return "<i class='fa fa-file-archive-o files-icon'></i>";
        } else if ($ft == "mp4" || $ft == "avi" || $ft == "flv" || $ft == "mkv") {
            return "<i class='fa fa-file-video-o files-icon'></i>";
        } else if ($ft == "mp3" || $ft == "flac") {
            return "<i class='fa fa-file-audio-o files-icon'></i>";
        } else if ($ft == "txt") {
            return "<i class='fa fa-file-text-o files-icon'></i>";
        } else {
            return "<i class='fa fa-file-o files-icon'></i>";
        }
    }

}