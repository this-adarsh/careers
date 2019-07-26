<?php

namespace Study\M23\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Study\M23\Model\CareersResponceFactory as ModelFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Notification\NotifierInterface as NotifierPool;

class SubmitForm extends Action 
{

    /**
     * Notifier Pool
     *
     * @var NotifierPool
     */
    protected $notifierPool;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @var \Study\M23\Model\CareersResponceFactory
     */
    protected $_modelCollection;
 
    /**
     * @var \Magento\Framework\Filesystem $filesystem
     */
    protected $filesystem;
 
    /**
     * @var \Magento\MediaStorage\Model\File\UploaderFactory $fileUploader
     */
    protected $fileUploader;

    public function __construct(ModelFactory $modelCollection,Context $context, ManagerInterface $messageManager,Filesystem $filesystem,UploaderFactory $fileUploader, 
        NotifierPool $notifierPool
    ) 
    {
        $this->messageManager       = $messageManager;
        $this->filesystem           = $filesystem;
        $this->fileUploader         = $fileUploader;
        $this->notifierPool = $notifierPool;
        $this->_modelCollection     = $modelCollection;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        parent::__construct($context);
    }    
    
    public function execute() {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $file = $this->getRequest()->getFiles('resume');
        if ( ($data !== null) && ($file !==null) ) {
            try{
                $absolutePath = $this->mediaDirectory->getAbsolutePath('resume/');
                $uploader = $this->fileUploader->create(['fileId' => 'resume']);
                $uploader->setAllowedExtensions(['jpg', 'pdf', 'doc', 'png']);
                $uploader->setAllowCreateFolders(true);
                $uploader->setAllowRenameFiles(true);
                $result = $uploader->save($absolutePath);                    
                if ($result['file']) {
                    $resume= $absolutePath.''.$file['name'];                    
                    $data['resume']=$resume;
                    $data['id'] = null;
                    $model = $this->_modelCollection->create();
                    $model->setData($data);
                    $model->save();
                    $this->notifierPool->addNotice(__($data['name']. " have submitted resume"), __(
                        $data['name'] ." have submitted resume for position of " .$data['position']));
                $this->messageManager->addSuccess(__('Your Request submitted successfully.'));
                
                return $resultRedirect->setPath('*/*/');
                }
            }
            catch (\Exception $e) {
                $this->messageManager->addError(__($e->getMessage()));
                return $resultRedirect->setPath('*/*/');
            }        

        }
        else{
            $this->messageManager->addError("Please fill the form");
            return $resultRedirect->setPath('*/*/');
            }
    }    
}
