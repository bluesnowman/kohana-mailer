<?php

/**
 * Copyright © 2011–2012 Spadefoot Team.
 * Copyright © 2015 Blue Snowman.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Ziminji\Core {

	/**
	 * This class represents the credentials that are sent to a host to authenticate.
	 *
	 * @access public
	 * @class
	 * @package Ziminji\Core
	 * @version 2015-09-21
	 */
	class Credentials extends \Ziminji\Core\Object {

		/**
		 * This variable stores the user name.
		 *
		 * @access protected
		 * @var string
		 */
		protected $username;

		/**
		 * This variable stores the password.
		 *
		 * @access protected
		 * @var string
		 */
		protected $password;

		/**
		 * This constructor creates an instance of this class.
		 *
		 * @access public
		 * @param string $username                                  the user name
		 * @param string $password                                  the password
		 */
		public function __construct($username, $password) {
			$this->username = $username;
			$this->password = $password;
		}

		/**
		 * This function provides read-only access to certain properties.
		 *
		 * @access public
		 * @param string $key                                       the name of the property
		 * @return mixed                                            the value of the property
		 * @throws \Ziminji\Core\Throwable\InvalidProperty\Exception indicates that the specified property is
		 *                                                          either inaccessible or undefined
		 */
		public function __get($key) {
			switch ($key) {
				case 'username':
					return $this->username;
				case 'password':
					return $this->password;
				default:
					throw new \Ziminji\Core\Throwable\InvalidProperty\Exception('Message: Unable to get the specified property. Reason: Property :key is either inaccessible or undefined.', array(':key' => $key));
			}
		}

		/**
		 * This function returns the components as an associated array.
		 *
		 * @access public
		 * @return array                                            the components
		 */
		public function as_array() {
			$array = array(
				'username' => $this->username,
				'password' => $this->password
			);
			return $array;
		}

	}

}