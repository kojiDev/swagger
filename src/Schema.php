<?php

namespace gossi\swagger;

use gossi\swagger\collections\Definitions;
use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ExternalDocsPart;
use gossi\swagger\parts\ItemsPart;
use gossi\swagger\parts\RefPart;
use gossi\swagger\parts\TypePart;
use phootwork\collection\ArrayList;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class Schema extends AbstractModel implements Arrayable
{
    use RefPart;
    use TypePart;
    use DescriptionPart;
    use ItemsPart;
    use ExternalDocsPart;
    use ExtensionPart;

    /** @var string */
    private $discriminator;

    /** @var bool */
    private $readOnly;

    /** @var string */
    private $title;

    private $xml;

    /** @var string */
    private $example;

    /** @var ArrayList|bool */
    private $required;

    /** @var Definitions */
    private $properties;

    /** @var ArrayList */
    private $allOf = [];

    /** @var Schema */
    private $additionalProperties;

    public function __construct(array $data = [])
    {
        $this->merge($data);
    }

    public function merge(array $data, $overwrite = false)
    {
        $this->required = $data['required'] ?? null;
        $this->properties = new Definitions($data['properties'] ?? []);

        foreach ($data['allOf'] ?? [] as $schema) {
            $this->allOf[] = new self($schema);
        }

        $data = CollectionUtils::toMap($data);

        $this->title = $data->get('title');
        $this->discriminator = $data->get('discriminator');
        $this->readOnly = $data->has('readOnly') && $data->get('readOnly');
        $this->example = $data->get('example');
        if ($data->has('additionalProperties')) {
            $this->additionalProperties = new self($data->get('additionalProperties'));
        }

        // parts
        $this->parseRef($data);
        $this->parseType($data);
        $this->parseDescription($data);
        $this->parseItems($data);
        $this->parseExternalDocs($data);
        $this->parseExtensions($data);
    }

    protected function doExport()
    {
        if ($this->hasRef()) {
            return ['$ref' => $this->getRef()];
        }

        return array_merge([
            'title' => $this->getTitle(),
            'discriminator' => $this->getDiscriminator(),
            'description' => $this->getDescription(),
            'readOnly' => $this->isReadOnly() ?: null,
            'example' => $this->getExample(),
            'externalDocs' => $this->getExternalDocs(),
            'items' => $this->getItems()->toArray() ?: null,
            'required' => $this->getRequired(),
            'properties' => $this->getProperties()->toArray() ?: null,
            'additionalProperties' => $this->getAdditionalProperties(),
            'allOf' => $this->getAllOf() ?: null,
        ], $this->doExportType());
    }

    /**
     * @return bool|array
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param bool|array $required
     *
     * @return $this
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiscriminator()
    {
        return $this->discriminator;
    }

    /**
     * @param string $discriminator
     */
    public function setDiscriminator($discriminator)
    {
        $this->discriminator = $discriminator;

        return $this;
    }

    /**
     * @return bool
     */
    public function isReadOnly()
    {
        return $this->readOnly;
    }

    /**
     * @param bool $readOnly
     */
    public function setReadOnly($readOnly)
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    /**
     * @return string
     */
    public function getExample()
    {
        return $this->example;
    }

    /**
     * @param string $example
     */
    public function setExample($example)
    {
        $this->example = $example;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Definitions
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @return ArrayList
     */
    public function getAllOf()
    {
        return $this->allOf;
    }

    /**
     * @return Schema|null
     */
    public function getAdditionalProperties()
    {
        return $this->additionalProperties;
    }
}
