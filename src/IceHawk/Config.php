<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\IceHawk;

use Fortuneglobe\IceHawk\IceHawkConfig;

/**
 * Class Config
 *
 * @package PHPinDD\CqrsNewsletter\IceHawk
 */
final class Config extends IceHawkConfig
{
	/**
	 * @return string
	 */
	public function getDomainNamespace()
	{
		return 'PHPinDD\\CqrsNewsletter\\Domains';
	}

	/**
	 * @return UriResolver
	 */
	public function getUriResolver()
	{
		return new UriResolver();
	}
}
