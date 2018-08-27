<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OpenApi\Collections;

use EXSyst\OpenApi\AbstractObject;
use EXSyst\OpenApi\ServerVariable;

final class ServerVariables extends AbstractObject
{
    /** @var ServerVariable[] */
    private $variables;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $variable) {
            $this->add($key, new ServerVariable($variable));
        }
    }

    public function isEmpty(): bool
    {
        return empty($this->variables);
    }

    public function get(string $key): ?ServerVariable
    {
        return $this->variables[$key] ?? null;
    }

    public function add(string $key, ServerVariable $variable): void
    {
        $this->variables[$key] = $variable;
    }

    protected function export(): array
    {
        return $this->variables;
    }
}
