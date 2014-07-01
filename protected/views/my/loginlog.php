<?php
$this->pageTitle=Yii::app()->name . ' - 登陆日志';
$this->breadcrumbs=array(
	'个人中心'=>array('my/index'),
	'登陆日志',
);


/**
*	ip whois 查询
*
*	1 参数 ip
*
*	返回值 数组
**/
function whois_ip( $ip ) {
	
	// http://www.icann.org/zh/about/learning/glossary 这是 介绍 IP等的,
	// inetnum =	IP段
	// netname =	公司名称
	// descr =		公司地址
	// country =	国家  中国 CN  美国US 日本JP
	// address =	IP 所在地址
	// whois =		查询的服务器
	
	// 非洲
	$whois['whois.afrinic.net']['inetnum'] = 'inetnum';
	$whois['whois.afrinic.net']['netname'] = 'netname';
	$whois['whois.afrinic.net']['country'] = 'country';
	$whois['whois.afrinic.net']['address'] = 'address';
	$whois['whois.afrinic.net']['descr'] = 'descr';
	
	
	// 美洲
	$whois['whois.arin.net']['inetnum'] = 'netrange';
	$whois['whois.arin.net']['netname'] = 'netname';
	$whois['whois.arin.net']['country'] = 'country';
	$whois['whois.arin.net']['address'] = 'address';
	$whois['whois.arin.net']['descr'] = 'orgname';
	
	// 亚太
	$whois['whois.apnic.net']['inetnum'] = 'inetnum';
	$whois['whois.apnic.net']['netname'] = 'netname';
	$whois['whois.apnic.net']['country'] = 'country';
	$whois['whois.apnic.net']['address'] = 'address';
	$whois['whois.apnic.net']['descr'] = 'descr';
	
	// 拉丁美洲和加勒比海
	$whois['whois.lacnic.net']['inetnum'] = 'inetnum';
	$whois['whois.lacnic.net']['netname'] = 'ownerid';
	$whois['whois.lacnic.net']['country'] = 'country';
	$whois['whois.lacnic.net']['address'] = 'address';
	$whois['whois.lacnic.net']['descr'] = 'owner';
	
	// 欧洲
	$whois['whois.ripe.net']['inetnum'] = 'inetnum';
	$whois['whois.ripe.net']['netname'] = 'netname';
	$whois['whois.ripe.net']['country'] = 'country';
	$whois['whois.ripe.net']['address'] = 'address';
	$whois['whois.ripe.net']['descr'] = 'descr';
	

	
	
	// 获得 ip 的查询地区
	if ( !$sock = fsockopen( 'whois.iana.org', 43, $errNum, $errStr, 5 ) ) {
		return false;
	}
	
	fputs( $sock, $ip . "\n" );
	$r = array( );
	while( !feof( $sock ) ) {
		$a = explode( ':', fgets( $sock, 4096 ), 2 );
		if ( count( $a ) == 2 ) {
			$a[1] = trim( $a[1] );
			if ( in_array( $a[0], array( 'whois', 'refer' ) ) && in_array( $a[1], array_keys( $whois ) ) ) {
				$refer = trim( $a[1] );
				break;
			}
		}
		if ( in_array( $a[0], array( 'inetnum', 'netname', 'descr', 'address', 'country' ) ) ) {
			$r[$a[0]] = $a[1];
		}
		
		if ( $a[0] == 'organisation' && empty( $r['netname'] ) ) {
			$r['netname'] = $a[1];
		}
	}
	fclose( $sock );
	if ( $r && empty( $refer ) ) {
		$r = array_pad_value( $r, array_keys( reset( $whois ) ) );
		$r['whois'] = 'whois.iana.org';
		return $r;
	}
	
	
	
	if ( empty( $refer ) ) {
		return false;
	}
	
	$whois = $whois[$refer];
	
	
	
	if ( !$sock = fsockopen( $refer, 43, $errNum, $errStr, 5 ) ) {
		return false;
	}
	fputs( $sock, $ip . "\n" );
	$arr = array();
	while( !feof( $sock ) ) {
		$a = explode( ':', fgets( $sock, 4096 ), 2 );
		$a[0] = strtolower( trim( $a[0] ) );
		if ( strpos( $a[0], ' ' ) || count( $a ) != 2 ) {
			continue;
		}
		$arr[] = $a;
	}
	
	$r = array();
	$all = array_flip( $whois );
	foreach ( $arr as $k => $v ) {
		if ( empty( $all[$v[0]] ) ) {
			continue;
		}
		$kk = $all[$v[0]];
		if ( empty( $r[$kk] ) ) {
			$r[$kk] = trim( $v[1] );
		} elseif ( $arr[$k-1][0] == $v[0] ) {
			$r[$kk] .= "\n". trim( $v[1] );
		}
	}
	
	$r = array_pad_value( $r, array_keys( $whois ) );
	$r['whois'] = $refer;
	return $r;
}

/**
*	数组 填补值
*
*	1 参数 需要进行处理的数组
*	2 参数 只保留下哪些下标 和没有添加哪些下标 数组 或者 字符串 array( 'key', 'tmd' ) key,tmd
*	3 参数 添加的默认值
*	4 参数 是否进行过滤 过滤后只保留2参数里面有的值的KEY
*
*	返回值 处理后的数组
**/
function array_pad_value( $arr = array(), $pad = array(), $value = null, $intersect_key = true ) {
	$arr = (array) $arr;
	if( !is_array( $pad ) ) {
		$pad = explode(',', $pad );
	}
	$p = array();
	foreach ( $pad as $v ) {
		$p[$v] = $value;
	}
	$arr += $p;
	if( $intersect_key ) {
		return array_intersect_key( $arr , $p );
	} else {
		return $arr;
	}
}
?>

<div class="info-body">
	<div class="com-user-box">
		<div class="titbox">
			<p>登陆日志</p>
		</div>
	</div>
	<div class="com-user-box">
		<table width="100%" border="0" cellpadding="4" cellspacing="0" style="margin-top: 10px;">
			<tbody>
				<tr>
					<td width="90" height="30" align="right">最后登录时间</td>
					<td><?php echo $model->Time; ?></td>
				</tr>
				<tr>
					<td width="90" height="30" align="right">最后登录IP</td>
					<td><?php echo $model->Ip; ?></td>
				</tr>
				<tr>
					<td width="90" height="30" align="right">最后登录地</td>
					<td><?php
						$addr = whois_ip($model->Ip);
						if(!empty($addr)){
							echo $addr['descr'];
						}
						else{
							echo 'Not found!';
						}
					?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
