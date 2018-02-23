<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OAS;

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
        $this->info = new Info($data['info']);
        $this->servers = instantiateBulk(Server::class, $data['servers'] ?? []);
        $this->paths = new Paths($data['paths']);
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
}
