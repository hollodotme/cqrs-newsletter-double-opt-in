<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application\Constants;

/**
 * Class SubscriptionStatus
 * @package PHPinDD\CqrsNewsletter\Application\Constants
 */
abstract class SubscriptionStatus
{
	const INITIALIZED = 'initialized';

	const CONFIRMED   = 'confirmed';
}
