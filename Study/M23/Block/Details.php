<?php

namespace Study\M23\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Study\M23\Helper\Data;
use Study\M23\Model\CareersFactory as ModelFactory;

class Details extends Template {

    public function __construct(Context $context, Data $helperData, ModelFactory $modelCollection) {
        $this->helperData = $helperData;
        $this->_modelCollection = $modelCollection;
        parent::__construct($context);
    }

    public function getBackgroundColor() {
        return $this->helperData->getGeneralConfig('bg_color');
    }

    public function getVacencyDetails() {
        $id = $this->getRequest()->getParams('id');
        $data = $this->_modelCollection->create()->load($id)->getData();
        return $data;
    }

}
