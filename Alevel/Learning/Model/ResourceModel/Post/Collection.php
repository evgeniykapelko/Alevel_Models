<?php

namespace Alevel\Learning\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Alevel\Learning\Model\ResourceModel\Post
 */
class Collection extends AbstractCollection
{
    /**
     * Define model and resource model.
     */
    protected function _construct()
    {
        $this->_init(
            \Alevel\Learning\Model\Post::class,
            \Alevel\Learning\Model\ResourceModel\Post::class
        );
    }
}