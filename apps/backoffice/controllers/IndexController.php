<?php

namespace Candidates\Backoffice\Controllers;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $this->tag->prependTitle('Dashboard');
    }

}

