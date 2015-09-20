<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\AddingSubscriptionFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\EmailAddressIsNotValid;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingConfirmationMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingWelcomeMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyConfirmed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyInitialized;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;

/**
 * Interface NewsletterWriteServiceInterface
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces
 */
interface NewsletterWriteServiceInterface
{
	/**
	 * @param string $email
	 *
	 * @throws EmailAddressIsNotValid
	 * @throws SubscriptionAlreadyInitialized
	 * @throws SubscriptionAlreadyConfirmed
	 * @throws AddingSubscriptionFailed
	 *
	 * @return SubscriptionInterface
	 */
	public function initializeSubscription( $email );

	/**
	 * @param SubscriptionInterface $subscription
	 *
	 * @throws SendingConfirmationMailFailed
	 */
	public function sendConfirmationMail( SubscriptionInterface $subscription );

	/**
	 * @param SubscriptionId $subscriptionId
	 *
	 * @throws SubscriptionNotFound
	 * @throws SubscriptionAlreadyConfirmed
	 * @throws SendingConfirmationMailFailed
	 */
	public function resendConfirmationMail( SubscriptionId $subscriptionId );

	/**
	 * @param SubscriptionId $subscriptionId
	 *
	 * @throws SubscriptionNotFound
	 * @throws SubscriptionAlreadyConfirmed
	 *
	 * @return SubscriptionInterface
	 */
	public function confirmSubscription( SubscriptionId $subscriptionId );

	/**
	 * @param SubscriptionInterface $subscription
	 *
	 * @throws SendingWelcomeMailFailed
	 */
	public function sendWelcomeMail( SubscriptionInterface $subscription );
}
