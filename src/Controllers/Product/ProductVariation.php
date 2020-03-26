<?php
/**
 * @author    Jan Weskamp <jan.weskamp@jtl-software.com>
 * @copyright 2010-2013 JTL-Software GmbH
 */

namespace JtlWooCommerceConnector\Controllers\Product;

use WP_Term;
use WP_Error;
use WC_Product;
use WC_Product_Attribute;
use jtl\Connector\Model\Identity;
use JtlWooCommerceConnector\Utilities\Id;
use JtlWooCommerceConnector\Utilities\Util;
use jtl\Connector\Model\Product as ProductModel;
use JtlWooCommerceConnector\Utilities\SqlHelper;
use JtlWooCommerceConnector\Logger\WpErrorLogger;
use JtlWooCommerceConnector\Controllers\BaseController;
use jtl\Connector\Model\ProductVariation as ProductVariationModel;
use jtl\Connector\Model\ProductVariationI18n as ProductVariationI18nModel;
use jtl\Connector\Model\ProductVariationValue as ProductVariationValueModel;
use jtl\Connector\Model\ProductVariationValueI18n as ProductVariationValueI18nModel;

class ProductVariation extends BaseController {
    // <editor-fold defaultstate="collapsed" desc="Pull">

    /**
     * @param ProductModel $model
     * @param WC_Product_Attribute $attribute
     * @param string $languageIso
     *
     * @return ProductVariationModel|null
     */
    public function pullDataParent(ProductModel $model, WC_Product_Attribute $attribute, $languageIso = '') {
        $id = new Identity(Id::link([$model->getId()->getEndpoint(), $attribute->get_id()]));

        $productVariation = (new ProductVariationModel())
            ->setId($id)
            ->setProductId($model->getId())
            ->setType(ProductVariationModel::TYPE_SELECT)
            ->addI18n((new ProductVariationI18nModel())
                ->setProductVariationId($id)
                ->setName(\wc_attribute_label($attribute->get_name()))
                ->setLanguageISO($languageIso));

        if ($attribute->is_taxonomy()) {
            $terms = $attribute->get_terms();

            if (!is_array($terms)) {
                return NULL;
            }

            /** @var WP_Term $term */
            foreach ($terms as $sort => $term) {
                $valueId = new Identity(Id::link([$id->getEndpoint(), $term->term_id]));

                $productVariation->addValue((new ProductVariationValueModel())
                    ->setId($valueId)
                    ->setProductVariationId($id)
                    ->setSort($sort)
                    ->addI18n((new ProductVariationValueI18nModel())
                        ->setProductVariationValueId($valueId)
                        ->setName($term->name)
                        ->setLanguageISO($languageIso))
                );
            }
        } else {
            $options = $attribute->get_options();

            foreach ($options as $sort => $option) {
                $valueId = new Identity(Id::link([$id->getEndpoint(), \sanitize_key($option)]));

                $productVariation->addValue((new ProductVariationValueModel())
                    ->setId($valueId)
                    ->setProductVariationId($id)
                    ->setSort($sort)
                    ->addI18n((new ProductVariationValueI18nModel())
                        ->setProductVariationValueId($valueId)
                        ->setName($option)
                        ->setLanguageISO($languageIso))
                );
            }
        }

        return $productVariation;
    }

