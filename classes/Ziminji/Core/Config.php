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
	 * This class is used to read a PHP config file.
	 *
	 * @access public
	 * @class
	 * @package Ziminji\Core
	 * @version 2015-09-22
	 */
	class Config extends \Ziminji\Core\Object {

		/**
		 * This variable stores the URI associated with the file resource.
		 *
		 * @access protected
		 * @var string
		 */
		protected $uri;

		/**
		 * This constructor initializes the class with the specified resource.
		 *
		 * @access public
		 * @param string $uri                                       the URI to be processed
		 * @throws \Ziminji\Core\Throwable\InvalidArgument\Exception indicates an invalid argument
		 *                                                          specified
		 * @throws \Ziminji\Core\Throwable\FileNotFound\Exception   indicates the file cannot be
		 *                                                          found
		 */
		public function __construct($uri) {
			if ( ! is_string($uri)) {
				throw new \Ziminji\Core\Throwable\InvalidArgument\Exception('Unable to handle argument. Argument must be a string.', array(':type' => gettype($uri)));
			}

			if ( ! file_exists($uri)) {
				throw new \Ziminji\Core\Throwable\FileNotFound\Exception('Unable to locate file. File ":uri" does not exist.', array(':uri' => $uri));
			}

			$segments = explode('.', $uri);
			$extension = end($segments);
			if ( ! in_array($extension,  array('inc', 'php'))) {
				throw new \Ziminji\Core\Throwable\InvalidArgument\Exception('Unable to process file. Expected file with either "inc" or "php" extension, but got ":extension" as an extension.', array(':extension' => $extension));
			}

			$this->uri = $uri;
		}

		/**
		 * This method releases any internal references to an object.
		 *
		 * @access public
		 */
		public function __destruct() {
			parent::__destruct();
			unset($this->uri);
		}

		/**
		 * This method returns the processed resource as a collection.
		 *
		 * @access public
		 * @return mixed                                            the resource as a collection
		 */
		public function read() {
			return include($this->uri);
		}

		/**
		 * This method return the value for the specified selector from the appropriate
		 * config file.  A selector follows dot syntax, where the first segment represents
		 * the name of the config file and the next segments represent the path to follow
		 * within the collection.
		 *
		 * @access public
		 * @static
		 * @param string $selector                                  the URI to be loaded
		 * @return mixed                                            the queried value found using
		 *                                                          the selector
		 */
		public static function query($selector) {
			$index = strpos($selector, '.');
			if ($index !== FALSE) {
				$file = substr($selector, 0, $index) . '.php';
				$uri = implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), '..', 'Config', $file));
				$config = new self($uri);
				$segments = explode('.', substr($selector, $index + 1));
				if (count($segments) > 0) {
					$element = $config->read();
					foreach ($segments as $segment) {
						if (is_array($element) && array_key_exists($segment, $element)) {
							$element = $element[$segment];
							continue;
						}
						return NULL;
					}
					return $element;
				}
			}
			return NULL;
		}

	}

}