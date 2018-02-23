<?php

namespace EXSyst\OAS;

use Closure;
use EXSyst\OAS\Collections\Collection;
use ReflectionClass;

function instantiateBulk(string $schemaName, $data)
{
    return array_map(function (array $item) use ($schemaName) {
        return referenceOr($schemaName, $item);
    }, $data);
}

function getShortType($value): string
{
    if (is_object($value)) {
        $reflect = new ReflectionClass($value);
        return $reflect->getShortName();
    }

    return gettype($value);
}

function referenceOr(string $schema, array $value)
{
    return isset($value['$ref']) ? new Reference($value) : (empty($value) ? null : new $schema($value));
}

function isFalse(): Closure
{
    return function ($value): bool {
        return false === $value;
    };
}
