<?php
declare(strict_types=1);

namespace Nadeem\Products\Api;

interface ProductsCollectionManagementInterface
{

    /**
     * Get product list
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     * @param string $brand_id
     * 
     */
    public function getProductsCollection(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
