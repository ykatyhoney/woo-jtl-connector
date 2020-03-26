<?php
/**
 * @copyright JTL-Software GmbH
 * @package jtl\Connector\Core\Serializer
 */

namespace jtl\Connector\Core\Serializer;

use jtl\Connector\Exception\JsonException;

/**
 * Yaml Class
 *
 * @access public
 * @author Andreas Jütten <andy@jtl-software.de>
 */
class Json implements ISerializer
{
    public static function encode($object, $pretty = false)
    {
        $options = 0;
        if ($pretty) {
            $options = JSON_PRETTY_PRINT;
        }

        $json = json_encode($object, $options);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw JsonException::encoding(json_last_error_msg());
        }

        return $json;
    }

    public static function decode($string, $assoc = false)
    {
        if (empty($string) || !is_string($string)) {
            throw new \InvalidArgumentException(sprintf('Invalid parameter "%s"', var_export($string, true)));
        }

        $object = json_decode($string, $assoc);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw JsonException::decoding(json_last_error_msg(), $string);
        }

        return $object;
    }
}
