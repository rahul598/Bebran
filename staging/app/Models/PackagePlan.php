<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PackagePlan extends Model
{
    protected $table = 'package_plan';
    
    public function page(){
        return $this->hasOne(Page::class, 'id', 'page_id');
    }

    public function category(){
        return $this->hasOne(PackageCategory::class, 'id', 'category_id');
    }

}
