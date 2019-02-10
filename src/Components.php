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

use EXSyst\OpenApi\Collections\Callbacks;
use EXSyst\OpenApi\Collections\Examples;
use EXSyst\OpenApi\Collections\Headers;
use EXSyst\OpenApi\Collections\Links;
use EXSyst\OpenApi\Collections\Parameters;
use EXSyst\OpenApi\Collections\ParametersMap;
use EXSyst\OpenApi\Collections\Schemas;
use EXSyst\OpenApi\Collections\SecuritySchemas;

final class Components extends AbstractObject
{
    /** @var Schemas|Schema[]|Reference[] */
    private $schemas;

    /** @var Responses|Response[]|Reference[] */
    private $responses;

    /** @var Parameters|Parameter[]|Reference[] */
    private $parameters;

    /** @var Examples|Example[]|Reference[] */
    private $examples;

    /** @var RequestBody|RequestBody[]|Reference[] */
    private $requestBodies;

    /** @var SecuritySchemas|SecurityScheme[]|Reference[] */
    private $securitySchemes;

    /** @var Headers|Header[]|Reference[] */
    private $headers;

    /** @var Links|Link[]|Reference[] */
    private $links;

    /** @var Callbacks|Callback[]|Reference[] */
    private $callbacks;

    public function __construct(array $data = [])
    {
        $this->schemas = new Schemas($data['schemas'] ?? []);
        $this->responses = new Responses($data['responses'] ?? []);
        $this->parameters = new ParametersMap($data['parameters'] ?? []);
        $this->examples = new Examples($data['examples'] ?? []);
        $this->requestBodies = new RequestBodies($data['requestBodies'] ?? []);
        $this->headers = new Headers($data['headers'] ?? []);
        $this->securitySchemes = new SecuritySchemas($data['securitySchemes'] ?? []);
        $this->links = new Links($data['links'] ?? []);
        $this->callbacks = new Callbacks($data['callbacks'] ?? []);
    }

    public function isEmpty(): bool
    {
        return
            $this->schemas->isEmpty() &&
            $this->responses->isEmpty() &&
            $this->parameters->isEmpty() &&
            $this->examples->isEmpty() &&
            $this->requestBodies->isEmpty() &&
            $this->headers->isEmpty() &&
            $this->securitySchemes->isEmpty() &&
            $this->links->isEmpty() &&
            $this->callbacks->isEmpty();
    }

    protected function export(): array
    {
        $return = [];

        if (!$this->schemas->isEmpty()) {
            $return['schemas'] = $this->schemas;
        }

        if (!$this->responses->isEmpty()) {
            $return['responses'] = $this->responses;
        }

        if (!$this->parameters->isEmpty()) {
            $return['parameters'] = $this->parameters;
        }

        if (!$this->examples->isEmpty()) {
            $return['examples'] = $this->examples;
        }

        if (!$this->requestBodies->isEmpty()) {
            $return['requestBodies'] = $this->requestBodies;
        }

        if (!$this->headers->isEmpty()) {
            $return['headers'] = $this->headers;
        }

        if (!$this->securitySchemes->isEmpty()) {
            $return['securitySchemes'] = $this->securitySchemes;
        }

        if (!$this->links->isEmpty()) {
            $return['links'] = $this->links;
        }

        if (!$this->callbacks->isEmpty()) {
            $return['callbacks'] = $this->callbacks;
        }

        return $return;
    }

    public function getSchemas(): Schemas
    {
        return $this->schemas;
    }

    public function setSchemas(Schemas $schemas): void
    {
        $this->schemas = $schemas;
    }

    public function getResponses(): Responses
    {
        return $this->responses;
    }

    public function setResponses(Responses $responses): void
    {
        $this->responses = $responses;
    }

    public function getParameters(): ParametersMap
    {
        return $this->parameters;
    }

    public function setParameters(ParametersMap $parameters): void
    {
        $this->parameters = $parameters;
    }

    public function getExamples(): Examples
    {
        return $this->examples;
    }

    public function setExamples(Examples $examples): void
    {
        $this->examples = $examples;
    }

    public function getRequestBodies(): RequestBodies
    {
        return $this->requestBodies;
    }

    public function setRequestBodies(RequestBodies $requestBodies): void
    {
        $this->requestBodies = $requestBodies;
    }

    public function getSecuritySchemes(): SecuritySchemas
    {
        return $this->securitySchemes;
    }

    public function setSecuritySchemes(SecuritySchemas $securitySchemes): void
    {
        $this->securitySchemes = $securitySchemes;
    }

    public function getHeaders(): Headers
    {
        return $this->headers;
    }

    public function setHeaders(Headers $headers): void
    {
        $this->headers = $headers;
    }

    public function getLinks(): Links
    {
        return $this->links;
    }

    public function setLinks(Links $links): void
    {
        $this->links = $links;
    }

    public function getCallbacks(): Callbacks
    {
        return $this->callbacks;
    }

    public function setCallbacks(Callbacks $callbacks): void
    {
        $this->callbacks = $callbacks;
    }
}
