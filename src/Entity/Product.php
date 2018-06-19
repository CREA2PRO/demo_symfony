<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 19/06/18
 * Time: 11:33
 */

namespace App\Entity;

/**
 * Class Product
 */
class Product
{
    /**
     * @var string
     */
    protected $reference;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var int
     */
    protected $count;
    /**
     * @var Position
     */
    protected $position;

    /**
     * Product constructor.
     *
     * Privé pour forcer l'usage d'un constructeur nommé
     */
    private function __construct()
    {
    }

    /**
     * Construction par valeurs scalaires
     *
     * @param string   $reference
     * @param string   $name
     * @param Position $position
     * @param int      $count
     *
     * @return Product
     */
    public static function createFromScalars(string $reference, string $name, Position $position, int $count): Product
    {
        $produit = new self();
        $produit->reference = $reference;
        $produit->name = $name;
        $produit->position = $position;
        $produit->count = $count;

        return $produit;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }
}
