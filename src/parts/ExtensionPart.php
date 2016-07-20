<?php

namespace gossi\swagger\parts;

use phootwork\collection\Map;

trait ExtensionPart
{
    private $extensions = [];

    private function parseExtensions(Map $data)
    {
        foreach ($data as $name => $value) {
            if (0 === strpos($name, 'x-')) {
                $this->extensions[substr($name, 2)] = $value;
            }
        }
    }

    /**
     * Returns extensions.
     *
     * @return array
     */
    public function getExtensions()
    {
        return $this->extensions;
    }
}
