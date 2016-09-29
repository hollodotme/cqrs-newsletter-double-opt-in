<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Infrastructure;

/**
 * Class MySqlManager
 * @package PHPinDD\CqrsNewsletter\Infrastructure
 */
final class MySqlManager extends \PDO
{
	public function __construct()
	{
		parent::__construct(
			'mysql:host=127.0.0.1;port=3306;dbname=newsletter;charset=utf-8',
			[
				\PDO::ATTR_CURSOR                   => \PDO::CURSOR_FWDONLY,
				\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
				\PDO::MYSQL_ATTR_INIT_COMMAND       => "SET CHARACTER SET utf-8",
			]
		);
	}
}
