<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowSubscriptionConfirmedQuery;
use PHPinDD\CqrsNewsletter\Responses\Page;

/**
 * Class ShowSubscriptionConfirmedQueryHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers
 */
final class ShowSubscriptionConfirmedQueryHandler
{
	/**
	 * @param ShowSubscriptionConfirmedQuery $query
	 */
	public function handle( ShowSubscriptionConfirmedQuery $query )
	{
		$page = new Page( 'Newsletter/Read/Pages/SubscriptionConfirmed.twig', [ ] );
		$page->respond();
	}
}
