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

use Magento\Framework\View\Element\Template\Context;
use Magento\Tax\Helper\Data;
use Magento\Tax\Model\Config;

class Tax extends \Magento\Tax\Block\Sales\Order\Tax
{
    /**
     * Tax Constructor
     * @param Context $context
     * @param Config $taxConfig
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $taxConfig,
        protected Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $taxConfig, $data);
    }

    /**
     * Get Helper Tax
     *
     * @return \Magento\Tax\Helper\Data
     */
    public function getHelper(): \Magento\Tax\Helper\Data
    {
        return $this->helper;
    }
}
