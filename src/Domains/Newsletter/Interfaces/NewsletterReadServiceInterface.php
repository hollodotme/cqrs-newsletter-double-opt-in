<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;

/**
 * Interface NewsletterReadServiceInterface
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces
 */
interface NewsletterReadServiceInterface
{
	/**
	 * @param SubscriptionId $subscriptionId
	 *
	 * @throws SubscriptionNotFound
	 *
	 * @return SubscriptionInterface
	 */
	public function findSubscriptionById( SubscriptionId $subscriptionId );

	/**
	 * @param string $email
	 *
	 * @throws SubscriptionNotFound
	 *
	 * @return SubscriptionInterface
	 */
	public function findSubscriptionByEmail( $email );
}
