<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\Events;

use IceHawk\PubSub\Interfaces\CarriesInformation;
use IceHawk\PubSub\Interfaces\IdentifiesMessage;
use IceHawk\PubSub\Interfaces\NamesMessage;
use IceHawk\PubSub\Types\MessageId;
use IceHawk\PubSub\Types\MessageName;

/**
 * Class SubscriptionWasInitializedEvent
 * @package PHPinDD\CqrsNewsletter\Application\WriteModel\Subscription\Events
 */
final class SubscriptionWasInitializedEvent implements CarriesInformation
{
	public function getMessageId() : IdentifiesMessage
	{
		return new MessageId( uniqid() );
	}

	public function getMessageName() : NamesMessage
	{
		return new MessageName( 'Subscription was initialized' );
	}
}
