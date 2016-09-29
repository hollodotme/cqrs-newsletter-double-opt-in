<?php declare(strict_types = 1);
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\Endpoints\Home\Read;

use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;
use PHPinDD\CqrsNewsletter\Application\Responses\Page;
use PHPinDD\CqrsNewsletter\Bridges\AbstractGetRequestHandler;
use PHPinDD\CqrsNewsletter\Env;

/**
 * Class StartRequestHandler
 * @package PHPinDD\CqrsNewsletter\Domains\Home\Read
 */
final class StartRequestHandler extends AbstractGetRequestHandler
{
	public function handleRequest( ProvidesReadRequestData $request, Env $env )
	{
		(new Page( $env ))->render( 'Home/Read/Pages/Start.twig', [] );
	}
}
