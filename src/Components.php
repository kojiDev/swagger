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

use EXSyst\OpenApi\Collections\Links;
use EXSyst\OpenApi\Collections\Schemas;
use EXSyst\OpenApi\Collections\SecuritySchemas;

final class Components extends AbstractObject
{
    /** @var Schemas|Schema[]|Reference[] */
    private $schemas;

    /** @var SecuritySchemas|SecurityScheme[]|Reference[] */
    private $securitySchemes;

    /** @var Links|Link[]|Reference[] */
    private $links;

    public function __construct(array $data)
    {
        $this->schemas         = new Schemas($data['schemas'] ?? []);
        $this->securitySchemes = new SecuritySchemas($data['securitySchemes'] ?? []);
        $this->links           = new Links($data['links'] ?? []);
    }

    public function isEmpty(): bool
    {
        return
            $this->schemas->isEmpty() && $this->links->isEmpty() && $this->securitySchemes->isEmpty();
    }

    protected function export(): array
    {
        $return = [];

        if (!$this->schemas->isEmpty()) {
            $return['schemas'] = $this->schemas;
        }

        if (!$this->securitySchemes->isEmpty()) {
            $return['securitySchemes'] = $this->securitySchemes;
        }

        if (!$this->links->isEmpty()) {
            $return['links'] = $this->links;
        }

        return $return;
    }
}
