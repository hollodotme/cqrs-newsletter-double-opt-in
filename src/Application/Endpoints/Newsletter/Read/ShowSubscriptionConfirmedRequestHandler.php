<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read;

use Fortuneglobe\IceHawk\DomainRequestHandlers\GetRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesGetRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowSubscriptionConfirmedQuery;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers\ShowSubscriptionConfirmedQueryHandler;

/**
 * Class ShowSubscriptionConfirmedRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Subscription\Read
 */
final class ShowSubscriptionConfirmedRequestHandler extends GetRequestHandler
{
	/**
	 * @param ServesGetRequestData $request
	 */
	public function handle( ServesGetRequestData $request )
	{
		$query   = new ShowSubscriptionConfirmedQuery( $request );
		$handler = new ShowSubscriptionConfirmedQueryHandler();

		$handler->handle( $query );
	}
}
