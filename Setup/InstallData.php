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
 * @copyright Swift Otter Studios, 10/4/16
 * @package default
 **/
namespace TylerSchade\Contacts\Setup;

class InstallData implements \Magento\Framework\Setup\InstallDataInterface
{
    protected $contactFactory;

    public function __construct(\TylerSchade\Contacts\Model\ContactFactory $contactFactory)
    {
        $this->contactFactory = $contactFactory;
    }

    public function install(\Magento\Framework\Setup\ModuleDataSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $contact = $this->contactFactory->create();

        $contact->setData('contact_name', 'Tyler Schade');
        $contact->setData('user_id', 1);
        $contact->save();
    }
}
