<?php

namespace Study\M23\Controller\Adminhtml\Careers;

use Magento\Backend\App\Action;
use Study\M23\Model\CareersFactory as ModelFactory;

class Edit extends \Magento\Backend\App\Action
{
    protected $_modelCollection;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        ModelFactory $modelCollection
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_modelCollection = $modelCollection;
        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Study_M23::careers')
            ->addBreadcrumb(__('Careers Listings'), __('Careers Listings'))
            ->addBreadcrumb(__('Manage Careers Listings'), __('Manage Careers Listings'));
        return $resultPage;
    }

    /**
     * Edit CMS page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
                
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $model = $this->_modelCollection->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This record no longer exists.'));
                /** \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        // 4. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Career Detail') : __('New Career Detail'),
            $id ? __('Edit Career Detail') : __('New Career Detail')
        );
        $resultPage->getConfig()->getTitle()->prepend(__(''));
        $resultPage->getConfig()->getTitle()
            ->prepend($model->getId() ? __('Edit "%1" %2', $model->getPosition(),' Job Detail') : __('New Career Detail'));
        return $resultPage;
    }
}
