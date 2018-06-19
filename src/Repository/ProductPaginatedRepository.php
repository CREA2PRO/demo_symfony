<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 19/06/18
 * Time: 11:38
 */

namespace App\Repository;

use App\Entity\Product;

/**
 * Class ProductPaginatedRepository
 *
 * Repository de type "in memory" et paginé
 */
class ProductPaginatedRepository extends ProductRepository
{
    /**
     * @var int
     */
    protected $page = 0;
    /**
     * @var int
     */
    protected $countPerPage = 5;
    /**
     * @var int
     */
    protected $pageCount;

    /**
     * Fixe la page courante
     *
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * Fixe le nombre d'éléments par page
     *
     * @param int $countPerPage
     */
    public function setCountPerPage(int $countPerPage): void
    {
        $this->countPerPage = $countPerPage;
    }

    /**
     * {@inheritdoc}
     */
    public function getByName(string $pattern): array
    {
        $result = parent::getByName($pattern);

        $this->fixPageCount($result);

        return $this->filterPerPagination($result);
    }

    /**
     * {@inheritdoc}
     */
    public function getByReference(string $pattern): array
    {
        $result = parent::getByReference($pattern);

        $this->fixPageCount($result);

        return $this->filterPerPagination($result);
    }

    /**
     * {@inheritdoc}
     */
    public function get(): array
    {
        $result = parent::get();

        $this->fixPageCount($result);

        return $this->filterPerPagination($result);
    }

    public function getLastPageCount()
    {
        return $this->pageCount;
    }

    /**
     * Filtre les éléments selon la pagination demandée
     *
     * @param $result
     *
     * @return array
     */
    protected function filterPerPagination($result): array
    {
        $paginatedResult = [];

        $firstIndex = $this->countPerPage * $this->page;
        $lastIndex = ($this->countPerPage * ($this->page + 1)) - 1;

        $index = 0;
        foreach ($result as $element) {
            if ($index >= $firstIndex && $index <= $lastIndex) {
                $paginatedResult[] = $element;
            }
            $index++;
        }

        return $paginatedResult;
    }

    /**
     * Fixe le nombre de page en fonction d'un résultat
     *
     * @param Product[] $result
     */
    protected function fixPageCount($result): void
    {
        $this->pageCount = (int) ceil(\count($result) / $this->countPerPage);
    }
}
