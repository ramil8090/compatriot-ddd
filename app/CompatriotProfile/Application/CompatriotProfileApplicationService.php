<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 3:36 PM
 */

namespace Elyurt\CompatriotProfile\Application;


use Elyurt\CompatriotProfile\Application\Commands\ChangeAwardsCommand;
use Elyurt\CompatriotProfile\Application\Commands\CreateCompatriotProfileCommand;
use Elyurt\CompatriotProfile\Application\Representations\CompatriotProfileRepresentation;
use Elyurt\CompatriotProfile\Domain\Award;
use Elyurt\CompatriotProfile\Domain\Awards;
use Elyurt\CompatriotProfile\Domain\CompatriotProfile;
use Elyurt\CompatriotProfile\Domain\CompatriotProfileId;
use Elyurt\CompatriotProfile\Domain\Personal;
use Elyurt\CompatriotProfile\Domain\Repositories\CompatriotProfileRepository;
use Elyurt\CompatriotProfile\Domain\ValueObjects\BirthPlace;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\CountryId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Emails;
use Elyurt\CompatriotProfile\Domain\ValueObjects\Name;
use Elyurt\CompatriotProfile\Domain\ValueObjects\NationalityId;
use Elyurt\CompatriotProfile\Domain\ValueObjects\ResidenceAddress;
use Elyurt\CompatriotProfile\Domain\ValueObjects\UserId;
use yii\web\User;

class CompatriotProfileApplicationService
{
    /**
     * @var CompatriotProfileRepository
     */
    private $compatriotProfileRepository;

    public function __construct(CompatriotProfileRepository $compatriotProfileRepository)
    {
        $this->compatriotProfileRepository = $compatriotProfileRepository;
    }

    public function createCompatriotProfile(CreateCompatriotProfileCommand $command): CompatriotProfileRepresentation
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {

            $compatriotProfile = new CompatriotProfile(
                $this->compatriotProfileRepository->nextId(),
                new Personal(
                    new UserId($command->person['user_id']),
                    new Name(
                        $command->person['first_name'],
                        $command->person['last_name'],
                        $command->person['middle_name']
                    ),
                    $command->person['birt_date'],
                    new CityId($command->person['birth_place_city_id']),
                    new NationalityId($command->person['nationalilty_id']),
                    new CountryId($command->person['citizenship_country_id']),
                    new ResidenceAddress(
                        new CountryId($command->person['residence_country_id']),
                        $command->person['residence_state'],
                        new CityId($command->person['residence_city_id']),
                        $command->person['residence_address']
                    ),
                    new Emails($command->person['emails'])
                ),
                new Awards(array_map(function($award){
                    return new Award(
                        $award['title'],
                        $award['description'],
                        $award['organization'],
                        $award['date']
                    );
                }, $command->awards))
            );

            $this->compatriotProfileRepository->add($compatriotProfile);

            $events = $compatriotProfile->releaseEvents();

            $transaction->commit();
            return new CompatriotProfileRepresentation($compatriotProfile);
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        throw new \Exception('Error create.');
    }

    public function changeAwards(ChangeAwardsCommand $command): CompatriotProfileRepresentation
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {

            $compatriotProfile = $this->compatriotProfileRepository->profileWithId(new CompatriotProfileId($command->compatriotProfileId));
            $awardsArray = array_map(function ($award) {
                return new Award(
                    $award['title'],
                    $award['description'],
                    $award['organization'],
                    new \DateTimeImmutable($award['date'])
                );
            }, $command->awards);

            $compatriotProfile->changeAwards(new Awards($awardsArray));
            $this->compatriotProfileRepository->save($compatriotProfile);

            $events = $compatriotProfile->releaseEvents();

            $transaction->commit();
            return new CompatriotProfileRepresentation($compatriotProfile);
        } catch (\Exception $e) {
            $transaction->rollBack();
        }
        throw new \Exception('Error create.');
    }
}