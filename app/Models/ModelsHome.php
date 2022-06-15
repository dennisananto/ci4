<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelsHome extends Model
{
    protected $table = 'home';

    public function getHome()
    {
        return $this->findAll();
    }
    public function SimpanHome($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function PilihHome($id)
    {
        $query = $this->getWhere(['id' => $id]);
        return $query;
    }
    public function edit_data($id, $data)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }
    public function HapusHome($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}
