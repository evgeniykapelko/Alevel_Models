<?php

namespace Alevel\Learning\Controller\Post;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Show.
 *
 * @package Alevel\Learning\Controller\Post
 */
class Show extends Action
{
    /**
     * Render posts.
     *
     * @return ResponseInterface|ResultInterface
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}