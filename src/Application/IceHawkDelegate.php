<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: hollodotme
 * Date: 29/09/2016
 * Time: 12:52
 */

namespace PHPinDD\CqrsNewsletter\Application;

use IceHawk\IceHawk\Interfaces\ProvidesRequestInfo;
use IceHawk\IceHawk\Interfaces\SetsUpEnvironment;

/**
 * Class IceHawkDelegate
 * @package PHPinDD\CqrsNewsletter\Application
 */
final class IceHawkDelegate implements SetsUpEnvironment
{
	public function setUpGlobalVars()
	{
	}

	public function setUpErrorHandling( ProvidesRequestInfo $requestInfo )
	{
		error_reporting( -1 );
		ini_set( 'display_errors', 'On' );
	}

	public function setUpSessionHandling( ProvidesRequestInfo $requestInfo )
	{
		ini_set( 'session.name', 'sid' );
		ini_set( 'session.save_handler', 'redis' );
		ini_set( 'session.save_path', 'tcp://127.0.0.1:6379?weight=1&database=0' );
		ini_set( 'session.gc_maxlifetime', (string)(60 * 60 * 24) );

		session_set_cookie_params( (60 * 60 * 24), '/', ',cqrs-newsletter.de', false, true );
	}
}
