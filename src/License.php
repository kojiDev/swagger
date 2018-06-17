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

final class License extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string */
    private $name;

    /** @var string|null */
    private $url;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->url  = $data['url'] ?? null;

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [
            'name' => $this->name,
        ];

        if ($this->url) {
            $return['url'] = $this->url;
        }

        return $return;
    }
}
