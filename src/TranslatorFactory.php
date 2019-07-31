<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility;

use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;

class TranslatorFactory
{
    public function create(): TranslationExtension
    {
        // TODO: Remove after Symfony removes Symfony\Component\Translation\TranslatorInterface.
        // @phan-suppress-next-line PhanDeprecatedInterface
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

        return new TranslationExtension($translator);
    }
}
