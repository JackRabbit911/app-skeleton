<?php declare(strict_types = 1);

namespace Docs\Guide\Controller;

use Docs\Guide\Repo;
use Sys\Controller\WebController;

class Guide extends WebController
{
    protected string $tplPath = APPPATH . 'docs/views';

    public function __invoke(Repo $repo, $folder, $file)
    {
        $data['menu'] = $repo->getSidebar();
        
        return view('@docs/guide/started', $data);
    }

    protected function _before()
    {
        $this->tpl->getEngine()
            ->getLoader()
            ->addPath(realpath($this->tplPath), 'docs');
    }
}
