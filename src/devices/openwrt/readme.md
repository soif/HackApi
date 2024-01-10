# Hackapi_Openwrt v0.41

Writen in php, this API client aims to provide a nice interface with **OPENWRT**'s Routers.

(WORK IN PROGRESS)

This API client works for OpenWrt 22.x.
but it should actually work for many previous version.
It does not require any specific packages.



## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| openwrt | 22.03.2 | January 9th, 2024 | @soif | Most ApiGet methods have been tested. Most ApiSet methods still need tests |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 182 methods are currently implemented

- **4** standardized methods
- **39** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **5** methods with status of **TESTED** (Params still not ordered or desc not set)
- **5** methods with status of **UNDER DEV** (Work in propress)
- **16** methods with status of **ERROR** (Returns an error)
- **113** methods with status of **DRAFT** (Not tested)



### 64 *Getter* methods (ReadOnly)

- **37** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **5** methods with status of **TESTED** (Params still not ordered or desc not set)
- **4** methods with status of **UNDER DEV** (Work in propress)
- **15** methods with status of **ERROR** (Returns an error)
- **3** methods with status of **DRAFT** (Not tested)


### 114 *Setter* methods (Writing or performing an action)

- **2** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **1** methods with status of **UNDER DEV** (Work in propress)
- **1** methods with status of **ERROR** (Returns an error)
- **110** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

## Standardized API Methods

| Method |
| ------ |
| **ApiLogin** |
| **ApiReboot** |
| **ApiWifiListClients** |
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
| **ApiGetFileRead** | Read a file contents. The file path is encoded in Base64 if the base64 param set to “true”  | UNDER DEV |
| **ApiGetIwinfo** | List Wireless objects | FINAL |
| **ApiGetIwinfoAssoclist** | List Wifi Stations | TESTED |
| **ApiGetIwinfoCountrylist** | Countries List | TESTED |
| **ApiGetIwinfoDevices** | DENIED -32002 | ERROR |
| **ApiGetIwinfoFreqlist** | Channels vs Frequencies List | FINAL |
| **ApiGetIwinfoInfo** | Interface Information | FINAL |
| **ApiGetIwinfoPhyname** | DENIED -32002 | ERROR |
| **ApiGetIwinfoSurvey** | DENIED -32002 | ERROR |
| **ApiGetIwinfoTxpowerlist** | dbm vs Transmit Power List? | TESTED |
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
| **ApiGetLuciGetRealtimeStats** | Realtime Statistics | TESTED |
| **ApiGetLuciGetSwconfigFeatures** | Switch Config (?) | UNDER DEV |
| **ApiGetLuciGetSwconfigPortState** |  | UNDER DEV |
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
| **ApiGetNetworkDeviceStatus** | Dump status of given network device ifname | ERROR |
| **ApiGetNetworkGetProtoHandlers** | Proto? handlers | TESTED |
| **ApiGetNetworkInterface** | List Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceLan** | List LAN Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceLanStatus** | Dump status of interface LAN | ERROR |
| **ApiGetNetworkInterfaceLoopback** | List Loopback Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceLoopbackStatus** | Dump status of interface LoopBack | ERROR |
| **ApiGetNetworkInterfaceStatus** | DENIED -32002 | ERROR |
| **ApiGetNetworkInterfaceWan** | List WAN Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceWan6** | List WAN6 Network Interface objects | FINAL |
| **ApiGetNetworkInterfaceWan6Status** | Dump status of interface WAN6 | ERROR |
| **ApiGetNetworkInterfaceWanStatus** | Dump status of interface WAN | ERROR |
| **ApiGetNetworkRrdns** | List RrDns objects | FINAL |
| **ApiGetNetworkWireless** | List Wireless objects | FINAL |
| **ApiGetNetworkWirelessGetValidate** |  | DRAFT |
| **ApiGetNetworkWirelessStatus** | DENIED -32002 | ERROR |
| **ApiGetService** | List Service objects | FINAL |
| **ApiGetServiceList** |  | DRAFT |
| **ApiGetSession** | List Session objects | FINAL |
| **ApiGetSessionList** |  | DRAFT |
| **ApiGetSystem** | List System objects | FINAL |
| **ApiGetSystemBoard** | Board and Firmare Information | FINAL |
| **ApiGetSystemInfo** | Memory, Storage, Load and Uptime | FINAL |
| **ApiGetUci** |  | FINAL |
| **ApiGetUciConfigs** | DENIED -32002 | ERROR |
| **ApiSetDhcpAddLease** |  | DRAFT |
| **ApiSetFileExec** |  | DRAFT |
| **ApiSetFileList** | List files | DRAFT |
| **ApiSetFileMd5** |  | DRAFT |
| **ApiSetFileRemove** |  | DRAFT |
| **ApiSetFileStat** | Stat File | DRAFT |
| **ApiSetFileWrite** | Write a data to a file by path. The file path is encoded in Base64 if the base64 param set to “true”. If the append param is “true” then file is not overwritten but the new content is added to the end of the file. The mode param if specified represent file permission mode. | DRAFT |
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
| **ApiSetNetworkInterfaceDump** |  | DRAFT |
| **ApiSetNetworkInterfaceLanAddDevice** | Add network device 'name' to interface LAN | DRAFT |
| **ApiSetNetworkInterfaceLanDown** |  | DRAFT |
| **ApiSetNetworkInterfaceLanDump** | Bring interface LAN down | DRAFT |
| **ApiSetNetworkInterfaceLanNotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceLanPrepare** | Prepare setup of interface LAN | DRAFT |
| **ApiSetNetworkInterfaceLanRemove** | Remove interface LAN | DRAFT |
| **ApiSetNetworkInterfaceLanRemoveDevice** | Remove network device 'name' from interface LAN | DRAFT |
| **ApiSetNetworkInterfaceLanRenew** |  | DRAFT |
| **ApiSetNetworkInterfaceLanSetData** |  | DRAFT |
| **ApiSetNetworkInterfaceLanUp** | Bring interface LAN up | DRAFT |
| **ApiSetNetworkInterfaceLoopbackAddDevice** | Add network device 'name' to interface LoopBack | DRAFT |
| **ApiSetNetworkInterfaceLoopbackDown** | Bring interface LoopBack down | DRAFT |
| **ApiSetNetworkInterfaceLoopbackDump** |  | DRAFT |
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
| **ApiSetNetworkInterfaceWan6Dump** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6NotifyProto** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Prepare** | Prepare setup of interface WAN6 | DRAFT |
| **ApiSetNetworkInterfaceWan6Remove** | Remove interface WAN6 | DRAFT |
| **ApiSetNetworkInterfaceWan6RemoveDevice** | Remove network device 'name' from interface WAN6 | DRAFT |
| **ApiSetNetworkInterfaceWan6Renew** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6SetData** |  | DRAFT |
| **ApiSetNetworkInterfaceWan6Up** | Bring interface WAN6 up | DRAFT |
| **ApiSetNetworkInterfaceWanAddDevice** | Add network device 'name' to interface WAN | DRAFT |
| **ApiSetNetworkInterfaceWanDown** | Bring interface WAN down | DRAFT |
| **ApiSetNetworkInterfaceWanDump** |  | DRAFT |
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
| **ApiSetNetworkWirelessDown** |  | DRAFT |
| **ApiSetNetworkWirelessNotify** |  | DRAFT |
| **ApiSetNetworkWirelessReconf** |  | DRAFT |
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
