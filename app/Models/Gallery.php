<?php 
namespace App\Models;

use CodeIgniter\Model;

class Gallery extends Model{
    protected $table      = 'galleries';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields=['imagen', 'usuario_id'];
}