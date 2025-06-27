<?php
declare(strict_types=1);

namespace Plaisio\LanguageResolver;

use Plaisio\PlaisioInterface;
use Plaisio\PlaisioObject;

/**
 * Class for resolving the language in which a response must be drafted based on ACCEPT_LANGUAGE HTTP header.
 */
class CoreLanguageResolver extends PlaisioObject implements LanguageResolver
{
  //--------------------------------------------------------------------------------------------------------------------
  /**
   * The ID of the language.
   *
   * @var int|null
   */
  private ?int $lanId = null;

  /**
   * The ID of the language when the requested language cannot be resolved.
   *
   * @var int
   */
  private int $lanIdDefault;

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Object constructor.
   *
   * @param PlaisioInterface $object       The parent PhpPlaisio object.
   * @param int              $lanIdDefault The ID of the language when the requested language cannot be resolved.
   */
  public function __construct(PlaisioInterface $object, int $lanIdDefault)
  {
    parent::__construct($object);

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
    if ($this->lanId===null)
    {
      $this->resolveLanId();
    }

    return $this->lanId;
  }

  //--------------------------------------------------------------------------------------------------------------------
  /**
   * Resolves the ID of the language in which the response must be drafted.
   */
  private function resolveLanId(): void
  {
    $languages = $this->nub->request->acceptLanguages;

    if (empty($languages))
    {
      $this->lanId = $this->lanIdDefault;

      return;
    }

    $map = $this->nub->babel->getInternalLanguageMap();

    // Try to find the language code. Examples: en, en-US, zh, zh-Hans.
    foreach (array_keys($languages) as $code)
    {
      if ($code==='')
      {
        continue;
      }
      // The official language code for Dutch in the Netherlands is nl-NL (with hyphen). But in practice, we encounter
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
    foreach (array_keys($languages) as $code)
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
