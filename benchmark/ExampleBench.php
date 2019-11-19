<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Benchmark;

use FunTimeCoding\PhpUtility\PhpUtility;

class ExampleBench
{
    public function benchMainMethod() : void
    {
        $application = new PhpUtility();
        $application->main();
    }
}
