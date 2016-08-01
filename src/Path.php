<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Swagger;

use EXSyst\Component\Swagger\Parts\ExtensionPart;

final class Path extends AbstractModel
{
    use ExtensionPart;

    private $operations = [];

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        foreach (Swagger::$METHODS as $method) {
            if (isset($data[$method])) {
                $this->getOperation($method)->merge($data[$method]);
            }
        }
        $this->mergeExtensions($data, $overwrite);
    }

    protected function doExport()
    {
        return $this->operations;
    }

    /**
     * Gets the operation for the given method, creates one if none exists.
     *
     * @param string $method
     *
     * @return Operation
     */
    public function getOperation(string $method): Operation
    {
        if (!$this->hasOperation($method)) {
            $this->setOperation($method, new Operation());
        }

        return $this->operations[$method];
    }

    /**
     * Sets the operation for a method.
     *
     * @param string    $method
     * @param Operation $operation
     */
    public function setOperation(string $method, Operation $operation)
    {
        $this->operations[$method] = $operation;

        return $this;
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function hasOperation(string $method): bool
    {
        return isset($this->operations[$method]);
    }

    /**
     * Removes an operation for the given method.
     *
     * @param string $method
     */
    public function removeOperation(string $method)
    {
        unset($this->operations[$method]);

        return $this;
    }

    /**
     * Returns all methods for this path.
     *
     * @return array
     */
    public function getMethods(): array
    {
        return array_keys($this->operations);
    }
}
