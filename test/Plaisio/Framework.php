<?php
declare(strict_types=1);

namespace Plaisio\LanguageResolver\Test\Plaisio;

use Plaisio\Babel\CoreBabel;
use Plaisio\Kernel\Nub;
use Plaisio\LanguageResolver\CoreLanguageResolver;

/**
 * Mock framework for testing purposes.
 */
class Framework extends Nub
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   */
  public function __construct()
  {
    parent::__construct();

    self::$DL               = new DataLayer();
    self::$babel            = new CoreBabel();
    self::$languageResolver = new CoreLanguageResolver(C::LAN_ID_EN);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
