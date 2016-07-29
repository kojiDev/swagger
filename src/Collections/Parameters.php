<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EGetick\Swagger\Collections;

use EGetick\Swagger\Parameter;
use EGetick\Swagger\Parts\RefPart;
use EGetick\Swagger\AbstractModel;

final class Parameters extends AbstractModel
{
    const REQUIRED = false;

    use RefPart;

    private $parameters = [];

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        $this->mergeRef($data, $overwrite);
        if (!$this->hasRef()) {
            foreach ($data as $parameter) {
                $this->add(new Parameter($parameter));
            }
        }
    }

    protected function doExport()
    {
        if ($this->hasRef()) {
            return ['$ref' => $this->getRef()];
        }

        return array_values($this->parameters);
    }

    /**
     * Searches whether a parameter with the given unique combination exists.
     */
    public function has(string $name, string $in): bool
    {
        return isset($this->parameters[$name.'/'.$in]);
    }

    public function get(string $name, string $in): Parameter
    {
        if (!$this->has($name, $in)) {
            $this->add($parameter = new Parameter([
                'name' => $name,
                'in' => $in,
            ]));
        }

        return $this->parameters[$name.'/'.$in];
    }

    /**
     * Adds a parameter.
     */
    public function add(Parameter $parameter)
    {
        $this->parameters[$this->getIdentifier($parameter)] = $parameter;

        return $this;
    }

    /**
     * Removes a parameter.
     */
    public function remove(Parameter $parameter)
    {
        unset($this->parameters[$this->getIdentifier($parameter)]);

        return $this;
    }

    private function getIdentifier(Parameter $parameter)
    {
        return $parameter->getName().'/'.$parameter->getIn();
    }
}
