<?php
/**
 * @author    Jan Weskamp <jan.weskamp@jtl-software.com>
 * @copyright 2010-2013 JTL-Software GmbH
 */

namespace JtlWooCommerceConnector\Controllers\Product;

use WP_Term;
use WP_Error;
use WC_Product;
use JtlConnectorAdmin;
use JtlWooCommerceConnector\Utilities\Util;
use JtlWooCommerceConnector\Utilities\Config;
use jtl\Connector\Model\Product as ProductModel;
use JtlWooCommerceConnector\Logger\WpErrorLogger;
use JtlWooCommerceConnector\Controllers\BaseController;
use JtlWooCommerceConnector\Utilities\SupportedPlugins;

class ProductDeliveryTime extends BaseController {
    /**
     * @param ProductModel $product
     * @param WC_Product  $wcProduct
     */
    public function pushData(ProductModel $product, WC_Product $wcProduct) {
        $productId = $product->getId()->getEndpoint();
        $time = $product->getSupplierDeliveryTime();

        if ($time === 0 && Config::get(JtlConnectorAdmin::OPTIONS_DISABLED_ZERO_DELIVERY_TIME)) {
            $this->removeDeliveryTimeTerm($productId);

            return;
        }

        if (Config::get(JtlConnectorAdmin::OPTIONS_USE_DELIVERYTIME_CALC)) {
            //FUNCTION ATTRIBUTE BY JTL
            $offset = 0;
            $pushedAttributes = $product->getAttributes();
            foreach ($pushedAttributes as $key => $pushedAttribute) {
                foreach ($pushedAttribute->getI18ns() as $i18n) {
                    if (!Util::getInstance()->isWooCommerceLanguage($i18n->getLanguageISO())) {
                        continue;
                    }

                    if (preg_match('/^(wc_)[a-zA-Z\_]+$/', trim($i18n->getName()))) {
                        if (strcmp(trim($i18n->getName()), 'wc_dt_offset') === 0) {
                            $offset = (int) trim($i18n->getValue());
                        }
                    }
                    unset($pushedAttributes[$key]);
                }
            }

            if ($offset !== 0) {
                $min = $time - $offset <= 0 ? 1 : $time - $offset;
                $max = $time + $offset;
                $time = sprintf('%s-%s', $min, $max);
            }

            //Build Term string
            $deliveryTimeString = trim(
                sprintf(
                    '%s %s %s',
                    Config::get(JtlConnectorAdmin::OPTIONS_PRAEFIX_DELIVERYTIME),
                    $time,
                    Config::get(JtlConnectorAdmin::OPTIONS_SUFFIX_DELIVERYTIME)
                )
            );

            $term = get_term_by('slug', wc_sanitize_taxonomy_name(
                Util::removeSpecialchars($deliveryTimeString)
            ), 'product_delivery_times');

            if ($term === FALSE) {

                //Add term
                $newTerm = \wp_insert_term(
                    $deliveryTimeString,
                    'product_delivery_times'
                );

                if ($newTerm instanceof WP_Error) {
                    //  var_dump($newTerm);
                    // die();
                    $error = new WP_Error('invalid_taxonomy', 'Could not create delivery time.');
                    WpErrorLogger::getInstance()->logError($error);
                    WpErrorLogger::getInstance()->logError($newTerm);
                } else {
                    $termId = $newTerm['term_id'];

                    wp_set_object_terms($productId, $termId, 'product_delivery_times', TRUE);

                    if (SupportedPlugins::isActive(SupportedPlugins::PLUGIN_GERMAN_MARKET)) {
                        update_post_meta($productId, '_lieferzeit', $termId);
                    }
                }
            } else {
                wp_set_object_terms($productId, $term->term_id, $term->taxonomy, TRUE);

                if (SupportedPlugins::isActive(SupportedPlugins::PLUGIN_GERMAN_MARKET)) {
                    update_post_meta($productId, '_lieferzeit', $term->term_id);
                }
            }
        } else {
            $this->removeDeliveryTimeTerm($productId);

            return;
        }
    }

    /**
     * @param string $productId
     */
    private function removeDeliveryTimeTerm($productId) {
        $terms = wp_get_object_terms($productId, 'product_delivery_times');
        if (is_array($terms) && !$terms instanceof WP_Error) {
            if (count($terms) > 0) {
                /** @var WP_Term $term */
                foreach ($terms as $key => $term) {
                    if ($term instanceof WP_Term) {
                        if (SupportedPlugins::isActive(SupportedPlugins::PLUGIN_GERMAN_MARKET)) {
                            delete_post_meta($productId, '_lieferzeit', $term->term_id);
                        }
                        wp_remove_object_terms($productId, $term->term_id, 'product_delivery_times');
                    }
                }
            }
        }
    }
}
