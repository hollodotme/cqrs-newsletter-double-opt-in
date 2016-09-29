<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter;

use PHPinDD\CqrsNewsletter\Application\Session;
use PHPinDD\CqrsNewsletter\Infrastructure\MySqlManager;
use PHPinDD\CqrsNewsletter\Infrastructure\RedisManager;
use PHPinDD\CqrsNewsletter\Infrastructure\TemplateRenderer;

/**
 * Class Env
 * @package PHPinDD\CqrsNewsletter
 */
final class Env
{
	/** @var array */
	private $instances;

	public function __construct()
	{
		$this->instances = [];
	}

	public function getTemplateRenderer() : TemplateRenderer
	{
		return $this->getSharedInstance(
			'templateRenderer',
			function ()
			{
				return new TemplateRenderer();
			}
		);
	}

	private function getSharedInstance( string $instanceName, \Closure $createFunction )
	{
		if ( !isset($this->instances[ $instanceName ]) )
		{
			$this->instances[ $instanceName ] = $createFunction->call( $this );
		}

		return $this->instances[ $instanceName ];
	}

	public function getRedisManager() : RedisManager
	{
		return $this->getSharedInstance(
			'redisManager',
			function ()
			{
				return new RedisManager();
			}
		);
	}

	public function getMySqlManager() : MySqlManager
	{
		return $this->getSharedInstance(
			'mySqlManager',
			function ()
			{
				return new MySqlManager();
			}
		);
	}

	public function getSession() : Session
	{
		return $this->getSharedInstance(
			'session',
			function ()
			{
				if ( session_status() !== PHP_SESSION_ACTIVE )
				{
					session_start();
				}

				return new Session( $_SESSION );
			}
		);
	}
}
