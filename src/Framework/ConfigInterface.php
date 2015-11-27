<?php

namespace FunTimeCoding\PhpUtility\Framework;

interface ConfigInterface
{
    /**
     * @param string $key
     * @return string
     */
    public function get($key);
}
