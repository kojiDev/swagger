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

use ReflectionClass;

function instantiateBulk(string $schemaName, array $data)
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

function assertReferenceOr(string $schema, $value)
{
    if (!$value instanceof Reference && !$value instanceof $schema) {
        throw new \InvalidArgumentException(sprintf('Argument has to be either Reference or %s', $schema));
    }
}
