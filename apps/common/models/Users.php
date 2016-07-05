<?php
namespace Candidates\Common\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends Model
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
    public $username;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $groupId;

    /**
     *
     * @var integer
     */
    public $profileId;

    /**
     *
     * @var integer
     */
    public $banned;

    /**
     *
     * @var integer
     */
    public $suspended;

    /**
     *
     * @var integer
     */
    public $createdDate;

    /**
     *
     * @var integer
     */
    public $deleted;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );

        if ($this->validationHasFailed() == true) {
            return false;
        }

        return true;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('groupId', 'Candidates\Common\Models\Groups', 'id', array('alias' => 'Groups'));
        $this->belongsTo('profileId', 'Candidates\Common\Models\Profiles', 'id', array('alias' => 'Profiles'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
