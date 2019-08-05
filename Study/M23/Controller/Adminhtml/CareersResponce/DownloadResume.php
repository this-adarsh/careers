<?php

namespace Study\M23\Controller\Adminhtml\CareersResponce;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Filesystem\DirectoryList;
use Study\M23\Model\CareersResponceFactory;

class DownloadResume extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Magento\Framework\App\Response\Http\FileFactory
     */
    protected $_downloader;

    /**
     * @var Magento\Framework\Filesystem\DirectoryList
     */
    protected $_directory;    
    /**
     * @var Study\M23\Model\CareersResponceFactory
     */
    protected $_careersResponceFactory;        

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context,PageFactory $resultPageFactory,FileFactory $fileFactory,DirectoryList $directoryList,CareersResponceFactory $careersResponceFactory) {
        $this->_downloader =  $fileFactory;
        $this->_directory = $directoryList;        
        $this->_careersResponceFactory = $careersResponceFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);        
    }   

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {   
        $id = $this->getRequest()->getParam('id');
        $model = $this->_careersResponceFactory->create()->load($id);
        $fileName = $model->getData('resume');
        $extension = pathinfo($fileName)['extension'];
        $applicantName = $model->getData('name')."'s_resume.".''.$extension;
        return $this->_downloader->create(
            $applicantName,
            @file_get_contents(file_get_contents(str_replace(" ", "_", $fileName)))
        );
    }
}
