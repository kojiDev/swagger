<?php

namespace gossi\swagger\Util;

/**
 * @internal
 */
class MergeHelper
{
    /**
     * @param string|int|null $original
     * @param string|int|null $external
     * @param bool            $overwrite
     */
    public static function mergeFields(&$original, $external, $overwrite)
    {
        if ($overwrite) {
            $original = null !== $external ? $external : $original;
        } else {
            $original = null === $original ? $external : $original;
        }
    }
}
