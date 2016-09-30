<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application\WriteModel;

use PHPinDD\CqrsNewsletter\Env;

/**
 * Class AbstractCommandHandler
 * @package PHPinDD\CqrsNewsletter\Application\WriteModel
 */
abstract class AbstractCommandHandler
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
