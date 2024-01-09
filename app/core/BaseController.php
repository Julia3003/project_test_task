<?php

namespace core;

use core\View;
class BaseController
{

    /**
     * @var array
     */
    public array $data = [];
    /**
     * @var array|string[]
     */
    public array $meta = ['title' => '', 'description' => ''];
    /**
     * @var string
     */
    public string $layout = '';
    /**
     * @var BaseModel
     */
    protected  $model;
    /**
     * @var View
     */
    protected  $view;

    public function __construct() {
        $this->view = new View();
        $this->model = new BaseModel();
    }

}