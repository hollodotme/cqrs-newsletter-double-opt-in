<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Domains\Newsletter;

/**
 * Class SubscriptionId
 *
 * @package PHPinDD\CqrsNewsletter\Domains\Newsletter
 */
final class SubscriptionId
{
	/** @var string */
	private $idString;

	/**
	 * @param string $idString
	 */
	public function __construct( $idString )
	{
		$this->idString = $idString;
	}

	/**
	 * @return string
	 */
	public function toString()
	{
		return $this->idString;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->toString();
	}

	/**
	 * @param string $string
	 *
	 * @return SubscriptionId
	 */
	public static function fromString( $string )
	{
		return new self( $string );
	}

	/**
	 * @return SubscriptionId
	 */
	public static function generate()
	{
		$uuid = uniqid( 'NL-', true );

		return self::fromString( $uuid );
	}
}
