<?php

namespace App\Controller;

use App\Entity\MPItem;
use App\Entity\Product;
use App\Form\ProductType;
use App\Form\MainFormType;
use App\Service\WalmartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Walmart\Models\MP\US\Inventory\Inventory;
use Walmart\Models\MP\US\Inventory\InputQty;

class ProductController extends AbstractController
{
    private $walmartService;
    private $projectRoot;

    public function __construct(KernelInterface $kernel,WalmartService $walmartService)
    {
        $this->walmartService = $walmartService;
        $this->projectRoot = $kernel->getProjectDir();
    }

    #[Route('/', name: 'products', methods: ['GET'])]
    public function getProductsWithInventory(Request $request): Response{
        try {
            $publishedStatus = $request->query->get('publishedStatus', '');
            $products = $this->fetchAllProducts($publishedStatus);
            $productsWithInventory = $this->appendInventoryToProducts($products);
            $productCount = count($products);
        } catch (\Exception $e) {
            return new Response('Error fetching products: ' . $e->getMessage());
        }
        return $this->render('product/show.html.twig', [
            'productsWithInventory' => $productsWithInventory,
            'count' => $productCount,
            'currentStatus' => $publishedStatus
        ]);
            }

    #[Route('/product/create', name: 'bulk_product')]
    public function postProduct(Request $request): Response{
        $form = $this->createForm(MainFormType::class, ['mpItem' => new MPItem()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleProductSubmission($form, $request);
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/product/addinventory/{id}', name: 'add_inventory')]
    public function addInventoryToProduct(Request $request, $id): Response{
        $form = $this->createForm(ProductType::class, (new Product())->setSku($id));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           $isSuccessful = $this->updateProductInventory($form, $id);
            if ($isSuccessful) {
                $this->addFlash('success', 'Inventory added successfully!');
            }

            return $this->redirectToRoute('products');
           
        }

        return $this->render('product/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/clearfeedid', name: 'clear_feedid')]
    public function clearFeedId(Request $request): Response{
        $request->getSession()->remove('feedId');
        return $this->redirectToRoute('bulk_product');
    }

    #[Route('/removeitem', name: 'remove_item', methods: ['POST'])]
    public function retireProduct(Request $request): Response {
    $sku = $request->request->get('sku');
    $isSuccessful = $this->deleteItem($sku);
    if($isSuccessful){
        $this->addFlash('success', 'Item removed successfully!');
    } else {
        $this->addFlash('error', 'Failed to remove item!');
    }
    return $this->redirectToRoute('products');
}



    private function fetchAllProducts($publishedStatus = ''){
        $response = $this->walmartService->getItems()->getAllItems(publishedStatus : $publishedStatus);
        return $response->getItemResponse();
    }

    private function appendInventoryToProducts($products){
        $productsWithInventory = [];
        foreach ($products as $product) {
            $gtin = $product['gtin'];
            $sku = $product['sku'];
            $inventory = $this->walmartService->getInventory()->getInventory($sku);
            $productSearchResponse = $this->walmartService->getItems()->getSearchResult($gtin);
            $dataArray = json_decode($productSearchResponse, true);
            $imageUrl = isset($dataArray['items'][0]['images'][0]['url']) ? $dataArray['items'][0]['images'][0]['url'] : null;
            $productsWithInventory[] = [
                'product' => $product,
                'inventory' => $inventory,
                'productSearch' => $imageUrl
            ];
                   }
                   
        return $productsWithInventory;
    }

    private function handleProductSubmission($form, $request){
        $mpItemData = $form->get('mpItem')->getData();

        // Set up MPItemFeedHeader data
        $mpItemFeedHeaderData = [
            'sellingChannel' => 'marketplace',
            'processMode' => 'REPLACE',
            'subset' => 'EXTERNAL',
            'locale' => 'en',
            'version' => '4.8',
        ];

        $dataToSend = [
            'MPItemFeedHeader' => $mpItemFeedHeaderData,
            'MPItem' => [$mpItemData->toArray()]
        ];

        $jsonDataToSend = json_encode($dataToSend, JSON_PRETTY_PRINT);

        // Write JSON to file
        $filePath = $this->projectRoot . '/src/assets/bulkitem.json';
        $fileWritten = @file_put_contents($filePath, $jsonDataToSend);

        if ($fileWritten !== false) {
            $feedType = 'MP_ITEM';
            $fileObject = new \SplFileObject($filePath, 'r');
           try {
                $result = $this->walmartService->getItems()->itemBulkUploads($feedType, $fileObject);
                if (isset($result['feedId'])) {
                    $request->getSession()->set('feedId', $result['feedId']);
                }
            } catch (\Exception $e) {
                $this->addFlash('error', 'Error sending data to Walmart: ' . $e->getMessage());
            } 
        } else {
            $error = error_get_last();
            throw new \RuntimeException("Failed to write to file. Error: " . $error['message']);
        }
    }

    private function updateProductInventory($form, $id){
        $inputQty = new InputQty();
        $walmartInventory = new Inventory();

        $quantityEntity = $form->getData()->getQuantity(); 
        $amount = $quantityEntity->getAmount();
        $unit = $quantityEntity->getUnit();
        $inputQty->setUnit($unit);
        $inputQty->setAmount($amount);
        $walmartInventory->setSku($id);
        $walmartInventory->setQuantity($inputQty);

        try {
           $this->walmartService->getInventory()->updateInventoryForAnItem($id, $walmartInventory);
           return true;
        } catch (\Exception $e) {
            echo "Error: {$e->getMessage()}\n";
        }
        return false;
    }


    private function deleteItem($sku){
        try{
            $this->walmartService->getItems()->retireAnItem($sku);
            return true;
        }
        catch(\Exception $e){
            echo "Error: {$e->getMessage()}\n";
            
        }
        return false;
    }   
}
