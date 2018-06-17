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

final class Tag extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string */
    private $name;

    /** @var string */
    private $description;

    /** @var ExternalDocumentation */
    private $externalDocs;

    public function __construct($data)
    {
        $this->name         = $data['name'];
        $this->description  = $data['description'] ?? null;
        $this->externalDocs = isset($data['externalDocs']) ? new ExternalDocumentation($data['externalDocs']) : null;
    }

    protected function export(): array
    {
        $return = [
            'name' => $this->name,
        ];

        if ($this->description) {
            $return['description'] = $this->description;
        }

        if ($this->externalDocs) {
            $return['externalDocs'] = $this->externalDocs;
        }

        return $return;
    }
}
