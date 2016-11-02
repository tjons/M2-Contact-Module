<?php
/**
 * SwiftOtter_Base is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SwiftOtter_Base is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with SwiftOtter_Base. If not, see <http://www.gnu.org/licenses/>.
 *
 * Copyright: 2013 (c) SwiftOtter Studios
 *
 * @author Tyler Schade
 * @copyright Swift Otter Studios, 10/18/16
 * @package default
 **/

namespace TylerSchade\Contacts\Controller\Add;

use Braintree\Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Message\ManagerInterface;

class Submit extends Action
{
    protected $contactFactory;
    protected $messages;
    protected $pageFactory;
    protected $session;

    public function __construct(
        Context $context,
        \TylerSchade\Contacts\Model\ContactFactory $contactFactory,
        ManagerInterface $messages,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Customer\Model\Session $session
    ){
        $this->contactFactory = $contactFactory;
        $this->messages = $messages;
        $this->pageFactory = $pageFactory;
        $this->session = $session;

        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $contactModel = $this->contactFactory->create()
            ->setData($data);

        $contactModel->setData('customer_id', $this->session->getCustomerId());

        try {
            $contactModel->save();
        } catch (Exception $e) {
            $this->messages->addErrorMessage($e->getMessage());

            return $this->pageFactory->create('*/*/newContact');
        }

        $this->messages->addSuccessMessage(__('The contact record was created.'));

        return $this->resultRedirectFactory->create()->setPath('*/');
    }
}