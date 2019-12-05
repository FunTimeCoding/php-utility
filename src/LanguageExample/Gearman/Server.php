<?php
declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Gearman;

use GearmanJob;
use GearmanWorker;

class Server
{
    public function main(): void
    {
        $worker = new GearmanWorker();
        $worker->addServer();
        $worker->addFunction('reverse', static function ($job) {
            /** @var $job GearmanJob */
            return strrev($job->workload());
        });
        $worker->addFunction('write_file', static function ($job) {
            /** @var $job GearmanJob */
            $workload = json_decode($job->workload(), true);
            file_put_contents($workload['path'], $workload['content']);

            return 'File written';
        });
        while ($worker->work()) {
        };
    }
}
