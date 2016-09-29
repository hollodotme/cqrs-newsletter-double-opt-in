<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read;

use Fortuneglobe\IceHawk\DomainRequestHandlers\GetRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesGetRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowSubscriptionInitializedQuery;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers\ShowSubscriptionInitializedQueryHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterReadService;

/**
 * Class ShowSubscriptionInitializedRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read
 */
final class ShowSubscriptionInitializedRequestHandler extends GetRequestHandler
{
	/**
	 * @param ServesGetRequestData $request
	 */
	public function handle( ServesGetRequestData $request )
	{
		$newsletterReadService = new NewsletterReadService();

		$query   = new ShowSubscriptionInitializedQuery( $request );
		$handler = new ShowSubscriptionInitializedQueryHandler( $newsletterReadService );

		$handler->handle( $query );
	}
}
