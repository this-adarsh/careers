<?php

/**
 * Description of Topmenu
 *
 * @author ranosys
 */

namespace Study\M23\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Event\ObserverInterface;
use \Magento\Store\Model\StoreManagerInterface;
use \Study\M23\Helper\Data;

class Topmenu implements ObserverInterface {

    /**
     *
     * @var type $_storemanager
     */
    private $_storeManager;

    /**
     *
     * @var type helper
     */
    private $_helper;

    /**
     * 
     * @param \Study\M23\Observer\StoreManagerInterface $storeManager
     * @param \Study\M23\Observer\data $helper
     */
    public function __construct(StoreManagerInterface $storeManager, Data $helper) {
        $this->_storeManager = $storeManager;
        $this->_helper = $helper;
    }

    /**
     * 
     * @param EventObserver $observer
     * @return $this
     */
    public function execute(EventObserver $observer) {
        $status = $this->_helper->getGeneralConfig('enable');
        if ($status == true) {
            /** @var \Magento\Framework\Data\Tree\Node $menu */
            $menu = $observer->getMenu();
            $tree = $menu->getTree();
            $data = [
                'name' => __('Careers'),
                'id' => 'Careers',
                'url' => $this->getBaseUrl() . 'careers',
                'is_active' => (false)
            ];
            $node = new Node($data, 'id', $tree, $menu);
            $menu->addChild($node);
            return $this;
        }
    }

    /**
     * returns base url
     * @return type string
     */
    public function getBaseUrl() {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
    }

}
