<?php
/**
 * @category   Dacod
 * @package    Dacod_MissingProductImagesReport
 * @author     Dacod Magagula
 */
namespace Dacod\MissingProductImagesReport\Controller\Adminhtml\Report;

class Index extends \Magento\Backend\App\Action
  {
    /**
    * @var \Magento\Framework\View\Result\PageFactory
    */
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
         parent::__construct($context);
         $this->resultPageFactory = $resultPageFactory;
    }



    protected function _isAllowed()
    {
     return $this->_authorization->isAllowed('Dacod_MissingProductImagesReport::report');
    }

    /**
     * Load the page defined in view/adminhtml/layout/exampleadminnewpage_helloworld_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
         return  $resultPage = $this->resultPageFactory->create();
    }
  }
?>