<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 3.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
namespace Cake\Network\Http;

/**
 * Implements methods for HTTP responses
 *
 * ### Get header values
 *
 * ### Get the response body
 *
 * ### Check the status code
 *
 */
class Response {

	const STATUS_OK = 200;

/**
 * The status code of the response.
 *
 * @var int
 */
	protected $_code;

/**
 * The array of headers in the response.
 *
 * @var array
 */
	protected $_headers;

/**
 * The response content
 *
 * @var string
 */
	protected $_content;

/**
 * Constructor
 *
 * @param array $headers Unparsed headers.
 * @param string $content The response body.
 */
	public function __construct($headers, $content) {
		$this->_parseHeaders($headers);
		$this->_content = $content;
	}

/**
 * Parses headers if necessary.
 *
 * @param array $headers
 */
	protected function _parseHeaders($headers) {
		foreach ($headers as $key => $value) {
			if (substr($value, 0, 5) === 'HTTP/') {
				preg_match('/HTTP\/[\d.]+ ([0-9]+)/i', $value, $matches);
				$this->_code = $matches[1];
				continue;
			}
			if (is_int($key)) {
				list($name, $value) = explode(':', $value, 2);
				$this->_headers[$name] = $value;
				continue;
			}
		}
	}

/**
 * Check if the response was OK
 *
 * @return boolean
 */
	public function isOk() {
		return $this->_code == static::STATUS_OK;
	}

/**
 * Check if the response had a redirect status code.
 *
 * @return boolean
 */
	public function isRedirect() {
		return (
			in_array($this->_code, array(301, 302, 303, 307)) &&
			$this->header('Location')
		);
	}

/**
 * Get the status code from the response
 *
 * @return int
 */
	public function statusCode() {
		return $this->_code;
	}

/**
 * Get the encoding if it was set.
 *
 * @return string
 */
	public function encoding() {
	}

/**
 * Read single/multiple header value(s) out.
 *
 * @param string $name The name of the header you want. Leave 
 *   null to get all headers.
 * @return null|string
 */
	public function header($name = null) {
		if ($name === null) {
			return $this->_headers;
		}
		return $this->_headers[$name];
	}

	public function content($content) {
		return $this->_content;
	}

}
