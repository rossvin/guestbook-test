<?php
class View {
    public function __construct() {

    }


    public function render($name)
    {
           require 'Views/layouts/header.php';
           require 'Views/' . $name . '.php';

    }
}
