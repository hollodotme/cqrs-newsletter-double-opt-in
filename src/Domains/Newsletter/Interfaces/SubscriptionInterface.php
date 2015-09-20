<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;

/**
 * Interface SubscriptionInterface
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces
 */
interface SubscriptionInterface
{
	/**
	 * @param SubscriptionId $subscriptionId
	 */
	public function setSubscriptionId( SubscriptionId $subscriptionId );

	/**
	 * @return SubscriptionId
	 */
	public function getSubscriptionId();

	/**
	 * @param string $email
	 */
	public function setEmail( $email );

	/**
	 * @return string
	 */
	public function getEmail();

	/**
	 * @param string $status
	 */
	public function setStatus( $status );

	/**
	 * @return string
	 */
	public function getStatus();
}
