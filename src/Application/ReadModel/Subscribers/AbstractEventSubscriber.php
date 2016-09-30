<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application\ReadModel\EventSubscribers;

use IceHawk\PubSub\AbstractMessageSubscriber;
use PHPinDD\CqrsNewsletter\Env;

/**
 * Class AbstractEventSubscriber
 * @package PHPinDD\CqrsNewsletter\Application\ReadModel\Subscribers
 */
abstract class AbstractEventSubscriber extends AbstractMessageSubscriber
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	final protected function getEnv() : Env
	{
		return $this->env;
	}
}
