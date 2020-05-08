<?php
declare(strict_types=1);

namespace Plaisio\LanguageResolver\Test\Plaisio;

/**
 * Mock up data layer for testing purposes.
 */
class TestDataLayer
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Selects all language codes as map from language code to language ID.
   *
   * @return \array[]
   */
  public function abcBabelCoreInternalCodeMap()
  {
    return ['en'      => C::LAN_ID_EN,
            'nl'      => C::LAN_ID_NL,
            'ru'      => C::LAN_ID_RU,
            'nl-be'   => C::LAN_ID_NL_BE,
            'zh-hant' => C::LAN_ID_ZH_HANT,
            'zh'      => C::LAN_ID_ZH];
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
