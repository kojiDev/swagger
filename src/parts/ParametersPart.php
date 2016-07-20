<?php

namespace gossi\swagger\parts;

use gossi\swagger\collections\Parameters;
use phootwork\collection\Map;

trait ParametersPart
{
    /** @var Parameters */
    private $parameters;

    private function parseParameters(Map $data)
    {
        $this->parameters = new Parameters($data->get('parameters', new Map()));
    }

    private function mergeParameters(array $data)
    {
        if (null === $this->parameters) {
            $this->parameters = new Parameters();
        }

        $this->parameters->merge($data['parameters'] ?? []);
    }

    /**
     * Return parameters.
     *
     * @return Parameters
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}
