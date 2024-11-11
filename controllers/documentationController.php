<?php
require_once 'views/viewDocumentation.php';

class DocumentationController{

    private $viewDocumentation;

    public function __construct(){

       $this->viewDocumentation = new ViewDocumentation();
    }

    public function showDocumentation(){

        $this->viewDocumentation->showDocumentation();
    }

}
