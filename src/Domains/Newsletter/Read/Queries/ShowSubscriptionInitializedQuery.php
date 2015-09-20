<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries;

use Fortuneglobe\IceHawk\DomainQuery;

/**
 * Class ShowSubscriptionInitializedQuery
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries
 */
final class ShowSubscriptionInitializedQuery extends DomainQuery
{
	/**
	 * @return null|string
	 */
	public function getSubscriptionId()
	{
		return $this->getRequestValue( 'subscriptionId' );
	}
}
