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
 * @copyright Swift Otter Studios, 10/6/16
 * @package default
 **/

namespace TylerSchade\Contacts\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface,
    Magento\Framework\Setup\ModuleContextInterface,
    Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $setup->getConnection()
            ->addColumn(
                $setup->getTable('tylerschade_contacts_contact'),
                'phone_number',
                [
                    'nullable' => true,
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 60,
                    'comment' => 'Phone number'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable('tylerschade_contacts_contact'),
                'first_name',
                [
                    'nullable' => false,
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 100,
                    'after' => 'entity_id',
                    'comment' => 'First name'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable('tylerschade_contacts_contact'),
                'last_name',
                [
                    'nullable' => false,
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 100,
                    'after' => 'first_name',
                    'comment' => 'Last name'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable('tylerschade_contacts_contact'),
                'email_address',
                [
                    'nullable' => false,
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 100,
                    'comment' => 'Email address'
                ]
            );

        $setup->getConnection()
            ->addColumn(
                $setup->getTable('tylerschade_contacts_contact'),
                'birthday',
                [
                    'nullable' => false,
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DATE,
                    'comment' => 'Birthday'
                ]
            );

        $setup->getConnection()
            ->changeColumn(
                $setup->getTable('tylerschade_contacts_contact'),
                'user_id',
                'customer_id',
                [
                    'nullable' => false,
                    'after' => 'entity_id',
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                ]
            );

        $setup->getConnection()->dropColumn($setup->getTable('tylerschade_contacts_contact'), 'contact_name');

        $setup->endSetup();
    }
}