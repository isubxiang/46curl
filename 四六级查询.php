<?php
    if(isset($_GET['id'])){
        //处理表单提交的数据
        if(empty($_GET['id']) || empty($_GET['name'])) die('缺少id或name参数！');    //缺少参数反馈
        
        $query_data = 'zkzh='.$_GET['id'].'&xm='.urlencode($_GET['name']);                        //拼接成URL参数
        
        //curl请求开始
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, 'http://www.XXX.com.cn/cet/query');    //请求URL
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt ($ch,CURLOPT_REFERER,'http://www.XXXXi.com.cn/cet/');    //制造假的REFERER
        curl_setopt ($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  //返回数据不直接输出
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_data );                    //设置参数数据
        $content = curl_exec ($ch);
        curl_close ($ch);
        //替换继续查询链接
        $content = str_replace('/cet/', $_SERVER['SCRIPT_NAME'], $content);
        echo $content;
    }else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>四六级成绩查询</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="zh-CN" />
</head>
<body>
<style>
div{float:left;clear:left;margin:5px;}
label,input{width:150px;float:left;}
</style>
<h1>四六级成绩查询</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div><label for="id">准考证号：</label><input type="text" name="id" id="id"/></div>
    <div><label for="name">姓名：</label><input type="text" name="name" id="name"/></div>
    <div><input type="submit" value="查询"/></div>
</form>
</body>
</html>
<?php
    }
?>