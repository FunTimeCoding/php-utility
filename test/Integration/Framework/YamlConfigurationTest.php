<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\Test\Integration\Framework;

use FunTimeCoding\PhpUtility\Framework\FrameworkException;
use FunTimeCoding\PhpUtility\Framework\YamlConfiguration;
use PHPUnit\Framework\TestCase;

class YamlConfigurationTest extends TestCase
{
    /**
     * @var YamlConfiguration
     */
    protected $configuration;

    /**
     * @throws FrameworkException
     */
    public function setUp(): void
    {
        $file = __DIR__ . '/fixture/configuration.yml';
        $this::assertFileExists($file);
        $this->configuration = new YamlConfiguration($file);
    }

    /**
     * @throws FrameworkException
     */
    public function testReadConfig(): void
    {
        $server = $this->configuration->getString('mediawiki-server');
        $name = $this->configuration->getString('mediawiki-username');
        $password = $this->configuration->getString('mediawiki-password');

        $this::assertNotEmpty($server);
        $this::assertNotEmpty($name);
        $this::assertNotEmpty($password);

        $this::assertEquals('http://localhost', $server);
        $this::assertEquals('randomUser', $name);
        $this::assertEquals('insecurePassword', $password);
    }

    /**
     * @throws FrameworkException
     */
    public function testReadArray(): void
    {
        $array = $this->configuration->getArray('development');

        $this::assertArrayHasKey('username', $array);
        $this::assertArrayHasKey('password', $array);

        $this::assertEquals('randomUser', $array['username']);
        $this::assertEquals('insecurePassword', $array['password']);
    }

    /**
     * @throws FrameworkException
     */
    public function testAccessSubKey(): void
    {
        $result = $this->configuration->getStringDeep(['development', 'username']);

        $this::assertEquals('randomUser', $result);
    }

    /**
     * @throws FrameworkException
     */
    public function testInvalidKey(): void
    {
        $result = $this->configuration->getString('invalidKey');

        $this::assertEquals('', $result);
    }

    /**
     * @throws FrameworkException
     */
    public function testInvalidSubKey(): void
    {
        $result = $this->configuration->getStringDeep(['development', 'invalidKey']);

        $this::assertEquals('', $result);
    }
}
