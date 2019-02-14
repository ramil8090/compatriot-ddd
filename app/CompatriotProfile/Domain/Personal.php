<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 14.01.19
 * Time: 16:49
 */

namespace Elyurt\CompatriotProfile\Domain;


use Elyurt\CompatriotProfile\Domain\ValueObjects\BirthPlace;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CountryId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Emails;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Name;
use Elyurt\CompatriotProfile\Domain\ValueObjects\NationalityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Phone;
use Elyurt\CompatriotProfile\Domain\ValueObjects\ResidenceAddress;
use Elyurt\CompatriotProfile\Domain\ValueObjects\ResidencePhones;
use Elyurt\CompatriotProfile\Domain\ValueObjects\UserId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\UzbekistanPhones;

class Personal
{
    /**
     * @var UserId
     */
    private $userId;
    /**
     * @var string
     */
    private $photo = "";
    /**
     * @var Name
     */
    private $name;
    /**
     * @var \DateTimeImmutable
     */
    private $birthDate;
    /**
     * @var CityId
     */
    private $birthPlace;
    /**
     * @var NationalityId
     */
    private $nationalityId;
    /**
     * @var CountryId
     */
    private $citizenshipId;
    /**
     * @var ResidenceAddress
     */
    private $residencePlace;
    /**
     * @var ResidencePhones
     */
    private $residencePhones;
    /**
     * @var Emails
     */
    private $emails;
    /**
     * @var UzbekistanPhones
     */
    private $uzbekistanPhones;

    public function __construct(
        UserId $userId,
        Name $name,
        \DateTimeImmutable $birthDate,
        CityId $birthPlace,
        NationalityId $nationalityId,
        CountryId $citizenshipId,
        ResidenceAddress $residencePlace,
        Emails $emails,
        array $residencePhones = [],
        array $uzbekistanPhones = []
    )
    {
        $this->userId = $userId;
        $this->name = $name;
        $this->birthDate = $birthDate;
        $this->birthPlace = $birthPlace;
        $this->nationalityId = $nationalityId;
        $this->citizenshipId = $citizenshipId;
        $this->residencePlace = $residencePlace;
        $this->emails = $emails;

        $this->residencePhones = new ResidencePhones($residencePhones);
        $this->uzbekistanPhones = new UzbekistanPhones($uzbekistanPhones);
    }

    public function setResidencePhone(Phone $phone): void
    {
        $this->residencePhones->set($phone);
    }

    public function getResidencePhones(): ResidencePhones
    {
        return $this->residencePhones;
    }

    public function setUzbekistanPhone(Phone $phone): void
    {
        $this->uzbekistanPhones->set($phone);
    }

    public function getUzbekistanPhones(): UzbekistanPhones
    {
        return $this->uzbekistanPhones;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBirthDate(): \DateTimeImmutable
    {
        return $this->birthDate;
    }

    /**
     * @return BirthPlace
     */
    public function getBirthPlace(): CityId
    {
        return $this->birthPlace;
    }

    /**
     * @return NationalityId
     */
    public function getNationalityId(): NationalityId
    {
        return $this->nationalityId;
    }

    /**
     * @return CountryId
     */
    public function getCitizenshipId(): CountryId
    {
        return $this->citizenshipId;
    }

    /**
     * @return ResidenceAddress
     */
    public function getResidencePlace(): ResidenceAddress
    {
        return $this->residencePlace;
    }

    /**
     * @return Emails
     */
    public function getEmails(): Emails
    {
        return $this->emails;
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }



}