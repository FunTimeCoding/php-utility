<?php

namespace FunTimeCoding\PhpUtility\Test\Integration\Framework;

use FunTimeCoding\PhpUtility\Framework\YamlConfiguration;
use PHPUnit\Framework\TestCase;

class YamlConfigurationTest extends TestCase
{
    /**
     * @var YamlConfiguration
     */
    protected $configuration;

    /**
     * @throws \FunTimeCoding\PhpUtility\Framework\FrameworkException
     */
    public function setUp(): void
    {
        $file = __DIR__ . '/fixture/configuration.yml';
        $this::assertFileExists($file);
        $this->configuration = new YamlConfiguration($file);
    }

    public function testReadConfig(): void
    {
        $name = $this->configuration->get('wpName');
        $password = $this->configuration->get('wpPassword');

        $this::assertNotEmpty($name);
        $this::assertNotEmpty($password);

        $this::assertEquals('randomUser', $name);
        $this::assertEquals('insecurePassword', $password);
    }

    public function testReadArray(): void
    {
        $array = $this->configuration->get('development');

        $this::assertArrayHasKey('username', $array);
        $this::assertArrayHasKey('password', $array);

        $this::assertEquals('randomUser', $array['username']);
        $this::assertEquals('insecurePassword', $array['password']);
    }

    /**
     * @throws \FunTimeCoding\PhpUtility\Framework\FrameworkException
     */
    public function testAccessSubKey(): void
    {
        $result = $this->configuration->getMultipleKeys(['development', 'username']);

        $this::assertEquals('randomUser', $result);
    }

    public function testInvalidKey(): void
    {
        $result = $this->configuration->get('invalidKey');

        $this::assertEquals('', $result);
    }

    /**
     * @throws \FunTimeCoding\PhpUtility\Framework\FrameworkException
     */
    public function testInvalidSubKey(): void
    {
        $result = $this->configuration->getMultipleKeys(['development', 'invalidKey']);

        $this::assertEquals('', $result);
    }
}
