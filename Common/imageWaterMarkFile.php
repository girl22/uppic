<?php
//ˮӡ����==========================================
//ˮӡ������ʼ============
/**    $groundImage    ����ͼƬ������Ҫ��ˮӡ��ͼƬ����ֻ֧��GIF,JPG,PNG��ʽ��
*      $waterPos       ˮӡλ�ã���10��״̬��0Ϊ���λ�ã�
*                      1Ϊ���˾���2Ϊ���˾��У�3Ϊ���˾��ң�
*                      4Ϊ�в�����5Ϊ�в����У�6Ϊ�в����ң�
*                      7Ϊ�׶˾���8Ϊ�׶˾��У�9Ϊ�׶˾��ң�
*      $waterImage     ͼƬˮӡ������Ϊˮӡ��ͼƬ����ֻ֧��GIF,JPG,PNG��ʽ��
*      $waterText      ����ˮӡ������������ΪΪˮӡ��֧��ASCII�룬��֧�����ģ�
*      $textFont       ���ִ�С��ֵΪ1��2��3��4��5��Ĭ��Ϊ5��
*      $textColor      ������ɫ��ֵΪʮ��������ɫֵ��Ĭ��Ϊ#FF0000(��ɫ)��
* */

function imageWaterMark($groundImage,$waterPos=5,$waterImage="",$waterText="", $textFont=5,$textColor="#FF0000")
{
    $isWaterImage = FALSE;
    $formatMsg = "Does not support the file format, with image processing software to convert the picture as gif, jpg, png, format.";
                  
    //��ȡˮӡ�ļ�
    if(!empty($waterImage) && file_exists($waterImage)) {
        $isWaterImage = TRUE;
        $water_info = getimagesize($waterImage);
        $water_w    = $water_info[0];//ȡ��ˮӡͼƬ�Ŀ�
        $water_h    = $water_info[1];//ȡ��ˮӡͼƬ�ĸ�

        switch($water_info[2])  {   //ȡ��ˮӡͼƬ�ĸ�ʽ  
            case 1:$water_im = imagecreatefromgif($waterImage);break;
            case 2:$water_im = imagecreatefromjpeg($waterImage);break;
            case 3:$water_im = imagecreatefrompng($waterImage);break;
            default:return $formatMsg;
        }
    }

    //��ȡ����ͼƬ
    if(!empty($groundImage) && file_exists($groundImage)) {
        $ground_info = getimagesize($groundImage);
        $ground_w    = $ground_info[0];//ȡ�ñ���ͼƬ�Ŀ�
        $ground_h    = $ground_info[1];//ȡ�ñ���ͼƬ�ĸ�

        switch($ground_info[2]) {   //ȡ�ñ���ͼƬ�ĸ�ʽ  
            case 1:$ground_im = imagecreatefromgif($groundImage);break;
            case 2:$ground_im = imagecreatefromjpeg($groundImage);break;
            case 3:$ground_im = imagecreatefrompng($groundImage);break;
            default:return ($formatMsg);
        }
    } else {
        return ("Need to add a watermark image does not exist!");
    }

    //ˮӡλ��
    if($isWaterImage) { //ͼƬˮӡ  
        $w = $water_w;
        $h = $water_h;
        $label = "Image";
    } else {  //����ˮӡ
        $temp = imagettfbbox(ceil($textFont*2.5),0,"./font/waterfont.ttf",$waterText);//ȡ��ʹ�� TrueType ������ı��ķ�Χ
        $w = $temp[2] - $temp[6];
        $h = $temp[3] - $temp[7];
        unset($temp);
        $label = "Text";
    }
    if( ($ground_w<$w) || ($ground_h<$h) ) {
        return "The length or width of the watermarked image is smaller than the watermark ".$label.", the watermark image can not be generated.";
    }
    switch($waterPos) {
        case 0://���
            $posX = rand(0,($ground_w - $w));
            $posY = rand(0,($ground_h - $h));
            break;
        case 1://1Ϊ���˾���
            $posX = 0;
            $posY = 0;
            break;
        case 2://2Ϊ���˾���
            $posX = ($ground_w - $w) / 2;
            $posY = 0;
            break;
        case 3://3Ϊ���˾���
            $posX = $ground_w - $w;
            $posY = 0;
            break;
        case 4://4Ϊ�в�����
            $posX = 0;
            $posY = ($ground_h - $h) / 2;
            break;
        case 5://5Ϊ�в�����
            $posX = ($ground_w - $w) / 2;
            $posY = ($ground_h - $h) / 2;
            break;
        case 6://6Ϊ�в�����
            $posX = $ground_w - $w;
            $posY = ($ground_h - $h) / 2;
            break;
        case 7://7Ϊ�׶˾���
            $posX = 0;
            $posY = $ground_h - $h;
            break;
        case 8://8Ϊ�׶˾���
            $posX = ($ground_w - $w) / 2;
            $posY = $ground_h - $h;
            break;
        case 9://9Ϊ�׶˾���
            $posX = $ground_w - $w;
            $posY = $ground_h - $h;
            break;
        default://���
            $posX = rand(0,($ground_w - $w));
            $posY = rand(0,($ground_h - $h));
            break;     
    }

    //�趨ͼ��Ļ�ɫģʽ
    imagealphablending($ground_im, true);

    if($isWaterImage) { //ͼƬˮӡ
        imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//����ˮӡ��Ŀ���ļ�         
    } else {//����ˮӡ
        if( !empty($textColor) && (strlen($textColor)==7) ) {
            $R = hexdec(substr($textColor,1,2));
            $G = hexdec(substr($textColor,3,2));
            $B = hexdec(substr($textColor,5));
        } else {
            return ("The watermark text color format is incorrect!");
        }
        imagestring ( $ground_im, $textFont, $posX, $posY, $waterText, imagecolorallocate($ground_im, $R, $G, $B));         
    }

    //����ˮӡ���ͼƬ
    @unlink($groundImage);
    switch($ground_info[2]) {//ȡ�ñ���ͼƬ�ĸ�ʽ
        case 1:imagegif($ground_im,$groundImage);break;
        case 2:imagejpeg($ground_im,$groundImage);break;
        case 3:imagepng($ground_im,$groundImage);break;
        default:return ($errorMsg);
    }

    //�ͷ��ڴ�
    if(isset($water_info)) unset($water_info);
    if(isset($water_im)) imagedestroy($water_im);
    unset($ground_info);
    imagedestroy($ground_im);
}
//ˮӡ������
   function ResizeImage($im,$maxwidth,$maxheight,$name){
    $width = imagesx($im);
    $height = imagesy($im);
    if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)){
        if($maxwidth && $width > $maxwidth){
            $widthratio = $maxwidth/$width;
            $RESIZEWIDTH=true;
        }
        if($maxheight && $height > $maxheight){
            $heightratio = $maxheight/$height;
            $RESIZEHEIGHT=true;
        }
        if($RESIZEWIDTH && $RESIZEHEIGHT){
            if($widthratio < $heightratio){
                $ratio = $widthratio;
            }else{
                $ratio = $heightratio;
            }
        }elseif($RESIZEWIDTH){
            $ratio = $widthratio;
        }elseif($RESIZEHEIGHT){
            $ratio = $heightratio;
        }
        $newwidth = $width * $ratio;
        $newheight = $height * $ratio;
        if(function_exists("imagecopyresampled")){
              $newim = imagecreatetruecolor($newwidth, $newheight);
              imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        }else{
            $newim = imagecreate($newwidth, $newheight);
              imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        }
        ImageJpeg ($newim,$smalladdrname.$name.".jpg");
        ImageDestroy ($newim);
    }else{
        ImageJpeg ($im,$smalladdrname.$name.".jpg");
    }
    }
    //���ɲ���
    if($_FILES['image']['size']){
    if($_FILES['image']['type'] == "image/pjpeg"){
        $im = imagecreatefromjpeg($bigaddrname.$exname);
    }elseif($_FILES['image']['type'] == "image/x-png"){
        $im = imagecreatefrompng($bigaddrname.$exname);
    }elseif($_FILES['image']['type'] == "image/gif"){
        $im = imagecreatefromgif($bigaddrname.$exname);
    }
    if($im){
        if(file_exists($smalladdrname.".jpg")){
            unlink($smalladdrname.".jpg");
        }
        ResizeImage($im,$RESIZEWIDTH,$RESIZEHEIGHT,$smalladdrname);
        ImageDestroy ($im);
    }
    return null;
 }
?>