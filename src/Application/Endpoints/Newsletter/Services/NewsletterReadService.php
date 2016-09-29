<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Services;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterReadServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\SubscriptionInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionRepository;

/**
 * Class NewsletterReadService
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Services
 */
final class NewsletterReadService implements NewsletterReadServiceInterface
{
	/**
	 * @param SubscriptionId $subscriptionId
	 *
	 * @throws SubscriptionNotFound
	 * @return SubscriptionInterface
	 */
	public function findSubscriptionById( SubscriptionId $subscriptionId )
	{
		$subscriptionRepository = new SubscriptionRepository();

		return $subscriptionRepository->findOneById( $subscriptionId );
	}

	/**
	 * @param string $email
	 *
	 * @throws SubscriptionNotFound
	 * @return SubscriptionInterface
	 */
	public function findSubscriptionByEmail( $email )
	{
		$subscriptionRepository = new SubscriptionRepository();

		return $subscriptionRepository->findOneByEmail( $email );
	}
}
