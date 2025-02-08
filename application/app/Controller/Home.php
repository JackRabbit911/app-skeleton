<?php declare(strict_types = 1);

namespace App\Controller;

use Sys\Controller\WebController;

class Home extends WebController
{
    public function __invoke()
    {
        return view('common/layout');
    }
}
