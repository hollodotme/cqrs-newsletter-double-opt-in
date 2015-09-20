<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Services;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterWriteServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;

/**
 * Class NewsletterWriteService
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Services
 */
final class NewsletterWriteService implements NewsletterWriteServiceInterface
{
	public function initializeSubscription( $email )
	{
		// TODO: Implement initializeSubscription() method.
	}

	public function resendConfirmationMail( SubscriptionId $subscriptionId )
	{
		// TODO: Implement resendConfirmationMail() method.
	}

	public function confirmSubscription( SubscriptionId $subscriptionId )
	{
		// TODO: Implement confirmSubscription() method.
	}
}
