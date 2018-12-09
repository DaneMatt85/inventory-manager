<?php
namespace App\Controller\Api;
use App\Controller\Api\ApiController;

/**
 * Skus Controller
 *
 * @property \App\Model\Table\SkusTable $Skus
 *
 * @method \App\Model\Entity\Skus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SkusController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {       
        $this->data = $this->Skus->find()
            ->contain(['Products'])        
            ->where(['Products.user_id' => $this->user_id])
            ->toArray();  
            
        // SKUs are dependant on products, but we have product data to ensure only a user's skus are fetched
        // so remove product data before responding
        array_walk($this->data, function($sku) {
            unset($sku->product);
        });           

        $this->returnResponse();         
    }

    /**
     * View method
     *
     * @param string|null $id Skus id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->data = $this->Skus->find()
            ->contain(['Products'])        
            ->where([
                'Skus.id' => $id,
                'Products.user_id' =>  $this->user_id
            ])
            ->first();
    
        unset($this->data->product);       

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
        $sku = $this->Skus->newEntity();

        if ($this->request->is('post')) {
            
            $postData = $this->request->getData();
            $postData['user_id'] = $this->user_id;            
            $this->data = $this->Skus->patchEntity($sku, $postData);
           
            if ($this->data['product_id'] && $this->Skus->save($this->data)) {                    
                
                $this->header = 'created';
            
            } elseif(!$this->data['product_id']) {

                // Not ideal should rather be handled by ORM validation, however the nature of the 
                // model where product's are the parent object makes this dynamic validation tricky and overkill for the scope
                $this->errors = ['product_id' => ['_required' => 'This field is required']];                
                $this->success = false;              

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
     * @param string|null $id Skus id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {         
        $postData = $this->request->getData();
        $postData['user_id'] = $this->user_id;  
        
        $sku = $this->Skus->find()
                ->contain(['Products'])        
                ->where([
                    'Skus.id' => $id,
                    'Products.user_id' =>  $this->user_id
                ])
                ->first();    
        
        // Make PUT requests idempotent, ideally should be on ORM level, but dynamic validation for this scope is overkill
        if ($this->request->is(['put'])) {               

            $putRequired = ['sku', 'price', 'product_id','quantity'];                        
            foreach($putRequired AS $field) {
              
                if (empty($postData[$field])) {                  
                    $this->errors[] = [$field => ['_required' => 'This field is required']];                
                    $this->success = false;    
                }
            }            
        }
        
        $this->data = $sku ? $this->Skus->patchEntity($sku, $postData) : []; 

        if ($this->success && $this->data && !$this->Skus->save($this->data)) {                    

            $this->errors = $this->data->errors();                
            $this->success = false;
        } 
        
        unset($this->data->product);
        $this->returnResponse();
    }

    /**
     * Delete method
     *
     * @param string|null $id Skus id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);
        $this->data = $this->Skus->find()
            ->contain(['Products'])        
            ->where([
                'Skus.id' => $id,
                'Products.user_id' =>  $this->user_id
            ])
            ->first();
       
        if ($this->data && !$this->Skus->delete($this->data)) {
            $this->success = false;  
        }     

        $this->returnResponse();                               
    }  
}
