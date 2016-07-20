<?php

namespace gossi\swagger\parts;

use gossi\swagger\Schema;
use phootwork\collection\Map;

trait SchemaPart
{
    /** @var Schema */
    private $schema;

    private function parseSchema(Map $data)
    {
        $this->schema = new Schema($data->has('schema') ? $data->get('schema')->toArray() : []);
    }

    /**
     * @return Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }
}
