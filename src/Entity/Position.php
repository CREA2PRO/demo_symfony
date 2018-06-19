<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 19/06/18
 * Time: 11:40
 */

namespace App\Entity;

/**
 * Class Position
 */
class Position
{
    /**
     * @var string
     */
    protected $batiment;
    /**
     * @var string
     */
    protected $couloir;

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
     * @param string $batiment
     * @param string $couloir
     *
     * @return Position
     */
    public static function createFromScalars(string $batiment, string $couloir): Position
    {
        $pos = new self();
        $pos->batiment = $batiment;
        $pos->couloir = $couloir;

        return $pos;
    }

    /**
     * @return string
     */
    public function getBatiment(): string
    {
        return $this->batiment;
    }

    /**
     * @return string
     */
    public function getCouloir(): string
    {
        return $this->couloir;
    }
}
