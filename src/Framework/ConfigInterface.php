<?php

namespace FunTimeCoding\PhpUtility\Framework;

interface ConfigInterface
{
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function get(string $key);
}
