<?php

class BaseController
{
    protected function renderView($viewPath, $viewModel = null)
    {
        if(!is_null($viewModel)) {
            $GLOBALS['viewModel'] = $viewModel;
        }
        $GLOBALS['viewPath'] = "views/$viewPath.php";
        safe_require("views/BaseView.php");
    }

    protected function redirectTo($path) {
        header("Location: $path");
    }

    protected function getPostParams($name) {
        $result = $_POST[$name];
        if (is_null($result)) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);
            $result = $data[$name];
        }
        return $result;
    }
}