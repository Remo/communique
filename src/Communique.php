<?php

/**
 * Communique
 *
 * A pluggable, flexible REST client
 * 
 * @author Robert Main
 * @package Communique
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

namespace Communique;

use \Curl;

/**
 * Communique
 *
 * A pluggable, flexible REST client.
 * 
 */
class Communique{

	/**
	 * The base path of the API. All other API paths will be used relative to this
	 * @var String
	 */
	private $_BASE_URL;

	/**
	 * An array of interceptors used for processing the requests
	 * @var String
	 */
	private $_interceptors = array();

	/**
	 * Instance of an HTTP client
	 * @var \Communique\HTTPClient
	 */
	private $_http;

	/**
	 * Constructs Communique REST library.
	 * @param String $base_url The base URL of the API you wish to make requests to. All other paths referenced will be treated as relative to this. For example, for facebook this would be http://graph.facebook.com.
	 * @param array $interceptors An array of any interceptors you wish to use to modify the request. An interceptor could do anything from JSON parsing to OAuth request signing.
	 * @param \Communique\HTTPClient $http_client The HTTP client you wish to make the request with
	 */
	public function __construct($base_url = '', array $interceptors = array(), \Communique\HTTPClient $http_client){
		$this->_BASE_URL = $base_url;
		$this->_interceptors = $interceptors;
		if($http_client == null){
			$this->_http = new \Communique\CURLHTTPClient();
		} else {
			$this->_http = $http_client;
		}
	}

	/**
	 * Makes the HTTP request using the HTTP client passed into the constructor(defaults to cURL).
	 * @param  RESTClientRequest $request A RESTClientRequest object encapsulating the request
	 * @return RESTClientResponse A RESTClientResponse object encapsulating the response
	 * @todo bubble the request and response through the interceptors
	 */
	private function _call(\Communique\RESTClientRequest $request){
		return $this->_http->request($request);
	}

	/**
	 * Make an HTTP GET request
	 * @param  String $url     The API to make the request to
	 * @param  array  $headers Any headers you want to add to the request(optional)
	 * @param  function $debug A function to be used for request debugging. 
	 * This function should accept two parameters, one for the request object one for the response object.
	 * @return \Communique\RESTClientResponse  REST response encapsulation object
	 */
	public function get($url, array $headers = array(), $debug = null){
		$request = new \Communique\RESTClientRequest('get', $this->_BASE_URL . $url, null, $headers);
		return $this->_call($request);
	}

	/**
	 * Make an HTTP PUT request
	 * @param  String $url     The API to make the request to
	 * @param  array  $payload The payload of the request(any data you wish to send across)
	 * @param  array  $headers Any headers you want to add to the request(optional)
	 * @param  function $debug A function to be used for request debugging. 
	 * This function should accept two parameters, one for the request object one for the response object.
	 * @return \Communique\RESTClientResponse  REST response encapsulation object
	 */
	public function put($url, array $payload, array $headers = array(), $debug = null){
		$request = new \Communique\RESTClientRequest('put', $this->_BASE_URL . $url, $payload, $headers);
		return $this->_call($request);
	}

	/**
	 * Make an HTTP POST request
	 * @param  String $url     The API to make the request to
	 * @param  array  $payload The payload of the request(any data you wish to send across)
	 * @param  array  $headers Any headers you want to add to the request(optional)
	 * @param  function $debug A function to be used for request debugging. 
	 * This function should accept two parameters, one for the request object one for the response object.
	 * @return \Communique\RESTClientResponse  REST response encapsulation object
	 */
	public function post($url, array $payload, array $headers = array(), $debug = null){
		$request = new \Communique\RESTClientRequest('post', $this->_BASE_URL . $url, $payload, $headers);
		return $this->_call($request);
	}

	/**
	 * Make an HTTP DELETE request
	 * @param  String $url     The API to make the request to
	 * @param  array  $payload The payload of the request(any data you wish to send across)
	 * @param  array  $headers Any headers you want to add to the request(optional)
	 * @param  function $debug A function to be used for request debugging. 
	 * This function should accept two parameters, one for the request object one for the response object.
	 * @return \Communique\RESTClientResponse  REST response encapsulation object
	 */
	public function delete($url, array $payload, array $headers = array(), $debug = null){
		$request = new \Communique\RESTClientRequest('delete', $this->_BASE_URL . $url, $payload, $headers);
		return $this->_call($request);
	}
}