<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Responses;

/**
 * Class InternalServerError
 *
 * @package PHPinDD\CqrsNewsletter\Responses
 */
final class InternalServerError extends TwigPage
{
	public function __construct()
	{
		parent::__construct( 'Error.twig', [ ], 500 );
	}
}
