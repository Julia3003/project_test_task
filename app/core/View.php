<?php

namespace core;

class View
{
    protected string $template = 'layout';

    public function __construct($template = null)
    {
        if ($template !== null) {
            $this->template = $template;
        }
    }

    /**
     * @param string $page
     * @param array $data
     * @return void
     */
    public function render(string $page, array $data = []): void
    {
        extract($data);
        include_once TEMPLATES_FOLDER . $this->template . '.php';
    }
}