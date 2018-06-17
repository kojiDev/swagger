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

final class Info extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $termsOfService;

    /** @var Contact */
    private $contact;

    /** @var License */
    private $license;

    /** @var string */
    private $version;

    public function __construct(array $data)
    {
        $this->title          = $data['title']          ?? '';
        $this->description    = $data['description']    ?? null;
        $this->termsOfService = $data['termsOfService'] ?? null;
        if (isset($data['contact'])) {
            $this->contact = new Contact($data['contact']);
        }
        if (isset($data['license'])) {
            $this->license = new License($data['license']);
        }
        $this->version = $data['version'];

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [
            'title'   => $this->title,
            'version' => $this->version,
        ];

        if ($this->description) {
            $return['description'] = $this->description;
        }

        if ($this->termsOfService) {
            $return['termsOfService'] = $this->termsOfService;
        }

        if ($this->contact) {
            $return['contact'] = $this->contact;
        }

        if ($this->license) {
            $return['license'] = $this->license;
        }

        return $return;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getTermsOfService(): ?string
    {
        return $this->termsOfService;
    }

    public function setTermsOfService(?string $termsOfService): void
    {
        $this->termsOfService = $termsOfService;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): void
    {
        $this->contact = $contact;
    }

    public function getLicense(): ?License
    {
        return $this->license;
    }

    public function setLicense(?License $license): void
    {
        $this->license = $license;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }
}
