<?php

namespace gossi\swagger;

use gossi\swagger\parts\DescriptionPart;
use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;

class Info extends AbstractModel implements Arrayable
{
    use DescriptionPart;
    use ExtensionPart;

    /** @var string */
    private $title;

    /** @var string */
    private $termsOfService;

    /** @var Contact */
    private $contact;

    /** @var License */
    private $license;

    /** @var string */
    private $version;

    public function __construct(array $data = [])
    {
        $this->merge($data);
    }

    public function merge(array $data, $overwrite = false)
    {
        $this->contact = new Contact($data['contact'] ?? []);
        $this->license = new License($data['license'] ?? []);

        $data = CollectionUtils::toMap($data);

        $this->title = $data->get('title');
        $this->termsOfService = $data->get('termsOfService');
        $this->version = $data->get('version');

        // extensions
        $this->parseDescription($data);
        $this->parseExtensions($data);
    }

    public function toArray()
    {
        return $this->export('version', 'title', 'description', 'termsOfService', 'contact', 'license');
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
     * @return string
     */
    public function getTerms()
    {
        return $this->termsOfService;
    }

    /**
     * @param string $terms
     *
     * @return $this
     */
    public function setTerms($terms)
    {
        $this->termsOfService = $terms;

        return $this;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @return License
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }
}
