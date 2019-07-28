<?php

namespace FunTimeCoding\PhpUtility\LanguageExample;

interface MediaWikiWebClient
{
    public function login(): void;

    public function setUsername(string $username): void;

    public function setPassword(string $password): void;

    public function getPage(string $page): string;
}
