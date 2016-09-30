<?php
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription;

use PHPinDD\CqrsNewsletter\Application\Types\Subscription;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\SubscriptionNotFound;
use PHPinDD\CqrsNewsletter\Domains\Newsletter\Exceptions\UpdatingSubscriptionStatusFailed;
use PHPinDD\CqrsNewsletter\Infrastructure\MySqlManager;

/**
 * Class SubscriptionRepository
 * @package PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription
 */
final class SubscriptionRepository
{
	/** @var MySqlManager */
	private $dbManager;

	public function __construct( MySqlManager $mySqlManager )
	{
		$this->dbManager = $mySqlManager;
	}

	public function add( Subscription $subscription )
	{
		$this->dbManager->beginTransaction();

		try
		{
			$this->queryPrepared(
				"INSERT INTO subscriptions (subscriptionId, email, status)
				 VALUES (:subscriptionId, :email, :status)",
				[
					'subscriptionId' => $subscription->getSubscriptionId()->toString(),
					'email'          => $subscription->getEmail()->toString(),
					'status'         => $subscription->getStatus(),
				]
			);

			$this->dbManager->commit();
		}
		catch ( \PDOException $e )
		{
			$this->dbManager->rollBack();

			throw $e;
		}
	}

	private function queryPrepared( string $query, array $params = [] ) : \PDOStatement
	{
		$statement = $this->dbManager->prepare( $query );

		if ( !$statement->execute( $params ? : null ) )
		{
			$errorInfo    = $statement->errorInfo();
			$errorMessage = $errorInfo[1] . ': ' . $errorInfo[2];
			throw new \PDOException( 'Execution of prepared statement failed. ' . $errorMessage );
		}
		else
		{
			if ( $statement->errorCode() > 0 )
			{
				$errorInfo = $statement->errorInfo();
				throw new \PDOException( $errorInfo[1] . ': ' . $errorInfo[2], $errorInfo[0] );
			}
		}

		return $statement;
	}

	public function update( Subscription $subscription )
	{
		$this->dbManager->beginTransaction();

		try
		{
			$this->queryPrepared(
				"UPDATE subscriptions SET status = :status 
				 WHERE subscriptionId = :subscriptionId 
				 LIMIT 1",
				[
					'subscriptionId' => $subscription->getSubscriptionId()->toString(),
					'status'         => $subscription->getStatus(),
				]
			);

			$this->dbManager->commit();
		}
		catch ( \PDOException $e )
		{
			$this->dbManager->rollBack();

			throw new UpdatingSubscriptionStatusFailed( $e->getMessage(), 0, $e );
		}
	}

	/**
	 * @param SubscriptionId $subscriptionId
	 *
	 * @throws SubscriptionNotFound
	 * @return SubscriptionInterface
	 */
	public function findOneById( SubscriptionId $subscriptionId )
	{
		$statement = $this->queryPrepared(
			"SELECT * FROM subscriptions WHERE subscriptionId = :subscriptionId LIMIT 1",
			[
				'subscriptionId' => $subscriptionId->toString(),
			]
		);

		$dbEntity = $statement->fetchObject();

		if ( $dbEntity !== false )
		{
			$subscription = $this->buildSubscriptionFromDbEntity( $dbEntity );

			return $subscription;
		}
		else
		{
			throw new SubscriptionNotFound( $subscriptionId->toString() );
		}
	}

	/**
	 * @param \stdClass $dbEntity
	 *
	 * @return SubscriptionInterface
	 */
	private function buildSubscriptionFromDbEntity( \stdClass $dbEntity )
	{
		$subscription = new Subscription();
		$subscription->setSubscriptionId( SubscriptionId::fromString( $dbEntity->subscriptionId ) );
		$subscription->setEmail( $dbEntity->email );
		$subscription->setStatus( $dbEntity->status );

		return $subscription;
	}

	/**
	 * @param string $email
	 *
	 * @throws SubscriptionNotFound
	 * @return SubscriptionInterface
	 */
	public function findOneByEmail( $email )
	{
		$statement = $this->queryPrepared(
			"SELECT * FROM subscriptions WHERE email = :email LIMIT 1",
			[
				'email' => $email,
			]
		);

		$dbEntity = $statement->fetchObject();

		if ( $dbEntity !== false )
		{
			$subscription = $this->buildSubscriptionFromDbEntity( $dbEntity );

			return $subscription;
		}
		else
		{
			throw new SubscriptionNotFound( $email );
		}
	}

}
