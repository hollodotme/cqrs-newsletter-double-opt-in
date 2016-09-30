<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application\Types;

/**
 * Class Email
 * @package PHPinDD\CqrsNewsletter\Application\Types
 */
final class Email implements \JsonSerializable
{
	/** @var string */
	private $email;

	public function __construct( string $email )
	{
		$this->email = $email;
	}

	public function toString() : string
	{
		return $this->email;
	}

	public function __toString()
	{
		return $this->toString();
	}

	public function jsonSerialize()
	{
		return $this->toString();
	}
}
