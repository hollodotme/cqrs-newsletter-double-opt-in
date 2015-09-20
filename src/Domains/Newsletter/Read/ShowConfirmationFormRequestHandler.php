<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read;

use Fortuneglobe\IceHawk\DomainRequestHandlers\GetRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesGetRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowConfirmationFormQuery;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers\ShowConfirmationFormQueryHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterReadService;

/**
 * Class ShowConfirmationFormRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read
 */
final class ShowConfirmationFormRequestHandler extends GetRequestHandler
{
	/**
	 * @param ServesGetRequestData $request
	 */
	public function handle( ServesGetRequestData $request )
	{
		$newsletterReadService = new NewsletterReadService();

		$query   = new ShowConfirmationFormQuery( $request );
		$handler = new ShowConfirmationFormQueryHandler( $newsletterReadService );

		$handler->handle( $query );
	}
}
