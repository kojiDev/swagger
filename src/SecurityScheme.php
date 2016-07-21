<?php

namespace gossi\swagger;

class SecurityScheme
{
    /** @var string */
    private $name;

    public function __construct($name, $data = [])
    {
        $this->name = $name;
        $this->merge($contents);
    }

    protected function doMerge($data, $overwrite = false)
    {
    }
}
