<?php

namespace Dacod\MissingProductImagesReport\Controller\Adminhtml\Report;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Ui\Model\Export\ConvertToCsv;
use Magento\Framework\App\Response\Http\FileFactory;
use Dacod\MissingProductImagesReport\Model\ResourceModel\Product\CollectionFactory;

class Export extends \Magento\Backend\App\Action
{
/**
 * @var \Magento\Backend\Model\View\Result\ForwardFactory
 */
protected $resultForwardFactory;

/**
 * Massactions filter
 *
 * @var Filter
 */
protected $filter;

/**
 * @var MetadataProvider
 */
protected $metadataProvider;
/**
 * @var WriteInterface
 */
protected $directory;
/**
 * @var ConvertToCsv
 */
protected $converter;
/**
 * @var FileFactory
 */
protected $fileFactory;



public function __construct(
    \Magento\Backend\App\Action\Context $context,
    \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
    Filter $filter,
    Filesystem $filesystem,
    ConvertToCsv $converter,
    FileFactory $fileFactory,
    \Magento\Ui\Model\Export\MetadataProvider $metadataProvider,
    \Magento\Catalog\Model\ResourceModel\Product $resource,
    \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory
) {
    $this->resources = $resource;
    $this->filter = $filter;
    $this->_connection = $this->resources->getConnection();
    $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
    $this->metadataProvider = $metadataProvider;
    $this->converter = $converter;
    $this->fileFactory = $fileFactory;
    parent::__construct($context);
    $this->resultForwardFactory = $resultForwardFactory;
    $this->collectionFactory = $collectionFactory;
}

/**
 * export.
 *
 * @return \Magento\Backend\Model\View\Result\Forward
 */
public function execute()
{
    try {
    $selected = $this->getRequest()->getParam('selected');
    if($selected) {

        $collection = $this->collectionFactory->create()
        ->addAttributeToFilter('entity_id', ['in' => $this->getRequest()->getParam('selected')]);
        
    }else {

         error_log("not selected");
        $collection = $this->filter->getCollection($this->collectionFactory->create());
    }
    $ids = $collection->getAllIds();

    $component = $this->filter->getComponent();
    $this->filter->prepareComponent($component);
    $dataProvider = $component->getContext()->getDataProvider();
    $dataProvider->setLimit(0, false);
    $searchResult = $component->getContext()->getDataProvider()->getSearchResult();
    $fields = $this->metadataProvider->getFields($component);
    $options = $this->metadataProvider->getOptions();
    $name = md5(microtime());
    $file = 'export/'. $component->getName() . $name . '.csv';
    $this->directory->create('export');
    $stream = $this->directory->openFile($file, 'w+');
    $stream->lock();

    $header = ["id","sku","name","price","url","status","created_at","last_updated_at"];

    $stream->writeCsv($header);

    foreach ($searchResult->getItems() as $document) {
        if( in_array( $document->getId(), $ids ) ) {
            $this->metadataProvider->convertDate($document, $component->getName());

            

            $itemData = [];

            $itemData[0] = $document->getId();
            $itemData[1] = $document->getSku();
            $itemData[2] = $document->getName();
            $itemData[3] = $document->getPrice();
            $itemData[4] = $document->getProductUrl();

            if($document->getStatus()==2){

                $itemData[5] = "disabled";

            }elseif($document->getStatus()==1){

                $itemData[5] = "enabled";
            }

            $itemData[6] = date("Y-m-d H:i:s", strtotime($document->getCreatedAt()));
            $itemData[7] = date("Y-m-d H:i:s", strtotime($document->getUpdatedAt()));
            
            $stream->writeCsv($itemData);
        }
    }
    $stream->unlock();
    $stream->close();
    return $this->fileFactory->create('dacod_missing_product_images_report.csv', [
        'type' => 'filename',
        'value' => $file,
        'rm' => true  // can delete file after use
    ], 'var');


    }catch (\Exception $e){

    }
}
}