<?php
class Bootstrap {
   
    public function __construct() {

        Session::init();

        require 'Controllers/indexController.php';
            $controller = new Index();
            $controller->route();

    }

}