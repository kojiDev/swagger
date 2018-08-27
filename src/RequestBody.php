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

use EXSyst\OpenApi\Collections\Content;

final class RequestBody extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string|null */
    private $description;

    /** @var Content */
    private $content;

    /** @var bool */
    private $required;

    public function __construct(array $data = [])
    {
        $this->description = $data['description'] ?? null;
        $this->content = new Content($data['content'] ?? []);
        $this->required = $data['required'] ?? false;

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [
            'content' => $this->content,
        ];

        if ($this->description) {
            $return['description'] = $this->description;
        }

        if ($this->required) {
            $return['required'] = $this->required;
        }

        return $return;
    }

    public function getContent(): Content
    {
        return $this->content;
    }
}
