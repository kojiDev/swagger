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

final class ServerVariable extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string[] */
    private $enum;

    /** @var string */
    private $default;

    /** @var string */
    private $description;

    public function __construct(array $data)
    {
        $this->default = $data['default'];
        $this->enum = $data['enum'] ?? [];
        $this->description = $data['description'] ?? null;
    }

    protected function export(): array
    {
        $return = [
            'default' => $this->default,
        ];

        if (!empty($this->enum)) {
            $return['enum'] = $this->enum;
        }

        if ($this->description) {
            $return['description'] = $this->description;
        }

        return $return;
    }
}
