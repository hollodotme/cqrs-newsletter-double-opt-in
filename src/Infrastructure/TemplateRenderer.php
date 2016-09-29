<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Infrastructure;

/**
 * Class TemplateRenderer
 * @package PHPinDD\CqrsNewsletter\TemplateRenderers
 */
final class TemplateRenderer
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
		$twigLoader   = new \Twig_Loader_Filesystem( [ __DIR__ . '/../Application/Endpoints' ] );
		$twigInstance = new \Twig_Environment(
			$twigLoader,
			[
				'debug'      => true,
				'autoescape' => 'html',
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
