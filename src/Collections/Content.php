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
use EXSyst\OpenApi\MediaType;

final class Content extends AbstractObject
{
    /** @var MediaType[] */
    private $payloads = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $mimeType => $payload) {
            $this->add($mimeType, new MediaType($payload));
        }
    }

    protected function export(): array
    {
        return $this->payloads;
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->payloads);
    }

    public function add(string $mimeType, MediaType $mediaType)
    {
        $this->payloads[$mimeType] = $mediaType;
    }
}
