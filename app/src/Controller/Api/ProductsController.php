<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 *
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends ApiController
{   
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {      
        $this->data = $this->Products->find()
            ->contain([
                'Skus', 
                'Categories'
            ])            
            ->where(['user_id' =>  $this->user_id])
            ->toArray();                         

        $this->returnResponse();                       
    }    

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {        
        $this->data = $this->Products->find()
            ->contain(['Categories', 'Skus'])        
            ->where([
                'id' => $id,
                'user_id' => $this->user_id
            ])
            ->first();         

        $this->returnResponse();      
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $errors =[];     
        $product = $this->Products->newEntity([
            'associated' => [
                'Skus', 
                'Categories'
            ]
        ]);

        if ($this->request->is('post')) {
            
            $postData = $this->request->getData();
            $postData['user_id'] = $this->user_id; 
            
            if($postData['categories']) {
                foreach ($postData['categories'] as $key => &$value) {
                    $value['user_id'] = $this->user_id; 
                }
            }
                
            $this->data = $this->Products->patchEntity($product, $postData, [                
                'associated' => [
                    'Skus',
                    'Categories'
                ]
            ]);               
         
            if ($this->Products->save($this->data)) {                    
                
                $this->header = 'created';

            } else {

                $this->errors = $this->data->errors();                
                $this->success = false;              
            }            
        }     
        
        $this->returnResponse();        
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) 
    {
       
        $postData = $this->request->getData();       
        $postData['user_id'] = $this->user_id;   

        $product = $this->Products->find()
            ->contain([
                'Categories', 
                'Skus'
            ])        
            ->where([
                'id' => $id,
                'user_id' => $this->user_id
            ])
            ->first();  
                    
        if ($this->request->is(['patch'])) {            
             
            $existing_cats = [];   
            $existing_skus = [];    
           
            foreach ($product['skus'] as $key => $sku) {
                $existing_skus[] = $sku['id'];
            } 
            foreach ($product['categories'] as $key => $category) {
                $existing_cats[] = $category['id'];
            }   

            $postData['skus']['_ids'] = $postData['skus']['_ids'] ?? []; 
            $postData['skus']['_ids'] = array_merge($postData['skus']['_ids'],  $existing_skus);
            
            $postData['categories']['_ids'] = $postData['categories']['_ids'] ?? [];
            $postData['categories']['_ids'] = array_merge($postData['categories']['_ids'],  $existing_cats);    
        }        

        // Unset so PUT is idempotent, we will be patching the existing cat and SKU ids from above
        unset($product->skus);
        unset($product->categories);  

        $this->data = $this->Products->patchEntity($product, $postData, [                
            'associated' => [
                'Skus' => ['onlyIds' => true],
                'Categories' => ['onlyIds' => true]
            ]
        ]);   
        
        if (!$this->Products->save($this->data)) {                    

            $this->errors = $this->data->errors();                
            $this->success = false;
        }  
        
        $this->returnResponse();   
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $this->request->allowMethod(['delete']);
        $this->data = $this->data = $this->Products->find()                
            ->where([
                'id' => $id,
                'user_id' => $this->user_id
            ])
            ->first();

        if ($this->data && !$this->Products->delete($this->data)) {
            $this->success = false;  
        }         

        $this->returnResponse();   
    }    
}
