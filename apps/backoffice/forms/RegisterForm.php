<?php
namespace Candidates\Backoffice\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class RegisterForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        // First Name
        $firstName = new Text('firstName');
        $firstName->setLabel('Your First Name');
        $firstName->setFilters(array('striptags', 'string'));
        $firstName->addValidators(array(
            new PresenceOf(array(
                'message' => 'First Name is required'
            ))
        ));
        $this->add($firstName);

        // Last Name
        $lastName = new Text('lastName');
        $lastName->setLabel('Your Last Name');
        $lastName->setFilters(array('striptags', 'string'));
        $lastName->addValidators(array(
            new PresenceOf(array(
                'message' => 'Last Name is required'
            ))
        ));
        $this->add($lastName);

        // Name
        $name = new Text('username');
        $name->setLabel('Username');
        $name->setFilters(array('alpha'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'Please enter your desired user name'
            ))
        ));
        $this->add($name);

        // Email
        $email = new Text('email');
        $email->setLabel('E-Mail');
        $email->setFilters('email');
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'E-mail is required'
            )),
            new Email(array(
                'message' => 'E-mail is not valid'
            ))
        ));
        $this->add($email);

        // Password
        $password = new Password('password');
        $password->setLabel('Password');
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Password is required'
            ))
        ));
        $this->add($password);

        // Confirm Password
        $repeatPassword = new Password('repeatPassword');
        $repeatPassword->setLabel('Repeat Password');
        $repeatPassword->addValidators(array(
            new PresenceOf(array(
                'message' => 'Confirmation password is required'
            ))
        ));
        $this->add($repeatPassword);
    }
}