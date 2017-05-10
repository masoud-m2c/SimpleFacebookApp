<?php
namespace App\Library;

class Input {
	/**
	* Fetch an item from the GET array
	* @param  string
	* @param  boolean
	* @return string
	*/
	function get($index = NULL, $sanitize_string = FALSE) {
		// Check if a field has been provided
		if ($index === NULL AND ! empty($_GET)) {
			$get = array();

			// loop through the full _GET array
			foreach (array_keys($_GET) as $key) {
				$get[$key] = $this->_fetch_from_array($_GET, $key, $sanitize_string);
			}
			return $get;
		}
		return $this->_fetch_from_array($_GET, $index, $sanitize_string);
	}

	/**
	* Fetch an item from the POST array
	* @param  string
	* @param  boolean
	* @return string
	*/
	function post($index = NULL, $sanitize_string = FALSE) {
		// Check if a field has been provided
		if ($index === NULL AND ! empty($_POST)) {
			$post = array();

			// Loop through the full _POST array and return it
			foreach (array_keys($_POST) as $key) {
				$post[$key] = $this->_fetch_from_array($_POST, $key, $sanitize_string);
			}
			return $post;
		}
		return $this->_fetch_from_array($_POST, $index, $sanitize_string);
	}

	/**
	 * This is a helper function to retrieve values from global arrays
	 * @param  array
	 * @param  string
	 * @param  boolean
	 * @return string
	 */
	function _fetch_from_array(&$array, $index = '', $sanitize_string = FALSE) {
		if ( ! isset($array[$index])) {
			return FALSE;
		}

		if ($sanitize_string === TRUE) {
			return filter_var($array[$index], FILTER_SANITIZE_STRING);
		}

		return $array[$index];
	}
}