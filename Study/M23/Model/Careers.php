<?php
/**
 * @author Created by Adarsh Shukla.
 * Date: 12/3/19
 */
namespace Study\M23\Model;

class Careers extends \Magento\Framework\Model\AbstractModel
{

    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('Study\M23\Model\ResourceModel\Careers');
    }

    /**
     * @return array
     */
    public function getAvailableStatuses()
    {
        $availableOptions = ['1' => 'Enable', '0' => 'Disable'];
        return $availableOptions;
    }
}
