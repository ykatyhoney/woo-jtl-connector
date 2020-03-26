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
class ProductMediaFileAttr extends DataType
{
    protected function loadProperties()
    {
        return array(
            new PropertyInfo('productMediaFileId', 'Identity', null, false, true, false),
            new PropertyInfo('i18ns', '\jtl\Connector\Model\ProductMediaFileAttrI18n', null, false, false, true),
        );
    }

    public function isMain()
    {
        return false;
    }
}
