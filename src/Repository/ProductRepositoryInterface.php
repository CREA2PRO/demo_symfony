<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 19/06/18
 * Time: 11:39
 */

namespace App\Repository;

use App\Entity\Product;

/**
 * Interface ProductRepositoryInterface
 */
interface ProductRepositoryInterface
{
    /**
     * Recherche des produits par name
     *
     * @param string $pattern
     *
     * @return Product[]
     */
    public function getByName(string $pattern): array;

    /**
     * Recherche des produits par reference
     *
     * @param string $pattern
     *
     * @return Product[]
     */
    public function getByReference(string $pattern): array;

    /**
     * Retourne tous les produits
     *
     * @return Product[]
     */
    public function get(): array;
}
