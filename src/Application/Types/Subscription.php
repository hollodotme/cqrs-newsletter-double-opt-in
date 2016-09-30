<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application\Types;

/**
 * Class Subscription
 * @package PHPinDD\CqrsNewsletter\Application\Types
 */
final class Subscription
{
	/** @var SubscriptionId */
	private $subscriptionId;

	/** @var Email */
	private $email;

	/** @var string */
	private $status;

	public function __construct( SubscriptionId $subscriptionId, Email $email, string $status )
	{
		$this->subscriptionId = $subscriptionId;
		$this->email          = $email;
		$this->status         = $status;
	}

	public function getSubscriptionId(): SubscriptionId
	{
		return $this->subscriptionId;
	}

	public function getEmail(): Email
	{
		return $this->email;
	}

	public function getStatus(): string
	{
		return $this->status;
	}
}
