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
 * @copyright Swift Otter Studios, 10/7/16
 * @package default
 **/

namespace TylerSchade\Contacts\Block;

use \Magento\Framework\View\Element\Template;

abstract class AbstractBlock extends Template
{
    protected $session;

    public function __construct(
        Template\Context $context,
        array $data,
        \Magento\Customer\Model\Session $session
    ) {
        $this->session = $session;

        parent::__construct($context, $data);
    }

    public function getIsLoggedIn() : bool
    {
        return (bool) $this->session->isLoggedIn();
    }

    public function getLoginUrl() : string
    {
        return $this->getUrl('customer/account/login');
    }
}