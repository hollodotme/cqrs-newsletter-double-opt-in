<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands;

use Fortuneglobe\IceHawk\DomainCommand;

/**
 * Class ConfirmSubscriptionCommand
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands
 */
final class ConfirmSubscriptionCommand extends DomainCommand
{
	/**
	 * @return string
	 */
	public function getSubscriptionId()
	{
		return $this->getRequestValue( 'subscriptionId' );
	}
}
