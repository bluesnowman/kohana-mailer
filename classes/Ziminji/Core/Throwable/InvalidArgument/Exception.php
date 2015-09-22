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

namespace Ziminji\Core\Throwable\InvalidArgument {

	/**
	 * This class indicates that an argument does not match with the expected value.
	 *
	 * @access public
	 * @class
	 * @package Leap\Core\Throwable
	 * @version 2015-09-21
	 */
	class Exception extends \InvalidArgumentException implements \Ziminji\Core\IObject {

		/**
		 * This variable stores the code associated with the exception.
		 *
		 * @access protected
		 * @var int
		 */
		protected $code;

		/**
		 * This constructor creates a new invalid argument exception.
		 *
		 *     throw new Throwable\Runtime\Exception('Unable to find :uri', array(':uri' => $uri));
		 *
		 * @access public
		 * @param string $message                                   the error message
		 * @param array $variables                                  translation variables
		 * @param integer $code                                     the exception code
		 */
		public function __construct($message, array $variables = null, $code = 0) {
			parent::__construct(
				empty($variables) ? (string) $message : strtr( (string) $message, $variables),
				(int) $code
			);
			$this->code = (int) $code; // Known bug: http://bugs.php.net/39615
		}

		/**
		 * This method dumps information about the object.
		 *
		 * @access public
		 */
		public function __debug() {
			var_dump($this);
		}

		/**
		 * This method releases any internal references to an object.
		 *
		 * @access public
		 */
		public function __destruct() {
			unset($this->code);
		}

		/**
		 * This method returns whether the specified object is equal to the called object.
		 *
		 * @access public
		 * @param \Leap\Core\IObject $object                        the object to be evaluated
		 * @return boolean                                          whether the specified object is equal
		 *                                                          to the called object
		 */
		public function __equals($object) {
			return (($object !== NULL) && ($object instanceof \Leap\Core\Throwable\InvalidArgument\Exception) && ((string) serialize($object) == (string) serialize($this)));
		}

		/**
		 * This method returns the name of the runtime class of this object.
		 *
		 * @access public
		 * @return string                                           the name of the runtime class
		 */
		public function __getClass() {
			return get_called_class();
		}

		/**
		 * This method returns the current object's hash code.
		 *
		 * @return string                                           the current object's hash code
		 */
		public function __hashCode() {
			return spl_object_hash($this);
		}

		/**
		 * This method returns the exception as a string.
		 *
		 * @access public
		 * @return string                                           a string representing the exception
		 */
		public function __toString() {
			return \Leap\Core\Throwable\Runtime\Exception::text($this);
		}

	}

}