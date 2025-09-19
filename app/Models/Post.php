<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
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
