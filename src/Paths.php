<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OAS;

final class Paths extends AbstractObject
{
    use ExtensionPart;

    private $paths = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $path) {
            if ($this->isExtensibleProperty($key)) {
                continue;
            }

            $this->paths[$key] = new Path($path);
        }

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        return $this->paths;
    }
}
