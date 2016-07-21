<?php

namespace gossi\swagger\collections;

use gossi\swagger\parts\ExtensionPart;
use gossi\swagger\Path;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Arrayable;
use phootwork\lang\Text;
use gossi\swagger\AbstractModel;

class Paths extends AbstractModel implements Arrayable, \Iterator
{
    use ExtensionPart;

    private $paths = [];

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        foreach ($data as $key => $path) {
            if (0 !== strpos($key, 'x-')) {
                $this->get($key)->merge($path, $overwrite);
            }
        }

        $this->mergeExtensions($data);
    }

    protected function doExport()
    {
        return $this->paths;
    }

    public function size()
    {
        return count($this->paths);
    }

    /**
     * Returns whether a path with the given name exists.
     *
     * @param string $path
     *
     * @return bool
     */
    public function has(string $path): bool
    {
        return isset($this->paths[$path]);
    }

    /**
     * Returns whether the given path exists.
     *
     * @param Path $path
     *
     * @return bool
     */
    public function contains(Path $path)
    {
        return in_array($path, $this->paths);
    }

    /**
     * Returns the path info for the given path.
     *
     * @param string $path
     *
     * @return Path
     */
    public function get(string $path)
    {
        if (!$this->has($path)) {
            $this->add(new Path($path));
        }

        return $this->paths[$path];
    }

    /**
     * Sets the path.
     *
     * @param Path $path
     *
     * @return $this
     */
    public function add(Path $path)
    {
        $this->paths[$path->getPath()] = $path;

        return $this;
    }

    /**
     * Adds all operations from another paths collection. Will overwrite existing operations.
     *
     * @param Paths $paths
     */
    public function addAll(Paths $paths)
    {
        foreach ($paths as $p) {
            $path = $this->get($p->getPath());
            foreach ($p->getMethods() as $method) {
                $path->setOperation($method, $p->getOperation($method));
            }
        }
    }

    /**
     * Removes the given path.
     *
     * @param string $path
     */
    public function remove($path)
    {
        unset($this->paths[$path]);

        return $this;
    }

    public function current()
    {
        return $this->paths->current();
    }

    public function key()
    {
        return $this->paths->key();
    }

    public function next()
    {
        return $this->paths->next();
    }

    public function rewind()
    {
        return $this->paths->rewind();
    }

    public function valid()
    {
        return $this->paths->valid();
    }
}
