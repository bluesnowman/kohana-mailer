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

namespace Ziminji\Core {

	/**
	 * This class represents an email attachment.
	 *
	 * @access public
	 * @class
	 * @package Ziminji\Core
	 * @version 2015-09-21
	 *
	 * @see http://msdn.microsoft.com/en-us/library/system.net.mail.attachment.aspx
	 */
	class Attachment extends \Ziminji\Core\DataSource {

		/**
		 * This variable stores the name of the attachment.
		 *
		 * @access protected
		 * @var string
		 */
		protected $name = null;

		/**
		 * This constructor instantiates the class with the contents of the specified
		 * data source.
		 *
		 * @access public
		 * @param enum $type                                        the data source type (e.g. data, file,
		 *                                                          string, url)
		 * @param mixed $source                                     the data source
		 * @param string $name                                      the name of the attachment
		 */
		public function __construct($type, $source, $name) {
			parent::__construct($type, $source);
			$this->name = basename($name);
		}

		/**
		 * This function provides read-only access to certain properties.
		 *
		 * @access public
		 * @param string $key                                       the name of the property
		 * @return string                                           the value of the property
		 * @throws \Ziminji\Core\Throwable\InvalidProperty\Exception indicates that the specified property is
		 *                                                          either inaccessible or undefined
		 */
		public function __get($key) {
			switch ($key) {
				case 'name':
					return $this->name;
				case 'contents':
					return $this->contents;
				case 'data':
					return chunk_split(base64_encode($this->contents));
				case 'encoding':
					return $this->encoding;
				case 'mime':
					return $this->mime;
				case 'type':
					return $this->type;
				default:
					throw new \Ziminji\Core\Throwable\InvalidProperty\Exception('Message: Unable to get the specified property. Reason: Property :key is either inaccessible or undefined.', array(':key' => $key));
			}
		}

	}

}