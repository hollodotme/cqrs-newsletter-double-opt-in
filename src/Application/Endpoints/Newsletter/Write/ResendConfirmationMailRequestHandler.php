<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write;

use Fortuneglobe\IceHawk\DomainRequestHandlers\PostRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesPostRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterMailService;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers\ResendConfirmationMailCommandHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands\ResendConfirmationMailCommand;

/**
 * Class ResendConfirmationMailRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Subscription\Write
 */
final class ResendConfirmationMailRequestHandler extends PostRequestHandler
{
	/**
	 * @param ServesPostRequestData $request
	 */
	public function handle( ServesPostRequestData $request )
	{
		$newsletterMailService = new NewsletterMailService();

		$command = new ResendConfirmationMailCommand( $request );
		$handler               = new ResendConfirmationMailCommandHandler( $newsletterMailService );

		$handler->handle( $command );
	}
}
