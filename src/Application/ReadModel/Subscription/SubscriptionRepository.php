<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application\ReadModel\Subscription;

use PHPinDD\CqrsNewsletter\Infrastructure\RedisManager;

/**
 * Class SubscriptionRepository
 * @package PHPinDD\CqrsNewsletter\Application\ReadModel\Subscription
 */
final class SubscriptionRepository
{
	/** @var RedisManager */
	private $redisManager;

	public function __construct( RedisManager $redisManager )
	{
		$this->redisManager = $redisManager;
	}

	public function addPage( string $uri, string $content )
	{
		$this->redisManager->set( 'page:' . $uri, $content );
	}

	public function getPage( string $uri ) : string
	{
		$page = $this->redisManager->get( 'page:' . $uri );

		if ( false === $page )
		{
			throw new \Exception( 'Page not found' );
		}

		return $page;
	}
}
