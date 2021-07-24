<?php

namespace App\Controllers;

use \App\Models\RegistrasiVaksinModel;
use Myth\Auth\Models\UserModel;

class RegistrasiVaksin extends BaseController
{
    public function __construct()
    {
        $this->reg_vaksin = new RegistrasiVaksinModel();
        $this->user = new UserModel();
    }

    public function getUser()
    {
        $request = service('request');
        $postData = $request->getVar();
        $response = array();

        if (!isset($postData['searchTerm'])) {
            // Fetch record
            $userlist = $this->user->select('id,username')
                ->orderBy('username')
                ->findAll();
        } else {
            $searchTerm = $postData['searchTerm'];

            // Fetch record
            $userlist = $this->user->select('id,username')
                ->like('username', $searchTerm)
                ->orderBy('username')
                ->findAll(10);
                // ->findAll();
        }
        $data = array();
        foreach ($userlist as $user) {
            $data[] = array(
                "id" => $user->id,
                "text" => 'Username: ' . $user->username,
            );
        }

        $response['data'] = $data;
        return $this->response->setJSON($response);
    }

    public function index()
    {
        $data = [
            'title' => 'Registrasi Vaksin - Covid 19'
        ];

        return view('reg_vaksin/index', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $users = $this->reg_vaksin->select('*, users.username, registrasi_vaksin.status, registrasi_vaksin.created_at as registrasi_dibuat')
                            ->join('users', 'users.id = registrasi_vaksin.user_id')
                            ->orderBy('registrasi_dibuat')
                            ->get();

            $data = [
                'tampildata'    => $users->getResultArray(),
            ];

            $msg = [
                'data' => view('reg_vaksin/tblRegistrasiVaksin', $data)
            ];

            echo json_encode($msg);
        } else {
            session()->setFlashdata('error', 'Maaf tidak dapat diproses');
            return redirect()->back();
        }
    }

    public function formtambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => view('reg_vaksin/modalTambah')
            ];

            echo json_encode($msg);
        } else {
            session()->setFlashdata('error', 'Maaf tidak dapat diproses');
            return redirect()->back();
        }
    }

    public function simpandata()
    {
        if ($this->request->isAJAX()) {
            // Validasi
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'user_id'  => [
                    'label' => 'user_id',
                    'rules' => 'required|is_unique[registrasi_vaksin.user_id]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong',
                        'is_unique' => 'User sudah terdaftar',
                    ]
                ],
            ]);

            // jika tidak valid (Ada yg salah)
            if (!$valid) {
                $msg = [
                    'error' => [
                        'user_id'  => $validation->getError('user_id'),
                    ]
                ];
            } else {
                // jika validasi sukses (benar)
                $user_id = $this->request->getVar('user_id');
                $simpandata = [
                    'user_id' =>  $user_id,
                    'nik' =>  $this->request->getVar('nik'),
                    'no_hp' =>  $this->request->getVar('no_hp'),
                    'alamat' =>  $this->request->getVar('alamat'),
                    'status' =>  'pending',
                ];
                $this->reg_vaksin->insert($simpandata);
                $msg = ['sukses' => 'Registrasi Vaksin baru berhasil ditambahkan'];
            }
            echo json_encode($msg);
        } else {
            session()->setFlashdata('error', 'Maaf tidak dapat diproses');
            return redirect()->back();
        }
    }

    public function hapus()
    {
        if ($this->request->isAJAX()) {
            $id_reg_vaksin = $this->request->getVar('id_reg_vaksin');
            $this->reg_vaksin->delete($id_reg_vaksin);

            $msg = ['sukses' => "User Registrasi Vaksin berhasil dihapus"];
            echo json_encode($msg);
        } else {
            return redirect()->to(base_url(''));
        }
    }
}
