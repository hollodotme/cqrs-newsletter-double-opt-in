<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\IceHawk;

use Fortuneglobe\IceHawk\Interfaces\ServesRequestInfo;
use Fortuneglobe\IceHawk\UriComponents;
use Fortuneglobe\IceHawk\UriResolver as IceHawkUriResolver;

/**
 * Class UriResolver
 *
 * @package PHPinDD\CqrsNewsletter\IceHawk
 */
final class UriResolver extends IceHawkUriResolver
{
	/**
	 * @param ServesRequestInfo $requestInfo
	 *
	 * @throws \Fortuneglobe\IceHawk\Exceptions\MalformedRequestUri
	 * @return \Fortuneglobe\IceHawk\Interfaces\ServesUriComponents
	 */
	public function resolveUri( ServesRequestInfo $requestInfo )
	{
		if ( $requestInfo->getUri() == '/' )
		{
			return new UriComponents( 'Home', 'Start', [ ] );
		}

		return parent::resolveUri( $requestInfo );
	}
}
