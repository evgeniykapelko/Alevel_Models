<?php

namespace Alevel\Learning\Setup;

use Magento\Framework\DB\TransactionFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Psr\Log\LoggerInterface;
use Alevel\Learning\Api\Data\PostInterfaceFactory;

/**
 * Class InstallData
 * @package Alevel\Learning\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var PostInterfaceFactory
     */
    private $postFactory;

    /**
     * @var TransactionFactory
     */
    private $transactionFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * InstallData constructor.
     *
     * @param PostInterfaceFactory $postFactory
     * @param TransactionFactory   $transactionFactory
     * @param LoggerInterface      $logger
     */
    public function __construct(
        PostInterfaceFactory $postFactory,
        TransactionFactory $transactionFactory,
        LoggerInterface $logger
    ) {
        $this->postFactory = $postFactory;
        $this->transactionFactory = $transactionFactory;
        $this->logger = $logger;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $transactionModel = $this->transactionFactory->create();

        for ($i = 1; $i < 20; $i++) {
            $enabled = true;

            $post = $this->postFactory->create();
            $post->setName(sprintf('Customer Name %d', $i));
            $post->setEmail(sprintf('test_%d_@gmail.com', $i));
            $post->setContent(
                'Optional dependencies are objects that your class uses for specific methods and scenarios. 
                If a class is expensive to instantiate and your class does not always use it, consider using a proxy.
'           );

            if ($i % 2 == 0) {
                $enabled = false;
            }

            $post->setEnabled($enabled);

            $transactionModel->addObject($post);
        }

        try {
            $transactionModel->save();
        } catch ( \Exception $exception) {
            $this->logger->critical($exception->getMessage());
        }
    }
}