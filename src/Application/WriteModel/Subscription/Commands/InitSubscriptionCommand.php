<?php
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\Commands;

use PHPinDD\CqrsNewsletter\Application\Types\Email;
use PHPinDD\CqrsNewsletter\Application\Types\SubscriptionId;

/**
 * Class InitSubscriptionCommand
 * @package PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\Commands
 */
final class InitSubscriptionCommand
{
	/** @var SubscriptionId */
	private $subscriptionId;

	/** @var Email */
	private $email;

	public function __construct( SubscriptionId $subscriptionId, Email $email )
	{
		$this->subscriptionId = $subscriptionId;
		$this->email          = $email;
	}

	public function getSubscriptionId(): SubscriptionId
	{
		return $this->subscriptionId;
	}

	public function getEmail(): Email
	{
		return $this->email;
	}
}
