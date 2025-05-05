<?php
namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\User';
    protected $format    = 'json';
    protected $model;
    public function __construct()
    {
        $model = new User();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $data = $this->model->orderBy('id_user', 'desc')->findAll();
        $ref  = [
            'status'    => 200,
            'message'   => 'success',
            'totalData' => count($data),
            'data_user' => $data,
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
    public function show($param = null)
    {

        if ($param === null) {
            return $this->fail('Parameter tidak boleh kosong.');
        }

        if (is_numeric($param)) {
            $userData  = $this->model->find($param);
            $fieldType = 'id_user' || 'nik';
        } else {
            $userData  = $this->model->where('nama', $param)->first();
            $fieldType = 'nama';
        }

        if ($userData === null) {
            return $this->failNotFound("Data dengan filedType '$param' tidak ditemukan.");
        }

        $data = [
            'message'   => 'success',
            'data_user' => $userData,
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
            'nik'      => 'required',
            'nama'     => 'required',
            'email'    => 'required',
            'password' => 'required',
            'alamat'   => 'required',
            'no_hp'    => 'required',
        ];

        if (! $this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $this->model->insert(
            [
                'nik'      => esc($this->request->getVar('nik')),
                'nama'     => esc($this->request->getVar('nama')),
                'email'    => esc($this->request->getVar('email')),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'alamat'   => esc($this->request->getVar('alamat')),
                'no_hp'    => esc($this->request->getVar('no_hp')),
                'rule'     => 'user',
            ]
        );
        $response = [
            'message' => 'data berhasil ditambahkan',
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
        // Ambil input mentah
        $input = $this->request->getRawInput();

        // Siapkan array kosong untuk data yang akan diupdate
        $data = [];

        // Cek dan isi data hanya jika ada di input
        if (! empty($input['nik'])) {
            $data['nik'] = esc($input['nik']);
        }
        if (! empty($input['nama'])) {
            $data['nama'] = esc($input['nama']);
        }

        if (! empty($input['email'])) {
            $data['email'] = esc($input['email']);
        }

        if (! empty($input['password'])) {
            $data['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        }

        if (! empty($input['alamat'])) {
            $data['alamat'] = esc($input['alamat']);
        }

        if (! empty($input['no_hp'])) {
            $data['no_hp'] = esc($input['no_hp']);
        }
        if (! empty($input['rule'])) {
            $data['rule'] = esc($input['rule']);
        }

        // Cegah update kosong
        if (empty($data)) {
            return $this->fail('Tidak ada data yang diubah', 400);
        }

        // Proses update
        $this->model->update($id, $data);

        $response = [
            'status'  => 200,
            'error'   => false,
            'message' => 'Data berhasil diupdate',
        ];

        return $this->respond($response, 200);
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
