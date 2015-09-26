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

namespace Ziminji\Plugin\Gmail {

	include_once(Kohana::find_file('vendor', 'PHPMailer/PHPMailerDriver', $ext = 'php'));

	/**
	 * This class send emails via the Gmail mail service.
	 *
	 * @access public
	 * @class
	 * @package Ziminji\Plugin\Gmail
	 * @version 2015-09-25
	 */
	class Mailer extends \PHPMailer\Driver implements \Ziminji\Core\IMailer {

		/**
		 * This constructor initializes the driver for this mail service.
		 *
		 * @access public
		 * @param array $config                                     the configuration array
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
		public function set_options(array $options) {
			// does nothing
		}

	}

}