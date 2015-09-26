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
	 * This class handles subscriptions via the specified mail service.
	 *
	 * @access public
	 * @class
	 * @package Ziminji\Core
	 * @version 2015-09-21
	 */
	class Subscriber extends \Ziminji\Core\Object {

		/**
		 * This variable stores the configuration settings.
		 *
		 * @access protected
		 * @var array
		 */
		protected $config = array();

		/**
		 * This variable stores an instance of the specified driver class.
		 *
		 * @access protected
		 * @var \Ziminji\Core\ISubscriber
		 */
		protected $driver = null;

		/**
		 * This constructor initializes the driver specified in the configuration array.
		 *
		 * @access public
		 * @param array $config                                     the configuration array
		 * @throws \Ziminji\Core\Throwable\InvalidProperty\Exception indicates that a property is invalid
		 * @throws \Ziminji\Core\Throwable\ClassCast\Exception      indicates that driver is not a subscriber
		 */
		public function __construct($config = array()) {
			// Loads configurations
			if (empty($config)) {
				$group = 'Mailer.default';
				if (($this->config = \Ziminji\Core\Config::query($group)) === null) {
					throw new \Ziminji\Core\Throwable\InvalidProperty\Exception('Undefined group :group', array(':group' => $group));
				}
			}
			else {
				if (is_string($config)) {
					$group = 'Mailer.' . $config;
					if (($this->config = \Ziminji\Core\Config::query($group)) === null) {
						throw new \Ziminji\Core\Throwable\InvalidProperty\Exception('Undefined group :group', array(':group' => $group));
					}
				}
				else {
					$this->config = $config;
				}
			}

			// Sets the driver class name
			$driver = '\\Ziminji\\Plugin\\' . $this->config['driver'] . '\\Subscriber';

			// Initializes the driver
			$this->driver = new $driver($this->config);

			// Validates the driver
			if (!($this->driver instanceof \Ziminji\Core\ISubscriber)) {
				throw new \Ziminji\Core\Throwable\ClassCast\Exception('Cannot cast class :class to interface :interface', array(':class' => $driver, ':interface' => 'ISubscriber'));
			}
		}

		/**
		 * This function will set the mailing list.
		 *
		 * @access public
		 * @param string $mailing_list                              the key used to identify the mailing
		 *                                                          list
		 */
		public function set_mailing_list($mailing_list) {
			$this->driver->set_mailing_list($mailing_list);
		}

		/**
		 * This function sets the subscriber's email and related data.
		 *
		 * @access public
		 * @param string $email                                     the subscriber's email address
		 * @param array $data                                       the data to be sent (e.g. first_name,
		 *                                                          last_name, address_1, address_2, city,
		 *                                                          state, postal_code, country, phone)
		 */
		public function set_subscriber($email, $data = null) {
			$this->driver->set_subscriber($email, $data);
		}

		/**
		 * This function sets the content type for the email.
		 *
		 * @access public
		 * @param string $mime                                      the content type (either "multipart/mixed",
		 *                                                          "text/html", or "text/plain")
		 */
		public function set_content_type($mime) {
			$this->driver->set_content_type($mime);
		}

		/**
		 * This function will cause a notification email to be sent upon success.
		 *
		 * @access public
		 * @param boolean $send                                     whether a notification email should be sent
		 * @param \Ziminji\Core\IMailer $mailer                     the mail service to be used
		 */
		public function do_notify($send, \Ziminji\Core\IMailer $mailer = null) {
			$this->driver->do_notify($send, $mailer);
		}

		/**
		 * This function will attempt to subscribe the recipient(s) to the specified mailing list.
		 *
		 * @access public
		 * @param boolean $force                                    whether the email address should be
		 *                                                          forcibly added to the specified mailing
		 *                                                          list
		 * @return boolean                                          whether the email address was successfully
		 *                                                          added to the specified mailing list
		 */
		public function subscribe($force = false) {
			return $this->driver->subscribe($force);
		}

		/**
		 * This function will unsubscribe the specified email address from the specified mailing list.
		 *
		 * @access public
		 * @param boolean $delete                                   whether to delete the subscription
		 *                                                          completely
		 * @return boolean                                          whether the subscriber was unsubscribed
		 */
		public function unsubscribe($delete = false) {
			return $this->driver->unsubscribe($delete);
		}

		/**
		 * This function returns the last error reported.
		 *
		 * @access public
		 * @return array                                            the last error reported
		 */
		public function get_error() {
			return $this->driver->get_error();
		}

	}

}