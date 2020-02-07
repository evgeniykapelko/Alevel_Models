<?php

namespace Alevel\Learning\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface PostSearchResultsInterface
 * @package Alevel\Learning\Api\Data
 */
interface PostSearchResultsInterface extends SearchResultsInterface
{
    /**
     *
     *
     * @return PostInterface[]
     */
    public function getItems();

    /**
     *
     * @param PostInterface[] $items
     *
     * @return $this
     */
    public function setItems(array $items);
}
