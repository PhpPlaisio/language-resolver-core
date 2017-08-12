<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\LanguageResolver\Test\Abc;

use SetBased\Abc\Abc;
use SetBased\Abc\ErrorLogger\ErrorLogger;
use SetBased\Abc\LanguageResolver\CoreLanguageResolver;
use SetBased\Exception\RuntimeException;

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
    self::$languageResolver = new CoreLanguageResolver(C::LAN_ID_EN);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  public function createMailMessage()
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  public function getBlobStore()
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the error logger.
   *
   * @return ErrorLogger
   */
  public function getErrorLogger()
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * {@inheritdoc}
   */
  public function getLoginUrl($url)
  {
    throw new RuntimeException('Not implemented');
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------