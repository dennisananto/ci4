<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelsMenu extends Model
{
    protected $table = 'menu';

    public function getMenu()
    {
        return $this->findAll();
    }
    public function SimpanMenu($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    public function PilihMenu($id)
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
