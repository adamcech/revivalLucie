<?php


class ListCreator
{
    /** @var string $sectionUrl Suburl for edit forms */
    public $sectionUrl;

    /** @var string $swapForm Url for form to swap items */
    public $swapForm;

    /** @var string $removeForm Url for form to remove item */
    public $removeForm;

    /** @var string $header h1 of list view... */
    public $header;

    /** @var DatabaseV2 $mapper Col to be list viewed... */
    public $mapper;

    /** @var string $orderProperty Order property to change sorting */
    public $orderProperty;

    /**
     * ListCreator constructor.
     * @var string $sectionUrl Suburl for edit forms
     * @var string $header h1 of list view...
     * @var DatabaseV2 $mapper Col to be list viewed...
     * @var string $orderProperty Order property to change sorting
     * @var string|bool $swapForm Url for form to swap items
     * @var string|bool $removeForm Url for form to remove item
    */
    public function __construct($sectionUrl, $header, $mapper, $orderProperty, $swapForm = false, $removeForm = false) {
        $this->sectionUrl = $sectionUrl;
        $this->swapForm = $swapForm;
        $this->removeForm = $removeForm;
        $this->header = $header;
        $this->mapper = $mapper;
        $this->orderProperty = $orderProperty;
    }

    /**
     * @return string HTML code for generated form
     */
    public function generateHtml() {
        $results = $this->mapper->selectAll();

        $code = "<h1>".$this->header."</h1>";

        $addLink = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]pridat";

        $code .= "<div><a class='a-button' href='$addLink'>Přidat</a></div>";

        if ($results->numRows == 0) {
            $code .= "<div>Žádné záznamy</div>";
        } else {
            $code .= "<div class='table_news'>";
            $code .= "<div class='tr'><div class='th'>Název</div><div class='th'></div><div class='th'></div><div class='th'></div></div>";

            for ($i = 0; $i < count($results->results); $i++) {
                /** @var Contact $result */
                $result = $results->results[$i];
                /** @var Contact|null $prev */
                $prev = $i == 0 ? null : $results->results[$i - 1];
                /** @var Contact|null $next */
                $next = $i + 1 < count($results->results) ? $results->results[$i + 1] : null;

                $code .= "<div class='tr'>";

                $code .= "<div class='td'><a href='".$this->sectionUrl.$result->id."/'>".$result."</a></div>";

                if ($this->swapForm !== false) {
                    if ($prev == null) {
                        $code .= "<div class='td'></div>";
                    } else {
                        // Move Up
                        $code .= "<div class='td'>";
                        $code .= "<form id='switch-form-up-$result->id' method='POST' action='$this->swapForm' accept-charset='UTF-8'>";
                        $code .= "<input type='hidden' value='$prev->id' name='id0'>";
                        $code .= "<input type='hidden' value='$result->id' name='id1'>";
                        $code .= "<input type='hidden' value='".$this->mapper->mapper->tableName."' name='tableName'>";
                        $code .= "<input type='hidden' value='$this->orderProperty' name='property'>";
                        $code .= "<label class='fa-mylink form-submit' form-id='switch-form-up-$result->id'><i class='fa fa-arrow-up fa-20px blue-icon order-delete'></i></label>";
                        $code .= "</form>";

                        $code .= "</div>";
                    }

                    if ($next == null) {
                        $code .= "<div class='td'></div>";
                    } else {
                        // Move Up
                        $code .= "<div class='td'>";
                        $code .= "<form id='switch-form-down-$result->id' method='POST' action='$this->swapForm' accept-charset='UTF-8'>";
                        $code .= "<input type='hidden' value='$next->id' name='id0'>";
                        $code .= "<input type='hidden' value='$result->id' name='id1'>";
                        $code .= "<input type='hidden' value='$this->orderProperty' name='property'>";
                        $code .= "<input type='hidden' value='".$this->mapper->mapper->tableName."' name='tableName'>";
                        $code .= "<label class='fa-mylink form-submit' form-id='switch-form-down-$result->id'><i class='fa fa-arrow-down fa-20px blue-icon order-delete'></i></label>";
                        $code .= "</form>";

                        $code .= "</div>";
                    }
                } else {
                    $code .= "<div class='td'></div>";
                    $code .= "<div class='td'></div>";
                }

                if ($this->removeForm !== false) {
                    // Remove
                    $code .= "<div class='td'>";
                    $code .= "<form id='delete-form-$result->id' method='POST' action='$this->removeForm' accept-charset='UTF-8'>";
                    $code .= "<input type='hidden' value='$result->id' name='id'>";
                    $code .= "<input type='hidden' value='".$this->mapper->mapper->tableName."' name='tableName'>";
                    $code .= "<a class='fa-mylink' href='#' onclick='opravdu_smazat(\"Smazat: ".$result."?\", \"delete-form-$result->id\");'><i class='fa fa-remove fa-20px order-delete'></i></a>";
                    $code .= "</form>";

                    $code .= "</div>";
                } else {
                    $code .= "<div class='td'></div>";
                }

                $code .= "</div>"; // tr
            }
            $code .= "</div>"; // table_new
        }

        return $code;
    }

}