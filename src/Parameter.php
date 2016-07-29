<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EGetick\Swagger;

use EGetick\Swagger\Parts\DescriptionPart;
use EGetick\Swagger\Parts\ExtensionPart;
use EGetick\Swagger\Parts\ItemsPart;
use EGetick\Swagger\Parts\RefPart;
use EGetick\Swagger\Parts\RequiredPart;
use EGetick\Swagger\Parts\SchemaPart;
use EGetick\Swagger\Parts\TypePart;
use EGetick\Swagger\Util\MergeHelper;

final class Parameter extends AbstractModel
{
    use RefPart;
    use DescriptionPart;
    use SchemaPart;
    use TypePart;
    use ItemsPart;
    use RequiredPart;
    use ExtensionPart;

    /** @var string */
    private $name;

    /** @var string */
    private $in;

    /** @var bool|null */
    private $allowEmptyValue;

    public function __construct($data = [])
    {
        if (!isset($data['name']) || !isset($data['in'])) {
            throw new \InvalidArgumentException('"in" and "name" are required for parameters');
        }

        $this->name = $data['name'];
        $this->in = $data['in'];

        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        MergeHelper::mergeFields($this->allowEmptyValue, $data['allowEmptyValue'] ?? null, $overwrite);

        $this->mergeDescription($data, $overwrite);
        $this->mergeExtensions($data, $overwrite);
        $this->mergeItems($data, $overwrite);
        $this->mergeRef($data, $overwrite);
        $this->mergeRequired($data, $overwrite);
        $this->mergeSchema($data, $overwrite);
        $this->mergeType($data, $overwrite);
    }

    protected function doExport()
    {
        if ($this->hasRef()) {
            return ['$ref' => $this->getRef()];
        }

        return array_merge([
            'name' => $this->name,
            'in' => $this->in,
            'allowEmptyValue' => $this->allowEmptyValue,
            'required' => $this->required,
            'description' => $this->description,
            'schema' => $this->schema,
            'items' => $this->items,
        ], $this->doExportType());
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getIn()
    {
        return $this->in;
    }

    /**
     * @return bool
     */
    public function getAllowEmptyValue()
    {
        return $this->allowEmptyValue;
    }

    /**
     * Sets the ability to pass empty-valued parameters. This is valid only for either `query` or
     * `formData` parameters and allows you to send a parameter with a name only or an empty value.
     * Default value is `false`.
     *
     * @param bool $allowEmptyValue
     */
    public function setAllowEmptyValue($allowEmptyValue)
    {
        $this->allowEmptyValue = $allowEmptyValue;

        return $this;
    }
}
