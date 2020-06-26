<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{

    const SQL = "SELECT c1.id , c1.title ,c1.category_id,c2.title AS parent_title
     FROM categories 
     c1 LEFT JOIN categories c2 ON c1.category_id =c2.id ";

    protected $table      = 'categories';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['title', 'category_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $validationRules    = [
        'title' => 'required',
        'category_id'     => 'required',
    ];
    protected $skipValidation     = false;

    public function withParentCategory()
    {


        return $this->db->query(self::SQL);
    }


    public function findOne($id)
    {

        $parent = $this->db->query(self::SQL . " WHERE c1.id = $id  limit 1");
        $categories = $parent->getResult();
        $categories = $this->loadSubs($categories);
        return $categories[0];
    }
    public function all()
    {
        $categories = $this->withParentCategory()->getResult();
        return $this->loadSubs($categories);
    }

    public function get_categories()
    {
        $parent =        $this->db->query(self::SQL . ' WHERE c1.category_id is null');
        $categories = $parent->getResult();

        return $this->loadSubs($categories);
    }

    public function sub_categories($id)
    {

        $child = $this->db->query(self::SQL . " WHERE c1.category_id = $id");
        $categories = $child->getResult();

        return $this->loadSubs($categories);
    }

    public function loadSubs($categories)
    {
        foreach ($categories as $key => $category) {
            $categories[$key]->sub = $this->sub_categories($category->id);
        }
        return $categories;
    }
}
