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

final class OAuthFlows extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var OAuthFlow|null */
    private $implicit;

    /** @var OAuthFlow|null */
    private $password;

    /** @var OAuthFlow|null */
    private $clientCredentials;

    /** @var OAuthFlow|null */
    private $authorizationCode;

    public function __construct(array $data = [])
    {
        if (isset($data['implicit'])) {
            $this->implicit = new OAuthFlow($data['implicit']);
        }

        if (isset($data['password'])) {
            $this->password = new OAuthFlow($data['password']);
        }

        if (isset($data['clientCredentials'])) {
            $this->clientCredentials = new OAuthFlow($data['clientCredentials']);
        }

        if (isset($data['authorizationCode'])) {
            $this->authorizationCode = new OAuthFlow($data['authorizationCode']);
        }

        $this->mergeExtensions($data);
    }

    public function getImplicit(): ?OAuthFlow
    {
        return $this->implicit;
    }

    public function setImplicit(?OAuthFlow $implicit): void
    {
        $this->implicit = $implicit;
    }

    public function getPassword(): ?OAuthFlow
    {
        return $this->password;
    }

    public function setPassword(?OAuthFlow $password): void
    {
        $this->password = $password;
    }

    public function getClientCredentials(): ?OAuthFlow
    {
        return $this->clientCredentials;
    }

    public function setClientCredentials(?OAuthFlow $clientCredentials): void
    {
        $this->clientCredentials = $clientCredentials;
    }

    public function getAuthorizationCode(): ?OAuthFlow
    {
        return $this->authorizationCode;
    }

    public function setAuthorizationCode(?OAuthFlow $authorizationCode): void
    {
        $this->authorizationCode = $authorizationCode;
    }

    protected function export(): array
    {
        $return = [];

        if (null !== $this->implicit) {
            $return['implicit'] = $this->implicit;
        }

        return $return;
    }
}
