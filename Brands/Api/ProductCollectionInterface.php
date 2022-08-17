<?php
namespace Menastore\Brands\Api;

/**
 * @api
 */
interface ProductCollectionInterface
{
    /**
     * Get product list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     * @param string $brand_id
     * 
     */
    public function getProductList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}