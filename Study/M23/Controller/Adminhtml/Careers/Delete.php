<?php

namespace Study\M23\Controller\Adminhtml\Careers;

use Study\M23\Model\CareersFactory as ModelFactory;

class Delete extends \Magento\Backend\App\Action
{
    protected $_modelCollection;

    /**
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param ModelGioLocation $ModelCertification
     */
    public function __construct(\Magento\Backend\App\Action\Context $context,
            ModelFactory $modelCollection)
    {
        $this->_modelCollection = $modelCollection;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                // init model and delete
                $this->_modelCollection->create()->load($id)->delete();
                // display success message
                $this->messageManager->addSuccess(__('The Data has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit',
                                ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find Data to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }

}
