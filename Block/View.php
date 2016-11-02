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
 * @copyright Swift Otter Studios, 10/5/16
 * @package default
 **/

namespace TylerSchade\Contacts\Block;

use TylerSchade\Contacts\Model\Contact;
use TylerSchade\Contacts\Model\ResourceModel\Contact\Collection;

class View extends AbstractBlock
{
    protected $contactFactory;
    protected $contactsCollection;

    public function __construct(
        array $data,
        \Magento\Framework\View\Element\Template\Context $context,
        \TylerSchade\Contacts\Model\ContactFactory $factory,
        \TylerSchade\Contacts\Model\ResourceModel\Contact\Collection $collection,
        \Magento\Customer\Model\Session $session
    ) {
        $this->contactFactory = $factory;
        $this->contactsCollection = $collection;
        
        parent::__construct($context, $data, $session);
    }
    
    public function getCollection()
    {
        return $this->contactsCollection;
    }
    
    protected function _prepareLayout()
    {
        $contactModel = $this->contactFactory->create();
        
        $this->contactsCollection = $contactModel->getCollection();

        $this->contactsCollection
            ->addCustomerFilter()
            ->load();
    }
}