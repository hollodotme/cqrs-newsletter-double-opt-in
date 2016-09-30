<?php
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\CommandHandlers;

use PHPinDD\CqrsNewsletter\Application\Constants\SubscriptionStatus;
use PHPinDD\CqrsNewsletter\Application\Types\Subscription;
use PHPinDD\CqrsNewsletter\Application\Types\SubscriptionId;
use PHPinDD\CqrsNewsletter\Application\WriteModel\AbstractCommandHandler;
use PHPinDD\CqrsNewsletter\Application\WriteModel\Constants\ResultType;
use PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\Commands\InitSubscriptionCommand;
use PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\Results\InitSubscriptionResult;
use PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\SubscriptionRepository;

/**
 * Class InitSubscriptionCommandHandler
 * @package PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\CommandHandlers
 */
final class InitSubscriptionCommandHandler extends AbstractCommandHandler
{
	public function handle( InitSubscriptionCommand $command ) : InitSubscriptionResult
	{
		$repository = new SubscriptionRepository( $this->getEnv()->getMySqlManager() );

		$subscription = new Subscription(
			SubscriptionId::generate(),
			$command->getEmail(),
			SubscriptionStatus::INITIALIZED
		);

		try
		{
			$repository->add( $subscription );

			return new InitSubscriptionResult();
		}
		catch ( \Throwable $e )
		{
			return new InitSubscriptionResult( ResultType::FAILURE, $e->getMessage() );
		}
	}
}
