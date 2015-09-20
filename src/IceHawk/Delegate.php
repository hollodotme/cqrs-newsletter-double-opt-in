<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\IceHawk;

use Fortuneglobe\IceHawk\IceHawkDelegate;
use PHPinDD\CqrsNewsletter\Responses\TwigPage;

/**
 * Class Delegate
 *
 * @package PHPinDD\CqrsNewsletter\IceHawk
 */
final class Delegate extends IceHawkDelegate
{
	public function configureErrorHandling()
	{
		# Report and display all errors
		error_reporting( E_ALL );
		ini_set( 'display_errors', 1 );
	}

	public function configureSession()
	{
		# Redis session handler
		ini_set( 'session.name', 'cqrsnlsid' );
		ini_set( 'session.save_handler', 'redis' );
		ini_set( 'session.save_path', 'tcp://127.0.0.1:6379?weight=1&database=0' );
		ini_set( 'session.gc_maxlifetime', 60 * 60 * 24 );

		# Cookie settings
		session_set_cookie_params( 60 * 60 * 24, '/', '.cqrs-newsletter.de', false, true );

		session_start();
	}

	public function handleUncaughtException( \Exception $exception )
	{
		try
		{
			throw $exception;
		}
		catch ( \Exception $e )
		{
			$errorMessage = sprintf( 'Exception %s thrown with message: %s', get_class( $e ), $e->getMessage() );
			$errorPage    = new TwigPage( 'Error.twig', [ 'errorMessage' => $errorMessage ], 500 );

			$errorPage->respond();
		}
	}
}
