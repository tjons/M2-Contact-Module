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
 * @copyright Swift Otter Studios, 10/1/16
 * @package default
 **/

namespace TylerSchade\Contacts\Model;

use \Magento\FrameWork\Model\AbstractModel;

class Contact extends AbstractModel implements ContactInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_KEY = 'tylerschade_contact_model';

    protected $url;

    public function __construct(
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->url = $url;

        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    protected function _construct()
    {
        $this->_init('TylerSchade\Contacts\Model\ResourceModel\Contact');
    }

    public function getIdentities()
    {
        return [self::CACHE_KEY . "_$this->getId()"];
    }

    public function getFirstName() : string
    {
        return (string) $this->getData('first_name');
    }

    public function getLastName() : string
    {
        return (string) $this->getData('last_name');
    }

    public function getEmailAddress() : string
    {
        return (string) $this->getData('email_address');
    }

    public function getPhoneNumber() : string
    {
        $rawPhoneNumber = (string) $this->getData('phone_number');
        $segments = [];
        preg_match('/([0-9]{3})([0-9]{3})([0-9]{4})/', $rawPhoneNumber, $segments);

        return "({$segments[1]}) {$segments[2]}-{$segments[3]}";
    }

    public function getRawPhoneNumber() : int
    {
        return (int) $this->getData('phone_number');
    }

    public function getBirthday() : string
    {
        return (string) $this->getData('birthday');
    }

    public function getUrl() : string
    {
        return $this->url->getUrl('contakt/view/contact/', ['id' => $this->getId()]);
    }
}