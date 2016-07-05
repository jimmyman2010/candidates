<?php
namespace Candidates\Common\Models;

use Phalcon\Mvc\Model;

class Questions extends Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $question;

    /**
     *
     * @var integer
     */
    public $typeId;

    /**
     *
     * @var integer
     */
    public $deleted;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Candidates\Common\Models\Answers', 'questionId', array('alias' => 'Answers'));
        $this->belongsTo('typeId', 'Candidates\Common\Models\Types', 'id', array('alias' => 'Types'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'questions';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Questions[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Questions
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
