<?php
/**
 *
 * @author h.woltersdorf
 */

namespace PHPinDD\CqrsNewsletter\TemplateRenderers;

use Fortuneglobe\IceHawk\Interfaces\RendersTemplate;

/**
 * Class TwigRenderer
 *
 * @package PHPinDD\CqrsNewsletter\TemplateRenderers
 */
final class TwigRenderer implements RendersTemplate
{
	/** @var \Twig_Environment */
	private $twigEnvironment;

	public function __construct()
	{
		$this->twigEnvironment = $this->getTwigEnvironment();
	}

	/**
	 * @return \Twig_Environment
	 */
	private function getTwigEnvironment()
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

	/**
	 * @param string $template
	 * @param array  $data
	 *
	 * @return string
	 */
	public function renderWithData( $template, array $data )
	{
		return $this->twigEnvironment->render( $template, $data );
	}
}
