/*
   QQ:909507090
   site:www.qhjsw.net
   mail:qhjsw#qhjsw.net(#号换为@)
   last date:2013-05-29
*/
本程序为PHP文件上传程序2.4.3。

在某网站看到其程序，索要及买源码未果。通过开发人员工具及其他抓包程序进行相关文件获取。

经过自己写后台代码，不断调试完成（因为比较仓促可能存在诸多问题）。

在此共享此资源。程序的主要功能就是图片上传。可以一次上传多个文件。速度也相当的快哦。

开发环境:windows7+Apache2.0

再次之前已经发布了此PHP程序的1.0版本，但之前1.0版本发现诸多问题。同样也收到一些网友
的问题反馈。首先感谢昵称为 QQTIY综合社区、soul等网友。

由于此次修改地方比较多一点，版本直接跳至2.0

ver 2.0更新如下问题：
  
   1.新增本论坛logo和网址
   2.修改贴图代码，使每张图片产生的网址占一行（增加换行）
   3.修改贴图代码显示容器 
   4.修改在使用非IE内核浏览器图片上传时出现文件上传失败的404错误(出现错误情况稍多)
   5.修改文件夹命名使用日期组合，去掉中间其他字符
   6.修改文件命名，去除以日期、时间、文件名的组合，改为编号
   7.修改点击文件名预览相应上传图片
   8.其他一些问题
---------------------------------------------------------------------------------------------
ver 2.1  更新如下
    1.新增自定义目录，在upload.php文件开头配图片上传的目录，但必须为本程序目录下。
    2.新增图片预览，鼠标放到文件名上就可以查看图片，得知其是否上传成功
---------------------------------------------------------------------------------------------
ver 2.2  更新如下内容

     1.新增关闭上传的功能。在文件开头设置相关参数即可实现上传程序是否可用。如果配置为禁止上传，程序将会返回自定义的错误信息
     
     2.新增判断上传图片的合法性。在以上版本中，在前台和后台分别判断文件是否符合指定的类型。其判断标准为后缀名。
     因为以上版本为后缀名作为判断，所以会导致其他非法文件被上传。例如：文件名为index.php的文件更改后缀名为index.jpg之后就会被接受上传。如果是IIS
     6.0作为服务器端话，别有用心的人可能会利用IIS6.0的解析漏洞作非法操作。当然这只是一个例子，因为以上版本程序虽然没有做合法性的判断，但做了重命名处理
     。即使文件上传成功，也没有执行的可能（当然服务配置图片映射的除外）。
----------------------------------------------------------------------------------------------
ver 2.3   更新如下内容
   
       1.新增以时间和随机数拼接为文件名并增加文件开头设置是否开启。true为开启,false为关闭
       注：用户 xzfd 反映上传图片改文件名失败，名称均相同。经本人本地和虚拟空间测试并没有发现此问题。但 xzfd 用户提供截图看确实存在这个现象（可能是环境问题），故新加以时间和随机数为文件名。如果你出现名称没有重新命名成功请讲upload.php页面中$filenameset的值设置为true.  在此向  xzfd  用户表示感谢
！
------------------------------------------------------------------------------------------

ver 2.4  更新如下内容
     1.上个版本可以设置程序的目录，如果把upfile文件下所有内容放到根目录下要把$rootfoldername="null"就可以。在运行过程中出现问题，可以上传成功，但目录找不到。
      把整个文件夹(upfile)放到根目录下无误，但修改为null后,目录出现问题。此次更新解决这个问题。

--------------------------------------------------------------------------------------------------
ver 2.4.1  更新内容如下
     1.修复部分空间上传返回Warning:session_start()的错误。例：Warning:session_start()[function.session-start]:Cannot send session
     2.自动获取网址，如果调用此程序无需在JS修改为自己的网址
     
 --------------------------------------------------------------------------------------------------
 
 var 2.4.2 更新如下内容
    
     1.新加上传图片水印功能
     2.控制水印是否开启
     3.更改上传后图片预览方式，先使用jquery.lightbox
----------------------------------------------------------------------------------------------	 
var 2.4.3  更新如下内容
     1.修正水印位置设置无效的问题
	 2.修复因BOM 格式造成火狐浏览器多以外字符的问题（造成返回网址多额外字符）

此版本演示地址：http://qhjsw.net/upfile/up.php

敬请注意：本程序为开源程序，你可以使用本程序在任何的商业、非商业项目或者网站中。但请你务必保留代码中相关信息（页面logo和页面上必要的链接可以清除），
	  请为本论坛（www.qhjsw.net）加上网址链接，谢谢支持。作为开发者你可以对相应的后台功能进行扩展（增删改相应代码）,但请保留代码中相关来源信息（例如：本论坛网址，邮箱等）。
          如果你进行了修改请务必把修改过的程序以邮件形式发送给本人（qhjsw#qhjsw.net #号换为@）。谢谢合作！
