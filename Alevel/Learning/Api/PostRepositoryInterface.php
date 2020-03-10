<?php

namespace Alevel\Learning\Api;

use Alevel\Learning\Api\Data\PostInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Alevel\Learning\Api\Data\PostSearchResultsInterface;

/**
 * Interface PostRepositoryInterface
 * @package Alevel\Learning\Api
 */
interface PostRepositoryInterface
{
    /**
     *
     * @param int $id
     *
     * @return \Alevel\Learning\Api\Data\PostInterface
     *
     * @throws NoSuchEntityException
     */
    public function getById(int $id);

    /**
     *
     * @param int $id
     *
     * @return string
     *
     */
    public function deleteById(int $id);

    /**
     * @param \Alevel\Learning\Api\Data\PostInterface $post
     * @return string
     */
    public function save($post);

    /**
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return PostSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param \Alevel\Learning\Api\Data\PostInterface $post
     * @return string
     */
    public function delete(\Alevel\Learning\Api\Data\PostInterface $post);
}