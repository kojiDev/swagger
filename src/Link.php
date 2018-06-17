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

use EXSyst\OpenApi\Collections\LinkParameters;

final class Link extends AbstractObject implements ExtensibleInterface
{
    use ExtensionPart;

    /** @var string */
    private $operationRef;

    /** @var string */
    private $operationId;

    /** @var LinkParameters */
    private $parameters;

    /** @var mixed */
    private $requestBody;

    /** @var string */
    private $description;

    /** @var Server */
    private $server;

    public function __construct(array $data)
    {
        // TODO: Validation (not only here btw, everywhere)
        $this->operationRef = $data['operationRef'] ?? null;
        $this->operationId  = $data['operationId']  ?? null;
        $this->parameters   = new LinkParameters($data['parameters'] ?? []);
        $this->requestBody  = $data['requestBody'] ?? null;
        $this->description  = $data['description'] ?? null;
        $this->server       = isset($data['server']) ? new Server($data['server']) : null;

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        $return = [];

        if ($this->operationRef) {
            $return['operationRef'] = $this->operationRef;
        }

        if ($this->operationId) {
            $return['operationId'] = $this->operationId;
        }

        if (!$this->parameters->isEmpty()) {
            $return['parameters'] = $this->parameters;
        }

        if ($this->requestBody) {
            $return['requestBody'] = $this->requestBody;
        }

        if ($this->description) {
            $return['description'] = $this->description;
        }

        if ($this->server) {
            $return['server'] = $this->server;
        }

        return $return;
    }
}
