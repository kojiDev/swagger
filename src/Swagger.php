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

use EGetick\Swagger\Collections\Definitions;
use EGetick\Swagger\Collections\Paths;
use EGetick\Swagger\Parts\ConsumesPart;
use EGetick\Swagger\Parts\ExtensionPart;
use EGetick\Swagger\Parts\ExternalDocsPart;
use EGetick\Swagger\Parts\ParametersPart;
use EGetick\Swagger\Parts\ProducesPart;
use EGetick\Swagger\Parts\ResponsesPart;
use EGetick\Swagger\Parts\SchemesPart;
use EGetick\Swagger\Parts\TagsPart;
use EGetick\Swagger\Util\MergeHelper;

final class Swagger extends AbstractModel
{
    use SchemesPart;
    use ConsumesPart;
    use ProducesPart;
    use TagsPart;
    use ParametersPart;
    use ResponsesPart;
    use ExternalDocsPart;
    use ExtensionPart;

    public static $METHODS = ['get', 'post', 'put', 'patch', 'delete', 'options', 'head'];

    /** @var Info */
    private $info;

    /** @var string */
    private $host;

    /** @var string */
    private $basePath;

    /** @var Paths */
    private $paths;

    /** @var Definitions */
    private $definitions;

    /** @var array */
    private $securityDefinitions = [];

    /**
     * @param string $filename
     *
     * @return static
     */
    public static function fromFile($filename)
    {
        return new static(json_decode(file_get_contents($filename), true));
    }

    public function __construct($data = [])
    {
        $this->info = new Info();
        $this->definitions = new Definitions();
        $this->paths = new Paths();

        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        MergeHelper::mergeFields($this->host, $data['host'] ?? null, $overwrite);
        MergeHelper::mergeFields($this->basePath, $data['basePath'] ?? null, $overwrite);

        if (isset($data['info'])) {
            $this->info->merge($data['info'], $overwrite);
        }
        if (isset($data['definitions'])) {
            $this->getDefinitions()->merge($data['definitions'], $overwrite);
        }
        if (isset($data['paths'])) {
            $this->getPaths()->merge($data['paths'], $overwrite);
        }

        $this->mergeConsumes($data, $overwrite);
        $this->mergeExtensions($data, $overwrite);
        $this->mergeExternalDocs($data, $overwrite);
        $this->mergeParameters($data, $overwrite);
        $this->mergeProduces($data, $overwrite);
        $this->mergeResponses($data, $overwrite);
        $this->mergeSchemes($data, $overwrite);
        $this->mergeTags($data, $overwrite);

        foreach ($this->securityDefinitions as $s => $def) {
            $this->securityDefinitions[$s] = new SecurityScheme($s, $def);
        }
    }

    protected function doExport()
    {
        return [
            'Swagger' => '2.0',
            'info' => $this->info,
            'host' => $this->host,
            'basePath' => $this->basePath,
            'schemes' => $this->getSchemes() ?: null,
            'consumes' => $this->getConsumes() ?: null,
            'produces' => $this->getProduces() ?: null,
            'paths' => $this->paths,
            'definitions' => $this->definitions,
            'parameters' => $this->parameters ?: null,
            'responses' => $this->responses,
            'tags' => $this->tags ?: null,
            'externalDocs' => $this->externalDocs,
        ];
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '2.0';
    }

    /**
     * @return Info
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     *
     * @return $this
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     *
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /**
     * @return Paths
     */
    public function getPaths()
    {
        return $this->paths;
    }

    /**
     * @return Definitions
     */
    public function getDefinitions()
    {
        return $this->definitions;
    }

    /**
     * @return array
     */
    public function getSecurityDefinitions()
    {
        return $this->securityDefinitions;
    }
}
