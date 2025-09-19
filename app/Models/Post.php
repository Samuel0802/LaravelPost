<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    //Ativar Soft delete
    use SoftDeletes;


    protected $table = 'posts';

    protected $fillable = [
          'user_id',
          'titulo',
          'conteudo'
    ];

    public function user(){
        //Relação de um para muitos
        //Muitos Post pertence um usuário
     return $this->belongsTo((User::class));
    }
}
