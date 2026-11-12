<?php

namespace App\Controllers;

use App\Models\BookModel;

class Book extends BaseController
{
    // Menampilkan daftar buku.//
    public function index()
    {
        $bookModel = new BookModel();

        $books = $bookModel
            ->orderBy('title', 'ASC')
            ->findAll();

        $data = [
            'title'      => 'Data Buku',
            'books'      => $books,
            'totalBooks' => count($books),
        ];

        return view('buku/index', $data);
    }


    // Menampilkan form tambah buku.//
    public function create()
    {
        $data = [
            'title' => 'Tambah Buku',
        ];

        return view('buku/create', $data);
    }


    // Menyimpan buku baru ke database.//
    public function store()
    {
        // ==========================================
        // 1. ATURAN VALIDASI
        // ==========================================

        $rules = [
            'book_code' => [
                'rules' => 'required|max_length[20]|is_unique[books.book_code]',
                'errors' => [
                    'required'   => 'Kode buku wajib diisi.',
                    'max_length' => 'Kode buku maksimal 20 karakter.',
                    'is_unique'  => 'Kode buku sudah digunakan.',
                ],
            ],

            'isbn' => [
                'rules' => 'permit_empty|max_length[20]',
                'errors' => [
                    'max_length' => 'ISBN maksimal 20 karakter.',
                ],
            ],

            'title' => [
                'rules' => 'required|max_length[200]',
                'errors' => [
                    'required'   => 'Judul buku wajib diisi.',
                    'max_length' => 'Judul buku maksimal 200 karakter.',
                ],
            ],

            'author' => [
                'rules' => 'required|max_length[150]',
                'errors' => [
                    'required'   => 'Nama penulis wajib diisi.',
                    'max_length' => 'Nama penulis maksimal 150 karakter.',
                ],
            ],

            'publisher' => [
                'rules' => 'permit_empty|max_length[150]',
                'errors' => [
                    'max_length' => 'Nama penerbit maksimal 150 karakter.',
                ],
            ],

            'publication_year' => [
                'rules' => 'permit_empty|integer',
                'errors' => [
                    'integer' => 'Tahun terbit harus berupa angka.',
                ],
            ],

            'category' => [
                'rules' => 'required|max_length[100]',
                'errors' => [
                    'required'   => 'Kategori wajib diisi.',
                    'max_length' => 'Kategori maksimal 100 karakter.',
                ],
            ],

            'stock_total' => [
                'rules' => 'required|integer|greater_than_equal_to[0]',
                'errors' => [
                    'required'              => 'Jumlah stok wajib diisi.',
                    'integer'               => 'Jumlah stok harus berupa angka.',
                    'greater_than_equal_to' => 'Jumlah stok tidak boleh negatif.',
                ],
            ],
        ];


        // ==========================================
        // 2. JALANKAN VALIDASI
        // ==========================================

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'errors',
                    $this->validator->getErrors()
                );
        }


        // ==========================================
        // 3. AMBIL STOK DARI FORM
        // ==========================================

        $stockTotal = (int) $this->request->getPost('stock_total');


        // ==========================================
        // 4. SIAPKAN DATA
        // ==========================================

        $data = [
            'book_code' => trim(
                (string) $this->request->getPost('book_code')
            ),

            'isbn' => trim(
                (string) $this->request->getPost('isbn')
            ) ?: null,

            'title' => trim(
                (string) $this->request->getPost('title')
            ),

            'author' => trim(
                (string) $this->request->getPost('author')
            ),

            'publisher' => trim(
                (string) $this->request->getPost('publisher')
            ) ?: null,

            'publication_year' =>
                $this->request->getPost('publication_year') ?: null,

            'category' => trim(
                (string) $this->request->getPost('category')
            ),

            'stock_total' => $stockTotal,

            'stock_available' => $stockTotal,
        ];


        // ==========================================
        // 5. SIMPAN KE DATABASE
        // ==========================================

        $bookModel = new BookModel();

        $bookModel->insert($data);


        // ==========================================
        // 6. KEMBALI KE HALAMAN DAFTAR BUKU
        // ==========================================

        return redirect()
            ->to(site_url('buku'))
            ->with(
                'success',
                'Data buku berhasil ditambahkan.'
            );
    }
}
