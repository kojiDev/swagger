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

final class RequestBodies extends AbstractObject implements \IteratorAggregate, ExtensibleInterface
{
    use ExtensionPart;

    private $requestBodies = [];

    public function __construct(array $data)
    {
        foreach ($data as $code => $requestBody) {
            if ($this->isExtensibleProperty($code)) {
                continue;
            }
            $this->requestBodies[$code] = referenceOr(RequestBody::class, $requestBody);
        }

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        return $this->requestBodies;
    }

    public function isEmpty(): bool
    {
        return 0 === count($this->requestBodies);
    }

    /**
     * @param string $code
     *
     * @return RequestBody|Reference|null
     */
    public function get(string $code)
    {
        return $this->requestBodies[$code] ?? null;
    }

    public function has(string $code): bool
    {
        return isset($this->requestBodies[$code]);
    }

    /**
     * @param string $code
     * @param RequestBody|Reference $requestBody
     */
    public function set(string $code, $requestBody)
    {
        assertReferenceOr(RequestBody::class, $requestBody);

        $this->requestBodies[$code] = $requestBody;
    }

    /**
     * @return \Traversable|RequestBody[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->requestBodies);
    }
}
