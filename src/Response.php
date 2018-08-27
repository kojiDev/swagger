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

use EXSyst\OpenApi\Collections\Callbacks;
use EXSyst\OpenApi\Collections\Content;
use EXSyst\OpenApi\Collections\Headers;
use EXSyst\OpenApi\Collections\Links;

final class Response extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string|null */
    private $description;

    /** @var Headers */
    private $headers;

    /** @var Content */
    private $content;

    /** @var Callbacks */
    private $callback;

    private $links;

    public function __construct(array $data)
    {
        $this->description = $data['description'] ?? '';
        $this->headers = new Headers($data['headers'] ?? []);
        $this->content = new Content($data['content'] ?? []);
        $this->callback = new Callbacks($data['callback'] ?? []);
        $this->links = new Links($data['links'] ?? []);
    }

    protected function export(): array
    {
        $return = [];

        $return['description'] = $this->description;

        if (!$this->content->isEmpty()) {
            $return['content'] = $this->content;
        }

        if (!$this->headers->isEmpty()) {
            $return['headers'] = $this->headers;
        }

        if (!$this->links->isEmpty()) {
            $return['links'] = $this->links;
        }

        return $return;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }
}
