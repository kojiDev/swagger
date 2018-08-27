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

use EXSyst\OpenApi\Collections\Schemas;

class Schema extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    private $title;

    private $multipleOf;

    private $maximum;

    private $exclusiveMaximum;

    private $minimum;

    private $exclusiveMinimum;

    private $maxLength;

    private $minLength;

    private $pattern;

    private $maxItems;

    private $minItems;

    private $uniqueItems;

    private $maxProperties;

    private $minProperties;

    /** @var string[]|null */
    private $required;

    /**
     * @var array
     */
    private $enum;

    /** @var string */
    private $type;

    /** @var Reference[]|Schema[]|Schemas */
    private $allOf;

    /** @var Reference[]|Schema[]|Schemas */
    private $oneOf;

    /** @var Reference[]|Schema[]|Schemas */
    private $anyOf;

    /** @var Reference|Schema */
    private $not;

    /** @var Schema|Reference|null */
    private $items;

    /** @var Schemas|Schema[]|Reference[] */
    private $properties;

    /** @var bool|Schema|Reference */
    private $additionalProperties;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $format;

    /** @var mixed */
    private $default;

    private $nullable;

    private $discriminator;

    private $readOnly;

    private $writeOnly;

    private $xml;

    private $externalDocs;

    /** @var string|null */
    private $example;

    private $deprecated;

    private static $ofs = ['allOf', 'anyOf', 'oneOf'];

    public function __construct(array $data)
    {
        $this->type = $data['type'] ?? null;

        $this->enum = $data['enum'] ?? null;

        $this->nullable = $data['nullable'] ?? null;

        foreach (self::$ofs as $of) {
            $this->{$of} = instantiateBulk(Schema::class, $data[$of] ?? []);
        }

        $this->example = $data['example'] ?? null;
        $this->default = $data['default'] ?? null;
        $this->description = $data['description'] ?? null;
        if (isset($data['additionalProperties'])) {
            $this->additionalProperties = is_bool($data['additionalProperties']) ?
                $data['additionalProperties'] :
                referenceOr(Schema::class, $data['additionalProperties']);
        }
        $this->required = $data['required'] ?? null;
        $this->items = isset($data['items']) ? referenceOr(Schema::class, $data['items']) : null;
        $this->properties = new Schemas($data['properties'] ?? []);
        $this->format = $data['format'] ?? null;

        if (isset($data['discriminator'])) {
            $this->discriminator = new Discriminator($data['discriminator']);
        }
    }

    protected function export(): array
    {
        $return = [];

        if (!is_null($this->required)) {
            $return['required'] = $this->required;
        }

        if ($this->type) {
            $return['type'] = $this->type;
        }

        if ($this->enum) {
            $return['enum'] = $this->enum;
        }

        if ($this->nullable) {
            $return['nullable'] = $this->nullable;
        }

        if ($this->description) {
            $return['description'] = $this->description;
        }

        if ($this->items) {
            $return['items'] = $this->items;
        }

        if (!$this->properties->isEmpty()) {
            $return['properties'] = $this->properties;
        }

        if ($this->format) {
            $return['format'] = $this->format;
        }

        if ($this->example) {
            $return['example'] = $this->example;
        }

        if (!is_null($this->additionalProperties)) {
            $return['additionalProperties'] = $this->additionalProperties;
        }

        if (!is_null($this->default)) {
            $return['default'] = $this->default;
        }

        if ($this->discriminator) {
            $return['discriminator'] = $this->discriminator;
        }

        foreach (self::$ofs as $of) {
            if (!empty($this->{$of})) {
                $return[$of] = $this->{$of};
            }
        }

        return $return;
    }
}
