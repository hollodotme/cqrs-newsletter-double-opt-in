<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers;

use Fortuneglobe\IceHawk\Responses\Redirect;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionAlreadyConfirmed;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Interfaces\NewsletterReadServiceInterface;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\Queries\ShowConfirmationFormQuery;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Subscription;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\SubscriptionId;
use PHPinDD\CqrsNewsletter\Responses\Page;

/**
 * Class ShowConfirmationFormQueryHandler
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Read\QueryHandlers
 */
final class ShowConfirmationFormQueryHandler
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
	 * @param ShowConfirmationFormQuery $query
	 */
	public function handle( ShowConfirmationFormQuery $query )
	{
		try
		{
			$subscriptionId = SubscriptionId::fromString( $query->getSubscriptionId() );
			$subscription   = $this->newsletterReadService->findSubscriptionById( $subscriptionId );

			if ( $subscription->getStatus() == Subscription::STATUS_CONFIRMED )
			{
				throw new SubscriptionAlreadyConfirmed();
			}

			$page = new Page(
				'Newsletter/Read/Pages/ConfirmationForm.twig',
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
		catch ( SubscriptionAlreadyConfirmed $e )
		{
			$redirect = new Redirect( '/newsletter/show-subscription-confirmed' );
			$redirect->respond();
		}
	}
}
