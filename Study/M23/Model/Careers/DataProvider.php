<?php

/**
 * @author Created by Adarsh Shukla.
 * Date: 12/3/19
 */

namespace Study\M23\Model\Careers;

use Study\M23\Model\ResourceModel\Careers\CollectionFactory;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider {

    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;
    protected $loadedData;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            CollectionFactory $CollectionFactory,
            array $meta = [],
            array $data = []
    ) {
        $this->collection = $CollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData() {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        /** @var \Magento\Cms\Model\Block $block */
        foreach ($items as $block) {
            if (($block->getId() !== null)) {
                $this->loadedData[$block->getId()] = $block->getData();
                //$temp = $block->getData();
            }
        }

        return $this->loadedData;
    }

}
