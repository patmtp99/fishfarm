<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SupplierModel;

class Supplier extends BaseController
{
	public function index()
    {
    //    initialise data array
        

        $supplierM = new SupplierModel();
        $suppliers = $supplierM->findAll();
        $session = session();

        $data = [
            'title' => 'Suppliers',
            'session' => $session,
            'supplier' => $suppliers,
        ];
        return view('supplier/listing',$data);
    }

    public function add(){
        $session = session();

        $data = [
            'title' => 'Suppliers',
            'session' => $session,
        ];

        if($this->request->getMethod() == 'post'){
            $rules = [
                'name' => 'required|min_length[3]|max_length[30]',
                'description' => 'required|min_length[3]|max_length[200]', 
                'contact' => 'required|min_length[3]|max_length[200]', 
                'email' => 'required|min_length[3]|max_length[200]', 
                'address' => 'required|min_length[3]|max_length[200]', 
            ];
    
            if (! $this->validate($rules)) {
                $data['validation'] = $this->validator;
            }else{
                $model = new SupplierModel();
                $newData = [
                    'name' => $this->request->getVar('name'),
                    'description' => $this->request->getVar('description'),                    
                    'contact' => $this->request->getVar('contact'),                    
                    'email' => $this->request->getVar('email'),                    
                    'address' => $this->request->getVar('address'),                    
                ];
                $model->save($newData);$session = session();
                $session->setFlashData('success','Supplier Added successfully');
                return redirect()->to('/fishfarm_ci/public/supplier');
            }
        }
        view('supplier/form',$data);


    }

    public function edit($id)
    {
        helper('form');
        $model = new SupplierModel();
        $session = session();
        //   fetch data
        $supplier = $model->find($id);
        $data = [
            'title' => 'Update supplier Details',
            'supplier' => $supplier,
            'action' => 'update'
        ];
        // load form with fetch data 
        echo view('fishform',$data);

        // validate form data 
        // update data
        if($this->request->getMethod() == 'post'){
            $model = new SupplierModel();
            $supplierUpdate = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),                    
                'contact' => $this->request->getVar('contact'),                    
                'email' => $this->request->getVar('email'),                    
                'address' => $this->request->getVar('address'),                    
            ];
            $model->db->table('fish')->update($supplierUpdate, ['id' => $id]);
            $session->setFlashData('success','Fish Data Updated');
                    return redirect()->to('/fishfarm_ci/public/fish');
    }

    }


}