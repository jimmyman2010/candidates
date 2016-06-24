<?php
namespace Candidates\Common\Models;

use Phalcon\Mvc\Model;

class Questionnaires extends Model
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
    public $name;

    /**
     *
     * @var string
     */
    public $objectives;

    /**
     *
     * @var string
     */
    public $data;

    /**
     *
     * @var string
     */
    public $candidates;

    /**
     *
     * @var string
     */
    public $status;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'questionnaires';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Questionnaires[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Questionnaires
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
