<?php

namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\parts\ExternalDocsPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

final class Tag extends AbstractModel implements Arrayable
{
    use DescriptionPart;
    use ExternalDocsPart;
    use ExtensionPart;

    /** @var string */
    private $name;

    private $isObject = true;

    public function __construct($data)
    {
        $data = $this->normalize($data);
        if (!isset($data['name'])) {
            throw new \InvalidArgumentException('A tag must have a name.');
        }

        $this->name = $data['name'];
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        $map = CollectionUtils::toMap($data);
        // parts
        $this->parseDescription($map);
        $this->parseExternalDocs($map);
        $this->parseExtensions($map);
    }

    public function toArray()
    {
        $return = parent::toArray();
        if (1 === count($return)) {
            return $return['name'];
        }

        return $return;
    }

    protected function doExport(): array
    {
        return [
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'externalDocs' => $this->getExternalDocs(),
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string|array $data
     */
    protected function normalize($data): array
    {
        if (is_string($data)) {
            return [
                'name' => $data,
            ];
        }

        return parent::normalize($data);
    }
}
