<?php
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\Endpoints\Newsletter\Write;

use IceHawk\IceHawk\Interfaces\ProvidesWriteRequestData;
use PHPinDD\CqrsNewsletter\Bridges\AbstractPostRequestHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterMailService;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterWriteService;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers\InitializeSubscriptionCommandHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands\InitSubscriptionCommand;
use PHPinDD\CqrsNewsletter\Env;

/**
 * Class InitializeSubscriptionRequestHandler
 * @package PHPinDD\CqrsNewsletter\Application\Endpoints\Subscription\Write
 */
class InitializeSubscriptionRequestHandler extends AbstractPostRequestHandler
{
	public function handleRequest( ProvidesWriteRequestData $request, Env $env )
	{
		// TODO: Implement handleRequest() method.
	}

	/**
	 * @param ServesPostRequestData $request
	 */
	public function handle( ServesPostRequestData $request )
	{
		$newsletterWriteService = new NewsletterWriteService();
		$newsletterMailService  = new NewsletterMailService();

		$command = new InitSubscriptionCommand( $request );
		$handler = new InitializeSubscriptionCommandHandler(
			$newsletterWriteService,
			$newsletterMailService
		);

		$handler->handle( $command );
	}
}
