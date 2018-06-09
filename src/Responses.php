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

final class Responses extends AbstractObject implements \IteratorAggregate
{
    use ExtensionPart;

    private $responses = [];

    public function __construct(array $data)
    {
        foreach ($data as $code => $response) {
            if ($this->isExtensibleProperty($code)) {
                continue;
            }
            $this->responses[$code] = referenceOr(Response::class, $response);
        }

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        return $this->responses;
    }

    public function isEmpty(): bool
    {
        return count($this->responses) === 0;
    }

    /**
     * @param string $code
     *
     * @return Response|Reference|null
     */
    public function get(string $code)
    {
        return $this->responses[$code] ?? null;
    }

    public function has(string $code): bool
    {
        return isset($this->responses[$code]);
    }

    /**
     * @param string $code
     * @param Response|Reference $response
     */
    public function set(string $code, $response)
    {
        assertReferenceOr(Response::class, $response);

        $this->responses[$code] = $response;
    }

    /**
     * @return \Traversable|Response[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->responses);
    }
}
