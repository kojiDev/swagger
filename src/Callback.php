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

final class Callback extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var Path[] */
    private $callbacks;

    public function __construct(array $data)
    {
        foreach ($data as $expression => $operation) {
            $this->callbacks[$expression] = new Path($operation);
        }

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        return $this->callbacks;
    }
}
