<?php
/**
 * @author    Jan Weskamp <jan.weskamp@jtl-software.com>
 * @copyright 2010-2013 JTL-Software GmbH
 */

namespace JtlWooCommerceConnector\Controllers\GlobalData;

use jtl\Connector\Core\Utilities\Language as LanguageUtil;
use jtl\Connector\Model\Identity;
use JtlWooCommerceConnector\Controllers\Traits\PullTrait;
use JtlWooCommerceConnector\Utilities\Util;

class Language
{
    use PullTrait;

    public function pullData()
    {
        $locale = \get_locale();

        return (new \jtl\Connector\Model\Language())
            ->setId(new Identity(Util::getInstance()->mapLanguageIso($locale)))
            ->setNameGerman($this->nameGerman($locale))
            ->setNameEnglish($this->nameEnglish($locale))
            ->setLanguageISO(Util::getInstance()->mapLanguageIso($locale))
            ->setIsDefault(true);
    }

    protected function nameGerman($locale)
    {
        if (function_exists('locale_get_display_language')) {
            return \locale_get_display_language($locale, 'de');
        }

        $isoCode = strtoupper(LanguageUtil::map($locale));
        $countries = WC()->countries->get_countries();

        return isset($countries[$isoCode]) ? $countries[$isoCode] : '';
    }

    protected function nameEnglish($locale)
    {
        if (function_exists('locale_get_display_language')) {
            return \locale_get_display_language($locale, 'en');
        }

        $isoCode = strtoupper(LanguageUtil::map($locale));
        $countries = WC()->countries->get_countries();

        return isset($countries[$isoCode]) ? $countries[$isoCode] : '';
    }
}
