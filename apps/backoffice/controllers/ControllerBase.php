<?php

namespace Candidates\Backoffice\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->tag->setTitle(' | OgilvyOne');
    }
}
