<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Infrastructure;

/**
 * Class RedisManager
 * @package PHPinDD\CqrsNewsletter\Infrastructure
 */
final class RedisManager extends \Redis
{
	public function __construct()
	{
		$this->connect( '127.0.0.1', 6379, 2.0 );
		$this->setOption( \Redis::OPT_PREFIX, 'CQRS-NL' );
		$this->setOption( \Redis::OPT_SERIALIZER, \Redis::SERIALIZER_NONE );

		$this->select( 1 );
	}
}
