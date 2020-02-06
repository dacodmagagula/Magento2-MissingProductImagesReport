<?php

namespace Dacod\Missingimagesreport\Ui\DataProvider\Product;

class ProductDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {

        $this->_productCollectionFactory = $productCollectionFactory;
        $this->collection = $this->_productCollectionFactory->create()
                            ->addAttributeToSelect('*')
                            ->addAttributeToFilter([
                                 ['attribute' => 'small_image','null' => true ],
                                 ['attribute' => 'small_image','eq' => 'no_selection' ]
                            ])
                            //->addAttributeToFilter('status', ['in' => $productStatus->getVisibleStatusIds()])
                            ->setVisibility($productVisibility->getVisibleInSiteIds());
    
        
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );    
      
    }


    public function getData(){

        $data = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items'        => array_values($this->getCollection()->toArray()),
        ];

        return $data;

    }

}