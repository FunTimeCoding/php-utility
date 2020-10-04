<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\RabbitMessageQueue;

use Exception;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * TODO: Try to remove with new Phan version when AST is updated.
 * @phan-file-suppress PhanUndeclaredClassMethod
 */
class Producer
{
    /**
     * @throws Exception
     */
    public function main(): void
    {
        $helper = new Helper();

        $channel = $helper->connect();
        $message = new AMQPMessage('Hello World!');
        $channel->basic_publish($message, '', 'hello');
        $channel->close();

        $helper->close();
    }
}