    /**
     * @param WC_Product $product
     * @param ProductModel $model
     * @param string $languageIso
     *
     * @return array
     */
    public function pullDataChild(WC_Product $product, ProductModel $model, $languageIso = '') {
        $parentProduct = \wc_get_product($product->get_parent_id());
        $productVariations = [];
        /**
         * @var string
         * @var WC_Product_Attribute $attribute
         */
        foreach ($parentProduct->get_attributes() as $slug => $attribute) {
            $id = new Identity(Id::link([$parentProduct->get_id(), $attribute->get_id()]));

            $productVariation = (new ProductVariationModel())
                ->setId($id)
                ->setProductId($model->getId())
                ->setType(ProductVariationModel::TYPE_SELECT)
                ->addI18n((new ProductVariationI18nModel())
                    ->setProductVariationId($id)
                    ->setName(\wc_attribute_label($attribute->get_name()))
                    ->setLanguageISO($languageIso));

            if ($attribute->is_taxonomy()) {
                $terms = $attribute->get_terms();

                if (!is_array($terms)) {
                    continue;
                }

                $value = $product->get_attribute($slug);

                /** @var WP_Term $term */
                foreach ($terms as $sort => $term) {
                    if ($term->name !== $value) {
                        continue;
                    }

                    $valueId = new Identity(Id::link([$id->getEndpoint(), $term->term_id]));

                    $productVariation->addValue((new ProductVariationValueModel())
                        ->setId($valueId)
                        ->setProductVariationId($id)
                        ->setSort($sort)
                        ->addI18n((new ProductVariationValueI18nModel())
                            ->setProductVariationValueId($valueId)
                            ->setName($term->name)
                            ->setLanguageISO($languageIso))
                    );
                }
            } else {
                $value = $product->get_attribute($slug);

                foreach ($attribute->get_options() as $sort => $option) {
                    if ($option !== $value) {
                        continue;
                    }

                    $valueId = new Identity(Id::link([$id->getEndpoint(), \sanitize_key($option)]));

                    $productVariation->addValue((new ProductVariationValueModel())
                        ->setId($valueId)
                        ->setProductVariationId($id)
                        ->setSort($sort)
                        ->addI18n((new ProductVariationValueI18nModel())
                            ->setProductVariationValueId($valueId)
                            ->setName($option)
                            ->setLanguageISO($languageIso))
                    );
                }
            }

            $productVariations[] = $productVariation;
        }

        return $productVariations;
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Push">
    public function pushMasterData(
        $productId,
        $variationSpecificData,
        $attributesFilteredVariationSpecifics
    ) {
        $result = NULL;
        $parent = (new ProductVaSpeAttrHandler());

        foreach ($variationSpecificData as $key => $variationSpecific) {
            $taxonomy = 'pa_'.wc_sanitize_taxonomy_name(substr(trim($key), 0, 27));
            $specificID = $this->database->query(SqlHelper::getSpecificId(sprintf('%s', $key)));
            $specificExists = isset($specificID[0]['attribute_id']) ? TRUE : FALSE;
            $options = [];

            if (array_key_exists($taxonomy, $attributesFilteredVariationSpecifics)) {
                $attributesFilteredVariationSpecifics[$taxonomy]['is_variation'] = TRUE;
            }

            if ($specificExists) {

                //Get existing values
                $pushedValues = explode(' '.WC_DELIMITER.' ', $variationSpecific['value']);
                foreach ($pushedValues as $pushedValue) {

                    //check if value did not exists
                    $specificValueId = $parent->getSpecificValueId(
                        $taxonomy,
                        trim($pushedValue)
                    );

                    $termId = (int) $specificValueId->getEndpoint();

                    if (!$termId > 0) {
                        //Add values
                        $newTerm = \wp_insert_term(
                            $pushedValue,
                            $taxonomy
                        );

                        if ($newTerm instanceof WP_Error) {
                            //  var_dump($newTerm);
                            // die();
                            WpErrorLogger::getInstance()->logError($newTerm);
                            continue;
                        }

                        $termId = $newTerm['term_id'];
                    }

                    if (array_key_exists($taxonomy, $attributesFilteredVariationSpecifics)) {
                        $attributesFilteredVariationSpecifics[$taxonomy]['is_variation'] = TRUE;

                        $options = explode(
                            ' '.WC_DELIMITER.' ',
                            $attributesFilteredVariationSpecifics[$taxonomy]['value']
                        );

                        if ((!in_array($termId, $options))) {
                            array_push($options, $termId);
                        }

                        $attributesFilteredVariationSpecifics[$taxonomy]['value'] = implode(
                            ' '.WC_DELIMITER.' ',
                            $options
                        );
                    } else {
                        array_push($options, $termId);
                        $attributesFilteredVariationSpecifics[$taxonomy] = [
                            'name'         => $taxonomy,
                            'value'        => implode(
                                ' '.WC_DELIMITER.' ',
                                $options
                            ),
                            'position'     => 0,
                            'is_visible'   => Util::showVariationSpecificsOnProductPageEnabled(),
                            'is_variation' => TRUE,
                            'is_taxonomy'  => $taxonomy,
                        ];
                    }

                    foreach ($options as $key => $value) {
                        $options[$key] = (int) $value;
                    }

                    wp_set_object_terms(
                        $productId,
                        $options,
                        $attributesFilteredVariationSpecifics[$taxonomy]['name'],
                        TRUE
                    );
                }
            } else {
                //Create specific and add values
                $endpoint = [
                    'id'       => '',
                    'name'     => $variationSpecific['name'],
                    'slug'     => $taxonomy,
                    'type'     => 'select',
                    'order_by' => 'menu_order',
                    //'attribute_public'  => 0,
                ];

                $options = explode(
                    ' '.WC_DELIMITER.' ',
                    $variationSpecific['value']
                );

                $attributeId = wc_create_attribute($endpoint);

                if ($attributeId instanceof WP_Error) {
                    //var_dump($attributeId);
                    //die();
                    //return $termId->get_error_message();
                    WpErrorLogger::getInstance()->logError($attributeId);

                    return NULL;
                }

                //Register taxonomy for current request
                register_taxonomy($taxonomy, NULL);

                $assignedValueIds = [];

                foreach ($options as $optionKey => $optionValue) {
                    $slug = wc_sanitize_taxonomy_name($optionValue);

                    $endpointValue = [
                        'name' => $optionValue,
                        'slug' => $slug,
                    ];

                    $exValId = $this->database->query(
                        SqlHelper::getSpecificValueId(
                            $taxonomy,
                            $endpointValue['name']
                        )
                    );

                    if (count($exValId) >= 1) {
                        if (isset($exValId[0]['term_id'])) {
                            $exValId = $exValId[0]['term_id'];
                        } else {
                            $exValId = NULL;
                        }
                    } else {
                        $exValId = NULL;
                    }

                    if (is_null($exValId)) {
                        $newTerm = \wp_insert_term(
                            $endpointValue['name'],
                            $taxonomy
                        );

                        if ($newTerm instanceof WP_Error) {
                            //  var_dump($newTerm);
                            // die();
                            WpErrorLogger::getInstance()->logError($newTerm);
                            continue;
                        }

                        $termId = $newTerm['term_id'];

                        if ($termId instanceof WP_Error) {
                            // var_dump($termId);
                            // die();
                            WpErrorLogger::getInstance()->logError($termId);
                            continue;
                        }

                        $assignedValueIds[] = $termId;
                    }
                }

                $attributesFilteredVariationSpecifics[$taxonomy] = [
                    'name'         => $taxonomy,
                    'value'        => implode(
                        ' '.WC_DELIMITER.' ',
                        $options
                    ),
                    'position'     => NULL,
                    'is_visible'   => Util::showVariationSpecificsOnProductPageEnabled(),
                    'is_variation' => TRUE,
                    'is_taxonomy'  => $taxonomy,
                ];

                wp_set_object_terms(
                    $productId,
                    $assignedValueIds,
                    $attributesFilteredVariationSpecifics[$taxonomy]['name'],
                    TRUE
                );
            }
            $result = $attributesFilteredVariationSpecifics;
        }

        return $result;
    }

    public function pushChildData(
        $productId,
        $pushedVariations
    ) {
        $updatedAttributeKeys = [];

        /** @var ProductVariationModel $variation */
        foreach ($pushedVariations as $variation) {
            foreach ($variation->getValues() as $variationValue) {
                foreach ($variation->getI18ns() as $variationI18n) {
                    if (!Util::getInstance()->isWooCommerceLanguage($variationI18n->getLanguageISO())) {
                        continue;
                    }

                    foreach ($variationValue->getI18ns() as $i18n) {
                        $metaKey =
                            'attribute_pa_'.wc_sanitize_taxonomy_name(
                                substr(
                                    trim(
                                        $variationI18n->getName()
                                    ),
                                    0,
                                    27
                                )
                            );
                        $updatedAttributeKeys[] = $metaKey;

                        \update_post_meta($productId, $metaKey,
                            wc_sanitize_taxonomy_name($i18n->getName()));
                    }

                    break;
                }
            }
        }

        /*	$attributesToDelete = $this->database->queryList( SqlHelper::productVariationObsoletes(
            $product->getId()->getEndpoint(),
            $updatedAttributeKeys
        ) );

        foreach ( $attributesToDelete as $key ) {
            \delete_post_meta( $product->getId()->getEndpoint(), $key );
        }*/

        return $updatedAttributeKeys;
    }

    // </editor-fold>

    // <editor-fold defaultstate="collapsed" desc="Methods">
    // </editor-fold>
}
