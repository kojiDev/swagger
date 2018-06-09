<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OpenApi;

/**
 * @internal
 */
abstract class AbstractObject
{
    public function toArray()
    {
        $return = [];
        foreach ($this->export() as $key => $value) {
            $value = $this->resolve($value);
            if (null === $value) {
                continue;
            }

            $return[$key] = $value;
        }

        if ($this instanceof ExtensibleInterface) {
            foreach ($this->getExtensions() as $name => $value) {
                $return['x-' . $name] = $value;
            }
        }

        return $return;
    }

    abstract protected function export(): array;

    private function resolve($value)
    {
        if (is_array($value)) {
            foreach ($value as &$v) {
                $v = $this->resolve($v);
            }
        } elseif ($value instanceof self) {
            $value = $value->toArray();
        }

        return $value;
    }
}
