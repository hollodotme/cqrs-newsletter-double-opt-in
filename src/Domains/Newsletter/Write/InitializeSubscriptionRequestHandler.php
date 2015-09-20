<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write;

use Fortuneglobe\IceHawk\DomainRequestHandlers\PostRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesPostRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterWriteService;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers\InitializeSubscriptionCommandHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands\InitializeSubscriptionCommand;

/**
 * Class InitializeSubscriptionRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Write
 */
class InitializeSubscriptionRequestHandler extends PostRequestHandler
{
	/**
	 * @param ServesPostRequestData $request
	 */
	public function handle( ServesPostRequestData $request )
	{
		$newsletterWriteService = new NewsletterWriteService();

		$command = new InitializeSubscriptionCommand( $request );
		$handler = new InitializeSubscriptionCommandHandler( $newsletterWriteService );

		$handler->handle( $command );
	}
}
