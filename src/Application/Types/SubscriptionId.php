<?php declare(strict_types = 1);
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\Types;

/**
 * Class SubscriptionId
 * @package PHPinDD\CqrsNewsletter\Application\Types
 */
final class SubscriptionId implements \JsonSerializable
{
	/** @var string */
	private $idString;

	public function __construct( string $idString )
	{
		$this->idString = $idString;
	}

	public function toString() : string
	{
		return $this->idString;
	}

	public function __toString()
	{
		return $this->toString();
	}

	public function jsonSerialize()
	{
		return $this->toString();
	}

	public static function generate() : self
	{
		$uuid = uniqid( 'NL-', true );

		return new self( $uuid );
	}
}
