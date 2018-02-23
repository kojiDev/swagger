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
use EXSyst\OAS\Link;
use function EXSyst\OAS\referenceOr;

/**
 * Helper class - Does not exist in actual Spec.
 */
final class Links extends AbstractObject
{
    private $links = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $link) {
            $this->links[$key] = referenceOr(Link::class, $link);
        }
    }

    protected function export(): array
    {
        return $this->links;
    }

    public function isEmpty(): bool
    {
        return empty($this->links);
    }
}
