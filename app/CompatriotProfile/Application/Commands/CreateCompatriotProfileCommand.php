<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 1/13/19
 * Time: 3:34 PM
 */

namespace Elyurt\CompatriotProfile\Application\Commands;

class CreateCompatriotProfileCommand
{
    /**
     * @var array
     */
    public $awards;
    /**
     * @var array
     */
    public $person;

    public function __construct(array $person, array $awards)
    {
        $this->person = $person;
        $this->awards = $awards;
    }
}