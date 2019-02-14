<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/12/19
 * Time: 11:32 PM
 */

namespace Elyurt\CompatriotProfile\Domain;


use Elyurt\Common\AggregateRoot;
use Elyurt\Common\EventTrait;
use Elyurt\CompatriotProfile\Domain\Events\CompatriotProfileAwardsChanged;
use Elyurt\CompatriotProfile\Domain\Events\CompatriotProfileCreated;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CountryId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Emails;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Name;
use Elyurt\CompatriotProfile\Domain\ValueObjects\NationalityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\ResidenceAddress;
use Elyurt\CompatriotProfile\Domain\ValueObjects\UserId;
use Elyurt\CompatriotProfile\Infrastructure\Persistence\InstantiateTrait;
use Elyurt\CompatriotProfile\Infrastructure\Persistence\LazyLoadTrait;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use ProxyManager\Proxy\LazyLoadingInterface;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class CompatriotProfile extends  ActiveRecord implements AggregateRoot
{
    use EventTrait, InstantiateTrait, LazyLoadTrait;

    /**
     * @var CompatriotProfileId
     */
    private $id;
    /**
     * @var Personal
     */
    private $personal;
    /**
     * @var Awards
     */
    private $awards;
    /**
     * @var \DateTimeImmutable
     */
    private $createdAt;

    public function __construct(CompatriotProfileId $id, Personal $personal, Awards $awards)
    {
        $this->id = $id;
        $this->personal = $personal;
        $this->awards = $awards;
        $this->createdAt = new \DateTimeImmutable();
        $this->recordEvent(new CompatriotProfileCreated($this->id, $this->createdAt));
    }

    public function changeAwards(Awards $awards)
    {
        $this->awards = $awards;
        $this->recordEvent(new CompatriotProfileAwardsChanged($this->id, $this->createdAt));
    }

    ######## INFRASTRUCTURE #########
    public static function tableName(): string
    {
        return '{{%compatriot_profiles}}';
    }
    public function behaviors(): array
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['relatedAwards'],
            ],
        ];
    }
    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }
    public function afterFind(): void
    {
        $this->id = new CompatriotProfileId(
            $this->getAttribute('id')
        );

        $this->personal = new Personal(
            new UserId($this->getAttribute('user_id')),
            new Name(
                $this->getAttribute('first_name'),
                $this->getAttribute('last_name'),
                $this->getAttribute('middle_name')
            ),
            new \DateTimeImmutable($this->getAttribute('dob')),
            new CityId($this->getAttribute('birth_place_city_id')),
            new NationalityId($this->getAttribute('nationality_id')),
            new CountryId($this->getAttribute('citizenship_country_id')),
            new ResidenceAddress(
                new CountryId($this->getAttribute('residence_country_id')),
                $this->getAttribute('residence_state'),
                new CityId($this->getAttribute('residence_city_id')),
                $this->getAttribute('residence_address')
            ),
            new Emails(json_decode($this->getAttribute('emails')))
        );

        $this->createdAt = new \DateTimeImmutable(
            $this->getAttribute('created_at')
        );

        $this->awards = self::getLazyFactory()->createProxy(
            Awards::class,
            function (&$target, LazyLoadingInterface $proxy) {
                $target = new Awards($this->relatedAwards);
                $proxy->setProxyInitializer(null);
            }
        );
        parent::afterFind();
    }
    public function beforeSave($insert): bool
    {
        $this->setAttribute('id', $this->id->getId());
        $this->setAttribute('user_id', $this->personal->getUserId()->getId());
        $this->setAttribute('dob', $this->personal->getBirthDate()->format('Y-m-d'));
        $this->setAttribute('birth_place_city_id', $this->personal->getBirthPlace()->getId());
        $this->setAttribute('first_name', $this->personal->getName()->getFirst());
        $this->setAttribute('last_name', $this->personal->getName()->getLast());
        $this->setAttribute('middle_name', $this->personal->getName()->getMiddle());
        $this->setAttribute('nationality_id', $this->personal->getNationalityId()->getId());
        $this->setAttribute('citizenship_country_id', $this->personal->getCitizenshipId()->getId());
        $this->setAttribute('residence_country_id', $this->personal->getResidencePlace()->getCountryId()->getId());
        $this->setAttribute('residence_state', $this->personal->getResidencePlace()->getState());
        $this->setAttribute('residence_city_id', $this->personal->getResidencePlace()->getCityId()->getId());
        $this->setAttribute('residence_address', $this->personal->getResidencePlace()->getAddress());

        //var_dump($this->getAttributes());die;
        //$this->setContactPhones();
        $this->setAttribute('emails', json_encode($this->personal->getEmails()->getAll()));
        $this->setAttribute('created_at', $this->createdAt->format('Y-m-d H:i:s'));

        if (!$this->awards instanceOf LazyLoadingInterface || $this->awards->isProxyInitialized()) {
            $this->relatedAwards = $this->awards->getAll();
        }
        return parent::beforeSave($insert);
    }

//    protected function setContactPhones(): void
//    {
//        $residencePhoneWork = json_encode([
//            'country' => $this->personal->getResidencePhones()->getWork()->getCountry(),
//            'code' => $this->personal->getResidencePhones()->getWork()->getCode(),
//            'number' => $this->personal->getResidencePhones()->getWork()->getNumber()
//        ]);
//        $residencePhoneHome = json_encode([
//            'country' => $this->personal->getResidencePhones()->getHome()->getCountry(),
//            'code' => $this->personal->getResidencePhones()->getHome()->getCode(),
//            'number' => $this->personal->getResidencePhones()->getHome()->getNumber()
//        ]);
//        $residencePhoneMobile = json_encode([
//            'country' => $this->personal->getResidencePhones()->getHome()->getCountry(),
//            'code' => $this->personal->getResidencePhones()->getHome()->getCode(),
//            'number' => $this->personal->getResidencePhones()->getHome()->getNumber()
//        ]);
//        $this->setAttribute('phone_residence_work', $residencePhoneWork);
//        $this->setAttribute('phone_residence_home', $residencePhoneHome);
//        $this->setAttribute('phone_residence_mobile', $residencePhoneMobile);
//
//        $uzbekistanPhoneHome = json_encode([
//            'country' => $this->personal->getResidencePhones()->getHome()->getCountry(),
//            'code' => $this->personal->getResidencePhones()->getHome()->getCode(),
//            'number' => $this->personal->getResidencePhones()->getHome()->getNumber()
//        ]);
//        $uzbekistanPhoneMobile = json_encode([
//            'country' => $this->personal->getResidencePhones()->getHome()->getCountry(),
//            'code' => $this->personal->getResidencePhones()->getHome()->getCode(),
//            'number' => $this->personal->getResidencePhones()->getHome()->getNumber()
//        ]);
//        $this->setAttribute('phone_uzbekistan_mobile', $uzbekistanPhoneHome);
//        $this->setAttribute('phone_uzbekistan_home', $uzbekistanPhoneMobile);
//
//    }
    public function getRelatedAwards(): ActiveQuery
    {
        return $this->hasMany(Award::className(), ['compatriot_profile_id' => 'id'])->orderBy('id');
    }
}