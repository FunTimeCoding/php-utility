<?php
namespace FunTimeCoding\PhpUtility;

use DateTime;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use ReflectionClass;
use ReflectionException;
use Symfony\Bridge\Twig\AppVariable;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Validation;
use Twig\Environment;
use Twig_Error;
use Twig_FactoryRuntimeLoader;
use Twig_Loader_Filesystem;

class FrontEnd
{
    const GET = 'GET';
    const POST = 'POST';
    const INDEX_HANDLER = 'index';
    const SETTINGS_HANDLER = 'settings';
    const FORM_GET_HANDLER = 'form_get';
    const FORM_POST_HANDLER = 'form_post';

    public static function main(string $resourceIdentifier, string $method): void
    {
        $frontEnd = new FrontEnd();
        echo $frontEnd->run($resourceIdentifier, $method);
    }

    /**
     * @return Environment
     * @throws ReflectionException
     */
    public function createTwigEnvironment(): Environment
    {
        $appVariableReflection = new ReflectionClass(AppVariable::class);
        // TODO: Use cache.
        //['cache' => 'path/to/cache']
        $twig = new Environment(
            new Twig_Loader_Filesystem(
                [
                    __DIR__ . '/../template',
                    dirname($appVariableReflection->getFileName()) . '/Resources/views/Form',
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
            new Twig_FactoryRuntimeLoader(
                [
                    FormRenderer::class => function () use ($formEngine) {
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

        $vendorDirectory = realpath(__DIR__ . '/../vendor');
        $vendorFormDirectory = $vendorDirectory . '/symfony/form';
        $vendorValidatorDirectory = $vendorDirectory . '/symfony/validator';
        $translator->addResource(
            'xlf',
            $vendorFormDirectory . '/Resources/translations/validators.en.xlf',
            'en',
            'validators'
        );
        $translator->addResource(
            'xlf',
            $vendorValidatorDirectory . '/Resources/translations/validators.en.xlf',
            'en',
            'validators'
        );

        $twig->addExtension(new TranslationExtension($translator));

        return $twig;
    }

    public function prepareResourceIdentifier(string $fullIdentifier): string
    {
        if (false !== $pos = strpos($fullIdentifier, '?')) {
            $preparedIdentifier = substr($fullIdentifier, 0, $pos);
        } else {
            $preparedIdentifier = $fullIdentifier;
        }

        return rawurldecode($preparedIdentifier);
    }

    public function run(string $resourceIdentifier, string $method): string
    {
        $dispatcher = simpleDispatcher(
            function (RouteCollector $collector) {
                $collector->addRoute(self::GET, '/', self::INDEX_HANDLER);
                $collector->addRoute(self::GET, '/settings', self::SETTINGS_HANDLER);
                $collector->addRoute(self::GET, '/form', self::FORM_GET_HANDLER);
                $collector->addRoute(self::POST, '/form', self::FORM_POST_HANDLER);
            }
        );
        $dispatchResult = $dispatcher->dispatch(
            $method,
            $this->prepareResourceIdentifier($resourceIdentifier)
        );

        switch ($dispatchResult[0]) {
            case Dispatcher::NOT_FOUND:
                $output = 'Not found.' . PHP_EOL;

                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $output = 'Allowed methods: ' . implode(',', $dispatchResult[1]) . PHP_EOL;

                break;
            case Dispatcher::FOUND:
                $handler = $dispatchResult[1];
                //$vars = $dispatchResult[2];
                //echo var_export($vars, true) . PHP_EOL;

                try {
                    $twig = $this->createTwigEnvironment();

                    if ($handler == self::INDEX_HANDLER) {
                        $output = $twig->render('index.html.twig');
                    } elseif ($handler == self::SETTINGS_HANDLER) {
                        $output = $twig->render('settings.html.twig');
                    } elseif ($handler == self::FORM_GET_HANDLER || $handler == self::FORM_POST_HANDLER) {
                        $factory = Forms::createFormFactoryBuilder()
                            ->addExtension(new ValidatorExtension(Validation::createValidator()))
                            ->getFormFactory();
                        $form = $factory->createBuilder(
                            FormType::class,
                            [
                                'dueDate' => new DateTime('tomorrow')
                            ]
                        )
                            ->add(
                                'task',
                                TextType::class,
                                [
                                    'constraints' => new NotBlank()
                                ]
                            )
                            ->add(
                                'dueDate',
                                DateType::class,
                                [
                                    'constraints' => [
                                        new NotBlank(),
                                        new Type(DateTime::class)
                                    ]
                                ]
                            )
                            ->getForm();
                        $form->handleRequest();

                        if ($form->isSubmitted() && $form->isValid()) {
                            $output = 'Task submitted: ' . $form->getData()['task'] . PHP_EOL;
                        } else {
                            $output = $twig->render(
                                'form.html.twig',
                                [
                                    'form' => $form->createView()
                                ]
                            );
                        }
                    } elseif ($handler == self::FORM_POST_HANDLER) {
                        $output = 'Implement once the FORM_GET_HANDLER works.' . PHP_EOL;
                    } else {
                        $output = 'Handler not implemented: ' . $handler . PHP_EOL;
                    }
                } catch (Twig_Error $exception) {
                    $output = $exception->getMessage() . PHP_EOL;
                } catch (ReflectionException $exception) {
                    $output = $exception->getMessage() . PHP_EOL;
                }

                break;
            default:
                $output = 'Unexpected dispatch result: ' . $dispatchResult[0] . PHP_EOL;

                break;
        }

        return $output;
    }
}
