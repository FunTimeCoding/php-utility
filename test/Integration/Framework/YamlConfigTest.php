<?php

namespace FunTimeCoding\PhpUtility\Test\Integration\Framework;

use FunTimeCoding\PhpUtility\Framework\YamlConfig;
use PHPUnit\Framework\TestCase;

class YamlConfigTest extends TestCase
{
    /**
     * @var YamlConfig
     */
    protected $config;

    public function setUp(): void
    {
        $file = __DIR__.'/fixture/config.yml';
        $this->assertFileExists($file);
        $this->config = new YamlConfig($file);
    }

    /**
     * @throws \Exception
     */
    public function testReadConfig(): void
    {
        $name = $this->config->get('wpName');
        $password = $this->config->get('wpPassword');

        $this->assertNotEmpty($name);
        $this->assertNotEmpty($password);

        $this->assertEquals('randomUser', $name);
        $this->assertEquals('insecurePassword', $password);
    }

    /**
     * @throws \Exception
     */
    public function testReadArray(): void
    {
        $array = $this->config->get('development');

        $this->assertArrayHasKey('username', $array);
        $this->assertArrayHasKey('password', $array);

        $this->assertEquals('randomUser', $array['username']);
        $this->assertEquals('insecurePassword', $array['password']);
    }

    /**
     * @throws \Exception
     */
    public function testAccessSubKey(): void
    {
        $result = $this->config->get(['development', 'username']);

        $this->assertEquals('randomUser', $result);
    }

    /**
     * @throws \Exception
     */
    public function testInvalidKey(): void
    {
        $result = $this->config->get('invalidKey');

        $this->assertEquals('', $result);
    }

    /**
     * @throws \Exception
     */
    public function testInvalidSubKey(): void
    {
        $result = $this->config->get(['development', 'invalidKey']);

        $this->assertEquals('', $result);
    }
}
