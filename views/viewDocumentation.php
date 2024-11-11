<?php
class ViewDocumentation{

    public function showDocumentation(){

        $htmlContent = file_get_contents('documentation/documentation.html');

        echo $htmlContent;
    }

}