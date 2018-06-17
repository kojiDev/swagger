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

final class Discriminator extends AbstractObject
{
    /** @var string */
    private $propertyName;

    /** @var string[] */
    private $mapping;

    public function __construct($data)
    {
        $this->propertyName = $data['propertyName'];
        $this->mapping      = $data['mapping'] ?? null;
    }

    protected function export(): array
    {
        $return = [
            'propertyName' => $this->propertyName,
        ];

        if ($this->mapping) {
            $return['mapping'] = $this->mapping;
        }

        return $return;
    }
}
