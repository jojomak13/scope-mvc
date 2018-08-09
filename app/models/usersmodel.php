<?php

namespace SCOPE\Models;

use SCOPE\Core\SessionManager;
use SCOPE\Models\usersgroupsprivilegesmodel;
use SCOPE\Models\ProfilesModel;

class usersmodel extends AbstractModel{

    // Profile data
    public $profile;
    public $privileges;

    public $Id;
    public $UserName;
    public $Password;
    public $Email;
    public $GroupId;
    public $Status;
    public $LastLogin;
    public $SubscriptionDate;


    protected static $tableName = 'users';
    protected static $primaryKey = 'Id';
    protected static $tableSchema = [
        'Id'         => self::DATA_TYPE_INT,
        'UserName'   => self::DATA_TYPE_STR,
        'Password'   => self::DATA_TYPE_STR,
        'Email'      => self::DATA_TYPE_STR,
        'GroupId'    => self::DATA_TYPE_INT,
        'Status'     => self::DATA_TYPE_INT,
        'LastLogin'  => self::DATA_TYPE_STR,
        'SubscriptionDate' => self::DATA_TYPE_STR,

    ];

    public static function getAll()
    {
        return self::get("SELECT *, users_groups.GroupName FROM " . static::$tableName . "
                    inner join users_groups
                    ON users_groups.GroupId = users.GroupId");
    }

    public function cryptPassword($newpass, $oldpass = '')
    {
        $this->Password = empty(trim($newpass, ' '))? $oldpass : crypt($newpass, APP_SALT);
    }

    public static function userExists($username, $userid)
    {
        $data = [
                    'username' => [$username, self::DATA_TYPE_STR],
                    'id' => [$userid, self::DATA_TYPE_INT]
                ];

        $data = self::getOne("SELECT * FROM " . static::$tableName . " WHERE UserName = :username AND Id != :id", $data);
        return $data == false ? false : true;
    }

    public static function loginAuth($username, $password, SessionManager $session)
    {
        $password = crypt($password, APP_SALT);

        $options = [
            'username' => [$username, self::DATA_TYPE_STR],
            'pass' => [$password, self::DATA_TYPE_STR]
        ];
        $user = self::getOne("SELECT * FROM " . static::$tableName . " WHERE UserName = :username AND Password = :pass", $options);

        if($user !== false){
            $user->privileges = usersgroupsprivilegesmodel::getPrivilegesForGroups($user->GroupId);
            $user->profile = ProfilesModel::getByPK($user->Id);
            $user->LastLogin = date('Y-m-d H:i:s');
            $user->save();
            $session->auth = $user;
            return [$user->UserName, $user->Status];
        }
        return false;
    }

    public static function getUser($userid)
    {
        $option = ['id' => [$userid, self::DATA_TYPE_INT]];
        return self::getOne("SELECT *, profiles.* FROM users INNER JOIN profiles ON profiles.Id = users.Id WHERE users.Id = :id", $option);
    }
}
