<?php
declare(strict_types=1);

namespace Menastore\Brands\Api;

interface BrandsByIdManagementInterface
{

    /**
     * GET for brands api
     * @param string $brandID
     * @return string
     */
    public function execute($brandID);
}
