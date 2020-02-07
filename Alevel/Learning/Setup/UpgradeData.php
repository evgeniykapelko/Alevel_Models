<?php

namespace Alevel\Learning\Setup;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Exception\LocalizedException;
use Alevel\Learning\Api\PostRepositoryInterface;
use Magento\Framework\DB\TransactionFactory;
use Magento\Framework\Math\Random;

/**
 * Class UpgradeData.
 *
 * @package Alevel\Learning\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TransactionFactory
     */
    private $transactionFactory;

    /**
     * @var Random
     */
    private $random;

    /**
     * UpgradeData constructor.
     *
     * @param PostRepositoryInterface $postRepository
     * @param TransactionFactory      $transactionFactory
     * @param SearchCriteriaBuilder   $searchCriteriaBuilder
     * @param Random                  $random
     */
    public function __construct(
        PostRepositoryInterface $postRepository,
        TransactionFactory $transactionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Random $random
    ) {
        $this->postRepository = $postRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->transactionFactory = $transactionFactory;
        $this->random = $random;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.0') < 0) {
            $this->changeData();
        }

        $setup->endSetup();
    }

    /**
     *
     */
    private function changeData()
    {
        $transactionModel = $this->transactionFactory->create();

        $searchCriteria = $this->searchCriteriaBuilder->create();

        $searchResult = $this->postRepository->getList($searchCriteria);

        foreach ($searchResult->getItems() as $item) {
            $item->setTelephone(sprintf('+4 %d',$this->random->getRandomNumber(10000000, 90000000)));

            $transactionModel->addObject($item);
        }

        try {
            $transactionModel->save();
        } catch ( \Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
    }

}