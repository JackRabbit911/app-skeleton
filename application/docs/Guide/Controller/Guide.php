<?php declare(strict_types = 1);

namespace Docs\Guide\Controller;

use Az\Route\Route;
use Sys\Controller\WebController;
use Sys\Template\TemplateInterface;

class Guide //extends WebController
{
    protected string $tplPath = APPPATH . 'docs/views';
    // private $tpl;

    public function __construct(TemplateInterface $tpl)
    {
        $tpl->getEngine()
            ->getLoader()
            ->addPath(realpath($this->tplPath), 'docs');
    }

    public function started($param = null)
    {
        // $route = $this->request->getAttribute(Route::class);
        // dd($route);
        return view('@docs/guide/started');
    }

    // protected function _before()
    // {
    //     $this->tpl->getEngine()
    //         ->getLoader()
    //         ->addPath(realpath($this->tplPath), 'docs');
    // }
}
