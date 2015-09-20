<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers;

use Fortuneglobe\IceHawk\Responses\Redirect;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingWelcomeMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyConfirmed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterWriteServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands\ConfirmSubscriptionCommand;

/**
 * Class ConfirmSubscriptionCommandHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers
 */
final class ConfirmSubscriptionCommandHandler
{
	/** @var NewsletterWriteServiceInterface */
	private $newsletterWriteService;

	/**
	 * @param NewsletterWriteServiceInterface $newsletterWriteService
	 */
	public function __construct( NewsletterWriteServiceInterface $newsletterWriteService )
	{
		$this->newsletterWriteService = $newsletterWriteService;
	}

	/**
	 * @param ConfirmSubscriptionCommand $command
	 */
	public function handle( ConfirmSubscriptionCommand $command )
	{
		try
		{
			$subscriptionId = SubscriptionId::fromString( $command->getSubscriptionId() );

			$subscription = $this->newsletterWriteService->confirmSubscription( $subscriptionId );

			$this->newsletterWriteService->sendWelcomeMail( $subscription );

			$redirect = new Redirect( '/newsletter/show-subscription-confirmed' );
			$redirect->respond();
		}
		catch ( SubscriptionNotFound $e )
		{
		}
		catch ( SubscriptionAlreadyConfirmed $e )
		{
		}
		catch ( SendingWelcomeMailFailed $e )
		{
		}
	}
}
