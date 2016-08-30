<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>OA财务查询系统</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
	<script type="text/javascript" src="/oaReport/Public/Js/WdatePicker.js"></script>
  <link rel="stylesheet" type="text/css" href="/oaReport/Public/Css/style.css" />
	
</head>
<body >
    <div class="content">
       <form id="outForm" action="/oaReport/index.php?s=/Home/Index/comeOut" method="post" name="outForm">         
          <h3>出库查询</h3>       
          <input id="Dstart" name="Dstart" class="Wdate" type="text" onClick="WdatePicker()"> <font color=red>选择开始日期</font>&nbsp;&nbsp;
          <input id="Dend" name="Dend" class="Wdate" type="text" onClick="WdatePicker()"> <font color=blue>选择截止日期</font>&nbsp;&nbsp;<input type="submit" value="获取出库信息" />
        </form>


        <form id="inForm" action="/oaReport/index.php?s=/Home/Index/comeIn" method="post" name="inForm"> 
          <h3>入库查询</h3>        
          <input id="Dstart" name="Dstart" class="Wdate" type="text" onClick="WdatePicker()"> <font color=red>选择开始日期</font>&nbsp;&nbsp;        
          <input id="Dend" name="Dend" class="Wdate" type="text" onClick="WdatePicker()"> <font color=blue>选择截止日期</font>&nbsp;&nbsp;<input type="submit" value="获取入库信息" />
        </form>

        <form id="outAPForm" action="/oaReport/index.php?s=/Home/Index/comeAPOut" method="post" name="outAPForm">
          <h3>AP出库查询</h3>      
          <input id="Dstart" name="Dstart" class="Wdate" type="text" onClick="WdatePicker()"> <font color=red>选择开始日期</font>&nbsp;&nbsp;
          <input id="Dend" name="Dend" class="Wdate" type="text" onClick="WdatePicker()"> <font color=blue>选择截止日期</font>&nbsp;&nbsp;<input type="submit" value="获取AP出库信息" />
        </form>


        <form id="inAPForm" action="/oaReport/index.php?s=/Home/Index/comeAPIn" method="post" name="inAPForm">        
          <h3>AP入库查询</h3>        
          <input id="Dstart" name="Dstart" class="Wdate" type="text" onClick="WdatePicker()"> <font color=red>选择开始日期</font>&nbsp;&nbsp;
          <input id="Dend" name="Dend" class="Wdate" type="text" onClick="WdatePicker()"> <font color=blue>选择截止日期</font>&nbsp;&nbsp;<input type="submit" value="获取AP入库信息" />
        </form>     

        <form id="cNum" action="/oaReport/index.php?s=/Home/Index/cNum" method="post" name="cNum">        
          <h3>按CP号查询</h3>        
          <input id="cpNum" name="cpNum" class="Wdate" type="text" placeholder="CP-XXXX"> <font color=red>输入CP号</font>&nbsp;&nbsp;
          <input type="submit" value="按CP号查询" />
        </form>

        <form id="cNum" action="/oaReport/index.php?s=/Home/Index/Inum" method="post" name="Inum">
         <h3>入库按单号查询</h3>        
          <input id="Inum" name="Inum" class="Wdate" type="text" placeholder="IN-xxxx"> <font color=red>输入入库单号</font>&nbsp;&nbsp; <input type="submit" value="获取入库信息" />
        </form>

        <form id="Onum" action="/oaReport/index.php?s=/Home/Index/Onum" method="post" name="Onum">
          <h3>出库按单号查询</h3>      
          <input id="Onum" name="Onum" class="Wdate" type="text" placeholder="OUT-xxxx"> <font color=red>输入出库单号</font>&nbsp;&nbsp;
          <input type="submit" value="获取出库信息" />
        </form> 

        <form id="GNum" action="/oaReport/index.php?s=/Home/Index/GNum" method="post" name="GNum">        
          <h3>按工程号查询</h3>        
          <input id="gcNum" name="gcNum" class="Wdate" type="text" placeholder="GC-XXXX"> <font color=red>输入工程号</font>&nbsp;&nbsp;
          <input type="submit" value="按GC号查询" />
        </form>

        <form id="conNum" action="/oaReport/index.php?s=/Home/Index/conNum" method="post" name="conNum">        
          <h3>按合同号查询</h3>        
          <input id="conNum" name="conNum" class="Wdate" type="text" placeholder="XX-XXXX-XXXX"> <font color=red>输入合同号</font>&nbsp;&nbsp;
          <input type="submit" value="按合同号查询" />
        </form>    
          
        <form id="comeBack" action="/oaReport/index.php?s=/Home/Index/comeBack" method="post" name="comeBack">
          <h3>退库查询</h3>      
          <input id="Dstart" name="Dstart" class="Wdate" type="text" onClick="WdatePicker()"> <font color=red>选择开始日期</font>&nbsp;&nbsp;
          <input id="Dend" name="Dend" class="Wdate" type="text" onClick="WdatePicker()"> <font color=blue>选择截止日期</font>&nbsp;&nbsp;<input type="submit" value="获取退库信息" />
        </form>

        <form id="Bnum" action="/oaReport/index.php?s=/Home/Index/Bnum" method="post" name="Bnum">
          <h3>按退库单号查询</h3>      
          <input id="Bnum" name="Bnum" class="Wdate" type="text" placeholder="BCK-xxxx"> <font color=red>输入退库单号</font>&nbsp;&nbsp;
          <input type="submit" value="获取退库信息" />
        </form> 



    </div>
</body>

</html>