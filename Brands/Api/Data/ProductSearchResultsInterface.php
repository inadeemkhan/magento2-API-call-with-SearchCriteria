<?php
namespace Menastore\Brands\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
/**
 * @api
 */
interface ProductSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get items
     * @return \Menastore\Brands\Api\Data\ProductInterface[]
     */
    public function getItems();
    /**
     * Set items
     * @param \Menastore\Brands\Api\Data\ProductInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}