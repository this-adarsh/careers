<?php

namespace Study\M23\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Study\M23\Helper\Data;
use Study\M23\Model\CareersFactory as ModelFactory;

class Careers extends Template {

    public function __construct(Context $context, Data $helperData, ModelFactory $modelCollection) {
        $this->helperData = $helperData;
        $this->_modelCollection = $modelCollection;
        parent::__construct($context);
    }

    public function getStatus() {
        return $this->helperData->getGeneralConfig('enable');
    }

    public function getTitle() {
        return $this->helperData->getGeneralConfig('title');
    }

    public function getAllVacancys() {
        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 6;
            $vacancyCollection = $this->_modelCollection->create()->getCollection()->addFieldToFilter('active', array('eq' => 1));
            $vacancyCollection->setPageSize($pageSize);
            $vacancyCollection->setCurPage($page);
            return $vacancyCollection;
    }

    protected function _prepareLayout() {
        parent::_prepareLayout();
        if ($this->getAllVacancys()) {
            $pager = $this->getLayout()->createBlock(
                    'Magento\Theme\Block\Html\Pager',
                    'Study_M23.Study_M23.record.pager'
            );
            $pager->setAvailableLimit(array(6 => 6, 12 => 12, 18 => 18, 24 => 24, 30 => 30));
            $pager->setCollection(
                    $this->getAllVacancys()
            );
            $this->setChild('pager', $pager);
        }
        return $this;
    }

    public function getPagerHtml() {
        return $this->getChildHtml('pager');
    }

}
