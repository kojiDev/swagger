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

use EXSyst\OpenApi\Collections\Parameters;

final class PathItem extends AbstractObject
{
    use ExtensionPart;

    private static $methods = ['get', 'put', 'post', 'delete', 'options', 'head', 'patch', 'trace'];

    /** @var string|null */
    private $ref;

    /** @var string|null */
    private $summary;

    /** @var string|null */
    private $description;

    /** @var Operation|null */
    private $get;

    /** @var Operation|null */
    private $put;

    /** @var Operation|null */
    private $post;

    /** @var Operation|null */
    private $delete;

    /** @var Operation|null */
    private $options;

    /** @var Operation|null */
    private $head;

    /** @var Operation|null */
    private $patch;

    /** @var Operation|null */
    private $trace;

    /** @var Server[] */
    private $servers;

    /** @var Parameters */
    private $parameters;

    public function __construct(array $data = [])
    {
        $this->ref = $data['ref'] ?? null;
        $this->summary = $data['summary'] ?? null;
        $this->description = $data['description'] ?? null;

        foreach (self::$methods as $method) {
            $this->{$method} = isset($data[$method]) ? new Operation($data[$method]) : null;
        }

        $this->servers = instantiateBulk(Server::class, $data['servers'] ?? []);
        $this->parameters = new Parameters($data['parameters'] ?? []);

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        if ($this->ref) {
            return [
                '$ref' => $this->ref,
            ];
        }

        $return = [];

        if ($this->summary) {
            $return['summary'] = $this->summary;
        }

        if ($this->description) {
            $return['description'] = $this->description;
        }

        foreach (self::$methods as $method) {
            if ($this->$method) {
                $return[$method] = $this->$method;
            }
        }

        if (count($this->servers) !== 0) {
            $return['servers'] = $this->servers;
        }

        if (!$this->parameters->isEmpty()) {
            $return['parameters'] = $this->parameters;
        }

        return $return;
    }

    /**
     * @param Operation|Reference $operation
     */
    public function setGet($operation)
    {
        $this->setOperation('get', $operation);
    }

    /**
     * @param Operation|Reference $operation
     */
    public function setPost(Operation $operation)
    {
        $this->setOperation('post', $operation);
    }

    /**
     * @param Operation|Reference $operation
     */
    public function setPut(Operation $operation)
    {
        $this->setOperation('put', $operation);
    }

    /**
     * @param Operation|Reference $operation
     */
    public function setPatch(Operation $operation)
    {
        $this->setOperation('patch', $operation);
    }

    /**
     * @param Operation|Reference $operation
     */
    public function setDelete(Operation $operation)
    {
        $this->setOperation('delete', $operation);
    }

    /**
     * @param Operation|Reference $operation
     */
    public function setOptions(Operation $operation)
    {
        $this->setOperation('options', $operation);
    }

    /**
     * @param Operation|Reference $operation
     */
    public function setHead(Operation $operation)
    {
        $this->setOperation('head', $operation);
    }

    /**
     * @param Operation|Reference $operation
     */
    public function setTrace(Operation $operation)
    {
        $this->setOperation('trace', $operation);
    }

    /**
     * @param string $method
     * @param Operation|Reference $operation
     */
    public function setOperation(string $method, $operation)
    {
        $method = $this->normalizeMethod($method);

        assertReferenceOr(Operation::class, $operation);

        $this->{$method} = $operation;
    }

    /**
     * @param string $method
     *
     * @return Operation|Reference|null
     */
    public function getOperation(string $method)
    {
        return $this->{$this->normalizeMethod($method)};
    }

    /**
     * @return Operation[]
     */
    public function getOperations(): array
    {
        $return = array_flip(self::$methods);

        foreach ($return as $method => $_) {
            $return[$method] = $this->{$method};
        }

        return array_filter($return);
    }

    protected function normalizeMethod(string $method): string
    {
        $method = strtolower($method);

        if (!in_array($method, self::$methods)) {
            throw new \InvalidArgumentException(sprintf('Invalid method: "%s"', $method));
        }
        return $method;
    }
}
