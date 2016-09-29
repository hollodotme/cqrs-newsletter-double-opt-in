<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Services;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\EmailAddressIsNotValid;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingConfirmationMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingWelcomeMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyConfirmed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterMailServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\SubscriptionInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Subscription;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionRepository;

/**
 * Class NewsletterMailService
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Services
 */
final class NewsletterMailService implements NewsletterMailServiceInterface
{
	/**
	 * @param SubscriptionInterface $subscription
	 *
	 * @throws SendingConfirmationMailFailed
	 */
	public function sendConfirmationMail( SubscriptionInterface $subscription )
	{
		$mailSent = $this->sendMail( $subscription->getEmail(), 'ConfirmationMail.tpl' );

		if ( !$mailSent )
		{
			throw new SendingConfirmationMailFailed();
		}
	}

	/**
	 * @param string $email
	 * @param string $template
	 *
	 * @return bool
	 */
	private function sendMail( $email, $template )
	{
		// TODO: implement sending mails
		$mailSent = true;

		return $mailSent;
	}

	/**
	 * @param string $email
	 *
	 * @throws SubscriptionAlreadyConfirmed
	 * @throws SubscriptionNotFound
	 * @throws SendingConfirmationMailFailed
	 * @throws EmailAddressIsNotValid
	 *
	 * @return SubscriptionInterface
	 */
	public function resendConfirmationMail( $email )
	{
		$this->guardEmailIsValid( $email );

		$subscriptionRepository = new SubscriptionRepository();

		$subscription = $subscriptionRepository->findOneByEmail( $email );

		if ( $subscription->getStatus() == Subscription::STATUS_CONFIRMED )
		{
			throw new SubscriptionAlreadyConfirmed();
		}

		$this->sendConfirmationMail( $subscription );

		return $subscription;
	}

	/**
	 * @param string $email
	 *
	 * @throws EmailAddressIsNotValid
	 */
	private function guardEmailIsValid( $email )
	{
		if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) === false )
		{
			throw new EmailAddressIsNotValid( $email );
		}
	}

	/**
	 * @param SubscriptionInterface $subscription
	 *
	 * @throws SendingWelcomeMailFailed
	 */
	public function sendWelcomeMail( SubscriptionInterface $subscription )
	{
		$mailSent = $this->sendMail( $subscription->getEmail(), 'WelcomeMail.tpl' );

		if ( !$mailSent )
		{
			throw new SendingWelcomeMailFailed();
		}
	}
}
