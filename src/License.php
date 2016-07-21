<?php

namespace gossi\swagger;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\UrlPart;
use gossi\swagger\Util\MergeHelper;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class License extends AbstractModel implements Arrayable
{
    use UrlPart;
    use ExtensionPart;

    /** @var string */
    private $name;

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        MergeHelper::mergeFields($this->name, $data['name'] ?? null, $overwrite);

        $data = CollectionUtils::toMap($data);
        // extensions
        $this->parseUrl($data);
        $this->parseExtensions($data);
    }

    public function toArray()
    {
        return $this->export('name', 'url');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
