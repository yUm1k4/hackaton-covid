<?php

namespace App\Controllers;

use \App\Models\RsRujukanModel;

class RsRujukan extends BaseController
{
    public function __construct()
    {
        $this->rs_rujukan = new RsRujukanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'RS Rujukan - Covid 19'
        ];

        return view('rs_rujukan/index', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata'    => $this->rs_rujukan->findAll()
            ];

            $msg = [
                'data' => view('rs_rujukan/tblRsRujukan', $data)
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
                'data' => view('rs_rujukan/modalTambah')
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
                'nama'  => [
                    'label' => 'Nama',
                    'rules' => 'required|min_length[5]|max_length[50]|is_unique[rs_rujukan.nama]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 5 karakter',
                        'max_length' => '{field} maximal 50 karakter',
                        'is_unique' => '{field} sudah terdaftar',
                    ]
                ],
                'hotline'  => [
                    'label' => 'Hotline',
                    'rules' => 'required|min_length[10]|max_length[13]|numeric',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 10 karakter',
                        'max_length' => '{field} maximal 13 karakter',
                        'numeric' => '{field} hanya boleh angka',
                    
                    ]
                ],
                'alamat'  => [
                    'label' => 'Alamat',
                    'rules' => 'required|min_length[10]|max_length[200]',
                    'errors' => [
                        'required'  => '{field} tidak boleh kosong',
                        'min_length' => '{field} minimal 10 karakter',
                        'max_length' => '{field} maximal 200 karakter'
                    ]
                ],
            ]);

            // jika tidak valid (Ada yg salah)
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama'  => $validation->getError('nama'),
                        'hotline'  => $validation->getError('hotline'),
                        'alamat'  => $validation->getError('alamat')
                    ]
                ];
            } else {
                // jika validasi sukses (benar)
                $simpandata = [
                    'nama' =>  $this->request->getVar('nama'),
                    'hotline' =>  $this->request->getVar('hotline'),
                    'alamat' =>  $this->request->getVar('alamat')
                ];
                $this->rs_rujukan->insert($simpandata);
                $msg = ['sukses' => 'RS Rujukan baru berhasil ditambahkan'];
            }
            echo json_encode($msg);
        } else {
            session()->setFlashdata('error', 'Maaf tidak dapat diproses');
            return redirect()->back();
        }
    }
}
