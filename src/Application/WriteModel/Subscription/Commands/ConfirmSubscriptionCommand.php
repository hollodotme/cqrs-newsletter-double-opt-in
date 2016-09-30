<?php declare(strict_types = 1);
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\Commands;

use PHPinDD\CqrsNewsletter\Application\Types\SubscriptionId;

/**
 * Class ConfirmSubscriptionCommand
 * @package PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\Commands
 */
final class ConfirmSubscriptionCommand
{
	/** @var SubscriptionId */
	private $subscriptionId;

	public function __construct( SubscriptionId $subscriptionId )
	{
		$this->subscriptionId = $subscriptionId;
	}

	public function getSubscriptionId(): SubscriptionId
	{
		return $this->subscriptionId;
	}
}
