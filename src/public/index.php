<?php
/**
 *
 * @author hollodotme
 */

namespace PHPinDD\CqrsNewsletter;

use Fortuneglobe\IceHawk\IceHawk;
use PHPinDD\CqrsNewsletter\IceHawk\Config;
use PHPinDD\CqrsNewsletter\IceHawk\Delegate;

require_once(__DIR__ . '/../../vendor/autoload.php');

$iceHawk = new IceHawk( new Config(), new Delegate() );
$iceHawk->init();
$iceHawk->handleRequest();


