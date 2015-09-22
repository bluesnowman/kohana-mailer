<?php

/**
 * Copyright © 2011–2015 Spadefoot Team.
 *
 * Unless otherwise noted, Leap is licensed under the Apache License,
 * Version 2.0 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License
 * at:
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Ziminji\Core\Mailer {

	include_once(Kohana::find_file('vendor', 'PHPMailer/PHPMailerDriver', $ext = 'php'));

	/**
	 * This class send emails via the Gmail mail service.
	 *
	 * @access public
	 * @class
	 * @package Ziminji\Core\Mailer
	 * @version 2015-09-21
	 */
	class Gmail extends \PHPMailer\Driver implements Base_Mailer_Interface {

		/**
		 * This constructor initializes the driver for this mail service.
		 *
		 * @access public
		 * @param array $config the configuration array
		 * @return Mailer_Interface              an instance of the driver class
		 */
		public function __construct($config) {
			parent::__construct($config['uri']['host'], $config['uri']['port'], $config['credentials']);
		}

		/**
		 * This function provides a way to pass specific options to the mail service.
		 *
		 * @access public
		 * @param array $options any special options for the mail service
		 */
		public function set_options(Array $options) {
			// does nothing
		}

	}

}