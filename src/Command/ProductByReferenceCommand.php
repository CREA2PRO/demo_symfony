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
 * Class ProductByReferenceCommand
 *
 * Recherche un produit par sa référence
 */
class ProductByReferenceCommand extends Command
{
    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * ProductByReferenceCommand constructor.
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
            ->setName('app:products:by-reference')
            ->setDescription('Cherche un produit par référence')
            ->setHelp('La commande liste les produits qui ont une référence spécifique')
            ->addArgument('reference', InputArgument::REQUIRED, 'Référence');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('recherche produit par référence');

        $reference = $input->getArgument('reference');

        $io->note('La référence est : '.$reference);

        $produits = $this->productRepository->getByReference($reference);

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
