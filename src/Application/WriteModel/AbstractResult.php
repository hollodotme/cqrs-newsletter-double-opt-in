<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Application\WriteModel;

use PHPinDD\CqrsNewsletter\Application\WriteModel\Constants\ResultType;

/**
 * Class AbstractResult
 * @package PHPinDD\CqrsNewsletter\Application\WriteModel
 */
abstract class AbstractResult
{
	/** @var int */
	private $type;

	/** @var string */
	private $message;

	public function __construct( int $type = ResultType::SUCCESS, $message = '' )
	{
		$this->type    = $type;
		$this->message = $message;
	}

	public function getType(): int
	{
		return $this->type;
	}

	public function getMessage(): string
	{
		return $this->message;
	}

	public function succeeded() : bool
	{
		return ($this->type == ResultType::SUCCESS);
	}

	public function failed() : bool
	{
		return ($this->type == ResultType::FAILURE);
	}
}
