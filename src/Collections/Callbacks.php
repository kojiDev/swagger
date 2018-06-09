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
use EXSyst\OpenApi\Callback;
use function EXSyst\OpenApi\referenceOr;

/**
 * Helper class - Does not exist in actual Spec.
 */
final class Callbacks extends AbstractObject
{
    private $callbacks = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $callback) {
            $this->callbacks[$key] = referenceOr(Callback::class, $callback);
        }
    }

    protected function export(): array
    {
        return $this->callbacks;
    }

    public function isEmpty(): bool
    {
        return empty($this->callbacks);
    }
}
