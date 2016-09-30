<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read;

use Fortuneglobe\IceHawk\DomainRequestHandlers\GetRequestHandler;
use Fortuneglobe\IceHawk\Interfaces\ServesGetRequestData;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowResendConfirmationFormQuery;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers\ShowResendConfirmationFormQueryHandler;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Services\NewsletterReadService;

/**
 * Class ShowResendConfirmationFormRequestHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Subscription\Read
 */
final class ShowResendConfirmationFormRequestHandler extends GetRequestHandler
{
	/**
	 * @param ServesGetRequestData $request
	 */
	public function handle( ServesGetRequestData $request )
	{
		$newsletterReadService = new NewsletterReadService();

		$query   = new ShowResendConfirmationFormQuery( $request );
		$handler = new ShowResendConfirmationFormQueryHandler( $newsletterReadService );

		$handler->handle( $query );
	}
}
