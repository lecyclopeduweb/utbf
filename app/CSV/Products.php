<?php

declare (strict_types = 1);

namespace AppUtbf\CSV;

/**
 * Products
 *
 * @author     "Jonathan ALCARAS" <lecyclopeduweb@gmail.com>
 */
class Products
{

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Items CVS
     *
     * @param array $products  List of products
     *
     * @return array
     */
    public function items_analytics($products) {

        $items = [];

        if(empty($products))
            return $items;

        foreach($products as $product):

            $items[] =[
                get_the_title($product['product_id']),
                $product['tax_product_school'][0]->name,
                $product['child']['last_name'],
                $product['child']['first_name'],
                $product['child']['classroom'],
                (!empty($product['child']['birthday']))? \DateTime::createFromFormat('Y-m-d', $product['child']['birthday'])->format('d/m/Y') : '',
                (!empty($product['canteen']['lundi']))? __('Yes',UTBF_TEXT_DOMAIN): __('No',UTBF_TEXT_DOMAIN),
                (!empty($product['canteen']['mardi'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['canteen']['mercredi'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['canteen']['jeudi'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['canteen']['vendredi'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['canteen']['samedi'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['canteen']['dimanche'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['lundi-08h-08h45'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['lundi-17h-18h'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['mardi-08h-08h45'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['mardi-17h-18h'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['mercredi-08h-08h45'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['mercredi-17h-18h'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['jeudi-08h-08h45'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['jeudi-17h-18h'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['vendredi-08h-08h45'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['vendredi-17h-18h'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['samedi-08h-08h45'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['samedi-17h-18h'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['dimanche-08h-08h45'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['daycare']['dimanche-17h-18h'])) ? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                ($product['child']['medical_treatments'])? __('Yes', UTBF_TEXT_DOMAIN) : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['child']['specific_aspects'])) ? $product['child']['specific_aspects'] : __('No', UTBF_TEXT_DOMAIN),
                (!empty($product['child']['recommendations'])) ? $product['child']['recommendations'] : __('No', UTBF_TEXT_DOMAIN),
                $product['consents']['blog'],
                $product['consents']['communication'],
                $product['legal_guardian']['legal_guardian']['last_name'],
                $product['legal_guardian']['legal_guardian']['first_name'],
                $product['legal_guardian']['legal_guardian']['phone'],
                $product['legal_guardian']['legal_guardian']['phone_2'],
                $product['legal_guardian']['legal_guardian']['email'],
                $product['legal_guardian']['$legal_guardian_2']['last_name'],
                $product['legal_guardian']['$legal_guardian_2']['first_name'],
                $product['legal_guardian']['$legal_guardian_2']['phone'],
                $product['legal_guardian']['$legal_guardian_2']['phone_2'],
                $product['legal_guardian']['$legal_guardian_2']['email'],
                $product['emergency']['last_name'],
                $product['emergency']['first_name'],
                $product['emergency']['phone'],
            ];

        endforeach;

       return $items;

    }

    /**
     * Header CVS
     *
     * @return array
     */
    public function header_analytics() {

        return [
            __('Product title',UTBF_TEXT_DOMAIN),
            __('Product school',UTBF_TEXT_DOMAIN),
            __('Child last name',UTBF_TEXT_DOMAIN),
            __('Child first name',UTBF_TEXT_DOMAIN),
            __('Child classroom',UTBF_TEXT_DOMAIN),
            __('Child birthday',UTBF_TEXT_DOMAIN),
            __('Canteen monday',UTBF_TEXT_DOMAIN),
            __('Canteen tuesday',UTBF_TEXT_DOMAIN),
            __('Canteen wednesday',UTBF_TEXT_DOMAIN),
            __('Canteen thursday',UTBF_TEXT_DOMAIN),
            __('Canteen friday',UTBF_TEXT_DOMAIN),
            __('Canteen saturday',UTBF_TEXT_DOMAIN),
            __('Canteen sunday',UTBF_TEXT_DOMAIN),
            __('Daycare Monday / 08:00 - 08:45', UTBF_TEXT_DOMAIN),
            __('Daycare Monday / 17:00 - 18:00', UTBF_TEXT_DOMAIN),
            __('Daycare Tuesday / 08:00 - 08:45', UTBF_TEXT_DOMAIN),
            __('Daycare Tuesday / 17:00 - 18:00', UTBF_TEXT_DOMAIN),
            __('Daycare Wednesday / 08:00 - 08:45', UTBF_TEXT_DOMAIN),
            __('Daycare Wednesday / 17:00 - 18:00', UTBF_TEXT_DOMAIN),
            __('Daycare Thursday / 08:00 - 08:45', UTBF_TEXT_DOMAIN),
            __('Daycare Thursday / 17:00 - 18:00', UTBF_TEXT_DOMAIN),
            __('Daycare Friday / 08:00 - 08:45', UTBF_TEXT_DOMAIN),
            __('Daycare Friday / 17:00 - 18:00', UTBF_TEXT_DOMAIN),
            __('Daycare Saturday / 08:00 - 08:45', UTBF_TEXT_DOMAIN),
            __('Daycare Saturday / 17:00 - 18:00', UTBF_TEXT_DOMAIN),
            __('Daycare Sunday / 08:00 - 08:45', UTBF_TEXT_DOMAIN),
            __('Daycare Sunday / 17:00 - 18:00', UTBF_TEXT_DOMAIN),
            __('Processing in progress', UTBF_TEXT_DOMAIN),
            __('Special items to report (food allergies, asthma, etc.)', UTBF_TEXT_DOMAIN),
            __('Any useful recommendations/comments to know about the child?', UTBF_TEXT_DOMAIN),
            __('Authorization to publish photos on the secure blog', UTBF_TEXT_DOMAIN),
            __("Authorization to publish photos on the association's communication tools (website, FB, IG, etc.)", UTBF_TEXT_DOMAIN),
            __('Legal guardian 1 last name (parent)', UTBF_TEXT_DOMAIN),
            __('Legal guardian 1 first name (parent)', UTBF_TEXT_DOMAIN),
            __('Legal guardian 1 phone 1 (parent)', UTBF_TEXT_DOMAIN),
            __('Legal guardian 1 phone 2 (parent)', UTBF_TEXT_DOMAIN),
            __('Legal guardian 1 email (parent)', UTBF_TEXT_DOMAIN),
            __('Legal guardian 2 last name', UTBF_TEXT_DOMAIN),
            __('Legal guardian 2 first name', UTBF_TEXT_DOMAIN),
            __('Legal guardian 2 phone 1', UTBF_TEXT_DOMAIN),
            __('Legal guardian 2 phone 2', UTBF_TEXT_DOMAIN),
            __('Legal guardian 2 email', UTBF_TEXT_DOMAIN),
            __('Emergency contact last name', UTBF_TEXT_DOMAIN),
            __('Emergency contact first name', UTBF_TEXT_DOMAIN),
            __('Emergency contact phone', UTBF_TEXT_DOMAIN),
        ];

    }


}
