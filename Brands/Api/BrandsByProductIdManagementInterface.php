<?php
declare(strict_types=1);

namespace Menastore\Brands\Api;

interface BrandsByProductIdManagementInterface
{

    /**
     * GET for brands api
     * @param string $product-id
     * @return string
     */
    public function execute($product_id);
}
