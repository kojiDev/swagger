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

final class OAuthFlow extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string|null */
    private $authorizationUrl;

    /** @var string|null */
    private $tokenUrl;

    /** @var string|null */
    private $refreshUrl;

    /** @var string[] */
    private $scopes;

    public function __construct(array $data)
    {
        $this->authorizationUrl = $data['authorizationUrl'] ?? null;
        $this->tokenUrl = $data['tokenUrl'] ?? null;
        $this->refreshUrl = $data['refreshUrl'] ?? null;
        $this->scopes = $data['scopes'];

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [
            'scopes' => $this->scopes,
        ];

        if ($this->authorizationUrl) {
            $return['authorizationUrl'] = $this->authorizationUrl;
        }

        if ($this->tokenUrl) {
            $return['tokenUrl'] = $this->tokenUrl;
        }

        if ($this->refreshUrl) {
            $return['refreshUrl'] = $this->refreshUrl;
        }

        return $return;
    }

    public function getAuthorizationUrl(): ?string
    {
        return $this->authorizationUrl;
    }

    public function setAuthorizationUrl(?string $authorizationUrl): void
    {
        $this->authorizationUrl = $authorizationUrl;
    }

    public function getTokenUrl(): ?string
    {
        return $this->tokenUrl;
    }

    public function setTokenUrl(?string $tokenUrl): void
    {
        $this->tokenUrl = $tokenUrl;
    }

    public function getRefreshUrl(): ?string
    {
        return $this->refreshUrl;
    }

    public function setRefreshUrl(?string $refreshUrl): void
    {
        $this->refreshUrl = $refreshUrl;
    }

    /**
     * @return string[]
     */
    public function getScopes(): array
    {
        return $this->scopes;
    }

    /**
     * @param string[] $scopes
     */
    public function setScopes(array $scopes): void
    {
        $this->scopes = $scopes;
    }
}
