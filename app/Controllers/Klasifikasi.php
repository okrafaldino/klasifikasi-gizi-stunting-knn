<?php

namespace App\Controllers;

use App\Models\DataUjiModel;
use App\Models\BalitaModel;
use Config\Services;

class Klasifikasi extends BaseController
{
    protected $dataUjiModel;
    protected $balitaModel;
    protected $helpers = ['form'];


    public function __construct()
    {
        $this->dataUjiModel = new DataUjiModel();
        $this->balitaModel = new BalitaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Klasifikasi',
            'uji' => $this->dataUjiModel->getUji()
        ];

        return view('user/klasifikasi/index', $data);
    }

    public function input()
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

        $this->dataUjiModel->save([
            'nama'          => $this->request->getPost('nama'),
            'umur'          => $this->request->getPost('umur'),
            'beratbadan'   => $this->request->getPost('beratbadan'),
            'tinggibadan'  => $this->request->getPost('tinggibadan')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan !! .');

        return redirect()->to('/klasifikasi');
    }

    public function update($id)
    {
        $data = [
            'title' => 'Form Update Data Uji',
            'uji' => $this->dataUjiModel->getUji($id),
            'validation' => \Config\Services::validation()
        ];

        return view('user/klasifikasi/edit', $data);
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

        $this->dataUjiModel->save([
            'id' => $id,
            'nama'          => $this->request->getPost('nama'),
            'umur'          => $this->request->getPost('umur'),
            'beratbadan'   => $this->request->getPost('beratbadan'),
            'tinggibadan'  => $this->request->getPost('tinggibadan')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil Ubah !! .');

        return redirect()->to('/klasifikasi');
    }

    public function delete($id)
    {
        $this->dataUjiModel->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil Dihapus !! .');
        return redirect()->to('/klasifikasi');
    }


    public function proses()
    {
        // Validasi Input
        $rules = [
            'k' => [
                'label'  => 'Nilai K',
                'rules'  => 'required|numeric',
                'errors' => [
                    'required' => 'Kolom {field} wajib diisi.',
                    'numeric' => 'Kolom {field} hanya boleh mengandung angka'
                ],
            ]
        ];

        if (!$this->validate($rules)) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $k = $this->request->getPost('k');
        $data_uji = $this->dataUjiModel->getUji();
        $data_balita = $this->balitaModel->getBalita();

        // Inisialisasi array untuk menyimpan hasil jarak, balita terdekat, dan status klasifikasi
        $hasil_klasifikasi = [];

        // Looping untuk setiap data uji
        foreach ($data_uji as $uji) {
            $jarak = [];
            $balita_terdekat = [];

            foreach ($data_balita as $balita) {
                $jarak_balita = sqrt(
                    pow($balita['umur'] - $uji['umur'], 2) +
                        pow($balita['beratbadan'] - $uji['beratbadan'], 2) +
                        pow($balita['tinggibadan'] - $uji['tinggibadan'], 2)
                );

                $jarak[] = [
                    'nama' => $balita['nama'],
                    'umur' => $balita['umur'],
                    'beratbadan' => $balita['beratbadan'],
                    'tinggibadan' => $balita['tinggibadan'],
                    'jarak' => $jarak_balita,
                    'status' => $balita['status']
                ];
            }

            // Urutkan array jarak berdasarkan jarak secara ascending
            usort($jarak, function ($a, $b) {
                return $a['jarak'] <=> $b['jarak'];
            });

            $balita_terdekat = array_slice($jarak, 0, $k);

            $stunting_count = 0;

            foreach ($balita_terdekat as $balita) {
                if ($balita['status'] == 'Stunting') {
                    $stunting_count++;
                }
            }

            $status_uji = $stunting_count >= ($k / 2) ? 'Stunting' : 'Normal';

            // Simpan hasil jarak, balita terdekat, dan status klasifikasi ke dalam array
            $hasil_klasifikasi[] = [
                'data_uji' => $uji,
                'jarak' => $jarak,
                'balita_terdekat' => $balita_terdekat,
                'status_uji' => $status_uji,
            ];
        }

        // Tampilkan view untuk setiap data uji
        return view('user/klasifikasi/hasil', [
            'title' => 'Klasifikasi',
            'k' => $k,
            'hasil_klasifikasi' => $hasil_klasifikasi
        ]);
    }

    public function import()
    {
        // Ambil file excel dari form
        $file = $this->request->getFile('file_excel');

        // Validasi file yang diupload adalah file excel
        if (!$file || !$file->isValid() || !in_array($file->getClientMimeType(), ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])) {
            session()->setFlashdata('pesan', 'File yang diupload bukan file excel');
            return redirect()->to('/klasifikasi');
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
            $this->dataUjiModel->save([
                'nama' => $data[0],
                'umur' => $data[1],
                'beratbadan' => $data[2],
                'tinggibadan' => $data[3]
            ]);
        }
        // Setelah selesai memproses data, tampilkan pesan berhasil
        session()->setFlashdata('pesan', 'Data berhasil diimport.');
        return redirect()->to('/klasifikasi');
    }
}
