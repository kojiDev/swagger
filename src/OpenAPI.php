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

final class OpenAPI extends AbstractObject
{
    /** @var string */
    private $openapi = '3.0.0';

    /** @var Info */
    private $info;

    /** @var Server[] */
    private $servers;

    /** @var Paths */
    private $paths;

    /** @var Components */
    private $components;

    /** @var Tag[] */
    private $tags;

    public function __construct(array $data)
    {
        $this->info = new Info($data['info'] ?? []);
        $this->servers = instantiateBulk(Server::class, $data['servers'] ?? []);
        $this->paths = new Paths($data['paths'] ?? []);
        $this->components = new Components($data['components'] ?? []);
        $this->tags = instantiateBulk(Tag::class, $data['tags'] ?? []);
    }

    protected function export(): array
    {
        $return = [
            'openapi' => $this->openapi,
            'info'    => $this->info,
            'paths'   => $this->paths,
        ];

        if (!$this->components->isEmpty()) {
            $return['components'] = $this->components;
        }

        if (!empty($this->servers)) {
            $return['servers'] = $this->servers;
        }

        if (!empty($this->tags)) {
            $return['tags'] = $this->tags;
        }

        return $return;
    }

    public function getPaths(): Paths
    {
        return $this->paths;
    }

    public function setPaths(Paths $paths): void
    {
        $this->paths = $paths;
    }

    public function getOpenapi(): string
    {
        return $this->openapi;
    }

    public function getInfo(): Info
    {
        return $this->info;
    }

    public function setInfo(Info $info): void
    {
        $this->info = $info;
    }

    /**
     * @return Server[]
     */
    public function getServers(): array
    {
        return $this->servers;
    }

    /**
     * @param Server[] $servers
     */
    public function setServers(array $servers): void
    {
        $this->servers = $servers;
    }

    public function getComponents(): Components
    {
        return $this->components;
    }

    public function setComponents(Components $components): void
    {
        $this->components = $components;
    }

    /**
     * @return Tag[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param Tag[] $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }
}
