<?php
require_once ('BaseController.php');
safe_require('repositories/TestRepo.php');

class TestController extends BaseController
{
    public function testAction() {
        $repo = new TestRepo();

        $testObject = $repo->getEntity(4);
        $repo->deleteEntity($testObject);

        $viewModel[] = $testObject;


        $this->renderView('Test/TestView', $viewModel);

    }
}