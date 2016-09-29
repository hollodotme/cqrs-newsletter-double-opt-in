<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter\Bridges;

use IceHawk\Forms\Form;
use IceHawk\Forms\Interfaces\IdentifiesForm;
use IceHawk\Session\AbstractSession;

/**
 * Class AbstractFormsSession
 * @package PHPinDD\CqrsNewsletter\Bridges
 */
abstract class AbstractFormsSession extends AbstractSession
{
	const FORMS = 'forms';

	public function getForm( IdentifiesForm $formId ) : Form
	{
		$forms = $this->get( self::FORMS ) ? : [];

		if ( !isset($forms[ $formId->toString() ]) )
		{
			$forms[ $formId->toString() ] = new Form( $formId );
			$this->set( self::FORMS, $forms );
		}

		return $forms[ $formId->toString() ];
	}

	public function unsetForm( IdentifiesForm $formId )
	{
		$forms = $this->get( self::FORMS ) ? : [];

		unset($forms[ $formId->toString() ]);

		$this->set( self::FORMS, $forms );
	}
}
