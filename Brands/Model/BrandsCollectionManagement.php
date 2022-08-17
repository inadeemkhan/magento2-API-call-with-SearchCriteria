<?php
declare(strict_types=1);

namespace Menastore\Brands\Model;

use Codazon\Shopbybrandpro\Model\BrandFactory;
use Codazon\Shopbybrandpro\Helper\Data;
use Magento\Framework\Registry;

class BrandsCollectionManagement implements \Menastore\Brands\Api\BrandsCollectionManagementInterface
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
    protected $_coreHelper;

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
        \Codazon\Core\Helper\Data $coreHelper
    ) {
        $this->_brandFactory = $brandFactory;
        $this->_helper = $helper;
        $this->_coreRegistry = $registry;   
        $this->_objectManager = $coreHelper->getObjectManager();     
    }

    /**
     * @return string
     */
    public function execute($brandID)
    {
        $data = [];
        $optionId = $brandID;
        $attributeCode = "manufacturer";
        $collection = $this->_objectManager->get(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory::class)->create();
        $collection->addStoreFilter()->setVisibility($this->_helper->getVisibleInCatalogIds())
            ->addAttributeToFilter($attributeCode, $optionId);

        if ($collection->getSize() > 1) {
            $data["items"][] = $collection->getData();
            header("Content-Type: application/json; charset=utf-8");
            print_r(json_encode($data));
            exit;
        }
        return "No record found!";
        
    }
}

