<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
	class IndexController extends Controller {

		

		/*public function index(){
			$sql = M()->table('ComeOutHead')->join('ComeOutBody on ComeOutHead.Tape_No = ComeOutBody.Tape_No')->join('Material on ComeOutBody.Material_Id = Material.Material_Id')->where("ComeOutHead.Comeout_Date >= '2016-01-01 00:00:00'
	AND ComeOutHead.Comeout_Date <= '2016-07-31 00:00:00'")->select();
			dump($sql);
			// echo(M()->getlastsql());

	}*/

		// $Dstart = $_POST["Dstart"];
  //   	$Dend =$_POST["Dend"];



    /*public function index(){
    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
		//要导入的xls文件，位于根目录下的Public文件夹
		$filename="./Public/1.xls";
		//创建PHPExcel对象，注意，不能少了\
		$PHPExcel=new \PHPExcel();
		//如果excel文件后缀名为.xls，导入这个类
		import("Org.Util.PHPExcel.Reader.Excel5");
		//如果excel文件后缀名为.xlsx，导入这下类
		//import("Org.Util.PHPExcel.Reader.Excel2007");
		//$PHPReader=new \PHPExcel_Reader_Excel2007();

		$PHPReader=new \PHPExcel_Reader_Excel5();
		//载入文件
		$PHPExcel=$PHPReader->load($filename);
		//获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
		$currentSheet=$PHPExcel->getSheet(0);
		//获取总列数
		$allColumn=$currentSheet->getHighestColumn();
		//获取总行数
		$allRow=$currentSheet->getHighestRow();
		//循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
		for($currentRow=1;$currentRow<=$allRow;$currentRow++){
			//从哪列开始，A表示第一列
			for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
				//数据坐标
				$address=$currentColumn.$currentRow;
				//读取到的数据，保存到数组$arr中
				$arr[$currentRow][$currentColumn]=$currentSheet->getCell($address)->getValue();
			}
		
		}
			dump($arr);
    }
*/

    // 出库查询
    public function comeOut(){
    	// $Dstart = '2016-01-01';
		// $Dstart = '2016-07-31';
		header("Content-Type:text/html; charset=utf-8");

		$Dstart = $_POST["Dstart"];
    	$Dend = $_POST["Dend"];
    	$Dnow = date('Y-m-d',time());

    	// echo $Dstart."<br/>".$Dend;

    	// $condition['ComeOutHead.Comeout_Date']>= '2016-04-05';
    	// $condition['ComeOutHead.Comeout_Date']<= '2016-08-03';
    	
		if(empty($Dstart) || empty($Dend)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('起始日期不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";
		
		}else if(strtotime($Dend)>strtotime($Dnow) || strtotime($Dstart)>strtotime($Dnow)){
			/*echo "<script>alert('选择正确日期')</script>";
	    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/	
	    	echo "<SCRIPT language=JavaScript>alert('日期不能大于当前日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
		}else if(strtotime($Dstart)>strtotime($Dend)){
			/*echo "<script>alert('选择正确日期')</script>";
	    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/
	    	echo "<SCRIPT language=JavaScript>alert('开始日期不能大于截止日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
		}else{
			

	    	$map['ComeOutHead.Comeout_Date'] = array(array('egt',$Dstart),array('elt',$Dend)) ;

		$data = M()->table('ComeOutHead')->
		join('ComeOutBody on ComeOutHead.Tape_No = ComeOutBody.Tape_No')->
		join('Material on ComeOutBody.Material_Id = Material.Material_Id')->
		where($map)->
		field('ComeOutHead.Comeout_Date,
		ComeOutHead.Tape_No,
		ComeOutHead.Comeout_Memo,
		ComeOutHead.Contract_Id,
		Material.Material_Name,
		ComeOutBody.Qty,
		Material.Material_Unit,
		ComeOutBody.Price,ComeOutBody.Amount')->
		order('Comeout_Date asc')->select();
		// echo(M()->getlastsql());
			
		}



    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename="出库查询".$Dstart."-".$Dend;
		$headArr=array("出库时间","出库单号","出库原因","合同号","设备名称","设备数量","设备单位","设备单价","设备总价");
		$this->getExcel($filename,$headArr,$data);

	}

	// 入库查询

	public function comeIn(){
    	// $Dstart = '2016-01-01';
		// $Dstart = '2016-07-31';
		header("Content-Type:text/html; charset=utf-8");

		$Dstart = $_POST["Dstart"];
    	$Dend = $_POST["Dend"];
    	$Dnow = date('Y-m-d',time());
    	// echo $Dstart."<br/>".$Dend."<br/>";
    	// echo $Dnow;

    	// $condition['ComeOutHead.Comeout_Date']>= '2016-04-05';
    	// $condition['ComeOutHead.Comeout_Date']<= '2016-08-03';
    	if(empty($Dstart) || empty($Dend)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('起始日期不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";
		
		}else if(strtotime($Dend)>strtotime($Dnow) || strtotime($Dstart)>strtotime($Dnow)){
			/*echo "<script>alert('选择正确日期')</script>";
	    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/	
	    	echo "<SCRIPT language=JavaScript>alert('日期不能大于当前日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
		}else if(strtotime($Dstart)>strtotime($Dend)){
			/*echo "<script>alert('选择正确日期')</script>";
	    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/
	    	echo "<SCRIPT language=JavaScript>alert('开始日期不能大于截止日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
		}else{
			

	    	$map['ComeInHead.Comein_Date'] = array(array('egt',$Dstart),array('elt',$Dend)) ;

			$data = M()->table('ComeInHead')->
			join('SSupplier on ComeInHead.SSupplier_Id = SSupplier.SSupplier_Id')->
			join('ComeInBody on ComeInHead.Tape_No = ComeInBody.Tape_No')->
			join('Material on ComeInBody.Material_Id = Material.Material_Id')->
			where($map)->		
			field('SSupplier.SSupplier_Name,
			ComeInHead.Comein_Date,
			ComeInHead.Tape_No,
			ComeInBody.ShenTape_No,
			Material.Material_Name,
			Material.Material_Unit,
			ComeInBody.Price,
			ComeInBody.Qty,
			ComeInBody.Amount')->
			order('Comein_Date asc')->
			select();
			// echo(M()->getlastsql());
			
		}

    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename="入库查询".$Dstart."-".$Dend;
		$headArr=array("供应商","入库时间","入库单号","采购申请单号","商品名称","单位","单价","数量","金额");
		$this->getExcel($filename,$headArr,$data);

	}


	//退库查询 按日期
	public function comeBack(){
	    	// $Dstart = '2016-01-01';
			// $Dstart = '2016-07-31';
			header("Content-Type:text/html; charset=utf-8");

			$Dstart = $_POST["Dstart"];
	    	$Dend = $_POST["Dend"];
	    	$Dnow = date('Y-m-d',time());
	    	// echo $Dstart."<br/>".$Dend."<br/>";
	    	// echo $Dnow;

	    	// $condition['ComeOutHead.Comeout_Date']>= '2016-04-05';
	    	// $condition['ComeOutHead.Comeout_Date']<= '2016-08-03';
	    	if(empty($Dstart) || empty($Dend)){
		    	// $this->show ("<script>alert('起始日期不能为空')</script>");
		    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
	    		echo "<SCRIPT language=JavaScript>alert('起始日期不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";
			
			}else if(strtotime($Dend)>strtotime($Dnow) || strtotime($Dstart)>strtotime($Dnow)){
				/*echo "<script>alert('选择正确日期')</script>";
		    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/	
		    	echo "<SCRIPT language=JavaScript>alert('日期不能大于当前日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
			}else if(strtotime($Dstart)>strtotime($Dend)){
				/*echo "<script>alert('选择正确日期')</script>";
		    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/
		    	echo "<SCRIPT language=JavaScript>alert('开始日期不能大于截止日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
			}else{
				

		    	$map['ComeBackHead.ComeBack_Date'] = array(array('egt',$Dstart),array('elt',$Dend)) ;

				$data = M()->table('ComeBackHead')->
				join('LEFT JOIN ComeBackBody on ComeBackHead.Tape_No = ComeBackBody.Tape_No')->
				join('LEFT JOIN Material on ComeBackBody.Material_Id = Material.Material_Id')->
				where($map)->		
				field('ComeBackHead.ComeBack_Date,
				ComeBackHead.Tape_No,
				ComeBackHead.Contract_Id,
				ComeBackHead.ComeBack_Memo,
				Material.Material_Name,
				ComeBackBody.Qty,
				ComeBackBody.Price,
				ComeBackBody.Amount,
				ComeBackHead.LastUpdator')->
				order('ComeBackHead.ComeBack_Date')->
				select();
				// echo(M()->getlastsql());
				
			}

	    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
			
			import("Org.Util.PHPExcel");
			import("Org.Util.PHPExcel.Writer.Excel5");
			import("Org.Util.PHPExcel.IOFactory.php");

			$filename="退库查询".$Dstart."-".$Dend;
			$headArr=array("退库日期","退库单号","合同号","项目名称","设备名称","数量","单价","金额","退库人");
			$this->getExcel($filename,$headArr,$data);

		}




	// AP出库查询
    public function comeAPOut(){
    	// $Dstart = '2016-01-01';
		// $Dstart = '2016-07-31';
		header("Content-Type:text/html; charset=utf-8");

		$Dstart = $_POST["Dstart"];
    	$Dend = $_POST["Dend"];
    	$Dnow = date('Y-m-d',time());

    	// echo $Dstart."<br/>".$Dend;

    	// $condition['ComeOutHead.Comeout_Date']>= '2016-04-05';
    	// $condition['ComeOutHead.Comeout_Date']<= '2016-08-03';
    	
		if(empty($Dstart) || empty($Dend)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('起始日期不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";
		
		}else if(strtotime($Dend)>strtotime($Dnow) || strtotime($Dstart)>strtotime($Dnow)){
			/*echo "<script>alert('选择正确日期')</script>";
	    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/	
	    	echo "<SCRIPT language=JavaScript>alert('日期不能大于当前日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
		}else if(strtotime($Dstart)>strtotime($Dend)){
			/*echo "<script>alert('选择正确日期')</script>";
	    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/
	    	echo "<SCRIPT language=JavaScript>alert('开始日期不能大于截止日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
		}else{
			

	    	$map['ComeAPOutHead.Comeout_Date'] = array(array('egt',$Dstart),array('elt',$Dend)) ;

			$data = M()->table('ComeAPOutHead')->
			join('ComeAPOutBody on ComeAPOutHead.Tape_No = ComeAPOutBody.Tape_No')->
			join('AP on ComeAPOutBody.AP_ID = AP.AP_ID')->
			join('AP_Type on AP.AP_Type_Id = AP_Type.AP_Type_Id')->
			where($map)->
			field('ComeAPOutHead.Comeout_Date,
			ComeAPOutHead.Tape_No,
			ComeAPOutHead.Comeout_Memo,
			ComeAPOutHead.Contract_Id,
			AP.AP_ID,
			AP.AP_MAC,
			AP_Type.AP_Type_Name,
  			AP_Type.AP_XingHao,
  			AP_Type.AP_Price')->
			order('Comeout_Date asc')->select();
			// echo(M()->getlastsql());
			
		}



    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename="AP出库查询".$Dstart."-".$Dend;
		$headArr=array("出库时间","出库单号","项目名称","合同号","AP编号","AP_MAC","AP名称","AP型号","AP单价");
		$this->getExcel($filename,$headArr,$data);

	}


	// AP入库查询

	public function comeAPIn(){
    	// $Dstart = '2016-01-01';
		// $Dstart = '2016-07-31';
		header("Content-Type:text/html; charset=utf-8");

		$Dstart = $_POST["Dstart"];
    	$Dend = $_POST["Dend"];
    	$Dnow = date('Y-m-d',time());
    	// echo $Dstart."<br/>".$Dend."<br/>";
    	// echo $Dnow;

    	// $condition['ComeOutHead.Comeout_Date']>= '2016-04-05';
    	// $condition['ComeOutHead.Comeout_Date']<= '2016-08-03';
    	if(empty($Dstart) || empty($Dend)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('起始日期不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";
		
		}else if(strtotime($Dend)>strtotime($Dnow) || strtotime($Dstart)>strtotime($Dnow)){
			/*echo "<script>alert('选择正确日期')</script>";
	    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/	
	    	echo "<SCRIPT language=JavaScript>alert('日期不能大于当前日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
		}else if(strtotime($Dstart)>strtotime($Dend)){
			/*echo "<script>alert('选择正确日期')</script>";
	    	$this->redirect("Index/form"); //直接跳转，不带计时后跳转*/
	    	echo "<SCRIPT language=JavaScript>alert('开始日期不能大于截止日期!');location.href='javascript:history.go(-1);';</SCRIPT>";
		}else{
			

	    	$map['AP.Createtime'] = array(array('egt',$Dstart),array('elt',$Dend)) ;

			$data = M()->table('AP')->
			join('AP_Type on AP.AP_Type_Id = AP_Type.AP_Type_Id')->
			where($map)->		
			field('AP.AP_ID,
				AP.AP_MAC,
				AP.AP_Type_Id,
				AP.Createtime,	
				AP_Type.AP_Type_Name,
				AP_Type.AP_XingHao,
				AP_Type.AP_Price')->
			order('AP.Createtime asc')->
			select();
			// echo(M()->getlastsql());
			
		}

    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename="AP入库查询".$Dstart."-".$Dend;
		$headArr=array("AP编号","AP_MAC","AP入库批次","AP入库时间","产品名称","产品型号","产品单价");
		$this->getExcel($filename,$headArr,$data);

	}


	// 按CP查询
    public function cNum(){    	
		header("Content-Type:text/html; charset=utf-8");
    	$cpNum = $_POST["cpNum"];

    	
		if(empty($cpNum)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('CP号不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";	
		}else{
			

	    	$condition['ClaimPay.Claim_ID'] = $cpNum ;

			$data = M()->table('ClaimPay')->
			join('LEFT JOIN Claim_Gongcheng ON ClaimPay.Claim_ID = Claim_Gongcheng.Claim_ID')->
			join('LEFT JOIN GongCheng ON Claim_Gongcheng.GC_ID = GongCheng.GC_ID')->			
			join('LEFT JOIN Contract ON GongCheng.Contract_ID = Contract.Contract_ID')->
			join('LEFT JOIN ComeOutHead ON Contract.Contract_ID = ComeOutHead.Contract_Id')->
			join('LEFT JOIN ComeOutBody ON ComeOutHead.Tape_No =ComeOutBody.Tape_No')->
			join('LEFT JOIN Material ON ComeOutBody.Material_Id =Material.Material_Id')->
			join('LEFT JOIN Claim_Contract ON ClaimPay.Claim_ID = Claim_Contract.Claim_ID')->
			join('LEFT JOIN ComeAPOutHead ON Contract.Contract_ID = ComeAPOutHead.Contract_Id')->
			join('LEFT JOIN Claim_ComeIn ON ClaimPay.Claim_ID = Claim_ComeIn.Claim_ID')->
			join('LEFT JOIN ComeInHead ON Claim_ComeIn.Tape_No = ComeInHead.Tape_No')->
			join('LEFT JOIN ComeInBody ON ComeInHead.Tape_No = ComeInBody.Tape_No')->
			join('LEFT JOIN Claim_Suptract ON ClaimPay.Claim_ID = Claim_Suptract.Claim_ID')->
			join('LEFT JOIN Suptract ON Claim_Suptract.Suptract_ID = Suptract.Supplier_Id')->
			group('GongCheng.GC_ID,Contract.Contract_ID,ComeInHead.Tape_No,Suptract.Suptract_ID')->
			where($condition)->
			field('ClaimPay.Claim_ID,
				Contract.Contract_ID,
				GongCheng.GC_ID,
				ClaimPay.Claim_Shoukuan,
				ClaimPay.Claim_ShuoMing,
				ClaimPay.Claim_Amount,
				GongCheng.GC_Name,
				GongCheng.GC_Memo,
				GongCheng.GC_JuesuanGC,	
				ComeOutHead.Tape_No,			
				Material.Material_Name,
				ComeOutBody.Qty,
				ComeOutBody.Price,
				GongCheng.Creator,
				GongCheng.GC_StartDate,
				GongCheng.GC_EndDate,
				ClaimPay.Createtime')->
			order('ClaimPay.Createtime ASC')->select();
			echo(M()->getlastsql());
			
		}



    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename=$cpNum;
		$headArr=array("CP号","合同号","工程号","CP名称","支出说明","支出金额","工程名称","工程详情","工程费用","出库单号",
			"材料名称","数量","单价","项目负责人","开工日期","完工日期","结账日期",);
		$this->getExcel($filename,$headArr,$data);

	}




// 出库查询按出库单号
    public function Onum(){
    	
		header("Content-Type:text/html; charset=utf-8");

		$Onum = $_POST["Onum"];

    	
    	
		if(empty($Onum)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('出库单号不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";
		
		}else{
			

		    $condition['ComeOutHead.Tape_No'] = $Onum;
			$data = M()->table('ComeOutHead')->
			join('LEFT JOIN ComeOutBody on ComeOutHead.Tape_No = ComeOutBody.Tape_No')->
			join('LEFT JOIN Material on ComeOutBody.Material_Id = Material.Material_Id')->
			join('LEFT JOIN GongCheng on ComeOutHead.GC_Id = GongCheng.GC_ID')->
			join('LEFT JOIN Contract on ComeOutHead.Contract_ID = Contract.Contract_ID')->
			where($condition)->
			field('ComeOutHead.Tape_No,
			ComeOutHead.Comeout_Date,
			GongCheng.GC_ID,
			GongCheng.GC_Name,
			Contract.Contract_ID,
			Contract.Contract_Memo,
			ComeOutHead.Comeout_Memo,
			Material.Material_Name,
			ComeOutBody.Qty,
			Material.Material_Unit,
			ComeOutBody.Price,
			ComeOutBody.Amount')->
			order('ComeOutHead.Tape_No asc')->select();
			echo(M()->getlastsql());
			
		}



    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename=$Onum;
		$headArr=array("出库单号","出库时间","工程号","工程名称","合同号","合同内容","出库原因","设备名称","设备数量","设备单位","设备单价","设备总价");
		$this->getExcel($filename,$headArr,$data);

	}

	// 入库查询 按入库单号

	public function Inum(){
    	// $Dstart = '2016-01-01';
		// $Dstart = '2016-07-31';
		header("Content-Type:text/html; charset=utf-8");

		$Inum = $_POST["Inum"];

    	
    	
		if(empty($Inum)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('入库单号不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";
		
		}else{
			

	    	$condition['ComeInHead.Tape_No'] = $Inum;

			$data = M()->table('ComeInHead')->
			join('SSupplier on ComeInHead.SSupplier_Id = SSupplier.SSupplier_Id')->
			join('ComeInBody on ComeInHead.Tape_No = ComeInBody.Tape_No')->
			join('Material on ComeInBody.Material_Id = Material.Material_Id')->
			where($condition)->		
			field('ComeInHead.Tape_No,
				SSupplier.SSupplier_Name,
				ComeInHead.Comein_Date,				
				ComeInBody.ShenTape_No,
				Material.Material_Name,
				Material.Material_Unit,
				ComeInBody.Price,
				ComeInBody.Qty,
				ComeInBody.Amount')->
				order('ComeInHead.Tape_No asc')->
				select();
			 	// echo(M()->getlastsql());
			
		}

    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename="按单号入库查询".$Inum;
		$headArr=array("入库单号","供应商","入库时间","采购申请单号","商品名称","单位","单价","数量","金额");
		$this->getExcel($filename,$headArr,$data);

	}



	// 退库查询 按退库单号

	public function Bnum(){
    	
		header("Content-Type:text/html; charset=utf-8");

		$Bnum = $_POST["Bnum"];

    	
    	
		if(empty($Bnum)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('退库单号不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";
		
		}else{
			

	    	$condition['ComeBackHead.Tape_No'] = $Bnum;

			$data = M()->table('ComeBackHead')->
			join('LEFT JOIN ComeBackBody on ComeBackHead.Tape_No = ComeBackBody.Tape_No')->
			join('LEFT JOIN Material on ComeBackBody.Material_Id = Material.Material_Id')->
			where($condition)->		
			field('ComeBackHead.ComeBack_Date,
				ComeBackHead.Tape_No,
				ComeBackHead.Contract_Id,
				ComeBackHead.ComeBack_Memo,
				Material.Material_Name,
				ComeBackBody.Qty,
				ComeBackBody.Price,
				ComeBackBody.Amount,
				ComeBackHead.LastUpdator')->
				order('ComeBackHead.ComeBack_Date')->
				select();
				// echo(M()->getlastsql());
				
			}

	    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
			
			import("Org.Util.PHPExcel");
			import("Org.Util.PHPExcel.Writer.Excel5");
			import("Org.Util.PHPExcel.IOFactory.php");

			$filename=$Bnum;
			$headArr=array("退库日期","退库单号","合同号","项目名称","设备名称","数量","单价","金额","退库人");
			$this->getExcel($filename,$headArr,$data);

	}




// 按GC查询
    public function GNum(){    	
		header("Content-Type:text/html; charset=utf-8");
    	$gcNum = $_POST["gcNum"];

    	
		if(empty($gcNum)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('工程号不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";	
		}else{
			

	    	$condition['GongCheng.GC_ID'] = $gcNum;

			$data = M()->table('GongCheng')->
			join('LEFT JOIN Contract ON GongCheng.Contract_ID = Contract.Contract_ID')->
			join('LEFT JOIN Customer ON Contract.Customer_Id = Customer.Customer_Id')->
			join('LEFT JOIN GSupplier ON GongCheng.GSupplier_id = GSupplier.GSupplier_ID')->
			join('LEFT JOIN ComeOutHead ON Contract.Contract_ID =ComeOutHead.Contract_Id')->
			
			group('GongCheng.GC_ID,Contract.Contract_ID,ComeOutHead.Tape_No')->
			where($condition)->
			field('GongCheng.GC_ID,
				GongCheng.GC_Type,
				Contract.Contract_ID,
				Customer.Customer_JianName,
				Customer.Customer_Id,
				Customer.Customer_Name,
				Contract.Contract_StartDate,
				Contract.Contract_EndDate,
				Contract.Contract_FeeStartDate,
				Contract.Contract_FeeEndDate,
				GongCheng.GC_Name,
				GongCheng.GC_Memo,				
				GSupplier.GSupplier_Name,
				GongCheng.GC_JuesuanAll,
				GongCheng.GC_JuesuanGC,
				ComeOutHead.Tape_No,
				GongCheng.LastUpdator')->
			order('GongCheng.GC_ID ASC')->select();
			echo(M()->getlastsql());
			
		}



    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename=$gcNum;
		$headArr=array("工程号","工程类型","合同号","合同名称","客户ID","客户名称","合同开始时间","合同结束时间","合同开始计费时间","合同结束计费时间","工程名称",
			"工程描述","施工单位名称","工程决算","工程款","出库单号","负责人",);
		$this->getExcel($filename,$headArr,$data);

	}


	// 按合同号查询
    public function conNum(){    	
		header("Content-Type:text/html; charset=utf-8");
    	$conNum = $_POST["conNum"];

    	
		if(empty($conNum)){
	    	// $this->show ("<script>alert('起始日期不能为空')</script>");
	    	// $this->redirect("Index/form"); //直接跳转，不带计时后跳转	    	
    		echo "<SCRIPT language=JavaScript>alert('合同号不能为空!');location.href='javascript:history.go(-1);';</SCRIPT>";	
		}else{
			

	    	$condition['Contract.Contract_ID'] = $conNum;

			$data = M()->table('ClaimPay')->
			join('LEFT JOIN Claim_Gongcheng ON ClaimPay.Claim_ID = Claim_Gongcheng.Claim_ID')->
			join('LEFT JOIN GongCheng ON Claim_Gongcheng.GC_ID = GongCheng.GC_ID')->
			join('LEFT JOIN ComeOutHead ON GongCheng.GC_ID = ComeOutHead.GC_Id')->
			join('LEFT JOIN ComeOutBody ON ComeOutHead.Tape_No =ComeOutBody.Tape_No')->
			join('LEFT JOIN Material ON ComeOutBody.Material_Id =Material.Material_Id')->
			join('LEFT JOIN Claim_Contract ON ClaimPay.Claim_ID = Claim_Contract.Claim_ID')->
			join('LEFT JOIN Contract ON Claim_Contract.Contract_ID = Contract.Contract_ID')->
			join('LEFT JOIN ComeAPOutHead ON Contract.Contract_ID = ComeAPOutHead.Contract_Id')->
			join('LEFT JOIN Claim_ComeIn ON ClaimPay.Claim_ID = Claim_ComeIn.Claim_ID')->
			join('LEFT JOIN ComeInHead ON Claim_ComeIn.Tape_No = ComeInHead.Tape_No')->
			join('LEFT JOIN ComeInBody ON ComeInHead.Tape_No = ComeInBody.Tape_No')->
			join('LEFT JOIN Claim_Suptract ON ClaimPay.Claim_ID = Claim_Suptract.Claim_ID')->
			join('LEFT JOIN Suptract ON Claim_Suptract.Suptract_ID = Suptract.Supplier_Id')->
			group('GongCheng.GC_ID,Contract.Contract_ID,ComeInHead.Tape_No,Suptract.Suptract_ID')->
			where($condition)->
			field('Contract.Contract_ID,
				GongCheng.GC_ID,
				ClaimPay.Claim_ID,								
				Suptract.Suptract_ID,
				ClaimPay.Claim_Shoukuan,
				ClaimPay.Claim_ShuoMing,
				ClaimPay.Claim_Amount,
				GongCheng.GC_Name,
				GongCheng.GC_Memo,
				GongCheng.GC_JuesuanGC,				
				Material.Material_Name,
				ComeOutBody.Qty,
				ComeOutBody.Price,
				GongCheng.Creator,
				GongCheng.GC_StartDate,
				GongCheng.GC_EndDate,
				ClaimPay.Createtime,
				ComeOutHead.Tape_No')->
			order('Contract.Contract_ID')->select();
			echo(M()->getlastsql());
			
		}



    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
		import("Org.Util.PHPExcel");
		import("Org.Util.PHPExcel.Writer.Excel5");
		import("Org.Util.PHPExcel.IOFactory.php");

		$filename=$conNum;
		$headArr=array("合同号","工程号","CP号","扣款单号","CP名称","支出说明","支出金额","工程名称","工程详情","工程费用","出库单号",
			"材料名称","数量","单价","项目负责人","开工日期","完工日期","结账日期",);
		$this->getExcel($filename,$headArr,$data);

	}



	private	function getExcel($fileName,$headArr,$data){
			//对数据进行检验
		    if(empty($data) || !is_array($data)){
		        die("检查输入内容");
		    }
		    //检查文件名
		    if(empty($fileName)){
		        exit;
		    }

		    $date = date("Y_m_d",time());
		    $fileName .= ".xls";

			//创建PHPExcel对象，注意，不能少了\
		    $objPHPExcel = new \PHPExcel();
		    $objProps = $objPHPExcel->getProperties();
			
		    //设置表头
		    $key = ord("A");
		    foreach($headArr as $v){
		        $colum = chr($key);
		        $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
		        $key += 1;
		    }
		    
		    $column = 2;
		    $objActSheet = $objPHPExcel->getActiveSheet();
		    foreach($data as $key => $rows){ //行写入
		        $span = ord("A");
		        foreach($rows as $keyName=>$value){// 列写入
		            $j = chr($span);
		            $objActSheet->setCellValue($j.$column, $value);
		            $span++;
		        }
		        $column++;
	    	}

		    $fileName = iconv("utf-8", "gb2312", $fileName);
		    //重命名表
		   	// $objPHPExcel->getActiveSheet()->setTitle('test');
		    //设置活动单指数到第一个表,所以Excel打开这是第一个表
		    $objPHPExcel->setActiveSheetIndex(0);
		    $objActSheet->getColumnDimension( 'I')->setAutoSize(true);
		    header('Content-Type: application/vnd.ms-excel');
			header("Content-Disposition: attachment;filename=\"$fileName\"");
			header('Cache-Control: max-age=0');

			ob_clean();//关键
            flush();//关键

		  	$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		    $objWriter->save('php://output'); //文件通过浏览器下载
		    exit;
		}

		// $this->ComeOut($Dstart,$Dend);


}