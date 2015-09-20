<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\Responses;

use Fortuneglobe\IceHawk\Interfaces\ServesResponse;

/**
 * Class TwigPage
 *
 * @package PHPinDD\CqrsNewsletter\Responses
 */
final class TwigPage implements ServesResponse
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
		$twigInstance = $this->getTwigInstance();

		header( 'Content-Type: text/html; charset=utf-8', true, $this->httpCode );
		echo $twigInstance->render( $this->template, $this->data );
	}

	/**
	 * @return \Twig_Environment
	 */
	private function getTwigInstance()
	{
		$baseDir      = __DIR__ . '/..';
		$twigLoader   = new \Twig_Loader_Filesystem( [ $baseDir . '/Domains', $baseDir . '/Themes' ] );
		$twigInstance = new \Twig_Environment(
			$twigLoader,
			[
				'debug'      => true,
				'autoescape' => true,
				'charset'    => 'utf-8',
				'cache'      => sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'twig',
			]
		);
		$twigInstance->addExtension( new \Twig_Extension_Debug() );

		return $twigInstance;
	}
}
