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

final class Parameter extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    const
        IN_QUERY = 'query';
    const IN_HEADER = 'header';
    const IN_PATH = 'path';
    const IN_COOKIE = 'cookie';

    /** @var string */
    private $name;

    /** @var string */
    private $in;

    /** @var string */
    private $description;

    /** @var bool */
    private $required;

    /** @var bool|null */
    private $deprecated;

    /** @var bool|null */
    private $allowEmptyValue;

    /** @var Schema|Reference */
    private $schema;

    /** @var string */
    private $style;

    /** @var bool */
    private $explode;

    /** @var bool */
    private $allowReserved;

    private $content; // TODO:

    private $example; // TODO:

    private $examples; // TODO:

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->in = $data['in'];
        $this->description = $data['description'] ?? null;
        $this->required = self::IN_PATH === $this->in ? true : ($data['required'] ?? null);
        $this->deprecated = $data['deprecated'] ?? null;
        $this->allowEmptyValue = self::IN_QUERY === $this->in ? ($data['allowEmptyValue'] ?? null) : null;
        $this->style = $data['style'] ?? null;
        $this->schema = $data['schema'] ?? null;

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [
            'name' => $this->name,
            'in' => $this->in,
        ];

        if ($this->description) {
            $return['description'] = $this->description;
        }

        if (!is_null($this->required)) {
            $return['required'] = $this->required;
        }

        if (true === $this->deprecated) {
            $return['deprecated'] = $this->deprecated;
        }

        if ($this->allowEmptyValue) {
            $return['allowEmptyValue'] = $this->allowEmptyValue;
        }

        if ($this->schema) {
            $return['schema'] = $this->schema;
        }

        if ($this->style) {
            $return['style'] = $this->style;
        }

        if ($this->explode) {
            $return['explode'] = $this->explode;
        }

        if ($this->allowReserved) {
            $return['allowReserved'] = $this->allowReserved;
        }

        return $return;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIn(): string
    {
        return $this->in;
    }

    // TODO: Getters/Setters
}
