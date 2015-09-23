<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\EmailAddressIsNotValid;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingConfirmationMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SendingWelcomeMailFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyConfirmed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;

/**
 * Interface NewsletterMailServiceInterface
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces
 */
interface NewsletterMailServiceInterface
{
	/**
	 * @param SubscriptionInterface $subscription
	 *
	 * @throws SendingConfirmationMailFailed
	 */
	public function sendConfirmationMail( SubscriptionInterface $subscription );

	/**
	 * @param string $email
	 *
	 * @throws SubscriptionNotFound
	 * @throws SubscriptionAlreadyConfirmed
	 * @throws SendingConfirmationMailFailed
	 * @throws EmailAddressIsNotValid
	 *
	 * @return SubscriptionInterface
	 */
	public function resendConfirmationMail( $email );

	/**
	 * @param SubscriptionInterface $subscription
	 *
	 * @throws SendingWelcomeMailFailed
	 */
	public function sendWelcomeMail( SubscriptionInterface $subscription );
}
