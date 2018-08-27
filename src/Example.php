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

final class Example extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string|null */
    private $summary;

    /** @var string|null */
    private $description;

    /** @var mixed */
    private $value;

    /** @var string|null */
    private $externalValue;

    public function __construct(array $data = [])
    {
        $this->summary = $data['summary'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->value = $data['value'] ?? null;
        $this->externalValue = $data['externalValue'] ?? null;

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [];

        if ($this->summary) {
            $return['summary'] = $this->summary;
        }

        if ($this->description) {
            $return['description'] = $this->description;
        }

        if ($this->value) {
            $return['value'] = $this->value;
        }

        if ($this->externalValue) {
            $return['externalValue'] = $this->externalValue;
        }

        return $return;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): void
    {
        $this->summary = $summary;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function getExternalValue(): ?string
    {
        return $this->externalValue;
    }

    public function setExternalValue(?string $externalValue): void
    {
        $this->externalValue = $externalValue;
    }
}
