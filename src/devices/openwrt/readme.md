# Hackapi_Openwrt v0.90

Writen in php, this API client aims to provide a nice interface with **OPENWRT**'s Routers.

(WORK IN PROGRESS)

This API client works for OpenWrt 22.x.
but it should actually work for many previous version.
It does not require any specific packages.

-------
Please note that some methods are not permitted using the default OpenWrt configuration. _(You'll get a nice '-32002 error')_

To grant access to all methods, you can add: 

```json
{
	"superuser": {
		"description": "Super user access role",
		"read": {
			"ubus": {
					"*": [ "*" ]
			},
			"uci": [ "*" ],
			"file": {
					"*": ["*"]
			}
		},
		"write": {
			"ubus": {
					"*": [ "*" ]
			},
			"uci": [ "*" ],
			"file": {
					"*": ["*"]
			},
			"cgi-io": ["*"]
		}
	}
}
```

into a new file (in your OpenWRT router) at: `/usr/share/rpcd/acl.d/superuser.json`.

_Then for security reasons, you might rather want to create a user dedicated to your API usage, with appropriate restrictions._



## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| openwrt | 22.03.2 | January 10th, 2024 | @soif | Most ApiGet methods have been tested. Most ApiSet methods still need tests |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 184 methods are currently implemented

- **6** standardised methods
- **41** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **28** methods with status of **TESTED** (Params still not ordered or desc not set)
- **9** methods with status of **UNDER DEV** (Work in propress)
- **100** methods with status of **DRAFT** (Not tested)



### 72 *Getter* methods (ReadOnly)

- **37** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **28** methods with status of **TESTED** (Params still not ordered or desc not set)
- **7** methods with status of **UNDER DEV** (Work in propress)


### 106 *Setter* methods (Writing or performing an action)

- **4** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **2** methods with status of **UNDER DEV** (Work in propress)
- **100** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

### Standardised API Methods

| Method |
| ------ |
| **:star: ApiLogin** |
| **:star: ApiReboot** |
| **:star: ApiWifiListClients** |
| **:star: ApiWifiListSsids** |
| **:star: ApiWifiStart** |
| **:star: ApiWifiStop** |

### Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **:star: ApiGetDhcp** | List DHCP objects | FINAL |
| **:white_check_mark: ApiGetDhcpIpv4leases** | (ACL needed) ipv6 DHCP Leases | TESTED |
| **:white_check_mark: ApiGetDhcpIpv6leases** | (ACL needed) ipv4 DHCP Leases | TESTED |
| **:star: ApiGetDnsmasq** | List DnsMasq objects | FINAL |
| **:white_check_mark: ApiGetDnsmasqMetrics** | (ACL needed) DnsMasq Metrics | TESTED |
| **:star: ApiGetFile** | List file objects | FINAL |
| **:white_check_mark: ApiGetFileList** | List files in the Directory | TESTED |
| **:white_check_mark: ApiGetFileMd5** | File md5 sum | TESTED |
| **:white_check_mark: ApiGetFileRead** | Read a file contents. The result is encoded in Base64 if the base64 param set to “true”  | TESTED |
| **:white_check_mark: ApiGetFileStat** | File or Directory Statistics | TESTED |
| **:star: ApiGetIwinfo** | List Wireless objects | FINAL |
| **:white_check_mark: ApiGetIwinfoAssoclist** | List Wifi Stations | TESTED |
| **:white_check_mark: ApiGetIwinfoCountrylist** | Countries List | TESTED |
| **:white_check_mark: ApiGetIwinfoDevices** | (ACL needed) Wifi Interfaces List | TESTED |
| **:star: ApiGetIwinfoFreqlist** | Channels vs Frequencies List | FINAL |
| **:star: ApiGetIwinfoInfo** | Interface Information | FINAL |
| **:white_check_mark: ApiGetIwinfoPhyname** | (ACL needed) Physical name | TESTED |
| **:white_check_mark: ApiGetIwinfoSurvey** | (ACL needed) Wifi Channels Stats ??? | TESTED |
| **:white_check_mark: ApiGetIwinfoTxpowerlist** | dbm vs Transmit Power List? | TESTED |
| **:star: ApiGetLuci** | List Luci objects | FINAL |
| **:wrench: ApiGetLuciGetBlockDevices** | ? | UNDER DEV |
| **:star: ApiGetLuciGetConntrackHelpers** | Connection Track Helpers | FINAL |
| **:star: ApiGetLuciGetConntrackList** | Connection Track Helpers | FINAL |
| **:star: ApiGetLuciGetFeatures** | Features | FINAL |
| **:star: ApiGetLuciGetInitList** | Init List | FINAL |
| **:star: ApiGetLuciGetLEDs** | LEDs status | FINAL |
| **:white_check_mark: ApiGetLuciGetLocaltime** | (ACL needed) Current local time | TESTED |
| **:star: ApiGetLuciGetMountPoints** | Mount Points | FINAL |
| **:star: ApiGetLuciGetProcessList** | Processes List | FINAL |
| **:white_check_mark: ApiGetLuciGetRealtimeStats** | Realtime Statistics | TESTED |
| **:white_check_mark: ApiGetLuciGetSwconfigFeatures** | Switch Configuration | TESTED |
| **:white_check_mark: ApiGetLuciGetSwconfigPortState** | Switch Ports States | TESTED |
| **:star: ApiGetLuciGetTimezones** | Time zones list | FINAL |
| **:star: ApiGetLuciGetUSBDevices** | USB ports and devices | FINAL |
| **:star: ApiGetLuciRpc** | List luci-RPC objects | FINAL |
| **:star: ApiGetLuciRpcGetBoardJSON** | Basic Board Information | FINAL |
| **:star: ApiGetLuciRpcGetDHCPLeases** | DHCP Leases : dhcp_leases & dhcp6_leases | FINAL |
| **:star: ApiGetLuciRpcGetHostHints** | Hosts (ip,ipv6,name) - indexed by MAC address | FINAL |
| **:star: ApiGetLuciRpcGetNetworkDevices** | Network Interfaces - indexed by interfaces | FINAL |
| **:star: ApiGetLuciRpcGetWirelessDevices** | Wireless Devices - indexed by interfaces | FINAL |
| **:star: ApiGetNetwork** | List Network objects | FINAL |
| **:star: ApiGetNetworkDevice** | List Device objects | FINAL |
| **:white_check_mark: ApiGetNetworkDeviceStatus** | (ACL needed) Dump status of given network device ifname | TESTED |
| **:white_check_mark: ApiGetNetworkGetProtoHandlers** | Proto? handlers | TESTED |
| **:star: ApiGetNetworkInterface** | List Network Interface objects | FINAL |
| **:white_check_mark: ApiGetNetworkInterfaceDump** | (ACL needed) Interfaces status ??? | TESTED |
| **:star: ApiGetNetworkInterfaceLan** | List LAN Network Interface objects | FINAL |
| **:white_check_mark: ApiGetNetworkInterfaceLanDump** | (ACL needed) LAN Interfaces Status | TESTED |
| **:white_check_mark: ApiGetNetworkInterfaceLanStatus** | (ACL needed) Dump status of interface LAN | TESTED |
| **:star: ApiGetNetworkInterfaceLoopback** | List Loopback Network Interface objects | FINAL |
| **:white_check_mark: ApiGetNetworkInterfaceLoopbackDump** | (ACL needed) LoopBack Interfaces Status | TESTED |
| **:white_check_mark: ApiGetNetworkInterfaceLoopbackStatus** | (ACL needed) Dump status of interface LoopBack | TESTED |
| **:wrench: ApiGetNetworkInterfaceStatus** | (ACL needed) ???? | UNDER DEV |
| **:star: ApiGetNetworkInterfaceWan** | List WAN Network Interface objects | FINAL |
| **:star: ApiGetNetworkInterfaceWan6** | List WAN6 Network Interface objects | FINAL |
| **:wrench: ApiGetNetworkInterfaceWan6Dump** | (ACL needed) WAN6 Interfaces Status | UNDER DEV |
| **:wrench: ApiGetNetworkInterfaceWan6Status** | (ACL needed) Dump status of interface WAN6 | UNDER DEV |
| **:wrench: ApiGetNetworkInterfaceWanDump** | (ACL needed) WAN Interfaces Status | UNDER DEV |
| **:wrench: ApiGetNetworkInterfaceWanStatus** | (ACL needed) Dump status of interface WAN | UNDER DEV |
| **:star: ApiGetNetworkRrdns** | List RrDns objects | FINAL |
| **:star: ApiGetNetworkWireless** | List Wireless objects | FINAL |
| **:white_check_mark: ApiGetNetworkWirelessGetValidate** | (ACL needed) ??? | TESTED |
| **:white_check_mark: ApiGetNetworkWirelessStatus** | (ACL needed) Dump status of WLAN interfaces | TESTED |
| **:star: ApiGetService** | List Service objects | FINAL |
| **:wrench: ApiGetServiceList** | (ACL needed) | UNDER DEV |
| **:star: ApiGetSession** | List Session objects | FINAL |
| **:white_check_mark: ApiGetSessionList** | (ACL needed) List (current) session | TESTED |
| **:star: ApiGetSystem** | List System objects | FINAL |
| **:star: ApiGetSystemBoard** | Board and Firmare Information | FINAL |
| **:star: ApiGetSystemInfo** | Memory, Storage, Load and Uptime | FINAL |
| **:star: ApiGetUci** |  | FINAL |
| **:white_check_mark: ApiGetUciConfigs** | (ACL needed) List UCI configurations | TESTED |
| **:alien: ApiSetDhcpAddLease** |  | DRAFT |
| **:alien: ApiSetFileExec** |  | DRAFT |
| **:alien: ApiSetFileRemove** |  | DRAFT |
| **:alien: ApiSetFileWrite** | Write a data to a file by path. | DRAFT |
| **:star: ApiSetIwinfoScan** | Scan neighbourhood Access Points | FINAL |
| **:alien: ApiSetLuciSetBlockDetect** |  | DRAFT |
| **:alien: ApiSetLuciSetInitAction** |  | DRAFT |
| **:alien: ApiSetLuciSetLocaltime** |  | DRAFT |
| **:wrench: ApiSetLuciSetPassword** |  | UNDER DEV |
| **:alien: ApiSetNetworkAddDynamic** |  | DRAFT |
| **:alien: ApiSetNetworkAddHostRoute** |  | DRAFT |
| **:alien: ApiSetNetworkDeviceSetAlias** |  | DRAFT |
| **:alien: ApiSetNetworkDeviceSetState** | Defer or ready the given network device ifname, depending on the boolean value defer | DRAFT |
| **:alien: ApiSetNetworkDeviceStpInit** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceAddDevice** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceDown** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanAddDevice** | Add network device 'name' to interface LAN | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanDown** | Bring interface LAN down | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanNotifyProto** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanPrepare** | Prepare setup of interface LAN | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanRemove** | Remove interface LAN | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanRemoveDevice** | Remove network device 'name' from interface LAN | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanRenew** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanSetData** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceLanUp** | Bring interface LAN up | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackAddDevice** | Add network device 'name' to interface LoopBack | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackDown** | Bring interface LoopBack down | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackNotifyProto** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackPrepare** | Prepare setup of interface LoopBack | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackRemove** | Remove interface LoopBack | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackRemoveDevice** | Remove network device 'name' from interface LoopBack | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackRenew** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackSetData** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceLoopbackUp** | Bring interface LoopBack up | DRAFT |
| **:alien: ApiSetNetworkInterfaceNotifyProto** |  | DRAFT |
| **:alien: ApiSetNetworkInterfacePrepare** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceRemove** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceRemoveDevice** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceRenew** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceSetData** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceUp** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6AddDevice** | Add network device 'name' to interface WAN6 | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6Down** | Bring interface WAN6 down | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6NotifyProto** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6Prepare** | Prepare setup of interface WAN6 | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6Remove** | Remove interface WAN6 | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6RemoveDevice** | Remove network device 'name' from interface WAN6 | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6Renew** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6SetData** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceWan6Up** | Bring interface WAN6 up | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanAddDevice** | Add network device 'name' to interface WAN | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanDown** | Bring interface WAN down | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanNotifyProto** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanPrepare** | Prepare setup of interface WAN | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanRemove** | Remove interface WAN | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanRemoveDevice** | Remove network device 'name' from interface WAN | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanRenew** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanSetData** |  | DRAFT |
| **:alien: ApiSetNetworkInterfaceWanUp** | Bring interface WAN up | DRAFT |
| **:alien: ApiSetNetworkNetnsUpdown** |  | DRAFT |
| **:alien: ApiSetNetworkReload** |  | DRAFT |
| **:alien: ApiSetNetworkRestart** |  Restart the network, reconfigures all interfaces | DRAFT |
| **:alien: ApiSetNetworkRrdnsLookup** |  | DRAFT |
| **:star: ApiSetNetworkWirelessDown** | Bring Wireless interfaces down | FINAL |
| **:alien: ApiSetNetworkWirelessNotify** |  | DRAFT |
| **:alien: ApiSetNetworkWirelessReconf** |  | DRAFT |
| **:star: ApiSetNetworkWirelessUp** | Bring Wireless interfaces up | FINAL |
| **:alien: ApiSetServiceAdd** |  | DRAFT |
| **:alien: ApiSetServiceDelete** |  | DRAFT |
| **:alien: ApiSetServiceEvent** |  | DRAFT |
| **:alien: ApiSetServiceGetData** |  | DRAFT |
| **:alien: ApiSetServiceSet** |  | DRAFT |
| **:alien: ApiSetServiceSignal** |  | DRAFT |
| **:alien: ApiSetServiceState** |  | DRAFT |
| **:alien: ApiSetServiceUpdateComplete** |  | DRAFT |
| **:alien: ApiSetServiceUpdateStart** |  | DRAFT |
| **:alien: ApiSetServiceValidate** |  | DRAFT |
| **:alien: ApiSetServiceWatchdog** |  | DRAFT |
| **:alien: ApiSetSessionAccess** |  | DRAFT |
| **:alien: ApiSetSessionCreate** |  | DRAFT |
| **:alien: ApiSetSessionDestroy** |  | DRAFT |
| **:alien: ApiSetSessionGet** |  | DRAFT |
| **:alien: ApiSetSessionGrant** |  | DRAFT |
| **:alien: ApiSetSessionLogin** |  | DRAFT |
| **:alien: ApiSetSessionRevoke** |  | DRAFT |
| **:alien: ApiSetSessionSet** |  | DRAFT |
| **:alien: ApiSetSessionUnset** |  | DRAFT |
| **:star: ApiSetSystemReboot** | Reboot Device | FINAL |
| **:wrench: ApiSetSystemSignal** | (ACL needed) ? | UNDER DEV |
| **:alien: ApiSetSystemSysupgrade** |  | DRAFT |
| **:alien: ApiSetSystemValidateFirmwareImage** |  | DRAFT |
| **:alien: ApiSetSystemWatchdog** |  | DRAFT |
| **:alien: ApiSetUciAdd** |  | DRAFT |
| **:alien: ApiSetUciApply** |  | DRAFT |
| **:alien: ApiSetUciChanges** |  | DRAFT |
| **:alien: ApiSetUciCommit** |  | DRAFT |
| **:alien: ApiSetUciConfirm** |  | DRAFT |
| **:alien: ApiSetUciDelete** |  | DRAFT |
| **:alien: ApiSetUciGet** |  | DRAFT |
| **:alien: ApiSetUciOrder** |  | DRAFT |
| **:alien: ApiSetUciReloadConfig** |  | DRAFT |
| **:alien: ApiSetUciRename** |  | DRAFT |
| **:alien: ApiSetUciRevert** |  | DRAFT |
| **:alien: ApiSetUciRollback** |  | DRAFT |
| **:alien: ApiSetUciSet** |  | DRAFT |
| **:alien: ApiSetUciState** |  | DRAFT |
