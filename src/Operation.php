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

use EGetick\Swagger\Parts\ConsumesPart;
use EGetick\Swagger\Parts\ExtensionPart;
use EGetick\Swagger\Parts\ExternalDocsPart;
use EGetick\Swagger\Parts\ParametersPart;
use EGetick\Swagger\Parts\ProducesPart;
use EGetick\Swagger\Parts\ResponsesPart;
use EGetick\Swagger\Parts\SchemesPart;
use EGetick\Swagger\Parts\TagsPart;
use EGetick\Swagger\Util\MergeHelper;

final class Operation extends AbstractModel
{
    use ConsumesPart;
    use ProducesPart;
    use TagsPart;
    use ParametersPart;
    use ResponsesPart;
    use SchemesPart;
    use ExternalDocsPart;
    use ExtensionPart;

    /** @var string */
    private $summary;

    /** @var string */
    private $description;

    /** @var string */
    private $operationId;

    /** @var bool */
    private $deprecated;

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        MergeHelper::mergeFields($this->summary, $data['summary'] ?? null, $overwrite);
        MergeHelper::mergeFields($this->description, $data['description'] ?? null, $overwrite);
        MergeHelper::mergeFields($this->operationId, $data['operationId'] ?? null, $overwrite);
        MergeHelper::mergeFields($this->deprecated, $data['deprecated'] ?? null, $overwrite);

        $this->mergeConsumes($data, $overwrite);
        $this->mergeExtensions($data, $overwrite);
        $this->mergeExternalDocs($data, $overwrite);
        $this->mergeParameters($data, $overwrite);
        $this->mergeProduces($data, $overwrite);
        $this->mergeResponses($data, $overwrite);
        $this->mergeSchemes($data, $overwrite);
        $this->mergeTags($data, $overwrite);
    }

    protected function doExport()
    {
        return [
            'summary' => $this->getSummary(),
            'description' => $this->getDescription(),
            'operationId' => $this->getOperationId(),
            'deprecated' => $this->getDeprecated(),
            'consumes' => $this->getConsumes() ?: null,
            'produces' => $this->getProduces() ?: null,
            'parameters' => $this->getParameters(),
            'responses' => $this->getResponses(),
            'schemes' => $this->getSchemes() ?: null,
            'tags' => $this->getTags() ?: null,
            'externalDocs' => $this->getExternalDocs(),
        ];
    }

    /**
     * @return the string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getOperationId()
    {
        return $this->operationId;
    }

    /**
     * @param string $operationId
     *
     * @return $this
     */
    public function setOperationId($operationId)
    {
        $this->operationId = $operationId;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDeprecated()
    {
        return $this->deprecated;
    }

    /**
     * @param bool $deprecated
     *
     * @return $this
     */
    public function setDeprecated($deprecated)
    {
        $this->deprecated = $deprecated;

        return $this;
    }
}
