<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Bridges;

use IceHawk\IceHawk\Interfaces\HandlesPostRequest;
use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;
use PHPinDD\CqrsNewsletter\Env;

/**
 * Class AbstractPostRequestHandler
 * @package PHPinDD\CqrsNewsletter\Bridges
 */
abstract class AbstractPostRequestHandler implements HandlesPostRequest
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	final public function handle( ProvidesWriteRequestData $request )
	{
		$this->handleRequest( $request, $this->env );
	}

	abstract public function handleRequest( ProvidesWriteRequestData $request, Env $env );
}
