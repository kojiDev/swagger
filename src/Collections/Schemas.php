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
use EXSyst\OAS\Schema;
use function EXSyst\OAS\referenceOr;

final class Schemas extends AbstractObject
{
    private $schemas = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $parameter) {
            $this->schemas[$key] = referenceOr(Schema::class, $parameter);
        }
    }

    public function isEmpty(): bool
    {
        return empty($this->schemas);
    }

    protected function export(): array
    {
        return $this->schemas;
    }
}
