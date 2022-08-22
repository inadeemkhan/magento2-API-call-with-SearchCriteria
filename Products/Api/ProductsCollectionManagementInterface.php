<?php
declare(strict_types=1);

namespace Nadeem\Products\Api;

interface ProductsCollectionManagementInterface
{

    /**
     * GET for productsCollection api
     * @param string $param
     * @return string
     */
    public function getProductsCollection($param);
}

