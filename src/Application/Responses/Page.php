<?php
/**
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Application\Responses;

use IceHawk\IceHawk\Constants\HttpCode;
use PHPinDD\CqrsNewsletter\Env;

/**
 * Class Page
 * @package PHPinDD\CqrsNewsletter\Application\Responses
 */
final class Page
{
	/** @var Env */
	private $env;

	public function __construct( Env $env )
	{
		$this->env = $env;
	}

	public function render( string $template, array $data, int $httpCode = HttpCode::OK )
	{
		header( 'Content-Type: text/html; charset=utf-8', true, $httpCode );
		echo $this->env->getTemplateRenderer()->renderWithData( $template, $data );
		flush();
	}
}
