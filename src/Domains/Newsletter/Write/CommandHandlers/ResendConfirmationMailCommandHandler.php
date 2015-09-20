<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers;

use Fortuneglobe\IceHawk\Responses\Redirect;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\EmailAddressIsNotValid;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingConfirmationMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyConfirmed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterWriteServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands\ResendConfirmationMailCommand;

/**
 * Class ResendConfirmationMailCommandHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\CommandHandlers
 */
final class ResendConfirmationMailCommandHandler
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
	 * @param ResendConfirmationMailCommand $command
	 */
	public function handle( ResendConfirmationMailCommand $command )
	{
		try
		{
			$subscription = $this->newsletterWriteService->resendConfirmationMail( $command->getEmail() );

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
					'This e-mail address is not valid.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'error',
				'alertSeverity' => 'danger',
			];

			$_SESSION['show-resend-confirmation-form'] = $feedback;

			$redirect = new Redirect( '/newsletter/show-resend-confirmation-form' );
			$redirect->respond();
		}
		catch ( SubscriptionNotFound $e )
		{
			$feedback = [
				'messages'      => [
					'We can not find your subscription.',
					'Please check your e-mail address.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'error',
				'alertSeverity' => 'danger',
			];

			$_SESSION['show-resend-confirmation-form'] = $feedback;

			$redirect = new Redirect( '/newsletter/show-resend-confirmation-form' );
			$redirect->respond();
		}
		catch ( SubscriptionAlreadyConfirmed $e )
		{
			$feedback = [
				'messages'      => [
					'Your subscription is already confirmed.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'info',
				'alertSeverity' => 'info',
			];

			$_SESSION['show-resend-confirmation-form'] = $feedback;

			$redirect = new Redirect( '/newsletter/show-resend-confirmation-form' );
			$redirect->respond();
		}
		catch ( SendingConfirmationMailFailed $e )
		{
			$feedback = [
				'messages'      => [
					'Your confirmation e-mail could not be sent.',
					'Please try again later.',
				],
				'email'         => $command->getEmail(),
				'severity'      => 'error',
				'alertSeverity' => 'danger',
			];

			$_SESSION['show-resend-confirmation-form'] = $feedback;

			$redirect = new Redirect( '/newsletter/show-resend-confirmation-form' );
			$redirect->respond();
		}
	}
}
