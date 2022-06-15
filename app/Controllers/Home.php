<?php

namespace App\Controllers;

use App\Models\ModelsHome;

class Home extends BaseController
{
    public function index()
    {
        $model = new ModelsHome();
        if (!$this->validate([])) {
            $data['validation'] = $this->validator;
            $data['home'] = $model->getHome();
            return view('home/home', $data);
        }
    }

    public function home()
    {
        $model = new ModelsHome();
        if (!$this->validate([])) {
            $data['validation'] = $this->validator;
            $data['home'] = $model->getHome();
            return view('home/view_list', $data);
        }
    }

    public function form()
    {
        helper('form');
        return view('home/view_form');
    }

    public function view($id)
    {
        $model = new ModelsHome();
        $data['home'] = $model->PilihHome($id)->getRow();
        return view('view', $data);
    }

    public function simpan()
    {
        $model = new ModelsHome();
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('home/home');
        }
        $validation = $this->validate([
            'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
        ]);

        if ($validation == FALSE) {
            $data = array(
                'judul'  => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi')
            );
        } else {
            $upload = $this->request->getFile('file_upload');
            $upload->move(WRITEPATH . '../public/assets/images/');
            $data = array(
                'judul'  => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'gambar' => $upload->getName()
            );
        }
        $model->SimpanHome($data);
        return redirect()->to('home/home')->with('berhasil', 'Data Berhasil di Simpan');
    }

    // public function form_edit($id)
    // {
    //     $model = new ModelsBlog();
    //     helper('form');
    //     $data['artikel'] = $model->PilihBlog($id)->getRow();
    //     return view('form_edit', $data);
    // }

    // public function edit()
    // {
    //     $model = new ModelsHome();
    //     if ($this->request->getMethod() !== 'post') {
    //         return redirect()->to('blog');
    //     }
    //     $id = $this->request->getPost('id');
    //     $validation = $this->validate([
    //         'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
    //     ]);

    //     if ($validation == FALSE) {
    //         $data = array(
    //             'judul'  => $this->request->getPost('judul'),
    //             'isi' => $this->request->getPost('isi')
    //         );
    //     } else {
    //         $dt = $model->PilihBlog($id)->getRow();
    //         $gambar = $dt->gambar;
    //         $path = '../public/assets/images/';
    //         @unlink($path . $gambar);
    //         $upload = $this->request->getFile('file_upload');
    //         $upload->move(WRITEPATH . '../public/assets/images/');
    //         $data = array(
    //             'judul'  => $this->request->getPost('judul'),
    //             'isi' => $this->request->getPost('isi'),
    //             'gambar' => $upload->getName()
    //         );
    //     }
    //     $model->edit_data($id, $data);
    //     return redirect()->to('./blog')->with('berhasil', 'Data Berhasil di Ubah');
    // }

    // public function hapus($id)
    // {
    //     $model = new ModelsBlog();
    //     $dt = $model->PilihBlog($id)->getRow();
    //     $model->HapusBlog($id);
    //     $gambar = $dt->gambar;
    //     $path = '../public/assets/images/';
    //     @unlink($path . $gambar);
    //     return redirect()->to('./blog')->with('berhasil', 'Data Berhasil di Hapus');
    // }
}
