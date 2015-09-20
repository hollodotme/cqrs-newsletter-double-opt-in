<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Services;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterReadServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;

/**
 * Class NewsletterReadService
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Services
 */
final class NewsletterReadService implements NewsletterReadServiceInterface
{
	public function findSubscriptionById( SubscriptionId $subscriptionId )
	{
		// TODO: Implement findSubscriptionById() method.
	}

	public function findSubscriptionByEmail( $email )
	{
		// TODO: Implement findSubscriptionByEmail() method.
	}

}
