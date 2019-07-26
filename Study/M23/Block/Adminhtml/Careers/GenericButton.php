<?php

/**
 * @author Created by Adarsh Shukla.
 * Date: 12/3/19
 */

namespace Study\M23\Block\Adminhtml\Careers;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{

    /**
     * @var Context
     */
    protected $context;

    /**
     * @param Context $context
     * @param BlockRepositoryInterface $blockRepository
     */
    public function __construct(
    Context $context
    )
    {
        $this->context = $context;
    }

    /**
     * Return CMS block ID
     *
     * @return int|null
     */
    public function getBlockId()
    {
        return null;
    }

    /**
     * Generate URL by route and parameters
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '',
            $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route,
                        $params);
    }

}
