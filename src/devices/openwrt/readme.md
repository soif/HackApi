# Hackapi_Openwrt

Writen in php, this API client aims to provide a nice interface with **OPENWRT**'s Routers.

This API client works for OpenWrt 22.x.
but it should actually work for many previous version.
It does not require any specific packages.



## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| openwrt | 22.03.2 |December 22nd, 2023 |@soif | Most ApiGet methods have been tested |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 182 methods are currently implemented

- **3** standardized methods
- **35** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **2** methods with status of **TESTED** (Params still not ordered or desc not set)
- **7** methods with status of **UNDER DEV** (Work in propress)
- **19** methods with status of **ERROR** (Returns an error)
- **116** methods with status of **DRAFT** (Not tested)



### 65 *Getter* methods (ReadOnly)

- **35** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **2** methods with status of **TESTED** (Params still not ordered or desc not set)
- **6** methods with status of **UNDER DEV** (Work in propress)
- **17** methods with status of **ERROR** (Returns an error)
- **5** methods with status of **DRAFT** (Not tested)


### 114 *Setter* methods (Writing or performing an action)

- **1** methods with status of **UNDER DEV** (Work in propress)
- **2** methods with status of **ERROR** (Returns an error)
- **111** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

## Standardized API Methods

| Method |
| ------ |
| **ApiLogin** |
| **ApiTest** |
| **ApiWifiListSsids** |

## Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **ApiGetDhcp** | List DHCP objects | FINAL |
| **ApiGetDhcpIpv4leases** | DENIED -32002 | ERROR |
| **ApiGetDhcpIpv6leases** | DENIED -32002 | ERROR |
| **ApiGetDnsmasq** | List DnsMasq objects | FINAL |
| **ApiGetDnsmasqMetrics** | DENIED -32002 | ERROR |
| **ApiGetFile** | List file objects | FINAL |
| **ApiGetFileRead** | UBUS_STATUS_PERMISSION_DENIED | UNDER DEV |
| **ApiGetIwinfo** | List Wireless objects | FINAL |
| **ApiGetIwinfoAssoclist** | UBUS_STATUS_INVALID_ARGUMENT | TESTED |
| **ApiGetIwinfoCountrylist** | UBUS_STATUS_INVALID_ARGUMENT | ERROR |
| **ApiGetIwinfoDevices** | DENIED -32002 | ERROR |
| **ApiGetIwinfoFreqlist** | UBUS_STATUS_INVALID_ARGUMENT | ERROR |
| **ApiGetIwinfoInfo** | UBUS_STATUS_INVALID_ARGUMENT | ERROR |
| **ApiGetIwinfoPhyname** | DENIED -32002 | ERROR |
| **ApiGetIwinfoSurvey** | DENIED -32002 | ERROR |
| **ApiGetIwinfoTxpowerlist** | UBUS_STATUS_INVALID_ARGUMENT | ERROR |
| **ApiGetLuci** | List Luci objects | FINAL |
| **ApiGetLuciGetBlockDevices** | ? | UNDER DEV |
| **ApiGetLuciGetConntrackHelpers** | Connection Track Helpers | FINAL |
| **ApiGetLuciGetConntrackList** | Connection Track Helpers | FINAL |
| **ApiGetLuciGetFeatures** | Features | FINAL |
| **ApiGetLuciGetInitList** | Init List | FINAL |
| **ApiGetLuciGetLEDs** | LEDs status | FINAL |
| **ApiGetLuciGetLocaltime** | DENIED -32002 | ERROR |
| **ApiGetLuciGetMountPoints** | Mount Points | FINAL |
| **ApiGetLuciGetProcessList** | Processes List | FINAL |
| **ApiGetLuciGetRealtimeStats** |  | UNDER DEV |
| **ApiGetLuciGetSwconfigFeatures** | Switch Config (?) | UNDER DEV |
| **ApiGetLuciGetSwconfigPortState** |  | UNDER DEV |
| **ApiGetLuciGetTimezones** | Time zones list | FINAL |
| **ApiGetLuciGetUSBDevices** | USB ports and devices | FINAL |
| **ApiGetLuciRpc** | List luci-RPC objects | FINAL |
| **ApiGetLuciRpcGetBoardJSON** | Basic Board Information | FINAL |
| **ApiGetLuciRpcGetDHCPLeases** | DHCP Leases : dhcp_leases & dhcp6_leases | FINAL |
| **ApiGetLuciRpcGetDUIDHints** | ??? | UNDER DEV |
| **ApiGetLuciRpcGetHostHints** | Connected Clients (ip,ipv6,name) indexed by MAC address | FINAL |
| **ApiGetLuciRpcGetNetworkDevices** | Network Interfaces - indexed by interfaces | FINAL |
| **ApiGetLuciRpcGetWirelessDevices** | Wireless Devices - indexed by interfaces | FINAL |
| **ApiGetNetwork** | List Network objects | FINAL |
| **ApiGetNetworkDevice** | List Device objects | FINAL |
| **ApiGetNetworkDeviceStatus** | DENIED -32002 | ERROR |
| **ApiGetNetworkGetProtoHandlers** | Proto? handlers | TESTED |
| **ApiGetNetworkInterface** | List Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceLan** | List LAN Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceLanStatus** | DENIED -32002 | ERROR |
| **ApiGetNetworkInterfaceLoopback** | List Loopback Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceLoopbackStatus** | DENIED -32002 | ERROR |
| **ApiGetNetworkInterfaceStatus** | DENIED -32002 | ERROR |
| **ApiGetNetworkInterfaceWan** | List WAN Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceWan6** | List WAN6 Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceWan6Status** | DENIED -32002 | ERROR |
| **ApiGetNetworkInterfaceWanStatus** | DENIED -32002 | ERROR |
| **ApiGetNetworkRrdns** | List RrDns objects | FINAL |
| **ApiGetNetworkWireless** | List Wireless objects | FINAL |
| **ApiGetNetworkWirelessGetValidate** |  | DRAFT |
| **ApiGetService** | List Service objects | FINAL |
| **ApiGetServiceList** |  | DRAFT |
| **ApiGetSession** | List Session objects | FINAL |
| **ApiGetSessionList** |  | DRAFT |
| **ApiGetSystem** | List System objects | FINAL |
| **ApiGetSystemBoard** | Board and Firmare Information | FINAL |
| **ApiGetSystemInfo** | Memory, Storage, Load and Uptime | FINAL |
| **ApiGetUci** |  | FINAL |
| **ApiGetUciConfigs** |  | DRAFT |
| **ApiGetUciReloadConfig** |  | DRAFT |
| **ApiSetDhcpAddLease** |  | DRAFT |
| **ApiSetFileExec** |  | DRAFT |
| **ApiSetFileList** | List files | DRAFT |
| **ApiSetFileMd5** |  | DRAFT |
| **ApiSetFileRemove** |  | DRAFT |
| **ApiSetFileStat** | Stat File | DRAFT |
| **ApiSetFileWrite** |  | DRAFT |
| **ApiSetIwinfoScan** | UBUS_STATUS_INVALID_ARGUMENT | ERROR |
| **ApiSetLuciSetBlockDetect** |  | DRAFT |
| **ApiSetLuciSetInitAction** |  | DRAFT |
| **ApiSetLuciSetLocaltime** |  | DRAFT |
| **ApiSetLuciSetPassword** |  | UNDER DEV |
| **ApiSetNetworkAddDynamic** |  | DRAFT |
| **ApiSetNetworkAddHostRoute** |  | DRAFT |
| **ApiSetNetworkDeviceSetAlias** |  | DRAFT |
| **ApiSetNetworkDeviceSetState** |  | DRAFT |
| **ApiSetNetworkDeviceStpInit** |  | DRAFT |
| **ApiSetNetworkInterfaceAddDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceDown** |  | DRAFT |
| **ApiSetNetworkInterfaceDump** |  | DRAFT |
| **ApiSetNetworkInterfaceLanAddDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceLanDown** |  | DRAFT |
| **ApiSetNetworkInterfaceLanDump** |  | DRAFT |
| **ApiSetNetworkInterfaceLanNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceLanPrepare** |  | DRAFT |
| **ApiSetNetworkInterfaceLanRemove** |  | DRAFT |
| **ApiSetNetworkInterfaceLanRemoveDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceLanRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceLanSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceLanUp** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackAddDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackDown** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackDump** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackPrepare** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackRemove** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackRemoveDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceLoopbackUp** |  | DRAFT |
| **ApiSetNetworkInterfaceNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfacePrepare** |  | DRAFT |
| **ApiSetNetworkInterfaceRemove** |  | DRAFT |
| **ApiSetNetworkInterfaceRemoveDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceUp** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6AddDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Down** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Dump** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6NotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Prepare** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Remove** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6RemoveDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Renew** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6SetData** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Up** |  | DRAFT |
| **ApiSetNetworkInterfaceWanAddDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceWanDown** |  | DRAFT |
| **ApiSetNetworkInterfaceWanDump** |  | DRAFT |
| **ApiSetNetworkInterfaceWanNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceWanPrepare** |  | DRAFT |
| **ApiSetNetworkInterfaceWanRemove** |  | DRAFT |
| **ApiSetNetworkInterfaceWanRemoveDevice** |  | DRAFT |
| **ApiSetNetworkInterfaceWanRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceWanSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceWanUp** |  | DRAFT |
| **ApiSetNetworkNetnsUpdown** |  | DRAFT |
| **ApiSetNetworkReload** |  | DRAFT |
| **ApiSetNetworkRestart** |  | DRAFT |
| **ApiSetNetworkRrdnsLookup** |  | DRAFT |
| **ApiSetNetworkWirelessDown** |  | DRAFT |
| **ApiSetNetworkWirelessNotify** |  | DRAFT |
| **ApiSetNetworkWirelessReconf** |  | DRAFT |
| **ApiSetNetworkWirelessStatus** | DENIED -32002 | ERROR |
| **ApiSetNetworkWirelessUp** |  | DRAFT |
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
| **ApiSetSystemReboot** |  | DRAFT |
| **ApiSetSystemSignal** | DENIED -32002 | DRAFT |
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
| **ApiSetUciRename** |  | DRAFT |
| **ApiSetUciRevert** |  | DRAFT |
| **ApiSetUciRollback** |  | DRAFT |
| **ApiSetUciSet** |  | DRAFT |
| **ApiSetUciState** |  | DRAFT |
