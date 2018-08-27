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

final class XML extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $namespace;

    /** @var string|null */
    private $prefix;

    /** @var bool|null */
    private $attribute;

    /** @var bool|null */
    private $wrapped;

    public function __construct($data = [])
    {
        $this->name = $data['name'] ?? null;
        $this->namespace = $data['namespace'] ?? null;
        $this->prefix = $data['prefix'] ?? null;
        $this->attribute = $data['attribute'] ?? null;
        $this->wrapped = $data['wrapped'] ?? null;

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [];

        if (null !== $this->name) {
            $return['name'] = $this->name;
        }

        if (null !== $this->namespace) {
            $return['namespace'] = $this->namespace;
        }

        if (null !== $this->prefix) {
            $return['prefix'] = $this->prefix;
        }

        if (null !== $this->attribute) {
            $return['attribute'] = $this->attribute;
        }

        if (null !== $this->wrapped) {
            $return['wrapped'] = $this->wrapped;
        }

        return $return;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function setNamespace(?string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    public function setPrefix(?string $prefix): void
    {
        $this->prefix = $prefix;
    }

    public function getAttribute(): ?bool
    {
        return $this->attribute;
    }

    public function setAttribute(?bool $attribute): void
    {
        $this->attribute = $attribute;
    }

    public function getWrapped(): ?bool
    {
        return $this->wrapped;
    }

    public function setWrapped(?bool $wrapped): void
    {
        $this->wrapped = $wrapped;
    }
}
