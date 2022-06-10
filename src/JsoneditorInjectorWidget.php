<?php

declare(strict_types=1);

namespace App\Jsoneditor;

use Bolt\Widget\BaseWidget;
use Bolt\Widget\Injector\RequestZone;
use Bolt\Widget\Injector\Target;
use Bolt\Widget\TwigAwareInterface;

class JsoneditorInjectorWidget extends BaseWidget implements TwigAwareInterface
{
    protected $name = 'Json Field Injector Widget';
    protected $target = Target::AFTER_JS;
    protected $zone = RequestZone::BACKEND;
    protected $template = '@jsoneditor/injector.html.twig';
    protected $priority = 200;

    public function __construct()
    {
    }

    // public function run(array $params = []): ?string
    // {
    //     $request = $this->getExtension()->getRequest();
    //     // Only produce output when editing or creating a Record, with GET method.
    //     if (! in_array($request->get('_route'), ['bolt_content_edit', 'bolt_content_new', 'bolt_content_duplicate'], true) ||
    //         ($this->getExtension()->getRequest()->getMethod() !== 'GET')) {
    //         return null;
    //     }

    //     return parent::run();
    // }

    protected function run(array $params = []): ?string
    {
        $config = $this->getExtension()->getConfig();

        return parent::run(['json_editor_config' => $config]);
    }
}
