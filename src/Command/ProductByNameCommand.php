<?php
/**
 * Created by PhpStorm.
 * User: ricardo
 * Date: 19/06/18
 * Time: 13:55
 */

namespace App\Command;

use App\Repository\ProductRepository;
use App\Repository\ProductRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ProductByNameCommand
 *
 * Recherche des produits par le nom
 */
class ProductByNameCommand extends Command
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductByNameCommand constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:products:by-name')
            ->setDescription('Cherche les produits par nom')
            ->setHelp('La commande liste les produits qui contient le motif dans le nom')
            ->addArgument('motif', InputArgument::REQUIRED, 'Motif dans le nom');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('recherche produit par nom');

        $motif = $input->getArgument('motif');

        $io->note('Le motif est : '.$motif);

        $produits = $this->productRepository->getByName($motif);

        $dataOutput = [];
        foreach ($produits as $produit) {
            $dataOutput[] = [
                $produit->getReference(),
                $produit->getName(),
                $produit->getPosition()->getBatiment(),
                $produit->getPosition()->getCouloir(),
            ];
        }

        $io->table(['reference', 'nom', 'batiment', 'couloir'], $dataOutput);
    }
}
