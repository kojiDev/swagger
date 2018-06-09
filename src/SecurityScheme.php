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

final class SecurityScheme extends AbstractObject
{
    use ExtensionPart;

    const
        TYPE_API_KEY = 'apiKey',
        TYPE_HTTP = 'http',
        TYPE_OAUTH2 = 'oauth2',
        TYPE_OPEN_ID_CONNECT = 'openIdConnect';

    const TYPES = [self::TYPE_API_KEY, self::TYPE_HTTP, self::TYPE_OAUTH2, self::TYPE_OPEN_ID_CONNECT];
    const INS   = ['query', 'header', 'cookie'];

    /** @var string */
    private $type;

    /** @var string|null */
    private $description;

    /** @var string|null */
    private $name;

    /** @var string|null */
    private $in;

    /** @var string|null */
    private $scheme;

    /** @var string|null */
    private $bearerFormat;

    /** @var OAuthFlows|null */
    private $flows;

    /** @var string|null */
    private $openIdConnectUrl;

    public function __construct(array $data)
    {
        if (!in_array($data['type'], self::TYPES)) {
            throw new \InvalidArgumentException();
        }

        if ($data['type'] === 'apiKey' && empty($data['name'])) {
            throw new \InvalidArgumentException();
        }

        $this->type = $data['type'];
        $this->description = $data['description'] ?? null;

        switch ($data['type']) {
            case self::TYPE_API_KEY:
                $this->name = $data['name'];

                $this->setIn($data['in']);

                break;
            case self::TYPE_HTTP:
                $this->scheme = $data['scheme'];
                $this->bearerFormat = $data['bearerFormat'];

                break;
            case self::TYPE_OAUTH2:
                $this->flows = new OAuthFlows($data['flows'] ?? []);

                break;
            case self::TYPE_OPEN_ID_CONNECT:
                $this->openIdConnectUrl = $data['openIdConnectUrl'];

                break;
        }

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [
            'type' => $this->type,
        ];

        if ($this->description) {
            $return['description'] = $this->description;
        }

        if ($this->name) {
            $return['name'] = $this->name;
        }

        if ($this->in) {
            $return['in'] = $this->in;
        }

        if ($this->scheme) {
            $return['scheme'] = $this->scheme;
        }

        if (self::TYPE_OAUTH2 === $this->type) {
            if ($this->flows) {
                $return['flows'] = $this->flows;
            }
        }

        if ($this->bearerFormat) {
            $return['bearerFormat'] = $this->bearerFormat;
        }

        if ($this->openIdConnectUrl) {
            $return['openIdConnectUrl'] = $this->openIdConnectUrl;
        }

        return $return;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description)
    {
        $this->description = $description;
    }

    public function getFlows(): OAuthFlows
    {
        // TODO: You shouldn't call this method unless you checked that type field is `oauth2`

        return $this->flows;
    }

    public function setFlows(OAuthFlows $flows): void
    {
        $this->flows = $flows;
    }

    public function getScheme(): string
    {
        return $this->scheme;
    }

    public function setSchema(string $scheme): void
    {
        $this->scheme = $scheme;
    }

    public function getBearerFormat(): ?string
    {
        return $this->bearerFormat;
    }

    public function setBearerFormat(?string $bearerFormat): void
    {
        $this->bearerFormat = $bearerFormat;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIn(): string
    {
        return $this->in;
    }

    public function setIn(string $in): void
    {
        if (!in_array($in, self::INS)) {
            $values = implode(', ', self::INS);
            $errorMessage = '"in" field has to be one of given values: %s, %s given';
            throw new \InvalidArgumentException(sprintf($errorMessage, $values, $in));
        }

        $this->in = $in;
    }

    public function getOpenIdConnectUrl(): string
    {
        return $this->openIdConnectUrl;
    }

    public function setOpenIdConnectUrl(string $openIdConnectUrl): void
    {
        $this->openIdConnectUrl = $openIdConnectUrl;
    }
}
