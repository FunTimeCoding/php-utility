<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

use Exception;

interface MediaWikiWebClient
{
    /**
     * @throws Exception
     */
    public function login();

    public function setUsername(string $username): void;

    public function setPassword(string $password): void;

    public function getPage(string $page): string;
}
