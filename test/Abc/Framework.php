<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\LanguageResolver\Test\Abc;

use SetBased\Abc\Abc;
use SetBased\Abc\Babel\CoreBabel;
use SetBased\Abc\LanguageResolver\CoreLanguageResolver;

/**
 * Mock framework for testing purposes.
 */
class Framework extends Abc
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
