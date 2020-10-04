<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use ReflectionException;
use Twig\Error\Error;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

use function FastRoute\simpleDispatcher;

class FrontEnd
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const INDEX_HANDLER = 'index';
    public const SETTINGS_HANDLER = 'settings';
    public const FORM_GET_HANDLER = 'form_get';
    public const FORM_POST_HANDLER = 'form_post';

    public static function main(string $resourceIdentifier, string $method): void
    {
        $frontEnd = new self();
        echo $frontEnd->run($resourceIdentifier, $method);
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
            static function (RouteCollector $collector): void {
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
                //$vars = $dispatchResult[2];
                //echo var_export($vars, true) . PHP_EOL;

                try {
                    $output = $this->foundRequest($dispatchResult[1]);
                } catch (Error $exception) {
                    $output = $exception->getMessage() . PHP_EOL;
                } catch (ReflectionException $exception) {
                    $output = $exception->getMessage() . PHP_EOL;
                } catch (Framework\FrameworkException $exception) {
                    $output = $exception->getMessage() . PHP_EOL;
                }

                break;
            default:
                $output = 'Unexpected dispatch result: ' . $dispatchResult[0] . PHP_EOL;

                break;
        }

        return $output;
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Framework\FrameworkException
     * TODO: Remove psalm-suppress oce Phan and Psalm can agree on the problem.
     * @psalm-suppress TooManyTemplateParams
     */
    public function foundRequest(string $handler): string
    {
        $helper = new TemplateHelper();
        $twig = $helper->createTwigEnvironment();

        if ($handler === self::INDEX_HANDLER) {
            $output = $twig->render('index.html.twig');
        } elseif ($handler === self::SETTINGS_HANDLER) {
            $output = $twig->render('settings.html.twig');
        } elseif (in_array($handler, [self::FORM_GET_HANDLER, self::FORM_POST_HANDLER], true)) {
            $exampleForm = new ExampleForm();
            $form = $exampleForm->create();
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
        } else {
            $output = 'Handler not implemented: ' . $handler . PHP_EOL;
        }

        return $output;
    }
}
