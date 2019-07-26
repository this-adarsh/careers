<?php
/**
 * @author Created by Adarsh Shukla.
 * Date: 12/3/19
 */
namespace Study\M23\Model\ResourceModel;

class Careers extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_init('careers', 'id');
    }
}
