<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OAS\Collections;

use EXSyst\OAS\AbstractObject;
use EXSyst\OAS\Parameter;
use EXSyst\OAS\Reference;
use function EXSyst\OAS\getShortType;
use function EXSyst\OAS\referenceOr;

/**
 * Helper class - Does not exist in actual Spec.
 */
final class Parameters extends AbstractObject
{
    /** @var Parameter[]|Reference[] */
    private $parameters = [];

    public function __construct(array $data)
    {
        foreach ($data as $parameter) {
            $this->add(referenceOr(Parameter::class, $parameter));
        }
    }

    protected function export(): array
    {
        return array_values($this->parameters);
    }

    public function add($parameter): self
    {
        if ($parameter instanceof Parameter) {
            $this->parameters[$this->getIdentifier($parameter)] = $parameter;
        } elseif ($parameter instanceof Reference) {
            $this->parameters[$parameter->getRef()] = $parameter;
        } else {
            throw new \Exception(
                sprintf('Parameter should be either Parameter or Reference Object, %s given', getShortType($parameter))
            );
        }

        return $this;
    }

    private function getIdentifier(Parameter $parameter)
    {
        return $parameter->getName() . '/' . $parameter->getIn();
    }

    public function isEmpty(): bool
    {
        return empty($this->parameters);
    }
}
