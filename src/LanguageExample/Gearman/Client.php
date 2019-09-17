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
        $client->doBackground(
            'write_file',
            json_encode(
                ['path' => '/tmp/test.txt', 'content' => 'example']
            )
        );
        echo $client->doNormal('reverse', 'Hello World!') . PHP_EOL;
    }
}
