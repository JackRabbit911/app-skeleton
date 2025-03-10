<?php declare(strict_types = 1);

namespace Docs\Guide;

use Sys\Helper\Facade\Text;

class Repo
{
    public function getSidebar()
    {
        $array = require APPPATH . 'docs/Guide/data/sidebar.php';
        return $this->arr2menu($array);
    }

    private function arr2menu($array, $key = '')
    {
        $menu = [];

        foreach ($array as $k => $val) {
            if (is_array($val)) {
                $menu[] = [
                    'title' => ucfirst($k),
                    'sub' => $this->arr2menu($val, $key . '/' . $k),
                ];
            } else {
                $menu[] = [
                    'title' => ucfirst($val),
                    'href' => path('guide', [
                        'file' => Text::strToSlug($key . '/' . $val) . '.html',
                    ]),
                ];
            }
        }

        return $menu;
    }
}
