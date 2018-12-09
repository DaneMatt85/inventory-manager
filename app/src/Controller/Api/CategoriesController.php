<?php
namespace App\Controller\Api;
use App\Controller\Api\ApiController;

/**
 * Categories Controller
 *
 * @property \App\Model\Table\CategoriesTable $Categories
 *
 * @method \App\Model\Entity\Category[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CategoriesController extends ApiController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {    
        $this->data =  $this->Categories->find()            
            ->where(['user_id' =>  $this->user_id]);                     

        $this->returnResponse();  
    }

    /**
     * View method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {       
        $this->data = $this->Categories->find()            
            ->where([
                'id' => $id,
                'user_id' =>  $this->user_id]
            );                    

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
        $category = $this->Categories->newEntity(['associated' => ['products']]);

        if ($this->request->is('post')) {
            
            $postData = $this->request->getData();
            $postData['user_id'] = $this->user_id;            
            
            $this->data = $this->Categories->patchEntity($category, $postData, [
                'associated' => [              
                    'Products' => ['onlyIds' => true]
                ]
            ]);
           
            if ($this->Categories->save($this->data)) {                   
                
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
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postData = $this->request->getData();
        $postData['user_id'] = $this->user_id;   
        
        if ($this->request->is(['patch', 'put'])) {
            
            $category = $this->Categories->find()            
                ->where([
                    'id' => $id,
                    'user_id' =>  $this->user_id
                ])
                ->first();

            $this->data = $this->Categories->patchEntity($category, $postData);    
            
            if (!$this->Categories->save($this->data)) {                    

                $this->errors = $this->data->errors();                
                $this->success = false;
            }  
        }
        
        $this->returnResponse();
    }

    /**
     * Delete method
     *
     * @param string|null $id Category id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['delete']);

        $this->data = $this->Categories->find()            
            ->where([
                'id' => $id,
                'user_id' =>  $this->user_id
            ])
            ->first();
      
        if ($this->data && !$this->Categories->delete($this->data)) {
            $this->success = false;  
        } 

        $this->returnResponse();   
    }
}
