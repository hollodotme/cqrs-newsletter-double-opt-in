<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Services;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\AddingSubscriptionFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\EmailAddressIsNotValid;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingConfirmationMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingWelcomeMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyConfirmed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyInitialized;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\UpdatingSubscriptionStatusFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterWriteServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\SubscriptionInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Subscription;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionRepository;

/**
 * Class NewsletterWriteService
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Services
 */
final class NewsletterWriteService implements NewsletterWriteServiceInterface
{

	/**
	 * @param string $email
	 *
	 * @throws EmailAddressIsNotValid
	 * @throws SubscriptionAlreadyConfirmed
	 * @throws SubscriptionAlreadyInitialized
	 * @throws AddingSubscriptionFailed
	 * @return SubscriptionInterface
	 */
	public function initializeSubscription( $email )
	{
		$this->guardEmailIsValid( $email );

		$subscriptionRepository = new SubscriptionRepository();

		try
		{
			$subscription = $subscriptionRepository->findOneByEmail( $email );

			if ( $subscription->getStatus() == Subscription::STATUS_INITIALIZED )
			{
				throw new SubscriptionAlreadyInitialized();
			}

			if ( $subscription->getStatus() == Subscription::STATUS_CONFIRMED )
			{
				throw new SubscriptionAlreadyConfirmed();
			}
		}
		catch ( SubscriptionNotFound $e )
		{
		}

		$subscription = new Subscription();
		$subscription->setSubscriptionId( SubscriptionId::generate() );
		$subscription->setEmail( $email );
		$subscription->setStatus( Subscription::STATUS_INITIALIZED );

		$subscriptionRepository->add( $subscription );

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
	 * @param SubscriptionId $subscriptionId
	 *
	 * @throws SubscriptionAlreadyConfirmed
	 * @throws SubscriptionNotFound
	 */
	public function resendConfirmationMail( SubscriptionId $subscriptionId )
	{
		$subscriptionRepository = new SubscriptionRepository();

		$subscription = $subscriptionRepository->findOneById( $subscriptionId );

		if ( $subscription->getStatus() == Subscription::STATUS_CONFIRMED )
		{
			throw new SubscriptionAlreadyConfirmed();
		}

		$this->sendConfirmationMail( $subscription );
	}

	/**
	 * @param SubscriptionId $subscriptionId
	 *
	 * @throws SubscriptionAlreadyConfirmed
	 * @throws SubscriptionNotFound
	 * @throws UpdatingSubscriptionStatusFailed
	 * @return SubscriptionInterface
	 */
	public function confirmSubscription( SubscriptionId $subscriptionId )
	{
		$subscriptionRepository = new SubscriptionRepository();

		$subscription = $subscriptionRepository->findOneById( $subscriptionId );

		if ( $subscription->getStatus() == Subscription::STATUS_CONFIRMED )
		{
			throw new SubscriptionAlreadyConfirmed();
		}

		$subscription->setStatus( Subscription::STATUS_CONFIRMED );

		$subscriptionRepository->update( $subscription );

		return $subscription;
	}

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
