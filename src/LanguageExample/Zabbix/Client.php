<?php

declare(strict_types=1);

namespace FunTimeCoding\PhpUtility\LanguageExample\Zabbix;

use FunTimeCoding\PhpUtility\Framework\FrameworkException;
use ZabbixApi\Exception;
use ZabbixApi\ZabbixApi;

/**
 * TODO: Try to remove with new Phan version when AST is updated.
 * @phan-file-suppress PhanUndeclaredClassMethod
 * @phan-file-suppress PhanUndeclaredTypeProperty
 * @phan-file-suppress PhanUndeclaredTypeThrowsType
 */
class Client
{
    private const DEFAULT_HOST_NAME = 'Zabbix server';
    private const HOST_IDENTIFIERS_KEY = 'hostids';
    private const ITEM_IDENTIFIERS_KEY = 'itemids';
    private const LIMIT_KEY = 'limit';
    private const KEY_KEY = 'key_';
    private const SEARCH_KEY = 'search';

    /**
     * @var ZabbixApi
     */
    private $client;


    /**
     * @throws Exception
     * @throws FrameworkException
     */
    public function main(): void
    {
        $home = getenv('HOME');

        if ($home === false) {
            throw new FrameworkException('HOME is not set.');
        }

        $configuration = include $home . '/.php-utility.php';
        $zabbixConfiguration = $configuration['zabbix'];
        $this->client = new ZabbixApi(
            $zabbixConfiguration['locator'],
            $zabbixConfiguration['username'],
            $zabbixConfiguration['password']
        );
        $hostIdentifier = -1;

        foreach ($this->client->hostGet() as $host) {
            if ($host->host === self::DEFAULT_HOST_NAME) {
                $hostIdentifier = (int)$host->hostid;
            }
        }

        if ($hostIdentifier === -1) {
            echo 'Could not find host.' . PHP_EOL;

            return;
        }

        $this->printHost($hostIdentifier);
        $this->printHistories($hostIdentifier);
        $this->printItems($hostIdentifier);
        $this->printItem($hostIdentifier, 'vfs.fs.size[/,used]');
        $this->printItem($hostIdentifier, 'vfs.fs.size[/,free]');
    }

    /**
     * @throws Exception
     */
    private function printHost(int $hostIdentifier): void
    {
        self::printLine([__FUNCTION__]);
        $hosts = $this->client->hostGet(
            [
                self::HOST_IDENTIFIERS_KEY => $hostIdentifier,
            ]
        );
        $host = $hosts[0];
        self::printLine(
            [
                $host->hostid,
                $host->host
            ]
        );
    }

    /**
     * @throws Exception
     */
    private function printHistories(int $hostIdentifier): void
    {
        self::printLine([__FUNCTION__]);
        $histories = $this->client->historyGet(
            [
                self::HOST_IDENTIFIERS_KEY => $hostIdentifier,
                self::LIMIT_KEY => 3,
            ]
        );

        foreach ($histories as $history) {
            $items = $this->client->itemGet(
                [
                    self::ITEM_IDENTIFIERS_KEY => $history->itemid,
                ]
            );
            $item = $items[0];
            self::printLine(
                [
                    $history->clock,
                    //$item->name,
                    $item->key_,
                    $history->value
                ]
            );
        }
    }

    /**
     * @throws Exception
     */
    private function printItems(int $hostIdentifier): void
    {
        self::printLine([__FUNCTION__]);
        $items = $this->client->itemGet(
            [
                self::HOST_IDENTIFIERS_KEY => $hostIdentifier,
                self::LIMIT_KEY => 3,
            ]
        );

        foreach ($items as $item) {
            self::printLine(
                [
                    $item->lastclock,
                    //$item->name,
                    $item->key_,
                    $item->lastvalue,
                ]
            );
        }
    }

    /**
     * @throws Exception
     */
    private function printItem(int $hostIdentifier, string $key): void
    {
        self::printLine([__FUNCTION__, $hostIdentifier, $key]);
        $items = $this->client->itemGet(
            [
                self::HOST_IDENTIFIERS_KEY => $hostIdentifier,
                self::SEARCH_KEY => [
                    self::KEY_KEY => $key,
                ],
            ]
        );
        $item = $items[0];
        self::printLine(
            [
                //$item->name,
                $item->key_,
                $item->lastvalue / 1024 . ' KB',
                $item->lastvalue / 1024 / 1024 . ' MB',
            ]
        );
    }

    private static function printLine(array $elements): void
    {
        echo implode(' ', $elements) . PHP_EOL;
    }
}
