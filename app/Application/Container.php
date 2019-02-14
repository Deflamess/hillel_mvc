<?php

namespace Hillel\Application;

class Container
{
    /**
     * @var array
     */
    private $container = [];

    /**
     * @param string $id
     * @return mixed
     */
    public function get(string $id)
    {
        return $this->container[$id];
    }

    /**
     * @param string $id
     * @param $value
     * @return $this
     */
    public function set(string $id, $value)
    {
        $this->container[$id] = $value;
        return $this;
    }
}