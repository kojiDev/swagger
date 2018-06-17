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

final class Contact extends AbstractObject
{
    use ExtensionPart;

    /** @var string */
    private $name;

    /** @var string */
    private $url;

    /** @var string */
    private $email;

    public function __construct(array $data = [])
    {
        $this->name  = $data['name']  ?? null;
        $this->url   = $data['url']   ?? null;
        $this->email = $data['email'] ?? null;

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [];

        if ($this->name) {
            $return['name'] = $this->name;
        }

        if ($this->url) {
            $return['url'] = $this->url;
        }

        if ($this->email) {
            $return['email'] = $this->email;
        }

        return $return;
    }
}
