<?php
/**
* @name butian-spider
* @author 昌维 867597730@qq.com
* @include simple_html_dom
* @link www.changwei.me
* @version 1.0.0
*/

// 2016-01-20 15:42:26

ini_set("max_execution_time", "3600");
// 引入simple_html_dom库
include('simple_html_dom/simple_html_dom.php');
//数据库连接
include('conn.php');
//脚本执行时间统计
include('timer.class.php');

//new一个timer对象并且start开始计算脚本执行时间
$timer= new Timer(); 
$timer->start();

// 新建一个Dom实例
$list = new simple_html_dom();
$detail = new simple_html_dom();

//初始页码
$page = 1;
//结束页码
$endpage = 500;
// 从url中加载
for ($page; $page < $endpage; $page++) { 
	$list->load_file('http://loudong.360.cn/vul/list-more/state/8/page/'.$page);
	foreach ($list->find('p.list-view a') as $key => $value) {
		if (strpos($value->href, '/profile/u/')>0) {
			continue;//判断如果获取到的链接是白帽子个人中心的链接则跳过
		}
		// echo $value->href . ' ' . $value->innertext . '<br>';//漏洞链接和名字
		// echo "<br>";
		$漏洞链接 = 'http://loudong.360.cn'.$value->href;
		$漏洞编号 = str_replace('http://loudong.360.cn/vul/info/qid/', '', $漏洞链接);
		$漏洞名称 = $value->innertext;
		$detail->load_file($漏洞链接);
		$漏洞厂商 = str_replace('/vul/search/c/', '', $detail->find('div.state ul li dt a',0)->href);
		$状态     = trim(strip_tags($detail->find('div.state ul li dt',1)));
		$提交时间 = trim(strip_tags($detail->find('div.state ul li dt',2)));
		$官方评级 = trim(strip_tags($detail->find('div.state ul li dt',3)));
		$漏洞描述 = trim($detail->find('#ld_td_description',0));
		$漏洞详情 = trim($detail->find('dl.ld-info-dl dd',0));
		$厂商回复 = trim(strip_tags($detail->find('dl.ld-info-dl dd',1)));

		$sql = "INSERT INTO butian_spider_changwei (href,QTVA,title,company,state,addtime,rank,description,detail,reply) VALUES ('{$漏洞链接}','{$漏洞编号}','{$漏洞名称}','{$漏洞厂商}','{$状态}','{$提交时间}','{$官方评级}','{$漏洞描述}','{$漏洞详情}','{$厂商回复}')";
		mysql_query($sql);
		echo mysql_errno().'-'.mysql_error();
		echo $sql."\n";

		// exit($detail->find('div.state ul li dt',0));
		// foreach ($detail->find('div.state ul li dt') as $detail_key => $detail_value) {
		// 	echo $detail_key.$detail_value;//0漏洞厂商&厂商注册情况 1状态 2提交时间 3官方评级 4分享到微博
		// }
		// echo "<br>";
		// exit($detail->find('#ld_td_description',0));
		// foreach ($detail->find('#ld_td_description') as $detail_key => $detail_value) {
		// 	echo $detail_value;//漏洞描述
		// }
		// echo "<br>";
		// exit($detail->find('dl.ld-info-dl dd',0));
		// foreach ($detail->find('dl.ld-info-dl dd') as $detail_key => $detail_value) {
		// 	echo $detail_value;//0漏洞详细 1厂商回复
		// }
		// echo "<hr>";
		$detail->clear();
	}
	$list->clear();
}
$timer->stop();
echo "当前脚本执行时间：".$timer->spent();
// echo "<pre>";
// print_r($lv);
// echo "</pre>";