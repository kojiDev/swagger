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
 *
 * @see ExtensibleInterface
 */
trait ExtensionPart
{
    private $extensions = [];

    private function mergeExtensions(array $data)
    {
        foreach ($data as $name => $value) {
            if (0 === strpos($name, 'x-')) {
                $this->extensions[substr($name, 2)] = $value;
            }
        }
    }

    private function isExtensibleProperty(string $propertyName): bool
    {
        return 0 === strpos($propertyName, 'x-');
    }

    public function getExtensions(): array
    {
        return $this->extensions;
    }
}
