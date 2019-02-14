<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 3:28 PM
 */

namespace Elyurt\CompatriotProfile\Domain\Repositories;


use Elyurt\CompatriotProfile\Domain\CompatriotProfile;
use Elyurt\CompatriotProfile\Domain\CompatriotProfileId;

interface CompatriotProfileRepository
{
    public function add(CompatriotProfile $compatriotProfile): void;
    public function profileWithId(CompatriotProfileId $id): CompatriotProfile;
    public function nextId(): CompatriotProfileId;
    public function save(CompatriotProfile $compatriotProfile): void;
}