<?php
namespace Candidates\Common\Models;

use Phalcon\Mvc\Model;

class Answers extends Model
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
    public $answer;

    /**
     *
     * @var integer
     */
    public $questionId;

    /**
     *
     * @var integer
     */
    public $isTrue;

    /**
     *
     * @var integer
     */
    public $deleted;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'answers';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Answers[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Answers
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
