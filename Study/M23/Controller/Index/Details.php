<?php

namespace Study\M23\Controller\Index;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\App\Action\Action;
use Study\M23\Helper\Data;
use Magento\Framework\App\Action\Context;
use Study\M23\Model\CareersFactory as ModelFactory;

class Details extends Action {

    public function __construct(Data $helper, Context $context, ModelFactory $modelCollection) {
        $this->_helper = $helper;
        $this->_modelCollection = $modelCollection;
        parent::__construct($context);
    }

    public function execute() {
        $status = $this->_helper->getGeneralConfig('enable');
        if ($status == true) {
            $this->_view->loadLayout();
            $this->_view->renderLayout();
        } else {
            throw new NotFoundException(__('Parameter is incorrect.'));
        }
    }

}
