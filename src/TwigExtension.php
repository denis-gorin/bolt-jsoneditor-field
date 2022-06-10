<?php

declare(strict_types=1);

namespace App\Jsoneditor;

use Bolt\Common\Json;
use Bolt\Extension\ExtensionRegistry;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    /** @var ExtensionRegistry */
    private $registry;

    public function __construct(ExtensionRegistry $registry)
    {
        $this->registry = $registry;
    }

    public function getFunctions(): array
    {
        $safe = [
            'is_safe' => ['html'],
        ];

        return [
            new TwigFunction('json_editor_value', [$this, 'jsonEditorValue'], $safe),
        ];
    }

    // public function jsonEditorConfig(): string
    // {
    //     $extension = $this->registry->getExtension(Extension::class);
    //     $config = $extension->getConfig();

    //     return Json::json_encode($config, JSON_HEX_QUOT | JSON_HEX_APOS);
    // }

    public function jsonEditorValue($value): string
    {
        // return Json::json_encode($value, JSON_HEX_QUOT | JSON_HEX_APOS);
        $value = preg_replace('/​/','',$value); // NOTE: invisible space here
        return json_encode(json_decode($value));
    }
}
