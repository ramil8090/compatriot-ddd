<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 3:57 PM
 */

namespace Elyurt\CompatriotProfile\Infrastructure\Persistence;


use Elyurt\CompatriotProfile\Domain\CompatriotProfile;
use Elyurt\CompatriotProfile\Domain\CompatriotProfileId;
use Elyurt\CompatriotProfile\Domain\Repositories\CompatriotProfileRepository;

class ARCompatriotProfileRepository implements CompatriotProfileRepository
{

    public function add(CompatriotProfile $compatriotProfile): void
    {
        if (!$compatriotProfile->insert()) {
            throw new \RuntimeException('Adding error.');
        }
    }

    public function profileWithId(CompatriotProfileId $id): CompatriotProfile
    {
        $id = $id->getId();
        $profile = CompatriotProfile::findOne(['id'=>$id]);
        if ($profile == null) {
           throw new \DomainException("Compatriot profile not found.");
        }
        return $profile;
    }

    public function nextId(): CompatriotProfileId
    {
        $model = CompatriotProfile::find()->orderBy('id DESC')->one();

        if($model == null) {
            $id = 1;
        } else {
            $id = $model->id + 1;
        }

        return new CompatriotProfileId($id);
    }


    public function save(CompatriotProfile $compatriotProfile): void
    {
        if ($compatriotProfile->update() === false) {
            throw new \RuntimeException('Saving error.');
        }
    }
}