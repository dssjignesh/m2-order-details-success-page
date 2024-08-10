<?php

declare(strict_types=1);

 /**
 * Digit Software Solutions..
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 *
 * @category   Dss
 * @package    Dss_OrderDetails
 * @author     Extension Team
 * @copyright Copyright (c) 2024 Digit Software Solutions. ( https://digitsoftsol.com )
 */
namespace Dss\OrderDetails\Block;

use Dss\OrderDetails\Helper\Data;
use Magento\Checkout\Model\Session;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Pricing\Helper\Data as PricingData;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Model\Order\Address\Renderer;
use Magento\Sales\Model\OrderFactory;

class Details extends \Magento\Sales\Block\Order\Totals
{
    /**
     * Order Details Constructor
     *
     * @param Session $checkoutSession
     * @param CustomerSession $customerSession
     * @param OrderFactory $orderFactory
     * @param Context $context
     * @param Data $helper
     * @param Renderer $render
     * @param Registry $registry
     * @param PricingData $formatPrice
     * @param array $data
     */
    public function __construct(
        protected Session $checkoutSession,
        protected CustomerSession $customerSession,
        protected OrderFactory $orderFactory,
        protected Context $context,
        protected Data $helper,
        protected Renderer $render,
        protected Registry $registry,
        protected PricingData $formatPrice,
        array $data = []
    ) {
        parent::__construct($context, $registry, $data);
    }

    /**
     * Get last order object
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder(): \Magento\Sales\Model\Order
    {
        return $this->orderFactory->create()->loadByIncrementId(
            $this->checkoutSession->getLastRealOrderId()
        );
    }

    /**
     * Get Enable|Disable
     *
     * @return bool
     */
    public function isEnableDetails(): bool
    {
        return $this->helper->isEnable();
    }

    /**
     * Get Thanks Messeger
     *
     * @return string
     */
    public function getThankMessegerDetails(): string
    {
        return $this->helper->getThankMesseger();
    }

    /**
     * Get Enable|Disable Order Status
     *
     * @return bool
     */
    public function isEnableOrderStatusDetails(): bool
    {
        return $this->helper->isEnableOrderStatus();
    }

    /**
     * Get Text Before Order
     *
     * @return string
     */
    public function getBeforeTextDetails(): string
    {
        return $this->helper->getBeforeText();
    }

    /**
     * Get Text After Order
     *
     * @return string
     */
    public function getAfterTextDetails(): string
    {
        return $this->helper->getAfterText();
    }

    /**
     * Get Enable|Disable Shipping Address
     *
     * @return bool
     */
    public function isEnableShippingAddressDetails(): bool
    {
        return $this->helper->isEnableShippingAddress();
    }

    /**
     * Get Enable|Disable Shipping Method
     *
     * @return bool
     */
    public function isEnableShippingMethodDetails(): bool
    {
        return $this->helper->isEnableShippingMethod();
    }

    /**
     * Get Enable|Disable BiLLing Address
     *
     * @return bool
     */
    public function isEnableBillingAddressDetails(): bool
    {
        return $this->helper->isEnableBillingAddress();
    }

    /**
     * Get Enable|Disable Payment Method
     *
     * @return bool
     */
    public function isEnablePaymentMethodDetails(): bool
    {
        return $this->helper->isEnablePaymentMethod();
    }

    /**
     * Get Enable|Disable Product Details
     *
     * @return bool
     */
    public function isEnableOrderProductDetails(): bool
    {
        return $this->helper->isEnableOrderProduct();
    }

    /**
     * Get Thank Messeger Size
     *
     * @return string
     */
    public function getThankMessegerSizeDetails(): string
    {
        return $this->helper->getThankMessegerSize();
    }

    /**
     * Get Text Before Size
     *
     * @return string
     */
    public function getBeforeTextSizeDetails(): string
    {
        return $this->helper->getBeforeTextSize();
    }

    /**
     * Get Text After Size
     *
     * @return string
     */
    public function getAfterTextSizeDetails(): string
    {
        return $this->helper->getAfterTextSize();
    }

