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

final class ExternalDocumentation extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string */
    private $description;

    /** @var string */
    private $url;

    public function __construct(array $data)
    {
        $this->url = $data['url'];
        $this->description = $data['description'];

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [
            'url' => $this->url,
        ];

        if ($this->description) {
            $return['description'] = $this->description;
        }

        return $return;
    }
}
