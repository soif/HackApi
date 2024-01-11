# Hackapi_Openwrt v0.41

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

- **6** standardized methods
- **41** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **28** methods with status of **TESTED** (Params still not ordered or desc not set)
- **8** methods with status of **UNDER DEV** (Work in propress)
- **1** methods with status of **ERROR** (Returns an error)
- **100** methods with status of **DRAFT** (Not tested)



### 72 *Getter* methods (ReadOnly)

- **37** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **28** methods with status of **TESTED** (Params still not ordered or desc not set)
- **7** methods with status of **UNDER DEV** (Work in propress)


### 106 *Setter* methods (Writing or performing an action)

- **4** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **1** methods with status of **UNDER DEV** (Work in propress)
- **1** methods with status of **ERROR** (Returns an error)
- **100** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

## Standardized API Methods

| Method |
| ------ |
| **ApiLogin** |
| **ApiReboot** |
| **ApiWifiListClients** |
| **ApiWifiListSsids** |
| **ApiWifiStart** |
| **ApiWifiStop** |

## Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **ApiGetDhcp** | List DHCP objects | FINAL |
| **ApiGetDhcpIpv4leases** | (ACL needed) ipv6 DHCP Leases | TESTED |
| **ApiGetDhcpIpv6leases** | (ACL needed) ipv4 DHCP Leases | TESTED |
| **ApiGetDnsmasq** | List DnsMasq objects | FINAL |
| **ApiGetDnsmasqMetrics** | (ACL needed) DnsMasq Metrics | TESTED |
| **ApiGetFile** | List file objects | FINAL |
| **ApiGetFileList** | List files in the Directory | TESTED |
| **ApiGetFileMd5** | File md5 sum | TESTED |
| **ApiGetFileRead** | Read a file contents. The result is encoded in Base64 if the base64 param set to “true”  | TESTED |
| **ApiGetFileStat** | File or Directory Statistics | TESTED |
| **ApiGetIwinfo** | List Wireless objects | FINAL |
| **ApiGetIwinfoAssoclist** | List Wifi Stations | TESTED |
| **ApiGetIwinfoCountrylist** | Countries List | TESTED |
| **ApiGetIwinfoDevices** | (ACL needed) Wifi Interfaces List | TESTED |
| **ApiGetIwinfoFreqlist** | Channels vs Frequencies List | FINAL |
| **ApiGetIwinfoInfo** | Interface Information | FINAL |
| **ApiGetIwinfoPhyname** | (ACL needed) Physical name | TESTED |
| **ApiGetIwinfoSurvey** | (ACL needed) Wifi Channels Stats ??? | TESTED |
| **ApiGetIwinfoTxpowerlist** | dbm vs Transmit Power List? | TESTED |
| **ApiGetLuci** | List Luci objects | FINAL |
| **ApiGetLuciGetBlockDevices** | ? | UNDER DEV |
| **ApiGetLuciGetConntrackHelpers** | Connection Track Helpers | FINAL |
| **ApiGetLuciGetConntrackList** | Connection Track Helpers | FINAL |
| **ApiGetLuciGetFeatures** | Features | FINAL |
| **ApiGetLuciGetInitList** | Init List | FINAL |
| **ApiGetLuciGetLEDs** | LEDs status | FINAL |
| **ApiGetLuciGetLocaltime** | (ACL needed) Current local time | TESTED |
| **ApiGetLuciGetMountPoints** | Mount Points | FINAL |
| **ApiGetLuciGetProcessList** | Processes List | FINAL |
| **ApiGetLuciGetRealtimeStats** | Realtime Statistics | TESTED |
| **ApiGetLuciGetSwconfigFeatures** | Switch Configuration | TESTED |
| **ApiGetLuciGetSwconfigPortState** | Switch Ports States | TESTED |
| **ApiGetLuciGetTimezones** | Time zones list | FINAL |
| **ApiGetLuciGetUSBDevices** | USB ports and devices | FINAL |
| **ApiGetLuciRpc** | List luci-RPC objects | FINAL |
| **ApiGetLuciRpcGetBoardJSON** | Basic Board Information | FINAL |
| **ApiGetLuciRpcGetDHCPLeases** | DHCP Leases : dhcp_leases & dhcp6_leases | FINAL |
| **ApiGetLuciRpcGetHostHints** | Hosts (ip,ipv6,name) - indexed by MAC address | FINAL |
| **ApiGetLuciRpcGetNetworkDevices** | Network Interfaces - indexed by interfaces | FINAL |
| **ApiGetLuciRpcGetWirelessDevices** | Wireless Devices - indexed by interfaces | FINAL |
| **ApiGetNetwork** | List Network objects | FINAL |
| **ApiGetNetworkDevice** | List Device objects | FINAL |
| **ApiGetNetworkDeviceStatus** | (ACL needed) Dump status of given network device ifname | TESTED |
| **ApiGetNetworkGetProtoHandlers** | Proto? handlers | TESTED |
| **ApiGetNetworkInterface** | List Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceDump** | (ACL needed) Interfaces status ??? | TESTED |
| **ApiGetNetworkInterfaceLan** | List LAN Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceLanDump** | (ACL needed) LAN Interfaces Status | TESTED |
| **ApiGetNetworkInterfaceLanStatus** | (ACL needed) Dump status of interface LAN | TESTED |
| **ApiGetNetworkInterfaceLoopback** | List Loopback Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceLoopbackDump** | (ACL needed) LoopBack Interfaces Status | TESTED |
| **ApiGetNetworkInterfaceLoopbackStatus** | (ACL needed) Dump status of interface LoopBack | TESTED |
| **ApiGetNetworkInterfaceStatus** | (ACL needed) ???? | UNDER DEV |
| **ApiGetNetworkInterfaceWan** | List WAN Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceWan6** | List WAN6 Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceWan6Dump** | (ACL needed) WAN6 Interfaces Status | UNDER DEV |
| **ApiGetNetworkInterfaceWan6Status** | (ACL needed) Dump status of interface WAN6 | UNDER DEV |
| **ApiGetNetworkInterfaceWanDump** | (ACL needed) WAN Interfaces Status | UNDER DEV |
| **ApiGetNetworkInterfaceWanStatus** | (ACL needed) Dump status of interface WAN | UNDER DEV |
| **ApiGetNetworkRrdns** | List RrDns objects | FINAL |
| **ApiGetNetworkWireless** | List Wireless objects | FINAL |
| **ApiGetNetworkWirelessGetValidate** | (ACL needed) ??? | TESTED |
| **ApiGetNetworkWirelessStatus** | (ACL needed) Dump status of WLAN interfaces | TESTED |
| **ApiGetService** | List Service objects | FINAL |
| **ApiGetServiceList** | (ACL needed) | UNDER DEV |
| **ApiGetSession** | List Session objects | FINAL |
| **ApiGetSessionList** | (ACL needed) List (current) session | TESTED |
| **ApiGetSystem** | List System objects | FINAL |
| **ApiGetSystemBoard** | Board and Firmare Information | FINAL |
| **ApiGetSystemInfo** | Memory, Storage, Load and Uptime | FINAL |
| **ApiGetUci** |  | FINAL |
| **ApiGetUciConfigs** | (ACL needed) List UCI configurations | TESTED |
| **ApiSetDhcpAddLease** |  | DRAFT |
| **ApiSetFileExec** |  | DRAFT |
| **ApiSetFileRemove** |  | DRAFT |
| **ApiSetFileWrite** | Write a data to a file by path. | DRAFT |
| **ApiSetIwinfoScan** | Scan neighbourhood Access Points | FINAL |
| **ApiSetLuciSetBlockDetect** |  | DRAFT |
| **ApiSetLuciSetInitAction** |  | DRAFT |
| **ApiSetLuciSetLocaltime** |  | DRAFT |
| **ApiSetLuciSetPassword** |  | UNDER DEV |
| **ApiSetNetworkAddDynamic** |  | DRAFT |
| **ApiSetNetworkAddHostRoute** |  | DRAFT |
| **ApiSetNetworkDeviceSetAlias** |  | DRAFT |
| **ApiSetNetworkDeviceSetState** | Defer or ready the given network device ifname, depending on the boolean value defer | DRAFT |
| **ApiSetNetworkDeviceStpInit** |  | DRAFT |
| **ApiSetNetworkInterfaceAddDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceDown** |  | DRAFT |
| **ApiSetNetworkInterfaceLanAddDevice** | Add network device 'name' to interface LAN | DRAFT |
| **ApiSetNetworkInterfaceLanDown** | Bring interface LAN down | DRAFT |
| **ApiSetNetworkInterfaceLanNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceLanPrepare** | Prepare setup of interface LAN | DRAFT |
| **ApiSetNetworkInterfaceLanRemove** | Remove interface LAN | DRAFT |
| **ApiSetNetworkInterfaceLanRemoveDevice** | Remove network device 'name' from interface LAN | DRAFT |
| **ApiSetNetworkInterfaceLanRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceLanSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceLanUp** | Bring interface LAN up | DRAFT |
| **ApiSetNetworkInterfaceLoopbackAddDevice** | Add network device 'name' to interface LoopBack | DRAFT |
| **ApiSetNetworkInterfaceLoopbackDown** | Bring interface LoopBack down | DRAFT |
| **ApiSetNetworkInterfaceLoopbackNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackPrepare** | Prepare setup of interface LoopBack | DRAFT |
| **ApiSetNetworkInterfaceLoopbackRemove** | Remove interface LoopBack | DRAFT |
| **ApiSetNetworkInterfaceLoopbackRemoveDevice** | Remove network device 'name' from interface LoopBack | DRAFT |
| **ApiSetNetworkInterfaceLoopbackRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackUp** | Bring interface LoopBack up | DRAFT |
| **ApiSetNetworkInterfaceNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfacePrepare** |  | DRAFT |
| **ApiSetNetworkInterfaceRemove** |  | DRAFT |
| **ApiSetNetworkInterfaceRemoveDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceUp** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6AddDevice** | Add network device 'name' to interface WAN6 | DRAFT |
| **ApiSetNetworkInterfaceWan6Down** | Bring interface WAN6 down | DRAFT |
| **ApiSetNetworkInterfaceWan6NotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Prepare** | Prepare setup of interface WAN6 | DRAFT |
| **ApiSetNetworkInterfaceWan6Remove** | Remove interface WAN6 | DRAFT |
| **ApiSetNetworkInterfaceWan6RemoveDevice** | Remove network device 'name' from interface WAN6 | DRAFT |
| **ApiSetNetworkInterfaceWan6Renew** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6SetData** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Up** | Bring interface WAN6 up | DRAFT |
| **ApiSetNetworkInterfaceWanAddDevice** | Add network device 'name' to interface WAN | DRAFT |
| **ApiSetNetworkInterfaceWanDown** | Bring interface WAN down | DRAFT |
| **ApiSetNetworkInterfaceWanNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceWanPrepare** | Prepare setup of interface WAN | DRAFT |
| **ApiSetNetworkInterfaceWanRemove** | Remove interface WAN | DRAFT |
| **ApiSetNetworkInterfaceWanRemoveDevice** | Remove network device 'name' from interface WAN | DRAFT |
| **ApiSetNetworkInterfaceWanRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceWanSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceWanUp** | Bring interface WAN up | DRAFT |
| **ApiSetNetworkNetnsUpdown** |  | DRAFT |
| **ApiSetNetworkReload** |  | DRAFT |
| **ApiSetNetworkRestart** |  Restart the network, reconfigures all interfaces | DRAFT |
| **ApiSetNetworkRrdnsLookup** |  | DRAFT |
| **ApiSetNetworkWirelessDown** | Bring Wireless interfaces down | FINAL |
| **ApiSetNetworkWirelessNotify** |  | DRAFT |
| **ApiSetNetworkWirelessReconf** |  | DRAFT |
| **ApiSetNetworkWirelessUp** | Bring Wireless interfaces up | FINAL |
| **ApiSetServiceAdd** |  | DRAFT |
| **ApiSetServiceDelete** |  | DRAFT |
| **ApiSetServiceEvent** |  | DRAFT |
| **ApiSetServiceGetData** |  | DRAFT |
| **ApiSetServiceSet** |  | DRAFT |
| **ApiSetServiceSignal** |  | DRAFT |
| **ApiSetServiceState** |  | DRAFT |
| **ApiSetServiceUpdateComplete** |  | DRAFT |
| **ApiSetServiceUpdateStart** |  | DRAFT |
| **ApiSetServiceValidate** |  | DRAFT |
| **ApiSetServiceWatchdog** |  | DRAFT |
| **ApiSetSessionAccess** |  | DRAFT |
| **ApiSetSessionCreate** |  | DRAFT |
| **ApiSetSessionDestroy** |  | DRAFT |
| **ApiSetSessionGet** |  | DRAFT |
| **ApiSetSessionGrant** |  | DRAFT |
| **ApiSetSessionLogin** |  | DRAFT |
| **ApiSetSessionRevoke** |  | DRAFT |
| **ApiSetSessionSet** |  | DRAFT |
| **ApiSetSessionUnset** |  | DRAFT |
| **ApiSetSystemReboot** | Reboot Device | FINAL |
| **ApiSetSystemSignal** | DENIED -32002 | ERROR |
| **ApiSetSystemSysupgrade** |  | DRAFT |
| **ApiSetSystemValidateFirmwareImage** |  | DRAFT |
| **ApiSetSystemWatchdog** |  | DRAFT |
| **ApiSetUciAdd** |  | DRAFT |
| **ApiSetUciApply** |  | DRAFT |
| **ApiSetUciChanges** |  | DRAFT |
| **ApiSetUciCommit** |  | DRAFT |
| **ApiSetUciConfirm** |  | DRAFT |
| **ApiSetUciDelete** |  | DRAFT |
| **ApiSetUciGet** |  | DRAFT |
| **ApiSetUciOrder** |  | DRAFT |
| **ApiSetUciReloadConfig** |  | DRAFT |
| **ApiSetUciRename** |  | DRAFT |
| **ApiSetUciRevert** |  | DRAFT |
| **ApiSetUciRollback** |  | DRAFT |
| **ApiSetUciSet** |  | DRAFT |
| **ApiSetUciState** |  | DRAFT |
