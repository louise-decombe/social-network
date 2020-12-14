<?php

class Infos
{
    public $infos;
    public function __construct(array $infos)
    {
        $this->infos = $infos;
    }

    public function renderInfo()
    {
        $info = $this->infos;
        if (!empty($info)) {
            $output = "";
            if (count($info) > 1) {
                $output .= "<ul id='error'>";
                foreach ($info as $error) {
                    $output .= "<li>" . $error . "</li>";
                }
                $output .= "</ul>";
            } else {
                $output = $info[0];
            }
            return "<div id='error'>"
                . $output .
                "</div>";
        } else {
            return "";
        }
    }
}

?>