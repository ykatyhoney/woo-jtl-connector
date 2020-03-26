<?php
/**
 * @author    Jan Weskamp <jan.weskamp@jtl-software.com>
 * @copyright 2010-2018 JTL-Software GmbH
 */

namespace JtlWooCommerceConnector\Controllers\Product;

use WP_Term;
use WC_Product;
use JtlConnectorAdmin;
use WC_Product_Attribute;
use jtl\Connector\Model\Identity;
use JtlWooCommerceConnector\Utilities\Util;
use JtlWooCommerceConnector\Utilities\Config;
use jtl\Connector\Model\Product as ProductModel;
use JtlWooCommerceConnector\Controllers\BaseController;
use JtlWooCommerceConnector\Utilities\SupportedPlugins;
use jtl\Connector\Model\ProductAttr as ProductAttrModel;
use jtl\Connector\Model\ProductAttrI18n as ProductAttrI18nModel;

class ProductAttr extends BaseController {
    // <editor-fold defaultstate="collapsed" desc="Pull">
    public function pullData(
        WC_Product $product,
        WC_Product_Attribute $attribute,
        $slug,
        $languageIso
    ) {
        return $this->buildAttribute(
            $product,
            $attribute,
            $slug,
            $languageIso
        );
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Push">

    /**
     * @param              $productId
     * @param              $pushedAttributes
     * @param              $attributesFilteredVariationsAndSpecifics
     * @param ProductModel $product
     *
     * @return mixed
     */
    public function pushData(
        $productId,
        $pushedAttributes,
        $attributesFilteredVariationsAndSpecifics,
        ProductModel $product
    ) {
        //  $parent = (new ProductVariationSpecificAttribute);
        //FUNCTION ATTRIBUTES BY JTL
        $virtual = FALSE;
        $downloadable = FALSE;
        $soldIndividual = FALSE;
        $payable = FALSE;
        $nosearch = FALSE;
        $fbStatusCode = FALSE;
        $purchaseNote = FALSE;
        /* $fbVisibility = false;*/
        //GERMAN MARKET
        $digital = FALSE;
        $altDeliveryNote = FALSE;
        $suppressShippingNotice = FALSE;
        $variationPreselect = [];

        /** @var ProductAttrModel $pushedAttribute */
        foreach ($pushedAttributes as $key => $pushedAttribute) {
            foreach ($pushedAttribute->getI18ns() as $i18n) {
                if (!Util::getInstance()->isWooCommerceLanguage($i18n->getLanguageISO())) {
                    continue;
                }

                $attrName = strtolower(trim($i18n->getName()));

                if (preg_match('/^(wc_)[a-zA-Z\_]+$/', $attrName)
                    || in_array($attrName, [
                        'nosearch',
                        'payable',
                    ])) {
                    if (SupportedPlugins::isActive(SupportedPlugins::PLUGIN_FB_FOR_WOO)) {
                        if (strcmp($attrName, ProductVaSpeAttrHandler::FACEBOOK_SYNC_STATUS_ATTR) === 0) {
                            $value = strcmp(trim($i18n->getValue()), 'true') === 0;
                            $value = $value ? '1' : '';

                            if (!add_post_meta(
                                $productId,
                                substr($attrName, 3),
                                $value,
                                TRUE
                            )) {
                                update_post_meta(
                                    $productId,
                                    substr($attrName, 3),
                                    $value,
                                    \get_post_meta($productId, substr($attrName, 3), TRUE)
                                );
                            }
                            $fbStatusCode = TRUE;
                        }

                        /* if (strcmp($attrName, self::FACEBOOK_VISIBILITY_ATTR) === 0) {
                             $value = strcmp(trim($i18n->getValue()), 'true') === 0;
                             $value = $value ? '1' : '0';

                             if (!add_post_meta(
                                 $productId,
                                 substr($attrName, 3),
                                 $value,
                                 true
                             )) {
                                 update_post_meta(
                                     $productId,
                                     substr($attrName, 3),
                                     $value
                                 );
                             }
                             $fbVisibility = true;
                         }*/
                    }
                    if (SupportedPlugins::isActive(SupportedPlugins::PLUGIN_WOOCOMMERCE_GERMANIZED2)) {
                        if ($i18n->getName() === ProductVaSpeAttrHandler::GZD_IS_SERVICE) {
                            $value = $i18n->getValue();
                            if (in_array($value, ['yes', 'no'])) {
                                $metaKey = '_service';

                                if (!add_post_meta($productId, $metaKey, $value, TRUE)) {
                                    update_post_meta($productId, $metaKey, $value,
                                        \get_post_meta($productId, $metaKey, TRUE)
                                    );
                                }
                            }
                        }
                    }

                    if (
                        preg_match(
                            '/^(wc_gm_v_preselect_)[a-zA-Z\_]+$/',
                            $attrName
                        )
                        && $product->getMasterProductId()->getHost() === 0
                    ) {
                        $attrName = substr($attrName, 18);

                        $term = \get_term_by(
                            'slug',
                            wc_sanitize_taxonomy_name(substr(trim($i18n->getValue()), 0, 27)),
                            'pa_'.$attrName
                        );

                        if ($term instanceof WP_Term) {
                            $variationPreselect[$term->taxonomy] = $term->slug;
                        }
                    }

                    if (
                        preg_match(
                            '/^(wc_v_preselect_)[a-zA-Z\_]+$/',
                            $attrName
                        )
                        && $product->getMasterProductId()->getHost() === 0
                    ) {
                        $attrName = substr($attrName, 15);

                        $term = \get_term_by(
                            'slug',
                            wc_sanitize_taxonomy_name(substr(trim($i18n->getValue()), 0, 27)),
                            'pa_'.$attrName
                        );

                        if ($term instanceof WP_Term) {
                            $variationPreselect[$term->taxonomy] = $term->slug;
                        }
                    }

                    if (SupportedPlugins::isActive(SupportedPlugins::PLUGIN_GERMAN_MARKET)) {
                        if (strcmp($attrName, ProductVaSpeAttrHandler::GM_DIGITAL_ATTR) === 0) {
                            $value = strcmp(trim($i18n->getValue()), 'true') === 0;
                            $value = $value ? 'yes' : 'no';
                            $metaKey = substr($attrName, 5);
                            if (!add_post_meta(
                                $productId,
                                $metaKey,
                                $value,
                                TRUE
                            )) {
                                update_post_meta(
                                    $productId,
                                    $metaKey,
                                    $value,
                                    \get_post_meta($productId, $metaKey, TRUE)
                                );
                            }
                            $digital = TRUE;
                        }

                        if (strcmp($attrName, ProductVaSpeAttrHandler::GM_SUPPRESS_SHIPPPING_NOTICE) === 0) {
                            $value = strcmp(trim($i18n->getValue()), 'true') === 0;
                            $value = $value ? 'on' : '';
                            if ($value) {
                                if (!add_post_meta(
                                    $productId,
                                    substr($attrName, 5),
                                    $value,
                                    TRUE
                                )) {
                                    update_post_meta(
                                        $productId,
                                        substr($attrName, 5),
                                        $value,
                                        \get_post_meta($productId, substr($attrName, 5), TRUE)
                                    );
                                }
                            }
                            $suppressShippingNotice = TRUE;
                        }

                        if (strcmp($attrName, ProductVaSpeAttrHandler::GM_ALT_DELIVERY_NOTE_ATTR) === 0) {
                            $value = trim($i18n->getValue());
                            $attrKey = '_alternative_shipping_information';
                            if (!add_post_meta(
                                $productId,
                                $attrKey,
                                $value,
                                TRUE
                            )) {
                                \update_post_meta(
                                    $productId,
                                    $attrKey,
                                    $value,
                                    \get_post_meta($productId, $attrKey, TRUE)
                                );
                            }
                            $altDeliveryNote = TRUE;
                        }
                    }

                    if (strcmp($attrName, ProductVaSpeAttrHandler::PURCHASE_NOTE_ATTR) === 0) {
                        $value = trim($i18n->getValue());
                        $attrKey = '_purchase_note';
                        if (!add_post_meta(
                            $productId,
                            $attrKey,
                            $value,
                            TRUE
                        )) {
                            \update_post_meta(
                                $productId,
                                $attrKey,
                                $value,
                                \get_post_meta($productId, $attrKey, TRUE)
                            );
                        }
                        $purchaseNote = TRUE;
                    }

                    if (strcmp($attrName, ProductVaSpeAttrHandler::DOWNLOADABLE_ATTR) === 0) {
                        $value = strcmp(trim($i18n->getValue()), 'true') === 0;
                        $value = $value ? 'yes' : 'no';

                        if (!add_post_meta(
                            $productId,
                            substr($attrName, 2),
                            $value,
                            TRUE
                        )) {
                            update_post_meta(
                                $productId,
                                substr($attrName, 2),
                                $value,
                                \get_post_meta($productId, substr($attrName, 2), TRUE)
                            );
                        }
                        $downloadable = TRUE;
                    }

                    if (strcmp($attrName, ProductVaSpeAttrHandler::PURCHASE_ONLY_ONE_ATTR) === 0) {
                        $value = strcmp(trim($i18n->getValue()), 'true') === 0;
                        $value = $value ? 'yes' : 'no';

                        if (!add_post_meta(
                            $productId,
                            substr($attrName, 2),
                            $value,
                            TRUE
                        )) {
                            update_post_meta(
                                $productId,
                                substr($attrName, 2),
                                $value,
                                \get_post_meta($productId, substr($attrName, 2), TRUE)
                            );
                        }
                        $soldIndividual = TRUE;
                    }

                    if (strcmp($attrName, ProductVaSpeAttrHandler::VIRTUAL_ATTR) === 0) {
                        $value = strcmp(trim($i18n->getValue()), 'true') === 0;
                        $value = $value ? 'yes' : 'no';

                        if (!add_post_meta(
                            $productId,
                            substr($attrName, 2),
                            $value,
                            TRUE
                        )) {
                            update_post_meta(
                                $productId,
                                substr($attrName, 2),
                                $value,
                                \get_post_meta($productId, substr($attrName, 2), TRUE)
                            );
                        }

                        $virtual = TRUE;
                    }

                    if ($attrName === ProductVaSpeAttrHandler::PAYABLE_ATTR || $attrName === 'payable') {
                        if (strcmp(trim($i18n->getValue()), 'false') === 0) {
                            \wp_update_post([
                                'ID'          => $productId,
                                'post_status' => 'private',
                            ]);
                            $payable = TRUE;
                        }
                    }

                    if ($attrName === ProductVaSpeAttrHandler::NOSEARCH_ATTR || $attrName === 'nosearch') {
                        if (strcmp(trim($i18n->getValue()), 'true') === 0) {
                            \update_post_meta(
                                $productId,
                                '_visibility',
                                'catalog',
                                \get_post_meta($productId, '_visibility', TRUE)
                            );

                            /*
                            "   exclude-from-catalog"
                            "   exclude-from-search"
                            "   featured"
                            "   outofstock"
                            */
                            wp_set_object_terms($productId, ['exclude-from-search'], 'product_visibility', TRUE);
                            $nosearch = TRUE;
                        }
                    }

                    unset($pushedAttributes[$key]);
                }
            }
        }

        \update_post_meta(
            $productId,
            '_default_attributes',
            $variationPreselect,
            \get_post_meta($productId,
                '_default_attributes',
                TRUE)
        );

        //Revert
        if (!$virtual) {
            if (!\add_post_meta(
                $productId,
                '_virtual',
                'no',
                TRUE
            )) {
                \update_post_meta(
                    $productId,
                    '_virtual',
                    'no',
                    \get_post_meta($productId, '_virtual', TRUE)
                );
            }
        }

        if (!$downloadable) {
            if (!\add_post_meta(
                $productId,
                '_downloadable',
                'no',
                TRUE
            )) {
                \update_post_meta(
                    $productId,
                    '_downloadable',
                    'no',
                    \get_post_meta($productId, '_downloadable', TRUE)
                );
            }
        }

        if (!$soldIndividual) {
            if (!\add_post_meta(
                $productId,
                substr(ProductVaSpeAttrHandler::PURCHASE_ONLY_ONE_ATTR, 2),
                'no',
                TRUE
            )) {
                \update_post_meta(
                    $productId,
                    substr(ProductVaSpeAttrHandler::PURCHASE_ONLY_ONE_ATTR, 2),
                    'no',
                    \get_post_meta($productId, substr(ProductVaSpeAttrHandler::PURCHASE_ONLY_ONE_ATTR, 2), TRUE)
                );
            }
        }

        if (!$nosearch) {
            if (!\add_post_meta(
                $productId,
                '_visibility',
                'visible',
                TRUE
            )) {
                \update_post_meta(
                    $productId,
                    '_visibility',
                    'visible',
                    \get_post_meta($productId, '_visibility', TRUE)
                );
            }
            \wp_remove_object_terms($productId, ['exclude-from-search'], 'product_visibility');
        }

        if (!$purchaseNote) {
            if (!\add_post_meta(
                $productId,
                '_purchase_note',
                '',
                TRUE
            )) {
                \update_post_meta(
                    $productId,
                    '_purchase_note',
                    '',
                    \get_post_meta($productId, '_purchase_note', TRUE)
                );
            }
        }

        if (SupportedPlugins::isActive(SupportedPlugins::PLUGIN_GERMAN_MARKET)) {
            if (!$altDeliveryNote) {
                if (!\add_post_meta(
                    $productId,
                    '_alternative_shipping_information',
                    '',
                    TRUE
                )) {
                    \update_post_meta(
                        $productId,
                        '_alternative_shipping_information',
                        '',
                        \get_post_meta($productId, '_alternative_shipping_information', TRUE)
                    );
                }
            }

            if (!$digital) {
                if (!\add_post_meta(
                    $productId,
                    '_digital',
                    'no',
                    TRUE
                )) {
                    \update_post_meta(
                        $productId,
                        '_digital',
                        'no',
                        \get_post_meta($productId, '_digital', TRUE)
                    );
                }
            }

            if (!$suppressShippingNotice) {
                \delete_post_meta($productId, '_suppress_shipping_notice');
            }
        }

        if (SupportedPlugins::isActive(SupportedPlugins::PLUGIN_FB_FOR_WOO)) {
            if (!$fbStatusCode) {
                if (!\add_post_meta(
                    $productId,
                    substr(ProductVaSpeAttrHandler::FACEBOOK_SYNC_STATUS_ATTR, 3),
                    '',
                    TRUE
                )) {
                    \update_post_meta(
                        $productId,
                        substr(ProductVaSpeAttrHandler::FACEBOOK_SYNC_STATUS_ATTR, 3),
                        '',
                        \get_post_meta($productId, substr(ProductVaSpeAttrHandler::FACEBOOK_SYNC_STATUS_ATTR, 3), TRUE)
                    );
                }
            }

            /*if (!$fbVisibility) {
                if (!add_post_meta(
                    $productId,
                    substr(self::FACEBOOK_VISIBILITY_ATTR, 3),
                    '1',
                    true
                )) {
                    update_post_meta(
                        $productId,
                        substr(self::FACEBOOK_VISIBILITY_ATTR, 3),
                        '1'
                    );
                }
            }*/
        }

        if (!$payable) {
            $wcProduct = \wc_get_product($productId);
            $wcProduct->set_status('publish');
        }

        foreach ($attributesFilteredVariationsAndSpecifics as $key => $attr) {
            if ($attr['is_variation'] === TRUE || $attr['is_variation'] === FALSE && $attr['value'] === '') {
                continue;
            }
            $tmp = FALSE;

            foreach ($pushedAttributes as $pushedAttribute) {
                if ($attr->id == $pushedAttribute->getId()->getEndpoint()) {
                    $tmp = TRUE;
                }
            }

            if ($tmp) {
                unset($attributesFilteredVariationsAndSpecifics[$key]);
            }
        }

        /** @var ProductAttrModel $attribute */
        foreach ($pushedAttributes as $attribute) {
            $result = NULL;
            if (!(bool) Config::get(JtlConnectorAdmin::OPTIONS_SEND_CUSTOM_PROPERTIES) && $attribute->getIsCustomProperty() === TRUE) {
                continue;
            }

            foreach ($attribute->getI18ns() as $i18n) {
                if (!Util::getInstance()->isWooCommerceLanguage($i18n->getLanguageISO())) {
                    continue;
                }

                $this->saveAttribute($attribute, $i18n, $attributesFilteredVariationsAndSpecifics);

                break;
            }
        }

        return $attributesFilteredVariationsAndSpecifics;
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Methods">

    /**
     * @param WC_Product           $product
     * @param WC_Product_Attribute $attribute
     * @param                       $slug
     * @param string                $languageIso
     *
     * @return ProductAttrModel
     */
    private function buildAttribute(
        WC_Product $product,
        WC_Product_Attribute $attribute,
        $slug,
        $languageIso
    ) {
        $productAttribute = $product->get_attribute($attribute->get_name());
        $isTax = $attribute->is_taxonomy();

        // Divided by |
        $values = explode(WC_DELIMITER, $productAttribute);

        $i18n = (new ProductAttrI18nModel())
            ->setProductAttrId(new Identity($slug))
            ->setName($attribute->get_name())
            ->setValue(implode(', ', $values))
            ->setLanguageISO($languageIso);

        return (new ProductAttrModel())
            ->setId($i18n->getProductAttrId())
            ->setProductId(new Identity($product->get_id()))
            ->setIsCustomProperty($isTax)
            ->addI18n($i18n);
    }

    private function saveAttribute(ProductAttrModel $attribute, ProductAttrI18nModel $i18n, array &$attributes) {
        $this->addNewAttributeOrEditExisting($i18n, [
            'name'             => \wc_clean($i18n->getName()),
            'value'            => \wc_clean($i18n->getValue()),
            'isCustomProperty' => $attribute->getIsCustomProperty(),
        ], $attributes);
    }

    private function addNewAttributeOrEditExisting(ProductAttrI18nModel $i18n, array $data, array &$attributes) {
        $slug = \wc_sanitize_taxonomy_name($i18n->getName());

        if (isset($attributes[$slug])) {
            $this->editAttribute($slug, $i18n->getValue(), $attributes);
        } else {
            $this->addAttribute($slug, $data, $attributes);
        }
    }

    private function editAttribute($slug, $value, array &$attributes) {
        $values = explode(',', $attributes[$slug]['value']);
        $values[] = \wc_clean($value);
        $attributes[$slug]['value'] = implode(' | ', $values);
    }

    private function addAttribute($slug, array $data, array &$attributes) {
        $attributes[$slug] = [
            'name'         => $data['name'],
            'value'        => $data['value'],
            'position'     => 0,
            'is_visible'   => 1,
            'is_variation' => 0,
            'is_taxonomy'  => 0,
        ];
    }

    // </editor-fold>
}
