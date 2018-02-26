1,upfile,images文件夹的必须改成777
2,水印的控制，找到;upload.php  这个文件。找到下面的代码：
    $watermark=true;  //是否启用水印，true开启，false关闭
    $waterPos=9;       /*水印位置，有10种状态，0为随机位置；
                      1为顶端居左，2为顶端居中，3为顶端居右；
                      4为中部居左，5为中部居中，6为中部居右；
                      7为底端居左，8为底端居中，9为底端居右；*/
   $waterImage="./images/logo.png";     //图片水印，即作为水印的图片，暂只支持GIF,JPG,PNG格式；
   $waterText=""  ;    //文字水印，即把文字作为为水印，支持ASCII码，不支持中文；
   $watertextFont=5    ;   //文字大小，值为1、2、3、4或5，默认为5；
   $watertextColor="#FF0000";      //文字颜色，值为十六进制颜色值，默认为#FF0000(红色)；

3，upload - closewate.php 关闭水印
upload - openwate 打开水印
upload 已经设置成关闭水印了.


up.php index.php,为原程序，index1.php index2.php 为空间去广告的程序，由于各个空间的广告代码不一样，去的方法也不一样，请参考ad文件中的几个去广告文件。

