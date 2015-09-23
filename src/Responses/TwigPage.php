<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Responses;

use Fortuneglobe\IceHawk\Interfaces\ServesResponse;
use PHPinDD\CqrsNewsletter\TemplateRenderers\TwigRenderer;

/**
 * Class TwigPage
 *
 * @package PHPinDD\CqrsNewsletter\Responses
 */
class TwigPage implements ServesResponse
{
	/** @var string */
	private $template;

	/** @var array */
	private $data;

	/** @var int */
	private $httpCode;

	/**
	 * @param string $template
	 * @param array  $data
	 * @param int    $httpCode
	 */
	public function __construct( $template, array $data, $httpCode = 200 )
	{
		$this->template = $template;
		$this->data     = $data;
		$this->httpCode = $httpCode;
	}

	public function respond()
	{
		$twigRenderer = new TwigRenderer();

		header( 'Content-Type: text/html; charset=utf-8', true, $this->httpCode );
		echo $twigRenderer->renderWithData( $this->template, $this->data );
	}
}
