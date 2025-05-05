<?php
namespace App\Controllers;

use App\Models\Denda;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class DendaController extends ResourceController
{
    protected $modelName = 'App\Models\Denda';
    protected $format    = 'json';
    protected $model;

    public function __construct()
    {
        $this->model = new Denda();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->findAll();
        $ref  = [
            'status'     => 200,
            'message'    => 'success',
            'totalData'  => count($data),
            'data_denda' => $data,
        ];
        return $this->respond($ref, 200);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        if ($id === null) {
            return $this->fail('Parameter tidak boleh kosong.');
        }

        if (is_numeric($id)) {
            $userData  = $this->model->find($id);
            $fieldType = 'id_denda';
        } else {
            $userData  = $this->model->where('keterangan', $id)->first();
            $fieldType = 'keterangan';
        }
        if ($userData === null) {
            return $this->failNotFound("Data dengan $fieldType '$id' tidak ditemukan.");
        }

        $data = [
            'message'    => 'success',
            'data_denda' => $userData,
        ];

        return $this->respond($data, 200);

    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new ()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $rules = [
            'id_pinjaman' => 'required',
            'jumlah_denda' => 'required',
            'tangaal_denda' => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert(
            [
                'id_pinjaman' => esc($this->request->getVar('id_pinjaman')),
                'jumlah_denda' => esc($this->request->getVar('jumlah_denda')),
                'tangaal_denda' => esc($this->request->getVar('tangaal_denda')),
            ]
        );
        $response = [
            'message' => 'data berhasil disimpan',
        ];

        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $input = $this->request->getRawInput();

        $data = [];

        if (! empty($input['id_pinjaman'])) {
            $data['id_pinjaman'] = esc($input['id_pinjaman']);
        }
        if (! empty($input['jumlah_denda'])) {
            $data['jumlah_denda'] = esc($input['jumlah_denda']);
        }
        if (! empty($input['tangaal_denda'])) {
            $data['tangaal_denda'] = esc($input['tangaal_denda']);
        }

        if (empty($data)) {
            return $this->fail('Tidak ada data yang diupdate.');
        }

        $this->model->update($id, $data);
        $response = [
            'status'  => 200,
            'error'   => false,
            'message' => 'data berhasil diupdate',
        ];

        return $this->respondUpdated($response);
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        $response = [
            'message' => 'data berhasil dihapus',
        ];

        return $this->respondDeleted($response);
    }
}
