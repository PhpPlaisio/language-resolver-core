<?php
//----------------------------------------------------------------------------------------------------------------------
namespace SetBased\Abc\LanguageResolver\Test\Abc;

/**
 * Mock up data layer for testing purposes.
 */
class DataLayer
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Selects all language codes as map from language code to language ID.
   *
   * @return \array[]
   */
  public function abcBabelLanguageGetAllCodes()
  {
    return ['en'      => ['lan_id' => C::LAN_ID_EN, 'lan_code' => 'en'],
            'nl'      => ['lan_id' => C::LAN_ID_NL, 'lan_code' => 'nl'],
            'ru'      => ['lan_id' => C::LAN_ID_RU, 'lan_code' => 'ru'],
            'nl-BE'   => ['lan_id' => C::LAN_ID_NL_BE, 'lan_code' => 'nl-BE'],
            'zh-Hant' => ['lan_id' => C::LAN_ID_ZH_HANT, 'lan_code' => 'zh-Hant'],
            'zh' =>      ['lan_id' => C::LAN_ID_ZH, 'lan_code' => 'zh']];
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
