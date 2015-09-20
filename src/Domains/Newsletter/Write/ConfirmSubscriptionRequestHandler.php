<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write;

use Fortuneglobe\IceHawk\DomainRequestHandlers\PostRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesPostRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterWriteService;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers\ConfirmSubscriptionCommandHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands\ConfirmSubscriptionCommand;

/**
 * Class ConfirmSubscriptionRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Write
 */
final class ConfirmSubscriptionRequestHandler extends PostRequestHandler
{
	/**
	 * @param ServesPostRequestData $request
	 */
	public function handle( ServesPostRequestData $request )
	{
		$newsletterWriteService = new NewsletterWriteService();

		$command = new ConfirmSubscriptionCommand( $request );
		$handler = new ConfirmSubscriptionCommandHandler( $newsletterWriteService );

		$handler->handle( $command );
	}
}
