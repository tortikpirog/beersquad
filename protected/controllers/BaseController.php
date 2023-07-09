<?php

class BaseController
{
    protected function renderView($viewPath, $viewModel)
    {
        $GLOBALS['viewModel'] = $viewModel;
        safe_require("views/$viewPath.php");
    }
}