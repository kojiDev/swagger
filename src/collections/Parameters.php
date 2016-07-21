<?php

namespace gossi\swagger\collections;

use gossi\swagger\Parameter;
use gossi\swagger\parts\RefPart;
use phootwork\collection\CollectionUtils;
use phootwork\lang\Arrayable;
use gossi\swagger\AbstractModel;

final class Parameters extends AbstractModel implements Arrayable, \Iterator
{
    use RefPart;

    private $parameters = [];

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        $map = CollectionUtils::toMap($data);

        $this->parseRef($map);

        if (!$this->hasRef()) {
            foreach ($data as $param) {
                $this->parameters[] = new Parameter($param);
            }
        }
    }

    protected function doExport()
    {
        if ($this->hasRef()) {
            return ['$ref' => $this->getRef()];
        }

        return array_values($this->parameters);
    }

    public function size()
    {
        return count($this->parameters);
    }

    /**
     * Searches whether a parameter with the given unique combination exists.
     *
     * @param string $name
     * @param string $id
     *
     * @return bool
     */
    public function search($name, $in)
    {
        return isset($this->parameters[$name.'/'.$in]);
    }

    public function find($name, $in)
    {
        if ($this->search($name, $in)) {
            return $this->parameters[$name.'/'.$in];
        }
    }

    public function get($name, $in)
    {
        $parameter = $this->find($name, $in);
        if (empty($param)) {
            $parameter = new Parameter([
                'name' => $name,
                'in' => $in,
            ]);
            $this->add($parameter);
        }

        return $parameter;
    }

    /**
     * Adds a parameter.
     *
     * @param Parameter $parameter
     */
    public function add(Parameter $parameter)
    {
        $this->parameters[$this->getIdentifier($parameter)] = $parameter;
    }

    /**
     * Removes a parameter.
     *
     * @param Parameter $parameter
     */
    public function remove(Parameter $parameter)
    {
        unset($this->parameters[$this->getIdentifier($parameter)]);
    }

    /**
     * Returns whether a given parameter exists.
     *
     * @param Parameter $param
     *
     * @return bool
     */
    public function contains(Parameter $param)
    {
        return $this->parameters->contains($param);
    }

    public function current()
    {
        return $this->parameters->current();
    }

    public function key()
    {
        return $this->parameters->key();
    }

    public function next()
    {
        return $this->parameters->next();
    }

    public function rewind()
    {
        return $this->parameters->rewind();
    }

    public function valid()
    {
        return $this->parameters->valid();
    }

    private function getIdentifier(Parameter $parameter)
    {
        return $parameter->getName().'/'.$parameter->getIn();
    }
}
