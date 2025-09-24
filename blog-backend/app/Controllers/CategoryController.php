<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Category;

class CategoryController extends BaseController
{

    protected $validationRules = [
        'name'      => 'required|min_length[3]|max_length[255]'
    ];

    protected $validationRulesUpdate = [
        'name'      => 'required|min_length[3]|max_length[255]'
    ];

    public function index()
    {
        return $this->response->setJSON([
            'status' => 'success',
            'data' => (new Category())->findAll()
        ]);
    }

    public function store()
    {
        if (!$this->validate($this->validationRules)) {
            return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
        }

        $data = [
            'name'       => $this->request->getJSON('name'),
        ];

        $model = new Category();
        $model->save($data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Categoría creada correctamente.']);
    }

    // public function edit($id) //* No usado sin vista
    // {
    //     $postModel = new Category();
    //     $data['post'] = $postModel->find($id);
    //     return view('admin/edit_post', $data);
    // }

    public function update($id)
    {

        if (!$this->validate($this->validationRules)) {
            return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
        }

        $model = new Category();
        $category = $model->find($id);

        if (!$category) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Categoría no encontrada.']);
        }

        $input = $this->request->getJSON(true); // Obtener datos como array asociativo

        $data = [
            'name'       => $input['name'] ?? null, // Usar null si no está definido
        ];

        $model->update($id, $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Categoría actualizada correctamente.']);
    }


    public function delete($id)
    {
        $model = new Category();
        $category = $model->find($id);

        if (!$category) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Categoría no encontrada.']);
        }

        $model->delete($id);
        return $this->response->setJSON(['status' => 'success', 'message' => 'Categoría eliminada correctamente.']);
    }
}
