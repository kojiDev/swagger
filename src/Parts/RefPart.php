<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Swagger\Parts;

/**
 * @internal
 */
trait RefPart
{
    /** @var string|null */
    private $ref;

    private function mergeRef(array $data, bool $overwrite)
    {
        $this->ref = $data['$ref'] ?? null;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function hasRef(): bool
    {
        return null !== $this->ref;
    }
}
