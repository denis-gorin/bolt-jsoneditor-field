<?php

declare(strict_types=1);

namespace App\Jsoneditor;

use Bolt\Extension\BaseExtension;
use Symfony\Component\Filesystem\Filesystem;

class Extension extends BaseExtension
{
    public function getName(): string
    {
        return 'Extension to add the Jsoneditor FieldType';
    }

    public function initialize(): void
    {
        $this->addTwigNamespace('jsoneditor');
        $this->addWidget(new JsoneditorInjectorWidget());
    }

    public function install(): void
    {
        $projectDir = $this->getContainer()->getParameter('kernel.project_dir');
        $public = $this->getContainer()->getParameter('bolt.public_folder');

        $source = dirname(__DIR__) . '/assets/';
        $destination = $projectDir . '/' . $public . '/assets/';

        $filesystem = new Filesystem();
        $filesystem->mirror($source, $destination);
    }
}
