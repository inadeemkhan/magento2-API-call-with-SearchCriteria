<?php
declare(strict_types=1);

namespace Menastore\Brands\Model;

use Codazon\Shopbybrandpro\Model\BrandFactory;
use Codazon\Shopbybrandpro\Helper\Data;
use Magento\Framework\Registry;

class BrandsManagement implements \Menastore\Brands\Api\BrandsManagementInterface
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
    public function getBrands()
    {
        $productCollection = $this->_helper->getBrandCollection();
        try {
            $data = [];
            $brandData = [];
            foreach ($productCollection as $brand) {

                $brandarray = [];
                $optId = $brand->getOptionId();
                $productCount = $this->_helper->getProductCount(null, $optId);
                $brandarray['brand_id'] = $brand->getId();
                $brandarray['brand_name'] = $brand->getName();
                $brandarray['brand_img'] = $brand->getBrandThumbnail();
                $brandarray['products_count'] = $productCount;
                array_push($brandData, $brandarray);
            }
            if(!empty($brandData)) {
                $data["items"][] = $brandData;
                header("Content-Type: application/json; charset=utf-8");
                print_r(json_encode($data));
                exit;
            }
            return "No record found!";
            
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}

