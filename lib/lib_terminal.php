<?php
    /**
     * 2014年11月4日
     * @author lvcy
     * @version 1.0.0-snapshot
     * 操作终端店库文件
     */
    if(!defined("DEW")){
        die("哥，别黑我！");
    }
    include '../includes/init.php';
    /**
     * 终端店账户登录
     * @param unknown $user
     */
    function login($user){
        $sql="select terminal_id from terminal_user
            where user_name='".$user['user_name']."' and user_password='".$user['user_password']."'";
        $result=$GLOBALS['db']->getOne($sql);
        if($result!=null || $result!=''){
            $_SESSION['user_name']=$user['user_name'];
            $_SESSION['user_password']=$user['user_password'];
            $_SESSION['terminal_id']=$result;
            $_SESSION['user_status']=2;
            return true;
        }else {
            return false;
        }
        
    }
    /**
     * 添加终端店账户信息
     * @param unknown $user
     * @return boolean
     */
    function addUser($user){
        $user_name=$user['user_name'];
        $user_password=$_user['user_password'];
        $user_email=$user['user_email'];
        $sql="insert into terminal_user (user_name,user_password,user_email) values ('$user_name','$user_password','$user_email')";
        $GLOBALS['db']->query($sql);
        $affect_rows=$GLOBALS['db']->affected_rows();
        if($affect_rows>0){
            return true;
        }else {
            return false;
        }
    }
    /**
     * 获取终端店账户信息
     * @param unknown $terminal_id
     */
    function getUser($terminal_id){
        $sql="select terminal_id,user_name,user_password from terminal_user where terminal_id=$terminal_id";
        $result=$GLOBALS['db']->getRow($sql);
        return $result;
    }
    /**
     * 跟新终端店用户信息
     * @param unknown $user
     * @return boolean
     */
    function updateUser($user){
        $sql="update terminal_user set user_name='".$user['user_name']."',user_password='".$user['user_password']."',user_email='".$user['user_email']."' where terminal_id=".$user['terminal_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 添加终端店信息
     * @param unknown $entity
     */
    function addEntity($entity){
        $terminal_id=$entity['terminal_id'];
        $entity_name=$entity('entity_name');
        $entity_province=$entity('entity_province');
        $entity_city=$entity['entity_city'];
        $entity_area=$entity['entity_area'];
        $entity_detail_address=$entity['entity_detail_address'];
        $entity_header_name=$entity['entity_header_name'];
        $entity_header_tel=$entity['entity_header_tel'];
        $entity_id_no=$entity['entity_id_no'];
        $entity_id_photoa=$entity['entity_id_photoa'];
        $entity_id_photob=$entity['entity_id_photob'];
        $entity_urgent_name=$entity['entity_urgent_name'];
        $entity_urgent_tel=$entity['entity_urgent_tel'];
        $sql="insert into terminal_entity (terminal_id,entity_name,entity_province,entity_city,entity_area,entity_detail_address,entity_header_name,entity_header_tel,entity_id_no,entity_id_photoa,entity_id_photob,entity_urgent_name,entity_urgent_tel)
            values ($terminal_id,'$entity_name','$entity_province','$entity_city','$entity_area','$entity_detail_address','$entity_header_name','$entity_header_tel','$entity_id_no','$entity_id_photoa','$entity_id_photob','$entity_urgent_name','$entity_urgent_tel')";
        $GLOBALS['db']->query($sql);
        $affect_rows=$GLOBALS['db']->affected_rows();
        if($affect_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 更新终端店信息
     * @param unknown $entity
     * @return boolean
     */
    function updateEntity($entity){
        $terminal_id=$entity['terminal_id'];
        $entity_name=$entity('entity_name');
        $entity_province=$entity('entity_province');
        $entity_city=$entity['entity_city'];
        $entity_area=$entity['entity_area'];
        $entity_detail_address=$entity['entity_detail_address'];
        $entity_header_name=$entity['entity_header_name'];
        $entity_header_tel=$entity['entity_header_tel'];
        $entity_id_no=$entity['entity_id_no'];
        $entity_id_photoa=$entity['entity_id_photoa'];
        $entity_id_photob=$entity['entity_id_photob'];
        $entity_urgent_name=$entity['entity_urgent_name'];
        $entity_urgent_tel=$entity['entity_urgent_tel'];
        $sql="update terminal_entity set entity_name='$entity_name',entity_proince='$entity_province',entity_city='$entity_city',entity_area='$entity_area',entity_detail_address='$entity_detail_address',entity_header_name='$entity_header_name',entity_header_tel='$entity_header_tel',entity_id_no='$entity_id_no',entity_id_photoa='$entity_id_photoa',entity_id_photob='$entity_id_photob',entity_urgent_name='$entity_urgent_name',entity_urgent_tel='$entity_urgent_tel' wehre terminal_id=".$entity['terminal_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取终端店信息
     * @param unknown $terminal_id
     */
    function getEntity($terminal_id){
        $sql="select * from terminal_entity where terminal_id=$terminal_id";
        $reuslt=$GLOBALS['db']->getRow($sql);
        return $reuslt;
    }
    /**
     * 添加终端店入驻丹露网信息
     * @param unknown $danlu
     */
    function addDanlu($danlu){
        $sql="insert into terminal_danlu (terminal_id,terminal_whole_name,terminal_type,business_category,food_license,business_license,hygiene_license,catering_license,wine_license,other_license)
            values (".$danlu['terminal_id'].",'".$danlu['terminal_whole_name']."','".$danlu['terminal_type']."','".$danlu['business_category']."','".$danlu['food_license']."','".$danlu['busuness_license']."','".$danlu['hygiene_license']."','".$danlu['catering_license']."','".$danlu['wine_license']."','".$danlu['other_license']."')";
        $GLOBALS['db']->query($sql);
        $affecte_rows=$GLOBALS['db']->affected_rows();
        if($affecte_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 更新终端店入驻丹露网信息
     * @param unknown $danlu
     * @return boolean
     */
    function updateDanlu($danlu){
        $sql="update terminal_danlu set terminal_whole_name='".$danlu['terminal_whole_name']."',terminal_type='".$danlu['terminal_type']."',business_category='".$danlu['business_category']."',food_license='".$danlu['food_license']."',hygiene_license='".$danlu['hygiene_license']."',catering_license='".$danlu['catering_license']."',wine_license='".$danlu['wine_license']."',other_license='".$danlu['other_license']."' where terminal_id=".$danlu['terminal_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取入驻丹露网信息
     * @param unknown $terminal_id
     */
    function getDanlu($terminal_id){
        $sql="select * from terminal_danlu where terminal_id=$terminal_id";
        $result=$GLOBALS['db']->getRow();
        return $result;
    }

?>