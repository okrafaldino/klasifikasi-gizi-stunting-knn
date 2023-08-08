<?php

namespace App\Controllers;

use App\Models\BalitaModel;
use Config\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DataBalita extends BaseController
{
    protected $balitaModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->balitaModel = new BalitaModel();
    }

    public function index()
    {
        // $balita = $this->balitaModel->findAll();

        $data = [
            'title' => 'Data',
            'balita' => $this->balitaModel->getBalita()
        ];

        return view('admin/databalita/index', $data);
    }

    public function input()
    {
        session();
        $data = [
            'title' => 'Form Input Data',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/databalita/input', $data);
    }

    public function simpan()
    {
        // Validasi Input
        $rules = [
            'nama' => [
                'label'  => 'Nama',
                'rules'  => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'alpha_space' => 'Kolom {field} hanya boleh mengandung huruf dan spasi.'
                ],
            ],
            'umur' => [
                'label'  => 'Umur',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong.',
                    'numeric' => 'Kolom {field} hanya boleh diisi dengan angka.'
                ],

            ],
            'beratbadan' => [
                'label'  => 'Berat Badan',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong.',
                    'numeric' => 'Kolom {field} hanya boleh diisi dengan angka.'
                ],

            ],
            'tinggibadan' => [
                'label'  => 'Tinggi Badan',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong.',
                    'numeric' => 'Kolom {field} hanya boleh diisi dengan angka.'
                ],
            ]
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->balitaModel->save([
            'nama'          => $this->request->getPost('nama'),
            'umur'          => $this->request->getPost('umur'),
            'beratbadan'   => $this->request->getPost('beratbadan'),
            'tinggibadan'  => $this->request->getPost('tinggibadan'),
            'status'        => $this->request->getPost('status')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !! .');

        return redirect()->to('/databalita');
    }

    public function delete($id)
    {
        $this->balitaModel->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !! .');
        return redirect()->to('/databalita');
    }

    public function update($id)
    {
        $data = [
            'title' => 'Form Update Data Balita',
            'balita' => $this->balitaModel->getBalita($id),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/databalita/edit', $data);
    }

    public function simpanupdate($id)
    {
        // Validasi Input
        $rules = [
            'nama' => [
                'label'  => 'Nama',
                'rules'  => 'required|alpha_space',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'alpha_space' => 'Kolom {field} hanya boleh mengandung huruf dan spasi.'
                ],
            ],
            'umur' => [
                'label'  => 'Umur',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong.',
                    'numeric' => 'Kolom {field} hanya boleh diisi dengan angka.'
                ],

            ],
            'beratbadan' => [
                'label'  => 'Berat Badan',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong.',
                    'numeric' => 'Kolom {field} hanya boleh diisi dengan angka.'
                ],

            ],
            'tinggibadan' => [
                'label'  => 'Tinggi Badan',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} tidak boleh kosong.',
                    'numeric' => 'Kolom {field} hanya boleh diisi dengan angka.'
                ],
            ]
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->balitaModel->save([
            'id' => $id,
            'nama'          => $this->request->getPost('nama'),
            'umur'          => $this->request->getPost('umur'),
            'beratbadan'   => $this->request->getPost('beratbadan'),
            'tinggibadan'  => $this->request->getPost('tinggibadan'),
            'status'        => $this->request->getPost('status')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ubah !! .');

        return redirect()->to('/databalita');
    }

    public function import()
    {
        // Ambil file excel dari form
        $file = $this->request->getFile('file_excel');

        // Validasi file yang diupload adalah file excel
        if (!$file || !$file->isValid() || !in_array($file->getClientMimeType(), ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])) {
            session()->setFlashdata('pesan', 'File yang diupload bukan file excel');
            return redirect()->to('/databalita');
        }

        // Proses pembacaan data dari file excel
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file->getPathname());
        $worksheet = $spreadsheet->getActiveSheet();

        // Get the highest row and column numbers referenced in the worksheet
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5

        // Lakukan loop untuk membaca setiap baris pada file excel
        for ($row = 2; $row <= $highestRow; ++$row) {
            $data = [];
            for ($col = 2; $col <= $highestColumnIndex; ++$col) {
                $value = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                $data[] = $value;
            }

            // Simpan data ke database
            $this->balitaModel->save([
                'nama' => $data[0],
                'umur' => $data[1],
                'beratbadan' => $data[2],
                'tinggibadan' => $data[3],
                'status' => $data[4]
            ]);
        }
        // Setelah selesai memproses data, tampilkan pesan berhasil
        session()->setFlashdata('pesan', 'Data berhasil diimport.');
        return redirect()->to('/databalita');
    }
}
