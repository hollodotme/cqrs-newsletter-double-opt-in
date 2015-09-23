<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Error\Read;

use Fortuneglobe\IceHawk\DomainRequestHandlers\GetRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesGetRequestData;
use PHPinDD\CqrsNewsletter\Responses\InternalServerError;

/**
 * Class InternalServerErrorRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Error\Read
 */
final class InternalServerErrorRequestHandler extends GetRequestHandler
{
	/**
	 * @param ServesGetRequestData $request
	 */
	public function handle( ServesGetRequestData $request )
	{
		( new InternalServerError() )->respond();
	}
}
