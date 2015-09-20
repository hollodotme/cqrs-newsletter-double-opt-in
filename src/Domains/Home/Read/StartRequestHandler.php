<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Home\Read;

use Fortuneglobe\IceHawk\DomainRequestHandlers\GetRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesGetRequestData;
use PHPinDD\CqrsNewsletter\Responses\TwigPage;

/**
 * Class StartRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Home\Read
 */
final class StartRequestHandler extends GetRequestHandler
{
	/**
	 * @param ServesGetRequestData $request
	 */
	public function handle( ServesGetRequestData $request )
	{
		$page = new TwigPage( 'Home/Read/Pages/Start.twig', [ ] );
		$page->respond();
	}
}
