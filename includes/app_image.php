<?php
if(!defined("DEW")){
    die("Hacking attempt");
}
class app_image
{
    var $error_msg="";
    function upload_image($upload,$dir,$img_name=''){
        /*查看传入的目录是否存在，如果不存在，创建目录*/
        if(!file_exists($dir)){
            if(!$this->make_dir($dir)){
                $this->error_msg="创建目录失败";
                return false;
            }
        }
        if(empty($img_name)){
            $img_name=time();
            
            $img_name=$dir.'/'.$img_name.$this->getfiletype($upload['name']);
        }
        if(!$this->check_img_type($upload['type'])){
            $this->error_msg="文件上传的图片类型不正确";
            return false;
        }
        
        /*允许上传的文件类型*/
        
        $allow_file_type='|GIF|JPG|JEPG|PNG|BMP|SWF';
        if(!$this->check_file_type($upload['tmp_name'],$img_name,$allow_file_type)){
            $this->error_msg="文件格式不正确";
            return false;
        }
        if($this->move_file($upload, $img_name)){
            return str_replace(ROOT_PATH, '', $img_name);
        }else {
            $this->error_msg="文件上传失败";
            return false;
        }
    }
    function move_file($upload,$target){
        if(isset($upload['error']) && $upload['error']>0){
            return false;
        }
        if(!move_uploaded_file($upload['tmp_name'], ROOT_PATH.'/'.$target)){
            return false;
        }
        return true;
    }
    function getfiletype($name){
        $pos = strrpos($name, '.');
        if ($pos !== false){
            return substr($name, $pos);
        }
        else{
            return '';
        }
    }
    function check_img_type($type){
        return $type == 'image/pjpeg' ||
               $type == 'image/x-png' ||
               $type == 'image/png'   ||
               $type == 'image/gif'   ||
               $type == 'image/jpeg';
    }
    function make_dir($dir){
        $recal=false;
        @umask(0);
        preg_match_all('/([^\/]*)\/?/i', $dir,$atmp);
        $base=($atmp[0][0]=='/')?'/':'';
        foreach ($atmp[1] AS $val){
            if ('' != $val){
                $base .= $val;
        
                if ('..' == $val || '.' == $val){
                    /* 如果目录为.或者..则直接补/继续下一个循环 */
                    $base .= '/';
                    continue;
                }
            }
            else{
                continue;
            }
            $base .= '/';
            if (!file_exists($base)){
                /* 尝试创建目录，如果创建失败则继续循环 */
                if (@mkdir(rtrim($base, '/'), 0777)){
                    @chmod($base, 0777);
                    $reval = true;
                }
            }
        }
        clearstatcache();
        return $reval;
    }
    function check_file_type($filename, $realname = '', $limit_ext_types = ''){
        if ($realname){
            $extname = strtolower(substr($realname, strrpos($realname, '.') + 1));
        }
        else{
            $extname = strtolower(substr($filename, strrpos($filename, '.') + 1));
        }
    
        if ($limit_ext_types && stristr($limit_ext_types, '|' . $extname . '|') === false){
            return '';
        }
    
        $str = $format = '';
    
        $file = @fopen($filename, 'rb');
        if ($file){
            $str = @fread($file, 0x400); // 读取前 1024 个字节
            @fclose($file);
        }
        else{
            if (stristr($filename, ROOT_PATH) === false){
                if ($extname == 'jpg' || $extname == 'jpeg' || $extname == 'gif' || $extname == 'png' || $extname == 'doc' ||
                    $extname == 'xls' || $extname == 'txt'  || $extname == 'zip' || $extname == 'rar' || $extname == 'ppt' ||
                    $extname == 'pdf' || $extname == 'rm'   || $extname == 'mid' || $extname == 'wav' || $extname == 'bmp' ||
                    $extname == 'swf' || $extname == 'chm'  || $extname == 'sql' || $extname == 'cert'|| $extname == 'pptx' ||
                    $extname == 'xlsx' || $extname == 'docx')
                {
                    $format = $extname;
                }
            }
            else{
                return '';
            }
        }
    
        if ($format == '' && strlen($str) >= 2 ){
            if (substr($str, 0, 4) == 'MThd' && $extname != 'txt'){
                $format = 'mid';
            }
            elseif (substr($str, 0, 4) == 'RIFF' && $extname == 'wav'){
                $format = 'wav';
            }
            elseif (substr($str ,0, 3) == "\xFF\xD8\xFF"){
                $format = 'jpg';
            }
            elseif (substr($str ,0, 4) == 'GIF8' && $extname != 'txt'){
                $format = 'gif';
            }
            elseif (substr($str ,0, 8) == "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"){
                $format = 'png';
            }
            elseif (substr($str ,0, 2) == 'BM' && $extname != 'txt'){
                $format = 'bmp';
            }
            elseif ((substr($str ,0, 3) == 'CWS' || substr($str ,0, 3) == 'FWS') && $extname != 'txt'){
                $format = 'swf';
            }
            elseif (substr($str ,0, 4) == "\xD0\xCF\x11\xE0"){   // D0CF11E == DOCFILE == Microsoft Office Document
                if (substr($str,0x200,4) == "\xEC\xA5\xC1\x00" || $extname == 'doc'){
                    $format = 'doc';
                }
                elseif (substr($str,0x200,2) == "\x09\x08" || $extname == 'xls'){
                    $format = 'xls';
                } elseif (substr($str,0x200,4) == "\xFD\xFF\xFF\xFF" || $extname == 'ppt'){
                    $format = 'ppt';
                }
            } elseif (substr($str ,0, 4) == "PK\x03\x04"){
                if (substr($str,0x200,4) == "\xEC\xA5\xC1\x00" || $extname == 'docx'){
                    $format = 'docx';
                }
                elseif (substr($str,0x200,2) == "\x09\x08" || $extname == 'xlsx'){
                    $format = 'xlsx';
                } elseif (substr($str,0x200,4) == "\xFD\xFF\xFF\xFF" || $extname == 'pptx'){
                    $format = 'pptx';
                }else{
                    $format = 'zip';
                }
            } elseif (substr($str ,0, 4) == 'Rar!' && $extname != 'txt'){
                $format = 'rar';
            } elseif (substr($str ,0, 4) == "\x25PDF"){
                $format = 'pdf';
            } elseif (substr($str ,0, 3) == "\x30\x82\x0A"){
                $format = 'cert';
            } elseif (substr($str ,0, 4) == 'ITSF' && $extname != 'txt'){
                $format = 'chm';
            } elseif (substr($str ,0, 4) == "\x2ERMF"){
                $format = 'rm';
            } elseif ($extname == 'sql'){
                $format = 'sql';
            } elseif ($extname == 'txt'){
                $format = 'txt';
            }
        }
    
        if ($limit_ext_types && stristr($limit_ext_types, '|' . $format . '|') === false){
            $format = '';
        }
    
        return $format;
    }
    function make_thumb($img, $thumb_width = 0, $thumb_height = 0, $path = '', $bgcolor=''){
        $gd = $this->gd_version(); //获取 GD 版本。0 表示没有 GD 库，1 表示 GD 1.x，2 表示 GD 2.x
        if ($gd == 0){
            $this->error_msg = "没有GD库";
            return false;
        }
        /* 检查缩略图宽度和高度是否合法 */
        if ($thumb_width == 0 && $thumb_height == 0){
            return str_replace(ROOT_PATH, '', str_replace('\\', '/', realpath($img)));
        }
    
        /* 检查原始文件是否存在及获得原始文件的信息 */
        $org_info = @getimagesize($img);
        if (!$org_info){
            $this->error_msg = "原始文件信息不存在";
            return false;
        }
    
        if (!$this->check_img_function($org_info[2])){
            $this->error_msg = "此图片不能进行缩略图处理";
            return false;
        }
    
        $img_org = $this->img_resource($img, $org_info[2]);
    
        /* 原始图片以及缩略图的尺寸比例 */
        $scale_org      = $org_info[0] / $org_info[1];
        /* 处理只有缩略图宽和高有一个为0的情况，这时背景和缩略图一样大 */
        if ($thumb_width == 0){
            $thumb_width = $thumb_height * $scale_org;
        }
        if ($thumb_height == 0){
            $thumb_height = $thumb_width / $scale_org;
        }
    
        /* 创建缩略图的标志符 */
        if ($gd == 2){
            $img_thumb  = imagecreatetruecolor($thumb_width, $thumb_height);
        }
        else{
            $img_thumb  = imagecreate($thumb_width, $thumb_height);
        }
    
        
        $bgcolor = "#FFFFFF";
        sscanf($bgcolor, "%2x%2x%2x", $red, $green, $blue);
        $clr = imagecolorallocate($img_thumb, $red, $green, $blue);
        imagefilledrectangle($img_thumb, 0, 0, $thumb_width, $thumb_height, $clr);
    
        if ($org_info[0] / $thumb_width > $org_info[1] / $thumb_height){
            $lessen_width  = $thumb_width;
            $lessen_height  = $thumb_width / $scale_org;
        }
        else{
            /* 原始图片比较高，则以高度为准 */
            $lessen_width  = $thumb_height * $scale_org;
            $lessen_height = $thumb_height;
        }
    
        $dst_x = ($thumb_width  - $lessen_width)  / 2;
        $dst_y = ($thumb_height - $lessen_height) / 2;
    
        /* 将原始图片进行缩放处理 */
        if ($gd == 2){
            imagecopyresampled($img_thumb, $img_org, $dst_x, $dst_y, 0, 0, $lessen_width, $lessen_height, $org_info[0], $org_info[1]);
        }
        else{
            imagecopyresized($img_thumb, $img_org, $dst_x, $dst_y, 0, 0, $lessen_width, $lessen_height, $org_info[0], $org_info[1]);
        }
    
        /* 创建当月目录 */
        if (empty($path)){
            $dir = ROOT_PATH . $this->images_dir . '/' . date('Ym').'/';
        }
        else{
            $dir = $path;
        }
    
    
        /* 如果目标目录不存在，则创建它 */
        if (!file_exists($dir)){
            if (!$this->make_dir($dir)){
                /* 创建目录失败 */
                $this->error_msg  = "创建目录失败";
                return false;
            }
        }
    
        /* 如果文件名为空，生成不重名随机文件名 */
        $filename = $this->unique_name($dir);
        /* 生成文件 */
        if (function_exists('imagejpeg')){
            $filename .= '.jpg';
            imagejpeg($img_thumb, $dir . $filename);
        }
        elseif (function_exists('imagegif')){
            $filename .= '.gif';
            imagegif($img_thumb, $dir . $filename);
        }
        elseif (function_exists('imagepng')){
            $filename .= '.png';
            imagepng($img_thumb, $dir . $filename);
        }
        else{
            $this->error_msg = "生成文件失败";
            return false;
        }
    
        imagedestroy($img_thumb);
        imagedestroy($img_org);
        //确认文件是否生成
        if (file_exists($dir . $filename)){
            return str_replace(ROOT_PATH, '', $dir) . $filename;
        }
        else{
            $this->error_msg = "文件生成失败";
            return false;
        }
    }
    function check_img_function($img_type){
        switch ($img_type)
        {
            case 'image/gif':
            case 1:
                if (PHP_VERSION >= '4.3'){
                    return function_exists('imagecreatefromgif');
                }
                else{
                    return (imagetypes() & IMG_GIF) > 0;
                }
                break;
    
            case 'image/pjpeg':
            case 'image/jpeg':
            case 2:
                if (PHP_VERSION >= '4.3'){
                    return function_exists('imagecreatefromjpeg');
                }
                else{
                    return (imagetypes() & IMG_JPG) > 0;
                }
                break;
    
            case 'image/x-png':
            case 'image/png':
            case 3:
                if (PHP_VERSION >= '4.3'){
                    return function_exists('imagecreatefrompng');
                }
                else{
                    return (imagetypes() & IMG_PNG) > 0;
                }
                break;
            default:
                return false;
        }
    }
    function img_resource($img_file, $mime_type){
        switch ($mime_type){
            case 1:
            case 'image/gif':
                $res = imagecreatefromgif($img_file);
                break;
            case 2:
            case 'image/pjpeg':
            case 'image/jpeg':
                $res = imagecreatefromjpeg($img_file);
                break;
            case 3:
            case 'image/x-png':
            case 'image/png':
                $res = imagecreatefrompng($img_file);
                break;
            default:
                return false;
        }
        return $res;
    }
    function unique_name($dir){
        $filename = '';
        while (empty($filename)){
            $filename = app_image::random_filename();
            if (file_exists($dir . $filename . '.jpg') || file_exists($dir . $filename . '.gif') || file_exists($dir . $filename . '.png')){
                $filename = '';
            }
        }
        return $filename;
    }
    static function gd_version(){
        static $version = -1;
        if ($version >= 0){
            return $version;
        }
        if (!extension_loaded('gd')){
            $version = 0;
        }
        else{
            if (PHP_VERSION >= '4.3'){
                if (function_exists('gd_info')){
                    $ver_info = gd_info();
                    preg_match('/\d/', $ver_info['GD Version'], $match);
                    $version = $match[0];
                }
                else{
                    if (function_exists('imagecreatetruecolor')){
                        $version = 2;
                    }
                    elseif (function_exists('imagecreate')){
                        $version = 1;
                    }
                }
            }
            else{
                if (preg_match('/phpinfo/', ini_get('disable_functions'))){
                    /* 如果phpinfo被禁用，无法确定gd版本 */
                    $version = 1;
                }
                else{
                    // 使用phpinfo函数
                    ob_start();
                    phpinfo(8);
                    $info = ob_get_contents();
                    ob_end_clean();
                    $info = stristr($info, 'gd version');
                    preg_match('/\d/', $info, $match);
                    $version = $match[0];
                }
            }
        }
        return $version;
    }
    function random_filename(){
        $str = '';
        for($i = 0; $i < 9; $i++){
        $str .= mt_rand(0, 9);
        }
        return (time() - date('Z')) . $str;
    }
}

?>