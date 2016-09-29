<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application;

use IceHawk\IceHawk\Defaults\Traits\DefaultEventSubscribing;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalReadResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultFinalWriteResponding;
use IceHawk\IceHawk\Defaults\Traits\DefaultRequestInfoProviding;
use IceHawk\IceHawk\Interfaces\ConfiguresIceHawk;
use IceHawk\IceHawk\Routing\Patterns\Literal;
use IceHawk\IceHawk\Routing\ReadRoute;
use PHPinDD\CqrsNewsletter\Application\Endpoints\Home\Read\StartRequestHandler;
use PHPinDD\CqrsNewsletter\Env;

/**
 * Class IceHawkConfig
 * @package PHPinDD\CqrsNewsletter\Application
 */
final class IceHawkConfig implements ConfiguresIceHawk
{
	use DefaultFinalReadResponding;
	use DefaultFinalWriteResponding;
	use DefaultEventSubscribing;
	use DefaultRequestInfoProviding;

	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	public function getReadRoutes()
	{
		return [
			new ReadRoute( new Literal( '/' ), new StartRequestHandler( $this->env ) ),
		];
	}

	public function getWriteRoutes()
	{
	}
}
