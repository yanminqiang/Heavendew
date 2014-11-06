<?php
    if(!defined("DEW")){
        die("哥，求不黑!");
    }
    include 'includes/init.php';
    /**
     * 添加酒信息
     * @param unknown $wine
     */
    function addWine($wine){
        $sql="insert into wine (barcode,brand_name,wine_name,origin_place,winery,alcoho,capacity,flavor,ingredients,color,storage_method,license_no,standard_no,factory,cover,propagate,detail,awards)
            values (".$wine['barcode'].",'".$wine['brand_name']."','".$wine['wine_name']."','".$wine['origin_place']."','".$wine['winery']."','".$wine['alcoho']."','".$wine['capacity']."','".$wine['flavor']."','".$wine['ingredients']."','".$wine['color']."','".$wine['storage_method']."','".$wine['license_no']."','".$wine['standard_no']."','".$wine['factory']."','".$wine['cover']."','".$wine['propagate']."','".$wine['detail']."','".$wine['awards']."')";
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    function isWineExist($barcode){
        $sql="select count(*) from wine where barcode='$barcode'";
        $result=$GLOBALS['db']->getOne($sql);
        if($result>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 更新商品信息
     * @param unknown $wine
     */
    function updateWine($wine){
        $sql="update wine set".
            "barcode='".$wine['barcode']."',".
            "brand_name='".$wine['brand_name']."',".
            "wine_name='".$wine['wine_name']."',".
            "origin_place='".$wine['origin_place']."',".
            "winery='".$wine['winery']."',".
            "alcoho='".$wine['alcoho']."',".
            "capacity='".$wine['capacity']."',".
            "flavor='".$wine['flavor']."',".
            "ingredients='".$wine['ingredients']."',".
            "color='".$wine['color']."',".
            "stotage_method='".$wine['storage_method']."',".
            "license_no='".$wine['license_no']."',".
            "standard_no='".$wine['standard_no']."',".
            "factory='".$wine['factory']."',".
            "cover='".$wine['cover']."',".
            "propagate='".$wine['propagate']."',".
            "detail='".$wine['detail']."',".
            "awards='".$wine['awards']."',".
            "where wine_id=".$wine['wine_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取酒信息
     * @param unknown $wine_id
     */
    function getWine($wine_id){
        $sql="select * from $wine where wine_id=$wine_id";
        $result=$GLOBALS['db']->getRow($sql);
        return $result;
    }
    /**
     * 添加酒相册信息
     * @param unknown $album
     */
    function addAlbum($album){
        $sql="insert into wine_album (wine_id,url) values (".$album['wine_id'].",'".$album['url']."')";
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    function updateAlbum($album){
        $sql="update wine_album set".
            "wine_id=".$album['wine_id'].
            "url='".$album['url']."',".
            "where album_id=".$album['album_id'];
        $GLOBALS['db']->query($sql);
        $affected_rows=$GLOBALS['db']->affected_rows();
        if($affected_rows>0){
            return true;
        }else{
            return false;
        }
    }
    /**
     * 获取酒相册信息
     * @param unknown $wine_id
     */
    function getAlbum($wine_id){
        $sql="select * from wine_album where wine_id=$wine_id";
        $result=$GLOBALS['db']->getAll($sql);
        return $result;
    }

?>