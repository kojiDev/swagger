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
use EXSyst\OpenApi\Components;
use EXSyst\OpenApi\Parameter;
use EXSyst\OpenApi\Reference;
use function EXSyst\OpenApi\assertReferenceOr;
use function EXSyst\OpenApi\referenceOr;

/**
 * Helper class - Does not exist in actual Spec.
 *
 * This is the additional @see Parameters collection class
 * It is necessary to represent parameters in @see Components object
 */
final class ParametersMap extends AbstractObject
{
    /** @var Parameter[]|Reference[] */
    private $parameters = [];

    public function __construct(array $data)
    {
        foreach ($data as $key => $parameter) {
            $this->add($key, referenceOr(Parameter::class, $parameter));
        }
    }

    protected function export(): array
    {
        return $this->parameters;
    }

    public function add(string $key, $parameter): void
    {
        assertReferenceOr(Parameter::class, $parameter);

        $this->parameters[$key] = $parameter;
    }

    public function isEmpty(): bool
    {
        return empty($this->parameters);
    }

    public function has(string $key): bool
    {
        return isset($this->parameters[$key]);
    }
}
