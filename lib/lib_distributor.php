<?php
/**
 * 2014年11月5日
 * @author lvcy
 * @version 1.0.0-snapshot
 * 操作配送商库文件
 */
if(!defined("DEW")){
    die("哥，求不黑");
}
include '../includes/init.php';
    /**
     * 配送商登录丹露网
     * @param unknown $user
     */
    function login($user){
        $sql="select distributor_id from distributor_user where username='".$user['user_name']."' and user_password='".$user['user_password']."'";
        $result=$GLOBALS['db']->getOne($sql);
        if($result!=null || $result != ''){
            $_SESSION['user_name']=$user['user_name'];
            $_SESSION['user_password']=$user['user_password'];
            $_SESSION['distributor_id']=$result;
            $_SESSION['user_status']=1;
            return true;
        }else{
            return false;
        }
    }
    /**
     * 增加配送商用户信息
     * @param unknown $user
     */
    function addUser($user){
        $sql="inert into distributor_user (user_name,user_password,user_email)
            values ('".$user['user_name']."','".$user['user_password']."','".$user['user_email']."')";
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 判断用户名是否存在
     * @param unknown $user_name
     * @return boolean
     */
    function isUserNameExist($user_name){
        $sql="select count(*) from distributor_user where user_name='".$user_name."'";
        $result=$GLOBALS['db'].getOne($sql);
        if($result>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 判断邮箱是否存在
     * @param unknown $user_email
     * @return boolean
     */
    function isEmailExist($user_email){
        $sql="select count(*) from distributor_user where user_email='$user_email'";
        $result=$GLOBALS['db']->getOne($sql);
        if($result>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 更新终端店用户信息
     * @param unknown $user
     * @return boolean
     */
    function updateUser($user){
        $sql="update distributor_user set user_name='".$user['user_name']."',user_password='".$user['user_password']."',user_email='".$user['user_email']."' where distributor_id=".$user['distributor_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取配送商用户信息
     * @param unknown $terminal_id
     */
    function  getUser($distributor_id){
        $sql="select * form distributor_user where distributor_id=$distributor_id";
        $result=$GLOBALS['db']->getRow();
        return $result;
    }
    /**
     * 增加配送商公司基本信息
     * @param unknown $Company
     */
    function addCompany($company){
        $sql="insert into distributor_company (distributor_id,company_name,company_province,company_city,company_area,company_area,company_address,company_register_capital,company_property,company_members,company_contact_name,company_contact_tel)
            values (".$company['distributor_id'].",'".$company['company_name']."','".$company['company_province']."','".$company['company_city']."','".$company['company_area']."','".$company['company_address']."',".$company['company_register_capital'].",'".$company['company_property']."',".$company['company_members'].",'".$company['company_contact_name']."','".$company['company_contact_tel']."')";
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 修改配送商公司基本信息
     * @param unknown $company
     * @return boolean
     */
    function updateCompany($company){
        $sql="update distributor_company".
            "set company_name='".$company['company_name']."',".
            "company_province='".$company['company_province']."',".
            "company_city='".$company['company_city']."',".
            "company_area='".$company['company_area']."',".
            "company_address='".$company['company_address']."',".
            "company_register_capital='".$company['company_register_capital']."',".
            "company_property='".$company['company_property']."',".
            "company_members='".$company['company_members']."',".
            "company_contact_name='".$company['company_contact_name']."',".
            "company_contact_tel='".$company['company_contact_tel']."',".
            "where distributor_id=".$company['distributor_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取配送商公司信息
     * @param unknown $distributor_id
     */
    function getCompany($distributor_id){
        $sql="select * from terminal_company where distributor_id=$distributor_id";
        $result=$GLOBALS['db']->getRow($sql);
        return $result;
    }
    /**
     * 增加配送商入驻丹露网信息
     * @param unknown $danlu
     */
    function addDanlu($danlu){
        $sql="insert into distributor_danlu (distributor_id,business_category,business_brand,warehouse,logistics)
            values (".$danlu['distributor_id'].",'".$danlu['business_category']."','".$danlu['business_brand']."',".$danlu['warehouse'].",".$danlu['logistics'].")"; 
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }       
    }
    /**
     * 更新配送商入驻丹露网信息
     * @param unknown $danlu
     * @return boolean
     */
    function updateDanlu($danlu){
        $sql="update distributor_danlu".
            "set business_category='".$danlu['business_category']."',".
            "business_brand='".$danlu['business_brand']."',".
            "warehouse=".$danlu['warehouse'].",".
            "logistics=".$danlu['logistics'].",".
            "where distributor_id=".$danlu['distributor_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取配送商入驻丹露网信息
     * @param unknown $distributor_id
     */
    function getDanlu($distributor_id){
        $sql="select * from distributor_danlu where distributor_id=$distributor_id";
        $result=$GLOBALS['db']->getRow($sql);
        return $result;
    }
    /**
     * 增加配送商公司资质信息
     * @param unknown $qualification
     */
    function addQualification($qualification){
        $sql="insert into distributor_qualification (distributor_id,legal_person_name,legal_person_id_no,legal_person_id_photoa,legal_person_id_photob,business_license_no,business_license_photo,organization_photo,tax_no,tax_identity_no,tax_photo)
            values (".$qualification['distributor_id'].",'".$qualification['legal_person_name']."',".$qualification['legal_person_id_no'].",'".$qualification['legal_person_id_photoa']."','".$qualification['legal_person_id_photob']."','".$qualification['business_license_no']."','".$qualification['business_license_photo']."','".$qualification['organization_photo']."','".$qualification['tax_no']."','".$qualification['tax_identity_no']."','".$qualification['tax_photo']."')";
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 更新配送商资质信息
     * @param unknown $qualification
     * @return boolean
     */
    function updateQualification($qualification){
        $sql="update distributor_qualification".
            "set legal_person_name='".$qualification['legal_person_name']."',".
            "legal_person_id_no='".$qualification['legal_person_id_no']."',".
            "legal_person_id_photoa='".$qualification['legal_person_id_photoa']."',".
            "legal_person_id_photob='".$qualification['legal_person_id_photob'].",'".
            "business_license_no='".$qualification['business_license_no']."',".
            "business_license_photo='".$qualification['business_license_photo']."',".
            "organization_photo='".$qualification['organization_photo']."',".
            "tax_no='".$qualification['tax_no']."',".
            "tax_identity_no='".$qualification['tax_identity_no']."',".
            "tax_photo='".$qualification['tax_phpto']."',".
            "where distributor_id=".$qualification['distributor_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取配送商公司资质信息
     * @param unknown $distributor_id
     */
    function getQualifacation($distributor_id){
        $sql="select * from distibutor_qualification where distributor_id=$distributor_id";
        $result=$GLOBALS['db']->getRow($sql);
        return $result;
    }
    /**
     * 增加配送商公司财务信息
     * @param unknown $finance
     */
    function addFinance($finance){
        $sql="insert into distributor_finance (distributor_id,business_account_no,business_bank_branch,business_bank_address,business_bank_license,private_account_name,private_account_no,private_bank_branch,private_bank_address)
            values (".$finance['distributor_id'].",'".$finance['business_account_name']."','".$finance['business_account_no']."','".$finance['business_bank_branch']."','".$finance['business_bank_address']."','".$finance['business_bank_license']."','".$finance['private_account_name']."','".$finance['private_account_no']."','".$finance['private_bank_branch']."','".$finance['private_bank_address']."')";
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }
        else{
            return false;
        }
    }
    function updateFinace($finance){
        $sql="update distributor_finance".
            "set business_account_name='".$finance['business_account_name']."',".
            "business_account_no='".$finance['business_account_no']."',".
            "business_bank_branch='".$finance['business_bank_branch']."',".
            "business_bank_address='".$finance['business_bank_address']."',".
            "business_bank_license='".$finance['business_bank_license']."',".
            "private_account_name='".$finance['private_account_name']."',".
            "private_account_no='".$finance['private_account_no']."',".
            "private_bank_branch='".$finance['private_bank_branch']."',".
            "private_bank_address='".$finance['private_bank_address']."',".
            "where distributor_id=".$finance['distributor_id'];
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * 获取配送商公司财务信息
     * @param unknown $distributor_id
     */
    function getFinance($distributor_id){
        $sql="select * from distributor_finance where distributor_id=$distributor_id";
    }

?>