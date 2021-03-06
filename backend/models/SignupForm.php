<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use backend\models\AuthAssignment;
use borales\extensions\phoneInput\PhoneInputValidator;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $contactNo;
    public $permissions;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['contactNo', 'required'],
            ['contactNo', 'string'],
            [['contactNo'], PhoneInputValidator::className()], 
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->contactNo = $this->contactNo;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
        $permissionList = $_POST['SignupForm']['permissions'];
      
        $newPermission = new AuthAssignment;
        $newPermission->user_id = $user->id;
        $newPermission->item_name = $permissionList;
       
        $newPermission->save();
       
        return $user;

    }

}
