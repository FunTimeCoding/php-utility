<?php
namespace FunTimeCoding\PhpUtility;

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use ReflectionException;
use Twig_Error;
use function FastRoute\simpleDispatcher;

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
                //$vars = $dispatchResult[2];
                //echo var_export($vars, true) . PHP_EOL;

                try {
                    $output = $this->foundRequest($dispatchResult[1]);
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

    /**
     * @param string $handler
     *
     * @return string
     * @throws ReflectionException
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function foundRequest(string $handler): string
    {
        $helper = new TemplateHelper();
        $twig = $helper->createTwigEnvironment();

        if ($handler == self::INDEX_HANDLER) {
            $output = $twig->render('index.html.twig');
        } elseif ($handler == self::SETTINGS_HANDLER) {
            $output = $twig->render('settings.html.twig');
        } elseif (in_array($handler, [self::FORM_GET_HANDLER, self::FORM_POST_HANDLER])) {
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
        } elseif ($handler == self::FORM_POST_HANDLER) {
            $output = 'Implement once the FORM_GET_HANDLER works.' . PHP_EOL;
        } else {
            $output = 'Handler not implemented: ' . $handler . PHP_EOL;
        }

        return $output;
    }
}
