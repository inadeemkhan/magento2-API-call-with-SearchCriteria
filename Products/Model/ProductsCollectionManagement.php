<?php
declare(strict_types=1);

namespace Nadeem\Products\Model;

class ProductsCollectionManagement implements \Nadeem\Products\Api\ProductsCollectionManagementInterface
{

    /**
     * {@inheritdoc}
     */
    public function getProductsCollection($param)
    {
        return 'hello api GET return the $param ' . $param;
    }
}

