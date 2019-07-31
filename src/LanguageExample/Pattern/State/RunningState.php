<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\State;

use Exception;

/**
 * @phan-file-suppress PhanUnusedPublicMethodParameter
 */
class RunningState implements EngineStateInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param EngineStateContext $context
     *
     * @throws Exception
     */
    public function start(EngineStateContext $context): void
    {
        throw new Exception('Cannot start a running engine.');
    }

    public function stop(EngineStateContext $context): void
    {
        $context->setState(new StoppedState());
        echo 'Engine stopped.';
    }
}
