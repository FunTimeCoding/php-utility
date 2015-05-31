<?php

namespace FunTimeCoding\PhpSkeleton\LanguageExample;

use Exception;

interface MediaWikiWebClient
{
    /**
     * @throws Exception
     */
    public function login();

    /**
     * @param string $username
     */
    public function setUsername($username);

    /**
     * @param string $password
     */
    public function setPassword($password);

    /**
     * @param string $page
     *
     * @return string
     */
    public function getPage($page);
}
