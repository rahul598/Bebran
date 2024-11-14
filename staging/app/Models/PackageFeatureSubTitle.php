<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PackageFeatureSubTitle extends Model
{
    protected $table = 'package_feature_sub_title';

    public function page(){
        return $this->hasOne(Page::class, 'id', 'page_id');
    }

    public function category(){
        return $this->hasOne(PackageCategory::class, 'id', 'category_id');
    }

    public function title(){
        return $this->hasOne(PackageFeatureTitle::class, 'id', 'title_id');
    }

   
}
