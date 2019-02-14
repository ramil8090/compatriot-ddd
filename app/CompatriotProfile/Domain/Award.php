<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/12/19
 * Time: 10:55 PM
 */

namespace Elyurt\CompatriotProfile\Domain;


use Elyurt\CompatriotProfile\Infrastructure\Persistence\InstantiateTrait;
use yii\db\ActiveRecord;

class Award extends ActiveRecord
{
    use InstantiateTrait;

    /**
     * @var CompatriotProfile
     */
    private $compatriotProfile;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $awardOrganization;
    /**
     * @var \DateTimeImmutable
     */
    private $awardDate;

    public function __construct(
        string $title,
        string $description,
        string $awardOrganization,
        \DateTimeImmutable $awardDate)
    {
        $this->title = $title;
        $this->description = $description;
        $this->awardOrganization = $awardOrganization;
        $this->awardDate = $awardDate;
    }

    public function isEqualTo(self $award): bool
    {
        return $this->title === $award->title;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getAwardOrganization(): string
    {
        return $this->awardOrganization;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getAwardDate(): \DateTimeImmutable
    {
        return $this->awardDate;
    }

    public function setCompatriotProfile(CompatriotProfile $compatriotProfile)
    {
        $this->compatriotProfile = $compatriotProfile;
    }

    ######## INFRASTRUCTURE #########
    public static function tableName(): string
    {
        return '{{%awards}}';
    }
    public function afterFind(): void
    {
        $this->title = $this->getAttribute('title');
        $this->description = $this->getAttribute('description');
        $this->awardOrganization = $this->getAttribute('award_organization');
        $this->awardDate = $this->getAttribute('award_date');
        parent::afterFind();
    }
    public function beforeSave($insert): bool
    {
        $this->setAttribute('title', $this->title);
        $this->setAttribute('description', $this->description);
        $this->setAttribute('award_organization', $this->awardOrganization);
        $this->setAttribute('award_date', $this->awardDate->format('Y-m-d H:i:s'));
        return parent::beforeSave($insert);
    }

}