<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write;

use Fortuneglobe\IceHawk\DomainRequestHandlers\PostRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesPostRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterWriteService;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers\ResendConfirmationMailCommandHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands\ResendConfirmationMailCommand;

/**
 * Class ResendConfirmationMailRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Write
 */
final class ResendConfirmationMailRequestHandler extends PostRequestHandler
{
	/**
	 * @param ServesPostRequestData $request
	 */
	public function handle( ServesPostRequestData $request )
	{
		$newsletterWriteService = new NewsletterWriteService();

		$command = new ResendConfirmationMailCommand( $request );
		$handler = new ResendConfirmationMailCommandHandler( $newsletterWriteService );

		$handler->handle( $command );
	}
}
