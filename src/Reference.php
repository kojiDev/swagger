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

final class Reference extends AbstractObject
{
    /** @var string */
    private $ref;

    public function __construct(array $data)
    {
        $this->ref = $data['$ref'];
    }

    protected function export(): array
    {
        return [
            '$ref' => $this->ref,
        ];
    }

    public function getRef(): string
    {
        return $this->ref;
    }
}
