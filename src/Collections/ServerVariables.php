<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OAS\Collections;

use EXSyst\OAS\AbstractObject;
use EXSyst\OAS\ServerVariable;

final class ServerVariables extends AbstractObject
{
    /** @var ServerVariable[] */
    private $variables;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $variable) {
            $this->variables[$key] = new ServerVariable($variable);
        }
    }

    public function isEmpty(): bool
    {
        return empty($this->variables);
    }

    protected function export(): array
    {
        return $this->variables;
    }
}
