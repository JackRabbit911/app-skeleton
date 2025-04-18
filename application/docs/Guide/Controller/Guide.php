<?php declare(strict_types = 1);

namespace Docs\Guide\Controller;

use Docs\Guide\Repo;
use Sys\Controller\WebController;
use APPPATH;

class Guide extends WebController
{
    protected string $tplPath = APPPATH . 'docs/views';
    protected string $guidePath = APPPATH . 'docs/Guide/data';

    public function __invoke(Repo $repo, $file = 'info.html')
    {
        if (!is_file($this->guidePath . '/' . $file)) {
            abort();
        }

        $data['menu'] = $repo->getSidebar();
        $data['file'] = "@guide/$file";
        $data['title'] = $this->getTitle($file);

        return view('@docs/guide/started', $data);
    }

    protected function _before()
    {
        $this->tpl
            ->addPath(realpath($this->tplPath), 'docs')
            ->addPath(realpath($this->guidePath), 'guide');
    }

    private function getTitle($file)
    {
        $filename = pathinfo($file)['filename'];
        return ucfirst($filename);
    }
}
