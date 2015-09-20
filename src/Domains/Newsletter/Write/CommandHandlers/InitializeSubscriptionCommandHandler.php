<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers;

use Fortuneglobe\IceHawk\Responses\Redirect;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\AddingSubscriptionFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\EmailAddressIsNotValid;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingConfirmationMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyConfirmed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyInitialized;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterWriteServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands\InitializeSubscriptionCommand;

/**
 * Class InitializeSubscriptionCommandHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers
 */
final class InitializeSubscriptionCommandHandler
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
	 * @param InitializeSubscriptionCommand $command
	 */
	public function handle( InitializeSubscriptionCommand $command )
	{
		try
		{
			$subscription = $this->newsletterWriteService->initializeSubscription( $command->getEmail() );

			$this->newsletterWriteService->sendConfirmationMail( $subscription );

			unset($_SESSION['show-subscription-form']);
			unset($_SESSION['show-resend-confirmation-form']);

			$redirect = new Redirect(
				'/newsletter/show-subscription-initialized?subscriptionId=' . $subscription->getSubscriptionId()
			);
			$redirect->respond();
		}
		catch ( EmailAddressIsNotValid $e )
		{
			$feedback = [
				'messages'      => [
					'This is not a valid e-mail address.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'error',
				'alertSeverity' => 'danger',
			];

			$_SESSION['show-subscription-form'] = $feedback;
			unset($_SESSION['show-resend-confirmation-form']);

			$redirect = new Redirect( '/newsletter/show-subscription-form' );
			$redirect->respond();
		}
		catch ( SubscriptionAlreadyInitialized $e )
		{
			$feedback = [
				'messages'      => [
					'There is already a subscription intialized for your e-mail address.',
					'Hit the "Resend e-mail" button.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'info',
				'alertSeverity' => 'info',
			];

			unset($_SESSION['show-subscription-form']);
			$_SESSION['show-resend-confirmation-form'] = $feedback;

			$redirect = new Redirect( '/newsletter/show-resend-confirmation-form' );
			$redirect->respond();
		}
		catch ( SubscriptionAlreadyConfirmed $e )
		{
			$feedback = [
				'messages'      => [
					'You already completed your subscription.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'info',
				'alertSeverity' => 'info',
			];

			$_SESSION['show-subscription-form'] = $feedback;
			unset($_SESSION['show-resend-confirmation-form']);

			$redirect = new Redirect( '/newsletter/show-subscription-form' );
			$redirect->respond();
		}
		catch ( AddingSubscriptionFailed $e )
		{
			$feedback = [
				'messages'      => [
					'There was an error storing your data.',
					'Please try again later.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'error',
				'alertSeverity' => 'danger',
			];

			$_SESSION['show-subscription-form'] = $feedback;
			unset($_SESSION['show-resend-confirmation-form']);

			$redirect = new Redirect( '/newsletter/show-subscription-form' );
			$redirect->respond();
		}
		catch ( SendingConfirmationMailFailed $e )
		{
			$feedback = [
				'messages'      => [
					'We could not send your confirmation e-mail.',
					'Hit the "Resend e-mail" button.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'error',
				'alertSeverity' => 'danger',
			];

			unset($_SESSION['show-subscription-form']);
			$_SESSION['show-resend-confirmation-form'] = $feedback;

			$redirect = new Redirect( '/newsletter/show-resend-confirmation-form' );
			$redirect->respond();
		}
	}
}
