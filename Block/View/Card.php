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
 * @copyright Swift Otter Studios, 10/19/16
 * @package default
 **/

namespace TylerSchade\Contacts\Block\View;

use \Magento\Framework\View\Element\Template;

class Card extends Template
{
    protected $contact;
    protected $contactFactory;

    public function __construct(
        Template\Context $context,
        array $data,
        \TylerSchade\Contacts\Model\ContactFactory $contactFactory
    ) {
        $this->contactFactory = $contactFactory;

        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        $this->assignContact();
    }

    public function getContact() : \TylerSchade\Contacts\Model\Contact
    {
        return $this->contact;
    }

    protected function assignContact()
    {
        $contactId = $this->getRequest()->getParam('id');
        $contact = $this->contactFactory->create();

        $this->contact = $contact->load($contactId);
    }
}