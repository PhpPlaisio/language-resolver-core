<?php
declare(strict_types=1);

namespace Plaisio\LanguageResolver\Test;

use PHPUnit\Framework\TestCase;
use Plaisio\Kernel\Nub;
use Plaisio\LanguageResolver\Test\Plaisio\C;
use Plaisio\LanguageResolver\Test\Plaisio\TestKernel;

/**
 * Test cases for class CoreBabel.
 */
class CoreLanguageResolverTest extends TestCase
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Our concrete instance of Abc.
   *
   * @var Nub
   */
  private static $nub;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Creates the concrete implementation of the ABC Framework.
   */
  public function setUp(): void
  {
    parent::setUpBeforeClass();

    self::$nub = new TestKernel();
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test language code with country.
   */
  public function testGetLanId01(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'nl-BE,en-US;q=0.7,en;q=0.3';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_NL_BE, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test language code without country.
   */
  public function testGetLanId02(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'nl,de;q=0.8,hu;q=0.6,en-US;q=0.4,en;q=0.2';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_NL, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test language code without country, not first preferred language
   */
  public function testGetLanId03(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'fr-CH,fr;q=0.8,en-US;q=0.6,en;q=0.4';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_EN, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test language code with country code .
   */
  public function testGetLanId04(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'nl-NL,en-US;q=0.7';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_NL, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test language code with country code .
   */
  public function testGetLanId05(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'nl_be,nl_nl,en-US;q=0.7';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_NL_BE, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test language code is Chinese.
   */
  public function testGetLanIdChinese01(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'zh-CN,zh,en-US,en;q=0';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_ZH, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test language code is Chinese.
   */
  public function testGetLanIdChinese02(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'zh-Hant-HK,zh-Hant;q=0.8,en-US;q=0.5,en;q=0.3';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_ZH_HANT, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test language code is Chinese.
   */
  public function testGetLanIdChinese03(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'zh-Hans-HK,zh-Hans;q=0.8,en-US;q=0.5,en;q=0.3';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_EN, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test with empty $_SERVER['HTTP_ACCEPT_LANGUAGE']
   */
  public function testGetLanIdEmpty01(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = null;

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_EN, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test with empty $_SERVER['HTTP_ACCEPT_LANGUAGE']
   */
  public function testGetLanIdEmpty02(): void
  {
    unset($_SERVER['HTTP_ACCEPT_LANGUAGE']);

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_EN, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Test unsupported language code.
   */
  public function testGetLanIdUnsupported(): void
  {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'de-CH,de;q=0.5';

    $lanId = Nub::$nub->languageResolver->getLanId();
    self::assertEquals(C::LAN_ID_EN, $lanId);
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
