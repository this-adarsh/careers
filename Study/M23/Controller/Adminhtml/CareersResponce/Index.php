<?php

namespace Study\M23\Controller\Adminhtml\CareersResponce;

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
        $resultPage->addBreadcrumb(__('Careers Listings'), __('Careers responce Listings'));
        $resultPage->addBreadcrumb(__('Manage Careers Listings'), __('Manage Careers responce Listings'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Careers responce Listings'));
        return $resultPage;
    }
}
