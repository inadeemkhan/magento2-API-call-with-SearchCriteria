<?php
namespace Menastore\Brands\Model;

use Menastore\Brands\Api\Data\ProductInterface;
use Codazon\Shopbybrandpro\Model\BrandFactory;
use Codazon\Shopbybrandpro\Helper\Data;
use Magento\Framework\Registry;

use Menastore\ProductsList\Api\ProductListInterface;
use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Eav\Model\Entity\Attribute\Exception as AttributeException;
use Magento\Catalog\Model\Product;

class ProductManagementModel implements \Menastore\Brands\Api\ProductCollectionInterface
{
    /**
     * @var BrandFactory
     */
    protected $_brandFactory;
    /**
     * @var Data
     */
    protected $_helper;
    /**
     * @var Registry
     */
    protected $_coreRegistry = null;
    /**
     * @var \Magento\Catalog\Api\ProductCustomOptionRepositoryInterface
     */
    protected $optionRepository;
    /**
     * @var \Magento\Catalog\Model\ProductFactory
     */
    protected $productFactory;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product
     */
    protected $resourceModel;

    /**
     * GetProductReviews constructor.
     *
     * @param BrandFactory $allBrandList
     * @param Data $helper
     * @param Registry $registry
     */
    public function __construct(
        BrandFactory $brandFactory,
        Data $helper,
        Registry $registry,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Catalog\Api\Data\ProductSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->_brandFactory = $brandFactory;
        $this->_helper = $helper;
        $this->_coreRegistry = $registry;   
        $this->productFactory = $productFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @inheritdoc
     */
    public function getProductList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $brand_id = '';
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $brand_id = $filter->getValue();
            }
        }

        $data = [];
        $optionId = $brand_id;
        $attributeCode = "manufacturer";
        $collection = $this->collectionFactory->create();
        $collection->addStoreFilter()->setVisibility($this->_helper->getVisibleInCatalogIds())
            ->addAttributeToFilter($attributeCode, $optionId);
        $skuArray = [];
        foreach ($collection as $items) {
            array_push($skuArray, $items->getSku());
        }

        $collectionData = $collection;
        $collectionData ->addFieldToSelect('*');
        $collectionData ->addAttributeToFilter('sku', ['in' => $skuArray]);
        
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collectionData->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $searchResults->setTotalCount($collectionData->getSize());
        $sortOrdersData = $searchCriteria->getSortOrders();
        if ($sortOrdersData) {
            foreach ($sortOrdersData as $sortOrder) {
                $collectionData->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collectionData->setCurPage($searchCriteria->getCurrentPage());
        $collectionData->setPageSize($searchCriteria->getPageSize());
        $searchResults->setItems($collectionData->getData());
        return $searchResults;
    }
}