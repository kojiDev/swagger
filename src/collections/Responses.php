<?php
namespace gossi\swagger\collections;

use gossi\swagger\parts\ExtensionPart;
use phootwork\collection\CollectionUtils;
use phootwork\collection\Map;
use phootwork\lang\Text;
use phootwork\lang\Arrayable;
use gossi\swagger\Response;

class Responses implements Arrayable {
	
	use ExtensionPart;
	
	/** @var Map */
	private $responses;
	
	public function __construct($contents = null) {
		$this->parse($contents === null ? new Map() : $contents);
	}
	
	private function parse($contents) {
		$data = CollectionUtils::toMap($contents);

		// responses
		$this->responses = new Map();
		foreach ($data as $r => $response) {
			if (!Text::create($r)->startsWith('x-')) {
				$this->responses->set(new Response($r, $response));
			}
		}
		
		// extensions
		$this->parseExtensions($data);
	}
	
	public function toArray() {
		return array_merge($this->responses->toArray(), $this->getExtensions()->toArray());
	}
	
	/**
	 * Returns whether the given response exists
	 * 
	 * @param string $code
	 * @return boolean
	 */
	public function has($code) {
		return $this->responses->has($code);
	}
	
	/**
	 * Returns whether the given response exists
	 * 
	 * @param Response $response
	 * @return boolean
	 */
	public function contains(Response $response) {
		return $this->responses->contains($response);
	}
	
	/**
	 * Returns the reponse info for the given code
	 * 
	 * @param string $code
	 * @return Response
	 */
	public function get($code) {
		return $this->responses->get($code);
	}
	
	/**
	 * Sets the response
	 * 
	 * @param Response $code
	 */
	public function set(Response $response) {
		$this->responses->set($response->getCode(), $response);
	}
	
	/**
	 * Removes the given repsonse
	 * 
	 * @param string $code
	 */
	public function remove($code) {
		$this->responses->remove($code);
	}
}
