<?php
namespace Waqas\FreeShippingBar\Controller\Adminhtml\Entity;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

/**
 * Class NewAction
 * @package Waqas\FreeShippingBar\Controller\Adminhtml\Entity
 */
class NewAction extends \Waqas\FreeShippingBar\Controller\Adminhtml\Entity implements HttpGetActionInterface
{
    /**
     * @return void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
