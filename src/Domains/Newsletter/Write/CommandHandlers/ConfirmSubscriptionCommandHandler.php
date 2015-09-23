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
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterMailServiceInterface;
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

	/** @var NewsletterMailServiceInterface */
	private $newsletterMailService;

	/**
	 * @param NewsletterWriteServiceInterface $newsletterWriteService
	 * @param NewsletterMailServiceInterface  $newsletterMailService
	 */
	public function __construct(
		NewsletterWriteServiceInterface $newsletterWriteService,
		NewsletterMailServiceInterface $newsletterMailService
	)
	{
		$this->newsletterWriteService = $newsletterWriteService;
		$this->newsletterMailService = $newsletterMailService;
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

			$this->newsletterMailService->sendWelcomeMail( $subscription );

			$redirect = new Redirect( '/newsletter/show-subscription-confirmed' );
			$redirect->respond();
		}
		catch ( SubscriptionNotFound $e )
		{
			$feedback = [
				'messages'      => [
					'We can not find your subscription.',
					'You can subscribe with your e-mail address here.',
				],
				'email'         => '',
				'severity'      => 'error',
				'alertSeverity' => 'danger',
			];

			$_SESSION['show-subscription-form'] = $feedback;

			$redirect = new Redirect( '/newsletter/show-subscription-form' );
			$redirect->respond();
		}
		catch ( SubscriptionAlreadyConfirmed $e )
		{
			$redirect = new Redirect( '/newsletter/show-subscription-confirmed' );
			$redirect->respond();
		}
		catch ( SendingWelcomeMailFailed $e )
		{
			$redirect = new Redirect( '/newsletter/show-subscription-confirmed' );
			$redirect->respond();
		}
	}
}
