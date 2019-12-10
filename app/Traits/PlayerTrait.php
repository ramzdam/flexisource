<?php

namespace App\Traits;

use App\Repositories\PlayerRepository;
use App\Player;

/**
 * Trait PlayerTrait
 *
 * This trait is responsible for handling all validation and conditions
 * that will be used as parameter to retrieve data in a repository
 */
trait PlayerTrait
{

	/**
     * Get all record
     *
     * @param PlayerRepository $repository
     * @return Array
     */
    public function getAll(PlayerRepository $repository)
    {
        return $repository->getAll();
    }

	/**
     * Get individual Player record
     *
     * @param PlayerRepository $repository
     * @param String $code
     * @return Array
     */
    public function get(PlayerRepository $repository, $code)
    {    	
    	return $repository->get($code);
    }
}
