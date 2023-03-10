<?php namespace Pensoft\Accordions\Models;

use Model;
use BackendAuth;
/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    // For Revisionable namespace
    use \October\Rain\Database\Traits\Revisionable;

    public $timestamps = false;

    // Add  for revisions limit
    public $revisionableLimit = 200;

    // Add for revisions on particular field
    protected $revisionable = ["id","title","content"];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_accordions_category';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasMany = [
        'items' => Item::class
    ];

    // Add  below relationship with Revision model 
    public $morphMany = [
        'revision_history' => ['System\Models\Revision', 'name' => 'revisionable']
            ];
    
    // Add below function use for get current user details
    public function diff(){
        $history = $this->revision_history;
    }
    public function getRevisionableUser()
    {
        return BackendAuth::getUser()->id;
    }
}
