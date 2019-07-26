<?php

namespace Study\M23\Controller\Adminhtml\Careers;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context,PageFactory $resultPageFactory) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }   

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {   
         /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Study_M23::careers');
        $resultPage->addBreadcrumb(__('Careers Listings'), __('Careers Listings'));
        $resultPage->addBreadcrumb(__('Manage Careers Listings'), __('Manage Careers Listings'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Careers Listings'));
        return $resultPage;
    }
}
