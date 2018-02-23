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
use EXSyst\OAS\MediaType;

final class Content extends AbstractObject
{
    /** @var MediaType[] */
    private $payloads = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $mimeType => $payload) {
            $this->payloads[$mimeType] = new MediaType($payload);
        }
    }

    protected function export(): array
    {
        return $this->payloads;
    }

    public function isEmpty(): bool
    {
        return count($this->payloads) === 0;
    }
}
