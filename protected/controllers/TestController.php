<?php
require_once ('BaseController.php');

class TestController extends BaseController
{
    public function testAction() {
        $this->renderView('Test/TestView');

    }
}