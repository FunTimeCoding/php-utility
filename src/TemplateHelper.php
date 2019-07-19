<?php
namespace FunTimeCoding\PhpUtility;

use ReflectionClass;
use ReflectionException;
use Symfony\Bridge\Twig\AppVariable;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Twig\Environment;
use Twig\RuntimeLoader\FactoryRuntimeLoader;
use Twig\Loader\FilesystemLoader;

class TemplateHelper
{
    /**
     * @return Environment
     * @throws ReflectionException
     */
    public function createTwigEnvironment(): Environment
    {
        $bridgeBundleClass = new ReflectionClass(AppVariable::class);
        // TODO: Use cache.
        //['cache' => 'path/to/cache']
        $twig = new Environment(
            new FilesystemLoader(
                [
                    __DIR__ . '/../template',
                    dirname($bridgeBundleClass->getFileName()) . '/Resources/views/Form',
                ]
            )
        );
        $formEngine = new TwigRendererEngine(
            [
                'form_div_layout.html.twig'
            ],
            $twig
        );
        $twig->addRuntimeLoader(
            new FactoryRuntimeLoader(
                [
                    FormRenderer::class => static function () use ($formEngine) {
                        return new FormRenderer($formEngine);
                    },
                ]
            )
        );
        $twig->addExtension(new FormExtension());

        $translator = new Translator('en');
        $translator->addLoader('xlf', new XliffFileLoader());
        $translator->addResource(
            'xlf',
            __DIR__ . '/../translation/messages.en.xlf',
            'en'
        );

        $vendorDirectory = dirname(__DIR__) . '/vendor';
        $formDirectory = $vendorDirectory . '/symfony/form';
        $validatorDirectory = $vendorDirectory . '/symfony/validator';
        $translator->addResource(
            'xlf',
            $formDirectory . '/Resources/translations/validators.en.xlf',
            'en',
            'validators'
        );
        $translator->addResource(
            'xlf',
            $validatorDirectory . '/Resources/translations/validators.en.xlf',
            'en',
            'validators'
        );

        $twig->addExtension(new TranslationExtension($translator));

        return $twig;
    }
}
