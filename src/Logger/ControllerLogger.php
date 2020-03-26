<?php
/**
 * @author    Jan Weskamp <jan.weskamp@jtl-software.com>
 * @copyright 2010-2013 JTL-Software GmbH
 */

namespace JtlWooCommerceConnector\Logger;

use jtl\Connector\Core\Logger\Logger;

/**
 * Class ControllerLogger has to be used by controllers.
 * Predefined are the file which is controller.log and the level which is debug.
 * @package JtlWooCommerceConnector\Logger
 */
class ControllerLogger extends WooCommerceLogger
{
    protected function getLevel()
    {
        return Logger::WARNING;
    }

    protected function getFilename()
    {
        return 'controller';
    }
}
