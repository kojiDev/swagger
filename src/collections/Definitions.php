<?php

namespace gossi\swagger\collections;

use gossi\swagger\Schema;
use phootwork\lang\Arrayable;
use gossi\swagger\AbstractModel;

class Definitions extends AbstractModel implements Arrayable, \Iterator
{
    private $definitions = [];

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        foreach ($data as $name => $schema) {
            $this->get($name)->merge($schema, $overwrite);
        }
    }

    protected function doExport()
    {
        return $this->definitions;
    }

    public function size()
    {
        return count($this->definitions);
    }

    /**
     * Returns the schema for the given field.
     *
     * @param string $name
     *
     * @return Schema
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            $this->set($name, new Schema());
        }

        return $this->definitions[$name];
    }

    /**
     * Sets the field.
     *
     * @param string name
     * @param Schema $schame
     */
    public function set($name, Schema $schema)
    {
        $this->definitions[$name] = $schema;
    }

    /**
     * Sets all definitions from another definitions collection. Will overwrite existing ones.
     *
     * @param Definitions $definitions
     */
    public function setAll(Definitions $definitions)
    {
        foreach ($definitions as $name => $schema) {
            $this->set($name, $schema);
        }
    }

    /**
     * Removes the given field.
     *
     * @param string $name
     */
    public function remove($name)
    {
        unset($this->definitions[$name]);
    }

    /**
     * Returns definitions has a schema with the given name.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->definitions[$name]);
    }

    /**
     * Returns whether the given schema exists.
     *
     * @param Schema $schema
     *
     * @return bool
     */
    public function contains(Schema $schema)
    {
        return $this->definitions->contains($schema);
    }

    public function current()
    {
        return $this->definitions->current();
    }

    public function key()
    {
        return $this->definitions->key();
    }

    public function next()
    {
        return $this->definitions->next();
    }

    public function rewind()
    {
        return $this->definitions->rewind();
    }

    public function valid()
    {
        return $this->definitions->valid();
    }
}
