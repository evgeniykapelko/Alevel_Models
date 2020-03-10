<?php

namespace Alevel\Learning\Block;

use Alevel\Learning\Api\PostRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;


/**
 * Class Post
 * @package Alevel\Learning\Block
 */
class Post extends Template
{
    const CONFIG_PATH_COUPON_GENERAL_VALUE = 'coupon/general/value';
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * Post constructor.
     *
     * @param Context                 $context
     * @param PostRepositoryInterface $postRepository
     * @param SearchCriteriaBuilder   $searchCriteriaBuilder
     * @param ScopeConfigInterface    $scopeConfig
     * @param CollectionFactory       $collectionFactory
     * @param array                   $data
     */
    public function __construct(
        Context $context,
        PostRepositoryInterface $postRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ScopeConfigInterface $scopeConfig,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->postRepository = $postRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionFactory = $collectionFactory;
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * <pre>
     * - ["from" => $fromValue, "to" => $toValue]
     * - ["eq" => $equalValue]
     * - ["neq" => $notEqualValue]
     * - ["like" => $likeValue]
     * - ["in" => [$inValues]]
     * - ["nin" => [$notInValues]]
     * - ["notnull" => $valueIsNotNull]
     * - ["null" => $valueIsNull]
     * - ["moreq" => $moreOrEqualValue]
     * - ["gt" => $greaterValue]
     * - ["lt" => $lessValue]
     * - ["gteq" => $greaterOrEqualValue]
     * - ["lteq" => $lessOrEqualValue]
     * - ["finset" => $valueInSet]
     * </pre>
     *
     * @return \Alevel\Learning\Api\Data\PostSearchResultsInterface
     */
    public function getPostFromRepository()
    {
        $limit = $this->getCustomConfig();
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('enabled', true, 'eq')
            ->setPageSize($limit)
        ->create();

        $searchResult = $this->postRepository->getList($searchCriteria);

        return $searchResult;
    }

    /**
     * @return \Alevel\Learning\Model\ResourceModel\Post\Collection
     */
    public function getPostFromCollection()
    {
        $limit = $this->getCustomConfig();

        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect('*')
        ->addFieldToFilter('enabled', ['eq' => true])
            ->setPageSize($limit);

        return $collection;
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