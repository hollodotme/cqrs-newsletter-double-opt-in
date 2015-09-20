<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\SubscriptionInterface;

/**
 * Class Subscription
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter
 */
final class Subscription implements SubscriptionInterface
{
	const STATUS_INITIALIZED = 'initialized';

	const STATUS_CONFIRMED   = 'confirmed';

	/** @var SubscriptionId */
	private $subscriptionId;

	/** @var string */
	private $email;

	/** @var string */
	private $status;

	/**
	 * @return SubscriptionId
	 */
	public function getSubscriptionId()
	{
		return $this->subscriptionId;
	}

	/**
	 * @param SubscriptionId $subscriptionId
	 */
	public function setSubscriptionId( $subscriptionId )
	{
		$this->subscriptionId = $subscriptionId;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail( $email )
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * @param string $status
	 */
	public function setStatus( $status )
	{
		$this->status = $status;
	}
}
