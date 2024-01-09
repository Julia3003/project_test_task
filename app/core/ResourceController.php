<?php

namespace core;

use core\View;
use core\BaseModel;

abstract class ResourceController
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
     * @var \core\BaseModel
     */
    protected $model;
    /**
     * @var \core\View
     */
    protected $view;

    public function __construct() {
        $this->view = new View();
        $this->model = new BaseModel();
    }

    /**
     * @return void
     */
    abstract public function index(): void;

    /**
     * @return void
     */
    abstract public function create(): void;

    /**
     * @param int $id
     * @return void
     */
    abstract public function show(): void;

    /**
     * @return void
     */
    abstract public function update(): void;

    /**
     * @return void
     */
    abstract public function destroy(): void;
}