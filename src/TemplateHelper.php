<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility;

use FunTimeCoding\PhpUtility\Framework\FrameworkException;
use ReflectionClass;
use Symfony\Bridge\Twig\AppVariable;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Twig\Environment;
use Twig\RuntimeLoader\FactoryRuntimeLoader;
use Twig\Loader\FilesystemLoader;

class TemplateHelper
{
    /**
     * @throws FrameworkException
     */
    public function createTwigEnvironment(): Environment
    {
        $bridgeBundleClass = new ReflectionClass(AppVariable::class);
        // TODO: Use cache.
        //['cache' => 'path/to/cache']

        $bridgeBundleFileName = $bridgeBundleClass->getFileName();

        if ($bridgeBundleFileName === false) {
            throw new FrameworkException('Could not determine bridge bundle file name.');
        }

        // TODO: Remove after Twig 3.0 is released.
        // @phan-suppress-next-line PhanDeprecatedInterface
        $fileSystemLoader = new FilesystemLoader(
            [
                __DIR__ . '/../template',
                dirname($bridgeBundleFileName) . '/Resources/views/Form',
            ]
        );

        $twig = new Environment($fileSystemLoader);
        $formEngine = new TwigRendererEngine(
            [
                'form_div_layout.html.twig'
            ],
            $twig
        );
        $twig->addRuntimeLoader(
            new FactoryRuntimeLoader(
                [
                    FormRenderer::class => static function () use ($formEngine): FormRenderer {
                        return new FormRenderer($formEngine);
                    },
                ]
            )
        );
        $twig->addExtension(new FormExtension());
        $twig->addExtension((new TranslatorFactory())->create());

        return $twig;
    }
}
