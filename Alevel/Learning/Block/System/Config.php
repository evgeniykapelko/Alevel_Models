<?php

namespace Alevel\Learning\Block\System;

use \Magento\Backend\Block\Template\Context;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Backend\Block\Template;
use \Magento\Store\Model\ScopeInterface;


class Config extends Template
{
    const CONFIG_PATH_COUPON_GENERAL_VALUE = 'coupon/general/value';

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Config constructor.
     *
     * @param Context              $context
     * @param ScopeConfigInterface $scopeConfig
     * @param array                $data
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $data
        );
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param string|null $storeId
     *
     * @return mixed
     */
    public function getCustomConfig(?string $storeId = null)
    {
        return $this->scopeConfig->getValue(
            'coupon/general/value',
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

}