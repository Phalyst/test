<?php
namespace Clickatell;

use \InvalidArgumentException;
use \Exception;
use \PDO;

class CompanyService
{
    private $database;
 
    public function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * Locate all the users in a company
     */
    public function locateCompanyUsers($companyId)
    {
		if($this->findEntryExist(self::getCompanyData($companyId))){
			$users = self::getUsers($companyId);
		}
        return $users;
    }

    /**
     * Delete all the users belonging to a specific company
     */
    public function deleteCompanyUsers($companyId){
		
		if($this->findEntryExist(self::getCompanyData($companyId))){
            return $this->database->exec('DELETE FROM users WHERE company_id=' . $companyId);
		}
    }


    /**
     * Link a specific user ID to a company ID
     */
    public function linkCompanyUser($userId, $companyId){
        
		if($this->findEntryExist(self::getCompanyData($companyId))){
			if($this->findEntryExist(self::getUserData($userId))){
				return $this->database->exec('UPDATE users SET company_id=' . $companyId . ' WHERE user_id=' . $userId);
			}

		}
	}
	/**
     * Retrieve users based on company ID
     */
	public function getUsers($companyId) {
		$stmt = $this->database->query('SELECT * FROM users WHERE company_id=' . $companyId);
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$users = $stmt->fetchAll();
		return $users;	
	}
	

    /**
     * Broadcast the worth of a user and return the result as
     * an array
     */
    public function userWorth($companyId){
		
        $users = self::getUsers($companyId);
        $result = array();

        foreach ($users as $user)
        {
            switch ($user['user_mtype'])
            {
                case 3:
                    $result[] = $user['user_name'] . ': Worth means nothing to me.';
                    break;
                case 2:
                    $result[] = $user['user_name'] . ': I am worth billions.';
                    break;
                default:
                    $result[] = $user['user_name'] . ': I am not worth much.';
                    break;
            }
        }

        return $result;
    }
		/**
     * Find if record exist otherwise throws Exception
     */
	public function findEntryExist($data) {

		$stmt = $this->database->query($data["sql"]);
        if ($stmt->fetchColumn() > 0) {
			return true;
		}
        throw new InvalidArgumentException($data["ErrorMsg"]);
	}
	/**
     * returns query to find if company exist by ID  
	 * and error message to be thrown when company record doesn't exist
     */
	public static function getCompanyData($companyId) {
		$data = array("sql"=>'SELECT COUNT(1) FROM companies WHERE `company_id`=' . $companyId,
					  "ErrorMsg"=>"Company could not be found.");
		return $data;	
	}
	/**
     * returns query to find if User exist by ID  
	 * and error message to be thrown when User record doesn't exist
     */
	public static function getUserData($userId) {
		$data = array("sql"=>'SELECT COUNT(1) FROM users WHERE user_id=' . $userId,
				      "ErrorMsg"=>"User could not be found.");
		return $data;	
	}
}