<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\RabbitMessageQueue;

use Exception;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * TODO: Try to remove with new Phan version when AST is updated.
 * @phan-file-suppress PhanUndeclaredClassMethod
 * @phan-file-suppress PhanUndeclaredTypeProperty
 * @phan-file-suppress PhanUndeclaredTypeReturnType
 */
class Helper
{
    /**
     * @var AMQPStreamConnection
     */
    private $connection;

    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('localhost', '5672', 'guest', 'guest');
    }

    public function connect(): AMQPChannel
    {
        $channel = $this->connection->channel();
        $channel->queue_declare('hello', false, false, false, false);

        return $channel;
    }

    /**
     * @throws Exception
     */
    public function close(): void
    {
        $this->connection->close();
    }
}
