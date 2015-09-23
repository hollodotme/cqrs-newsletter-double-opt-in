<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\AddingSubscriptionFailed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\EmailAddressIsNotValid;
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
	 * @param SubscriptionId $subscriptionId
	 *
	 * @throws SubscriptionNotFound
	 * @throws SubscriptionAlreadyConfirmed
	 *
	 * @return SubscriptionInterface
	 */
	public function confirmSubscription( SubscriptionId $subscriptionId );
}
