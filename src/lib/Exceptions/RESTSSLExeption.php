<?php

/**
 * REST SSL Exception
 *
 * Exception used for REST SSL related errors
 * 
 * @author Robert Main
 * @package Communique\Exceptions
 * @category Exception
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace Communique\Exceptions;

/**
 *
 * Exception
 *
 * This exception is thrown for errors related to SSL such as certificate errors, key errors etc.
 * 
 */
class RESTSSLException extends RESTException{
	/**
	 * Constructor for REST SSL Exception
	 * @param String $message A human readable description of the exception
	 */
	public function __construct($message){
		parent::__construct($message);
	}
}