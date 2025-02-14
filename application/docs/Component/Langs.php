<?php declare(strict_types = 1);

namespace Docs\Component;

use Psr\Http\Message\ServerRequestInterface;
use Sys\I18n\I18n;
use Sys\Template\Component;
use Sys\Template\TemplateInterface;

class Langs extends Component
{
    private ServerRequestInterface $request;
    private TemplateInterface $tpl;
    private I18n $i18n;

    public function __construct(ServerRequestInterface $request, TemplateInterface $tpl, I18n $i18n)
    {
        $this->request = $request;
        $this->tpl = $tpl;
        $this->i18n = $i18n;
    }

    public function render()
    {
        $path = $this->request->getUri()->getPath();
        return $this->tpl->render('@docs/common/langs', [
            'currentLang' => $this->i18n->currentTitle(),
            'langs' => $this->i18n->linksList($path),
        ]);
    }
}