    /**
     * Get Thank Messeger Color
     *
     * @return string
     */
    public function getThankMessegerColorDetails(): string
    {
        return $this->helper->getThankMessegerColor();
    }

    /**
     * Get Text Before Color
     *
     * @return string
     */
    public function getBeforeTextColorDetails(): string
    {
        return $this->helper->getBeforeTextColor();
    }

    /**
     * Get Text After Color
     *
     * @return string
     */
    public function getAfterTextColorDetails(): string
    {
        return $this->helper->getAfterTextColor();
    }

    /**
     * Get Customer Id
     *
     * @return int
     */
    public function getCustomerId(): int
    {
        return (int)$this->customerSession->getCustomer()->getId();
    }

    /**
     * Render Block
     *
     * @return string
     */
    public function getAdditionalInfoHtml(): string
    {
        return $this->_layout->renderElement('order.success.additional.info');
    }

    /**
     * Format Price
     *
     * @param float $value
     * @return float
     */
    public function formatPrice($value)
    {
        return $this->formatPrice->currency($value, true, false);
    }

    /**
     * Get Re-Order
     *
     * @return string
     */
    public function getReorder(): string
    {
        $order = $this->getOrder();
        $orderID = $order -> getId();
        $reorder = $this->getBaseUrl().'sales/order/view/order_id/'.$orderID;
        return $reorder;
    }

    /**
     * Get Print Order
     *
     * @return string
     */
    public function getPrint(): string
    {
        $order = $this->getOrder();
        $orderID = $order -> getId();
        $print = $this->getBaseUrl().'sales/order/print/order_id/'.$orderID;
        return $print;
    }

    /**
     * Can View Re-Order
     *
     * @return bool
     */
    public function canViewReorder(): bool
    {
        if ($this->helper->isEnableReOrderLink() && $this->helper->isEnableReOrder() && $this->getCustomerId()) {
            return true;
        }
            return false;
    }

    /**
     * Can View Print Order
     *
     * @return bool
     */
    public function canViewPrint(): bool
    {
        if ($this->helper->isEnablePrintOrderLink() && $this->getCustomerId()) {
            return true;
        }
            return false;
    }

    /**
     * Format Shipping Address
     *
     * @return string
     */
    public function formatShipping(): string
    {
        $order = $this->getOrder();
        if ($order->getShippingAddress()) {
            return $this->render->format($order->getShippingAddress(), 'html');
        }
            return false;
    }

    /**
     * Format Billing Address
     *
     * @return string
     */
    public function formatBilling(): string
    {
            $order = $this->getOrder();
            return $this->render->format($order->getBillingAddress(), 'html');
    }

    /**
     * Format date
     *
     * @param string $date
     * @param string $format
     * @param bool $showTime
     * @param string $timezone
     * @param string $pattern
     * @return string
     */
    public function formatDate(
        $date = null,
        $format = \IntlDateFormatter::SHORT,
        $showTime = false,
        $timezone = null,
        $pattern = 'd MMM Y'
    ) {
        
            $date = $date instanceof \DateTimeInterface;
            return $this->_localeDate->formatDateTime(
                $date,
                $format,
                $showTime ? $format : \IntlDateFormatter::NONE,
                null,
                $timezone,
                $pattern
            );
    }

    /**
     * Return Opptions Configurable Product
     *
     * @param object $item
     * @return array
     */
    public function getItemOptions($item): array
    {
        $result = [];
        $option = $item->getProductOptions();
        if ($option) {
            if (isset($option['options'])) {
                    $result = array_merge($result, $option['options']);
            }
            if (isset($option['additional_options'])) {
                    $result = array_merge($result, $option['additional_options']);
            }
            if (isset($option['attributes_info'])) {
                    $result = array_merge($result, $option['attributes_info']);
            }
        }
        return $result;
    }

    /**
     * Return Opptions Bundle Product
     *
     * @param object $item
     * @return array
     */
    public function getBundleItemOptions($item): array
    {
        $result = [];
        $option = $item->getProductOptions();
        if ($option) {
            if (isset($option['bundle_options'])) {
                $result = array_merge($result, $option['bundle_options']);
            }
        }
        return $result;
    }
}
