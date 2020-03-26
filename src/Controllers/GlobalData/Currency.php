<?php
/**
 * @author    Jan Weskamp <jan.weskamp@jtl-software.com>
 * @copyright 2010-2013 JTL-Software GmbH
 */

namespace JtlWooCommerceConnector\Controllers\GlobalData;

use jtl\Connector\Model\Currency as CurrencyModel;
use jtl\Connector\Model\Identity;
use JtlWooCommerceConnector\Controllers\Traits\PullTrait;
use JtlWooCommerceConnector\Controllers\Traits\PushTrait;

class Currency
{
    use PullTrait, PushTrait;

    const ISO = 'woocommerce_currency';
    const SIGN_POSITION = 'woocommerce_currency_pos';
    const CENT_DELIMITER = 'woocommerce_price_decimal_sep';
    const THOUSAND_DELIMITER = 'woocommerce_price_thousand_sep';

    public function pullData()
    {
        $iso = \get_woocommerce_currency();

        return
            (new CurrencyModel())
                ->setId(new Identity(strtolower($iso)))
                ->setName($iso)
                ->setDelimiterCent(\get_option(self::THOUSAND_DELIMITER, ''))
                ->setDelimiterThousand(\get_option(self::CENT_DELIMITER, ''))
                ->setIso($iso)
                ->setNameHtml(\get_woocommerce_currency_symbol())
                ->setHasCurrencySignBeforeValue(\get_option(self::SIGN_POSITION, '') === 'left')
                ->setIsDefault(true);
    }

    public function pushData(array $currencies)
    {
        /** @var CurrencyModel $currency */
        foreach ($currencies as $currency) {
            if (!$currency->getIsDefault()) {
                continue;
            }

            \update_option(self::ISO, $currency->getIso(), 'yes');
            \update_option(self::CENT_DELIMITER, $currency->getDelimiterCent(), 'yes');
            \update_option(self::THOUSAND_DELIMITER, $currency->getDelimiterThousand(), 'yes');
            \update_option(self::SIGN_POSITION, $currency->getHasCurrencySignBeforeValue() ? 'left' : 'right', 'yes');

            break;
        }

        return $currencies;
    }
}
