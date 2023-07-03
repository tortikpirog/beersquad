<?php

class BaseController
{
protected function renderView($viewPath){
    require_once ($_SERVER['DOCUMENT_ROOT']."/protected/views/$viewPath.php");
}
}