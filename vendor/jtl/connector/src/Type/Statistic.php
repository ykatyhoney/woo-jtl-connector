<?php
/**
 * @copyright 2010-2014 JTL-Software GmbH
 * @package jtl\Connector\Type
 */

namespace jtl\Connector\Type;

use \jtl\Connector\Type\PropertyInfo;

/**
 * @access public
 * @package jtl\Connector\Type
 */
class Statistic extends DataType
{
    protected function loadProperties()
    {
        return array(
            new PropertyInfo('available', 'integer', null, false, false, false),
            new PropertyInfo('controllerName', 'string', false, false, false, false)
        );
    }

    public function isMain()
    {
        return false;
    }
}
