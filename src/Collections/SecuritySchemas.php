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
use EXSyst\OpenApi\SecurityScheme;
use function EXSyst\OpenApi\referenceOr;

final class SecuritySchemas extends AbstractObject
{
    private $schemas = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $parameter) {
            $this->schemas[$key] = referenceOr(SecurityScheme::class, $parameter);
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
