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
use EXSyst\OpenApi\Example;
use function EXSyst\OpenApi\referenceOr;

/**
 * Helper class - Does not exist in actual Spec.
 */
final class Examples extends AbstractObject
{
    private $examples = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $example) {
            $this->examples[$key] = referenceOr(Example::class, $example);
        }
    }

    protected function export(): array
    {
        return $this->examples;
    }

    public function isEmpty(): bool
    {
        return empty($this->examples);
    }
}
