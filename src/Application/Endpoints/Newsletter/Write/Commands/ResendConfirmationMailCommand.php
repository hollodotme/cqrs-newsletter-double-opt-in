<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands;

use Fortuneglobe\IceHawk\DomainCommand;

/**
 * Class ResendConfirmationMailCommand
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter\Write\Commands
 */
final class ResendConfirmationMailCommand extends DomainCommand
{
	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->getRequestValue( 'email' );
	}
}
