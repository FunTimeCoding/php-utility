<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\RabbitMessageQueue;

use ErrorException;

/**
 * TODO: Try to remove with new Phan version when AST is updated.
 * @phan-file-suppress PhanUndeclaredClassMethod
 */
class Consumer
{
    /**
     * @throws ErrorException
     */
    public function main(): void
    {
        $helper = new Helper();

        $channel = $helper->connect();
        $callback = static function ($msg): void {
            echo $msg->body . PHP_EOL;
        };
        $channel->basic_consume(
            'hello',
            '',
            false,
            true,
            false,
            false,
            $callback
        );

        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }
}
