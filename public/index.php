<?php declare(strict_types = 1);
/**
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter;

use IceHawk\IceHawk\IceHawk;
use PHPinDD\CqrsNewsletter\Application\IceHawkConfig;
use PHPinDD\CqrsNewsletter\Application\IceHawkDelegate;

require_once(__DIR__ . '/../vendor/autoload.php');

$env     = new Env();
$iceHawk = new IceHawk( new IceHawkConfig( $env ), new IceHawkDelegate() );

$iceHawk->init();
$iceHawk->handleRequest();


