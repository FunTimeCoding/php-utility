<?php

namespace FunTimeCoding\PhpUtility\Test\Integration\Framework;

use FunTimeCoding\PhpUtility\Framework\YamlConfig;
use PHPUnit_Framework_TestCase;

class YamlConfigTest extends PHPUnit_Framework_TestCase
{
    public function testReadConfig()
    {
        $config = new YamlConfig('~/.php-skeleton.yml');

        $name = $config->getValue('wpName');
        $password = $config->getValue('wpPassword');

        $this->assertNotEmpty($name);
        $this->assertNotEmpty($password);
    }
}