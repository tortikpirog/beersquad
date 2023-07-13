<?php
require_once ('BaseController.php');
safe_require('repositories/TestRepo.php');
safe_require('services/TestService.php');
class TestController extends BaseController
{
    private $testService;

    public function __construct()
    {
        $this->testService = new TestService();
    }

    public function testAction() {
        $viewModel[] = $this->testService->test($_GET["id"]);;
        $this->renderView('Test/TestView', $viewModel);
    }

    public function showALlAction() {
        $viewModel = $this->testService->showAll();
        $this->renderView('Test/TestView', $viewModel);
    }

    public function createAction() {
        $this->testService->create($this->getPostParams("name"));
        $this->redirectTo("/test/showAll");
    }
}