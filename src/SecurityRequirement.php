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

final class SecurityRequirement extends AbstractObject
{
    /** @var string[] */
    private $requirements;

    public function __construct(array $requirements)
    {
        if (count($requirements) === 0) {
            throw new \InvalidArgumentException('SecurityRequirement has to has at least one requirement');
        }

        $this->requirements = $requirements;
    }

    public function get(string $requirement): ?array
    {
        return $this->requirements[$requirement] ?? null;
    }

    public function set(string $requirement, array $scopeNames)
    {
        $this->requirements[$requirement] = $scopeNames;
    }

    protected function export(): array
    {
        return $this->requirements;
    }
}
