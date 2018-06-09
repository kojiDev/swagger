<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OpenApi\Collections;

use EXSyst\OpenApi\AbstractObject;

/**
 * Helper class - Does not exist in actual Spec.
 */
final class LinkParameters extends AbstractObject
{
    /** @var mixed[] */
    private $parameters = [];

    public function __construct(array $data)
    {
        foreach ($data as $key => $parameter) {
            $this->parameters[$key] = $parameter;
        }
    }

    protected function export(): array
    {
        return $this->parameters;
    }

    public function isEmpty(): bool
    {
        return empty($this->parameters);
    }
}
