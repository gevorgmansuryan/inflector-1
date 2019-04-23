<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace Yiisoft\Helpers\Tests;

use Yiisoft\Helpers\InflectorHelper;

/**
 * Forces Inflector::slug to use PHP even if intl is available.
 */
class FallbackInflector extends InflectorHelper
{
    /**
     * {@inheritdoc}
     */
    protected static function hasIntl(): bool
    {
        return false;
    }
}
