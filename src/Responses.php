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

final class Responses extends AbstractObject
{
    use ExtensionPart;

    private $responses = [];

    public function __construct(array $data)
    {
        foreach ($data as $code => $response) {
            if ($this->isExtensibleProperty($code)) {
                continue;
            }
            $this->responses[$code] = referenceOr(Response::class, $response);
        }

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        return $this->responses;
    }

    public function isEmpty(): bool
    {
        return count($this->responses) === 0;
    }
}
