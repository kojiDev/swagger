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
use EGetick\Swagger\Parts\UrlPart;

final class ExternalDocs extends AbstractModel
{
    const REQUIRED = false;

    use DescriptionPart;
    use UrlPart;
    use ExtensionPart;

    public function __construct($data = [])
    {
        $this->merge($data);
    }

    protected function doMerge($data, $overwrite = false)
    {
        $this->mergeDescription($data, $overwrite);
        $this->mergeExtensions($data, $overwrite);
        $this->mergeUrl($data, $overwrite);
    }

    protected function doExport()
    {
        return [
            'description' => $this->description,
            'url' => $this->url,
        ];
    }
}
