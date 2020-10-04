<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Gearman;

use GearmanClient;

class Client
{
    public function main(): void
    {
        $client = new GearmanClient();
        $client->addServer();
        $encoded = json_encode(
            ['path' => '/tmp/test.txt', 'content' => 'example']
        );

        if ($encoded !== false) {
            $client->doBackground('write_file', $encoded);
            echo $client->doNormal('reverse', 'Hello World!') . PHP_EOL;
        } else {
            echo 'JSON encode failed: ' . json_last_error_msg() . PHP_EOL;
        }
    }
}
