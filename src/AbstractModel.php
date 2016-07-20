<?php

namespace gossi\swagger;

use phootwork\collection\Collection;
use phootwork\collection\CollectionUtils;

abstract class AbstractModel
{
    public function toArray()
    {
        $return = [];
        foreach ($this->doExport() as $key => $value) {
            $value = $this->resolve($value);
            if (null === $value) {
                continue;
            }

            $return[$key] = $value;
        }

        if (method_exists($this, 'getExtensions')) {
            foreach ($this->getExtensions() as $name => $value) {
                $return['x-'.$name] = $value;
            }
        }

        return $return;
    }

    protected function export()
    {
        $cols = func_get_args();

        // add cols
        if (method_exists($this, 'hasRef') && $this->hasRef()) {
            $cols = array_merge(['$ref'], $cols);
        }

        // flatten array
        $fields = [];
        array_walk_recursive($cols, function ($a) use (&$fields) { $fields[] = $a; });

        $out = [];
        $refl = new \ReflectionClass(get_class($this));

        foreach ($fields as $field) {
            if ($field == 'tags') {
                $val = $this->exportTags();
            } else {
                $prop = $refl->getProperty($field == '$ref' ? 'ref' : $field);
                $prop->setAccessible(true);
                $val = $prop->getValue($this);

                if ($val instanceof Collection) {
                    $val = CollectionUtils::toArrayRecursive($val);
                } elseif (method_exists($val, 'toArray')) {
                    $val = $val->toArray();
                }
            }

            if ($field == 'required' && is_bool($val) || !empty($val)) {
                $out[$field] = $val;
            }
        }

        if (method_exists($this, 'getExtensions')) {
            $out = array_merge($out, $this->getExtensions());
        }

        return $out;
    }

    private function resolve($value)
    {
        if (is_array($value)) {
            foreach ($value as &$v) {
                $v = $this->resolve($v);
            }
        } elseif ($value instanceof self) {
            $value = $value->toArray();
        }

        return $value;
    }
}
