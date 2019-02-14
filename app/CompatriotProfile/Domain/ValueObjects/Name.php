<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 14.01.19
 * Time: 17:18
 */

namespace Elyurt\CompatriotProfile\Domain\ValueObjects;


use Assert\Assertion;

class Name
{
    /**
     * @var array
     */
    private $values;

    const RUSSIAN_LANGUAGE = 'ru';
    const ENGLISH_LANGUAGE = 'en';
    const UZBEK_LANGUAGE = 'uz';

    public function __construct(string $first, string $last, string $middle="", string $language=self::ENGLISH_LANGUAGE)
    {
        Assertion::notEmpty($first);
        Assertion::notEmpty($last);

        Assertion::inArray($language, [
           self::RUSSIAN_LANGUAGE,
           self::ENGLISH_LANGUAGE,
           self::UZBEK_LANGUAGE
        ]);

        $this->addValue([$first, $last, $middle], $language);
    }

    private function addValue(array $values, string $language)
    {
        $this->values[$language] = $values;
    }

    /**
     * @param ENGLISH_LANGUAGE|UZBEK_LANGUAGE|RUSSIAN_LANGUAGE $language
     * @return string
     * @throws \Assert\AssertionFailedException
     */
    public function getFullName($language=self::ENGLISH_LANGUAGE): string
    {
        Assertion::notEmpty($language);

        $first = $this->values[$language][0];
        $last = $this->values[$language][1];
        $middle = $this->values[$language][2];

        return $first." ".$last." ".$middle;
    }

    /**
     * @param ENGLISH_LANGUAGE|UZBEK_LANGUAGE|RUSSIAN_LANGUAGE $language
     * @return string
     */
    public function getFirst($language=self::ENGLISH_LANGUAGE): string
    {
        return $this->values[$language][0];
    }

    /**
     * @param ENGLISH_LANGUAGE|UZBEK_LANGUAGE|RUSSIAN_LANGUAGE $language
     * @return string
     */
    public function getLast($language=self::ENGLISH_LANGUAGE): string
    {
        return $this->values[$language][1];
    }

    /**
     * @return string
     */
    public function getMiddle($language=self::ENGLISH_LANGUAGE): string
    {
        return $this->values[$language][2];
    }
}