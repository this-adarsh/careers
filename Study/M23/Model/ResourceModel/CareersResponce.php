<?php
/**
 * @author Created by Adarsh Shukla.
 * Date: 12/3/19
 */
namespace Study\M23\Model\ResourceModel;

class CareersResponce extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Construct
     */
    protected function _construct()
    {
        $this->_init('careersresponce', 'id');
    }
}
