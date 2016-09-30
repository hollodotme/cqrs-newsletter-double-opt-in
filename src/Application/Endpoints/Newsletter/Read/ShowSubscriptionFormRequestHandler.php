<?php declare(strict_types = 1);
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\Endpoints\Newsletter\Read;

use IceHawk\Forms\FormId;
use IceHawk\IceHawk\Interfaces\ProvidesReadRequestData;
use PHPinDD\CqrsNewsletter\Application\Responses\Page;
use PHPinDD\CqrsNewsletter\Bridges\AbstractGetRequestHandler;
use PHPinDD\CqrsNewsletter\Env;

/**
 * Class ShowSubscriptionFormRequestHandler
 * @package PHPinDD\CqrsNewsletter\Application\Endpoints\Subscription\Read
 */
final class ShowSubscriptionFormRequestHandler extends AbstractGetRequestHandler
{
	public function handleRequest( ProvidesReadRequestData $request, Env $env )
	{
		$session          = $env->getSession();
		$subscriptionForm = $session->getForm( new FormId( 'subscriptionForm' ) );

		$subscriptionForm->renewToken();

		$data = [
			'subscriptionForm' => $subscriptionForm,
		];

		(new Page( $env ))->render( 'Subscription/Read/Pages/SubscriptionForm.twig', $data );
	}
}
