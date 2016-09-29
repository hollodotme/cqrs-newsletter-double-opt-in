<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Bridges;

use IceHawk\IceHawk\Interfaces\HandlesGetRequest;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;
use PHPinDD\CqrsNewsletter\Env;

/**
 * Class AbstractGetRequestHandler
 * @package PHPinDD\CqrsNewsletter\Bridges
 */
abstract class AbstractGetRequestHandler implements HandlesGetRequest
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	final public function handle( ProvidesReadRequestData $request )
	{
		$this->handleRequest( $request, $this->env );
	}

	abstract public function handleRequest( ProvidesReadRequestData $request, Env $env );
}
