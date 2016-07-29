<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EGetick\Swagger;

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
