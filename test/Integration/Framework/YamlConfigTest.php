<?php

namespace FunTimeCoding\PhpUtility\Test\Integration\Framework;

use Exception;
use FunTimeCoding\PhpUtility\Framework\YamlConfig;
use PHPUnit\Framework\TestCase;

class YamlConfigTest extends TestCase
{
    /**
     * @var YamlConfig
     */
    protected $config;

    public function setUp()
    {
        $file = __DIR__.'/fixture/config.yml';
        $this->assertFileExists($file);
        $this->config = new YamlConfig($file);
    }

    public function testReadConfig()
    {
        $name = $this->config->get('wpName');
        $password = $this->config->get('wpPassword');

        $this->assertNotEmpty($name);
        $this->assertNotEmpty($password);

        $this->assertEquals('randomUser', $name);
        $this->assertEquals('insecurePassword', $password);
    }

    public function testReadArray()
    {
        $array = $this->config->get('development');

        $this->assertArrayHasKey('username', $array);
        $this->assertArrayHasKey('password', $array);

        $this->assertEquals('randomUser', $array['username']);
        $this->assertEquals('insecurePassword', $array['password']);
    }

    public function testAccessSubKey()
    {
        $result = $this->config->get(['development', 'username']);

        $this->assertEquals('randomUser', $result);
    }

    public function testInvalidKey()
    {
        $result = $this->config->get('invalidKey');

        $this->assertEquals('', $result);
    }

    public function testInvalidSubKey()
    {
        $result = $this->config->get(['development', 'invalidKey']);

        $this->assertEquals('', $result);
    }
}
