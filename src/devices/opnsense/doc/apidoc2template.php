#!/usr/bin/php
<?php
// if(!isset($argv[1])){
// 	echo "please pass the API Documentation URL as the first argument. ie:\n";
// 	echo "https://docs.opnsense.org/development/api/core/core.html\n";
// 	exit(1);
// }

// $url=$argv[1];

$pages="
https://docs.opnsense.org/development/api/core/captiveportal.html
https://docs.opnsense.org/development/api/core/core.html
https://docs.opnsense.org/development/api/core/cron.html
https://docs.opnsense.org/development/api/core/dhcp.html
https://docs.opnsense.org/development/api/core/dhcpv4.html
https://docs.opnsense.org/development/api/core/dhcpv6.html
https://docs.opnsense.org/development/api/core/diagnostics.html
https://docs.opnsense.org/development/api/core/firewall.html
https://docs.opnsense.org/development/api/core/firmware.html
https://docs.opnsense.org/development/api/core/ids.html
https://docs.opnsense.org/development/api/core/interfaces.html
https://docs.opnsense.org/development/api/core/ipsec.html
https://docs.opnsense.org/development/api/core/menu.html
https://docs.opnsense.org/development/api/core/monit.html
https://docs.opnsense.org/development/api/core/openvpn.html
https://docs.opnsense.org/development/api/core/proxy.html
https://docs.opnsense.org/development/api/core/routes.html
https://docs.opnsense.org/development/api/core/syslog.html
https://docs.opnsense.org/development/api/core/trafficshaper.html
https://docs.opnsense.org/development/api/core/unbound.html
https://docs.opnsense.org/development/api/plugins/acmeclient.html
https://docs.opnsense.org/development/api/plugins/apcupsd.html
https://docs.opnsense.org/development/api/plugins/backup.html
https://docs.opnsense.org/development/api/plugins/bind.html
https://docs.opnsense.org/development/api/plugins/chrony.html
https://docs.opnsense.org/development/api/plugins/cicap.html
https://docs.opnsense.org/development/api/plugins/clamav.html
https://docs.opnsense.org/development/api/plugins/collectd.html
https://docs.opnsense.org/development/api/plugins/crowdsec.html
https://docs.opnsense.org/development/api/plugins/diagnostics.html
https://docs.opnsense.org/development/api/plugins/dnscryptproxy.html
https://docs.opnsense.org/development/api/plugins/dyndns.html
https://docs.opnsense.org/development/api/plugins/fetchmail.html
https://docs.opnsense.org/development/api/plugins/firewall.html
https://docs.opnsense.org/development/api/plugins/freeradius.html
https://docs.opnsense.org/development/api/plugins/ftpproxy.html
https://docs.opnsense.org/development/api/plugins/gridexample.html
https://docs.opnsense.org/development/api/plugins/haproxy.html
https://docs.opnsense.org/development/api/plugins/helloworld.html
https://docs.opnsense.org/development/api/plugins/hwprobe.html
https://docs.opnsense.org/development/api/plugins/iperf.html
https://docs.opnsense.org/development/api/plugins/lldpd.html
https://docs.opnsense.org/development/api/plugins/maltrail.html
https://docs.opnsense.org/development/api/plugins/mdnsrepeater.html
https://docs.opnsense.org/development/api/plugins/muninnode.html
https://docs.opnsense.org/development/api/plugins/netdata.html
https://docs.opnsense.org/development/api/plugins/netsnmp.html
https://docs.opnsense.org/development/api/plugins/nginx.html
https://docs.opnsense.org/development/api/plugins/nodeexporter.html
https://docs.opnsense.org/development/api/plugins/nrpe.html
https://docs.opnsense.org/development/api/plugins/ntopng.html
https://docs.opnsense.org/development/api/plugins/nut.html
https://docs.opnsense.org/development/api/plugins/openconnect.html
https://docs.opnsense.org/development/api/plugins/postfix.html
https://docs.opnsense.org/development/api/plugins/proxysso.html
https://docs.opnsense.org/development/api/plugins/proxyuseracl.html
https://docs.opnsense.org/development/api/plugins/puppetagent.html
https://docs.opnsense.org/development/api/plugins/qemuguestagent.html
https://docs.opnsense.org/development/api/plugins/quagga.html
https://docs.opnsense.org/development/api/plugins/radsecproxy.html
https://docs.opnsense.org/development/api/plugins/redis.html
https://docs.opnsense.org/development/api/plugins/relayd.html
https://docs.opnsense.org/development/api/plugins/rspamd.html
https://docs.opnsense.org/development/api/plugins/shadowsocks.html
https://docs.opnsense.org/development/api/plugins/siproxd.html
https://docs.opnsense.org/development/api/plugins/smart.html
https://docs.opnsense.org/development/api/plugins/softether.html
https://docs.opnsense.org/development/api/plugins/sslh.html
https://docs.opnsense.org/development/api/plugins/stunnel.html
https://docs.opnsense.org/development/api/plugins/tayga.html
https://docs.opnsense.org/development/api/plugins/telegraf.html
https://docs.opnsense.org/development/api/plugins/tftp.html
https://docs.opnsense.org/development/api/plugins/tinc.html
https://docs.opnsense.org/development/api/plugins/tor.html
https://docs.opnsense.org/development/api/plugins/udpbroadcastrelay.html
https://docs.opnsense.org/development/api/plugins/vnstat.html
https://docs.opnsense.org/development/api/plugins/wazuhagent.html
https://docs.opnsense.org/development/api/plugins/wireguard.html
https://docs.opnsense.org/development/api/plugins/wol.html
https://docs.opnsense.org/development/api/plugins/zabbixagent.html
https://docs.opnsense.org/development/api/plugins/zabbixproxy.html
https://docs.opnsense.org/development/api/plugins/zerotier.html
";


$OUT='';
foreach(explode("\n",trim($pages)) as $url){
	echo "# ".str_pad($url,80);
	if($count=ExtractTemplate($url)){
		echo $count;
	}
	else{
		echo "ERROR";
	}
	echo "\n\n";
	sleep(2);
}


// -------
function ExtractTemplate($url){
	$url=trim($url);
	if(!$url){
		return;
	}
	global $OUT;
	$OUT .="\n// $url --------------------------------------\n\n";

	$html=file_get_contents($url);
	$dom = new DOMDocument();
	@$dom->loadHTML($html);
	$tds = $dom->getElementsByTagName('td'); 

	$cols=5;
	$l=0;
	$c=0;
	$trs=array();
	foreach($tds as $td){	
		$trs[$l][$c]=$td->textContent;
		$c++;
		if($c >= $cols){
			$l++;
			$c=0;
		}
	}
	$count=0;
	foreach($trs as $row){
		$type=strtolower($row[0]);
		$path="/{$row[1]}/{$row[2]}/{$row[3]}";
		$meth='get';
		if($type=='post'){
			$meth='set';
		}
		$par="''";
		if($row[4]){
			$par=$row[4];
			$par=str_replace('$','',$par);
			$pars=explode(',',$par);
			foreach($pars as $k => $v){
				if(preg_match('#(\w+)=’’#',$v,$m)){
					$pars[$k]="'{$m[1]}'=>''";
				}
				else{
					$pars[$k]="'{$v}'=>'!'";
				}
			}
			$par="[".implode(", ",$pars)."]";
		}
		$OUT .="	['{$path}',					'1',	'{$meth}',	'{$type}',		{$par},		''],\n";
		$count++;
	}
	return $count;
}
$OUT.="\n";
echo $OUT;

?>