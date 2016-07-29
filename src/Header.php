<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EGetick\Swagger;

use EGetick\Swagger\Parts\DescriptionPart;
use EGetick\Swagger\Parts\ExtensionPart;
use EGetick\Swagger\Parts\ItemsPart;
use EGetick\Swagger\Parts\TypePart;

final class Header extends AbstractModel
{
    use DescriptionPart;
    use TypePart;
    use ItemsPart;
    use ExtensionPart;

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        $this->mergeDescription($data, $overwrite);
        $this->mergeExtensions($data, $overwrite);
        $this->mergeItems($data, $overwrite);
        $this->mergeType($data, $overwrite);
    }

    public function doExport()
    {
        return array_merge([
            'description' => $this->description,
            'items' => $this->items,
        ], $this->doExportType());
    }
}
