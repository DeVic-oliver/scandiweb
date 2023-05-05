<?php
require 'controllers/ProductController.php';
require 'views/header.html';


$controller = new ProductController();

if(isset($_REQUEST) && !empty($_REQUEST['class'])){
    if(method_exists($_REQUEST['class'], $_REQUEST['method'])){
        $method = $_REQUEST['method'];
        call_user_func(array($controller, $method));
    }
}
$controller->show();

require 'Views/footer.html';