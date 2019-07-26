<?php

namespace Study\M23\Model\ResourceModel\Careers;

use Study\M23\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Study\M23\Model\Careers', 'Study\M23\Model\ResourceModel\Careers');
        $this->_map['fields']['id'] = 'main_table.id';
    }
}
