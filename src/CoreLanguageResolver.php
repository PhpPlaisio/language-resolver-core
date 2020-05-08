<?php
declare(strict_types=1);

namespace Plaisio\LanguageResolver;

use Plaisio\Kernel\Nub;

/**
 * Class for resolving the language in which a response must be drafted based on $_SERVER['HTTP_ACCEPT_LANGUAGE'].
 */
class CoreLanguageResolver implements LanguageResolver
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The ID of the language.
   *
   * @var int|null
   */
  private $lanId;

  /**
   * The ID of the language when to requested language can not be resolved.
   *
   * @var int
   */
  private $lanIdDefault;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   *
   * @param int $lanIdDefault The ID of the language when to requested language can not be resolved.
   */
  public function __construct(int $lanIdDefault)
  {
    $this->lanIdDefault = $lanIdDefault;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Returns the ID of the language in which the response must be drafted.
   *
   * @return int
   */
  public function getLanId(): int
  {
    if ($this->lanId===null) $this->resolveLanId();

    return $this->lanId;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Resolves the ID of the language in which the response must be drafted.
   */
  private function resolveLanId(): void
  {
    $codes = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '');

    // If HTTP_ACCEPT_LANGUAGE is not set or empty return the default language.
    if (empty($codes)) $this->lanIdDefault;

    $map = Nub::$nub->babel->getInternalLanguageMap();

    // Try to find the language code. Examples: en, en-US, zh, zh-Hans.
    // BTW We assume HTTP_ACCEPT_LANGUAGE is sorted properly.
    foreach ($codes as &$code)
    {
      // The official language code for Dutch in the Netherlands is nl-NL (with hyphen). But in practice we encounter
      // nl_NL, nl_nl, nl-nl. Therefore, internal language codes are in lower case and with hyphen.

      // Remove sorting weight, replace underscore with dash, and convert to lower case.
      $code = strtolower(str_replace('_', '-', strtok($code, ';')));

      if (isset($map[$code]))
      {
        $this->lanId = $map[$code];

        return;
      }
    }

    // We did not find the language code. Try without county code. Examples: en, zh.
    foreach ($codes as $code)
    {
      $code = substr($code, 0, 2);

      if (isset($map[$code]))
      {
        $this->lanId = $map[$code];

        return;
      }
    }

    // We did not find the language code. Use the ID of the default language.
    $this->lanId = $this->lanIdDefault;
  }

  //--------------------------------------------------------------------------------------------------------------------
}

//----------------------------------------------------------------------------------------------------------------------
