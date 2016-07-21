<?php

namespace gossi\swagger;

use gossi\swagger\collections\Definitions;
use gossi\swagger\collections\Paths;
use gossi\swagger\parts\ConsumesPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ExternalDocsPart;
use gossi\swagger\parts\ParametersPart;
use gossi\swagger\parts\ProducesPart;
use gossi\swagger\parts\ResponsesPart;
use gossi\swagger\parts\SchemesPart;
use gossi\swagger\parts\TagsPart;
use gossi\swagger\Util\MergeHelper;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\file\exception\FileNotFoundException;
use phootwork\lang\Arrayable;

class Swagger extends AbstractModel implements Arrayable
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

    /** @var string */
    private $swagger = '2.0';

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

    /** @var Map */
    private $securityDefinitions;

    /**
     * @param string $filename
     *
     * @throws FileNotFoundException
     * @throws JsonException
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

        $this->info->merge($data['info'] ?? [], $overwrite);
        $this->definitions->merge($data['definitions'] ?? [], $overwrite);
        $this->paths->merge($data['paths'] ?? [], $overwrite);

        $this->mergeConsumes($data);
        $this->mergeParameters($data);

        $data = CollectionUtils::toMap($data);

        // security schemes
        $this->securityDefinitions = $data->get('securityDefinitions', new Map());
        foreach ($this->securityDefinitions as $s => $def) {
            $this->securityDefinitions->set($s, new SecurityScheme($s, $def));
        }

        // parts
        $this->parseSchemes($data);
        $this->parseProduces($data);
        $this->parseTags($data);
        $this->parseResponses($data);
        $this->parseExternalDocs($data);
        $this->parseExtensions($data);
    }

    public function toArray()
    {
        return $this->export('swagger', 'info', 'host', 'basePath', 'schemes', 'consumes', 'produces',
            'paths', 'definitions', 'parameters', 'responses', 'tags', 'externalDocs'
        );
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->swagger;
    }

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->swagger = $version;

        return $this;
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
     * @return Map
     */
    public function getSecurityDefinitions()
    {
        return $this->securityDefinitions;
    }

// 	/**
// 	 *
// 	 * @param Map $securityDefinitions
// 	 */
// 	public function setSecurityDefinitions(Map $securityDefinitions) {
// 		$this->securityDefinitions = $securityDefinitions;
// 		return $this;
// 	}
}
