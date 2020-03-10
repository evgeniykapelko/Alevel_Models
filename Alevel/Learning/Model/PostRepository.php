<?php

namespace Alevel\Learning\Model;

use Alevel\Learning\Api\Data\PostInterface;
use Alevel\Learning\Api\Data\PostSearchResultsInterface;
use Alevel\Learning\Api\PostRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Alevel\Learning\Api\Data\PostSearchResultsInterfaceFactory;
use Alevel\Learning\Model\ResourceModel\Post\CollectionFactory;
use Alevel\Learning\Model\PostFactory;
use Alevel\Learning\Model\ResourceModel\Post as ResourceModel;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;

/**
 * Class PostRepository.
 *
 * @package Alevel\Learning\Model
 */
class PostRepository implements PostRepositoryInterface
{
    /**
     * @var ResourceModel
     */
    protected $resource;

    /**
     * @var \Alevel\Learning\Model\PostFactory
     */
    protected $postFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var PostSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /** @var \Magento\Framework\Api\DataObjectHelper $dataObjectHelper */
    protected $dataObjectHelper;

    /** @var ExtensibleDataObjectConverter $dataObjectConverter */
    protected $dataObjectConverter;

    /**
     * PostRepository constructor.
     *
     * @param ResourceModel                      $resource
     * @param \Alevel\Learning\Model\PostFactory $postFactory
     * @param CollectionProcessorInterface       $collectionProcessor
     * @param CollectionFactory                  $collectionFactory
     * @param PostSearchResultsInterfaceFactory  $postSearchResultsInterfaceFactory
     */
    public function __construct(
        ResourceModel $resource,
        PostFactory $postFactory,
        CollectionProcessorInterface $collectionProcessor,
        CollectionFactory $collectionFactory,
        DataObjectHelper $dataObjectHelper,
        ExtensibleDataObjectConverter $dataObjectConverter,
        PostSearchResultsInterfaceFactory $postSearchResultsInterfaceFactory
    ) {
        $this->resource = $resource;
        $this->postFactory = $postFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory = $collectionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectConverter = $dataObjectConverter;
        $this->searchResultsFactory = $postSearchResultsInterfaceFactory;
    }

    /**
     * @param int $id
     *
     * @return \Alevel\Learning\Api\Data\PostInterface|void
     * @throws NoSuchEntityException
     */
    public function getById(int $id)
    {
        $post = $this->postFactory->create();
        $this->resource->load($post, $id);

        if (!$post->getId()) {
            throw new NoSuchEntityException(__('Post with id "%1" does not exist.', $id));
        }

        return $post;
    }

    /**
     *
     * @param int $id
     *
     * @return string
     */
    public function deleteById(int $id)
    {
        $this->delete($this->getById($id));

        $deleted = 'deleted';
        return $deleted;
    }

    /**
     * @param \Alevel\Learning\Api\Data\PostInterface $post
     * @return string
     */
    public function save($post)
    {
        $postObject = $this->postFactory->create();

        $itemData = $this->dataObjectConverter->toNestedArray($post, [], PostInterface::class);

        $postObject->setData($itemData);
        $this->resource->save($postObject);

        $success = 'success';

        return $postObject->getId();
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return PostSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());

        return $searchResult;
    }

    /**
     * @param \Alevel\Learning\Api\Data\PostInterface $post
     * @return string
     */
    public function delete(\Alevel\Learning\Api\Data\PostInterface $post)
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        $deleted = 'deleted';
        return $deleted;
    }
}