<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read;

use Fortuneglobe\IceHawk\DomainRequestHandlers\GetRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesGetRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowSubscriptionFormQuery;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers\ShowSubscriptionFormQueryHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterReadService;

/**
 * Class ShowSubscriptionFormRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read
 */
final class ShowSubscriptionFormRequestHandler extends GetRequestHandler
{
	/**
	 * @param ServesGetRequestData $request
	 */
	public function handle( ServesGetRequestData $request )
	{
		$newsletterReadService = new NewsletterReadService();

		$query   = new ShowSubscriptionFormQuery( $request );
		$handler = new ShowSubscriptionFormQueryHandler( $newsletterReadService );

		$handler->handle( $query );
	}
}
