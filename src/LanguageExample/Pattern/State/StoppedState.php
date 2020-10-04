<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Pattern\State;

use Exception;

/**
 * @phan-file-suppress PhanUnusedPublicMethodParameter
 */
class StoppedState implements EngineStateInterface
{
    public function start(EngineStateContext $context): void
    {
        $context->setState(new RunningState());
        echo 'Engine started.';
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @param EngineStateContext $context
     *
     * @throws Exception
     */
    public function stop(EngineStateContext $context): void
    {
        throw new Exception('Cannot stop a stopped engine.');
    }
}
