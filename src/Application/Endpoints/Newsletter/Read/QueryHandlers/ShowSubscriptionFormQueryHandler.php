<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers;

use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterReadServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowSubscriptionFormQuery;
use PHPinDD\CqrsNewsletter\Responses\Page;

/**
 * Class ShowSubscriptionFormQueryHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers
 */
final class ShowSubscriptionFormQueryHandler
{
	/** @var NewsletterReadServiceInterface */
	private $newsletterReadService;

	/**
	 * @param NewsletterReadServiceInterface $newsletterReadService
	 */
	public function __construct( NewsletterReadServiceInterface $newsletterReadService )
	{
		$this->newsletterReadService = $newsletterReadService;
	}

	/**
	 * @param ShowSubscriptionFormQuery $query
	 */
	public function handle( ShowSubscriptionFormQuery $query )
	{
		if ( isset($_SESSION['show-subscription-form']) )
		{
			$feedback = $_SESSION['show-subscription-form'];
		}
		else
		{
			$feedback = [ ];
		}

		$page = new Page(
			'Newsletter/Read/Pages/SubscriptionForm.twig',
			[
				'feedback' => $feedback,
			]
		);

		$page->respond();
	}
}
