<?php
namespace FunTimeCoding\PhpUtility;

use DateTime;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Forms;
use Twig_Environment;
use Twig_Error;
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

    public function createTwigEnvironment(): Twig_Environment
    {
        // TODO: Use cache.
        //['cache' => 'path/to/cache']
        return new Twig_Environment(
            new Twig_Loader_Filesystem(__DIR__ . '/../template')
        );
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
        $dispatcher = simpleDispatcher(function (RouteCollector $collector) {
            $collector->addRoute(self::GET, '/', self::INDEX_HANDLER);
            $collector->addRoute(self::GET, '/settings', self::SETTINGS_HANDLER);
            $collector->addRoute(self::GET, '/form', self::FORM_GET_HANDLER);
            $collector->addRoute(self::POST, '/form', self::FORM_POST_HANDLER);
        });
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
                $twig = $this->createTwigEnvironment();

                try {
                    if ($handler == self::INDEX_HANDLER) {
                        $output = $twig->render('index.html.twig');
                    } elseif ($handler == self::SETTINGS_HANDLER) {
                        $output = $twig->render('settings.html.twig');
                    } else if ($handler == self::FORM_GET_HANDLER) {
                        $twig->addExtension(new FormExtension());
                        $factory = Forms::createFormFactoryBuilder()
                            // TODO: Comment in once the form works.
                            //->addExtension(new ValidatorExtension(Validation::createValidator()))
                            ->getFormFactory();
                        $form = $factory->createBuilder(
                            FormType::class,
                            ['dueDate' => new DateTime('tomorrow')]
                        )
                            ->add('task', TextType::class)
                            ->add('dueDate', DateType::class)
                            ->getForm();
                        $output = $twig->render(
                            'form.html.twig',
                            ['form' => $form->createView()]
                        );
                    } else if ($handler == self::FORM_POST_HANDLER) {
                        $output = 'Implement once the FORM_GET_HANDLER works.';
                    } else {
                        $output = 'Handler not implemented: ' . $handler;
                    }
                } catch (Twig_Error $exception) {
                    //$output = 'Render error.' . PHP_EOL;
                    $output = $exception->getMessage();
                }

                break;
            default:
                $output = 'Unexpected dispatch result: ' . $dispatchResult[0] . PHP_EOL;

                break;
        }

        return $output;
    }
}
