<?php
declare(strict_types=1);

namespace Menastore\Brands\Model;

use Codazon\Shopbybrandpro\Model\BrandFactory;
use Codazon\Shopbybrandpro\Helper\Data;
use Magento\Framework\Registry;

class BrandsByIdManagement implements \Menastore\Brands\Api\BrandsByIdManagementInterface
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
     * GetProductReviews constructor.
     *
     * @param BrandFactory $allBrandList
     * @param Data $helper
     * @param Registry $registry
     */
    public function __construct(
        BrandFactory $brandFactory,
        Data $helper,
        Registry $registry
    ) {
        $this->_brandFactory = $brandFactory;
        $this->_helper = $helper;
        $this->_coreRegistry = $registry;        
    }

    /**
     * {@inheritdoc}
     */
    public function execute($brandID)
    {
        $data = [];
        $brandFactory = $this->_brandFactory->create();
        $brandCollection = $brandFactory->load($brandID);

        if (!empty($brandCollection)) {
            $data["items"][] = $brandCollection->getData();
            header("Content-Type: application/json; charset=utf-8");
            print_r(json_encode($data));
            exit;
        }
        return "No record found!";
    }
}
