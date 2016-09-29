<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries;

use Fortuneglobe\IceHawk\DomainQuery;

/**
 * Class ShowConfirmationFormQuery
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries
 */
final class ShowConfirmationFormQuery extends DomainQuery
{
	/**
	 * @return string
	 */
	public function getSubscriptionId()
	{
		return $this->getRequestValue( 'subscriptionId' );
	}
}
