<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 19/06/18
 * Time: 11:38
 */

namespace App\Repository;

use App\Entity\Position;
use App\Entity\Product;

/**
 * Class ProductRepository
 *
 * Repository de type "in memory"
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product[]
     */
    protected $allProducts;

    /**
     * ProductRepository constructor.
     */
    public function __construct()
    {
        $jedi = Product::createFromScalars('SW1', 'Figurine Jedi', Position::createFromScalars('A', 'A113'), 100);
        $this->add($jedi);

        $armoire = Product::createFromScalars('ARM2', 'Armoire large', Position::createFromScalars('B', 'T1000'), 0);
        $this->add($armoire);

        $tesla = Product::createFromScalars('TL3', 'Tesla Model 3', Position::createFromScalars('A', 'NVL'), 1);
        $this->add($tesla);

        $positionLemmings = Position::createFromScalars('PC', 'x386');

        for ($i = 1; $i <= 20; $i++) {
            $lemming = Product::createFromScalars('L'.$i, 'Lemming '.$i, $positionLemmings, 5);
            $this->add($lemming);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getByName(string $pattern): array
    {
        $result = [];

        foreach ($this->allProducts as $product) {
            if (strpos($product->getName(), $pattern) !== false) {
                $result[] = $product;
            }
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getByReference(string $pattern): array
    {
        $result = [];

        foreach ($this->allProducts as $product) {
            if ($product->getReference() === $pattern) {
                $result[] = $product;
            }
        }

        return $result;
    }

    /**
     * Ajout d'un produit dans le repository
     *
     * @param Product $product
     */
    protected function add(Product $product): void
    {
        $this->allProducts[] = $product;
    }

    /**
     * Retourne tous les produits
     *
     * @return Product[]
     */
    public function get(): array
    {
        return $this->allProducts;
    }
}
