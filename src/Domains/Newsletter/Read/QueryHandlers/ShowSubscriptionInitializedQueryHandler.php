<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers;

use Fortuneglobe\IceHawk\Responses\Redirect;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterReadServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowSubscriptionInitializedQuery;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;
use PHPinDD\CqrsNewsletter\Responses\TwigPage;

/**
 * Class ShowSubscriptionInitializedQueryHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers
 */
final class ShowSubscriptionInitializedQueryHandler
{
	/** @var NewsletterReadServiceInterface */
	private $newsletterReadService;

	/**
	 * ShowSubscriptionInitializedQueryHandler constructor.
	 *
	 * @param NewsletterReadServiceInterface $newsletterReadService
	 */
	public function __construct( NewsletterReadServiceInterface $newsletterReadService )
	{
		$this->newsletterReadService = $newsletterReadService;
	}

	/**
	 * @param ShowSubscriptionInitializedQuery $query
	 */
	public function handle( ShowSubscriptionInitializedQuery $query )
	{
		try
		{
			$subscriptionId = SubscriptionId::fromString( $query->getSubscriptionId() );

			$subscription = $this->newsletterReadService->findSubscriptionById( $subscriptionId );

			$page = new TwigPage(
				'Newsletter/Read/Pages/SubscriptionInitialized.twig',
				[
					'subscription' => $subscription,
				]
			);

			$page->respond();
		}
		catch ( SubscriptionNotFound $e )
		{
			$feedback = [
				'messages'      => [
					'We can not find your subscription.',
					'You can subscribe with your e-mail address here.',
				],
				'email'         => '',
				'severity'      => 'error',
				'alertSeverity' => 'danger',
			];

			$_SESSION['show-subscription-form'] = $feedback;

			$redirect = new Redirect( '/newsletter/show-subscription-form' );
			$redirect->respond();
		}
	}
}
