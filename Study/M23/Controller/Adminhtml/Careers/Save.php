<?php
/**
 * @author Created by Adarsh Shukla.
 * Date: 12/3/19
 */
namespace Study\M23\Controller\Adminhtml\Careers;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Study\M23\Model\CareersFactory as ModelFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\TestFramework\Inspection\Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\RequestInterface;



class Save extends \Magento\Backend\App\Action
{
    /**
     * Scope configuration
     */
    protected $scopeConfig;
   
    /**
     * 
     */
    protected $inlineTranslation;
    /**
     * 
     */
    protected $_modelCollection;
    /**
     * @param Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        ModelFactory $modelCollection

    ) {
        $this->dataPersistor = $dataPersistor;
        $this->scopeConfig = $scopeConfig;
        $this->inlineTranslation = $inlineTranslation;
        $this->_modelCollection = $modelCollection;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('id');

            if (empty($data['id'])) {
                $data['id'] = null;
            }
                    
            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->_modelCollection->create()->load($id);
            
            if (!$model->getId() && $id) {
                $this->messageManager->addError(__('This no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            $model->setData($data);

            $this->inlineTranslation->suspend();
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Data Saved successfully'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
