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

final class Paths extends AbstractObject implements \IteratorAggregate
{
    use ExtensionPart;

    private $paths = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $path) {
            if ($this->isExtensibleProperty($key)) {
                continue;
            }

            $this->add($key, new PathItem($path));
        }

        $this->mergeExtensions($data);
    }

    protected function export(): array
    {
        return $this->paths;
    }

    public function get(string $path): ?PathItem
    {
        return $this->paths[$path] ?? null;
    }

    public function has(string $path): bool
    {
        return isset($this->paths[$path]);
    }

    public function add(string $path, PathItem $pathObj)
    {
        $this->paths[$path] = $pathObj;
    }

    /**
     * @return \Traversable|PathItem[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->paths);
    }
}
