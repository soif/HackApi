# Hackapi_Huawei_modem v1.01

Writen in php, this API client aims to provide a nice interface with **HUAWEI**'s Modems.

This API client works for the Huawei B535-333 modem (also sold under Soyea brand).
It should also work on many other Huawei modems



## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| B535-333 | 11.0.5.51 | December 17th, 2023 | @soif | Most ApiGet methods have been tested |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 132 methods are currently implemented

- **14** standardised methods
- **74** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **31** methods with status of **TESTED** (Params still not ordered or desc not set)
- **13** methods with status of **ERROR** (Returns an error)



### 114 *Getter* methods (ReadOnly)

- **72** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **29** methods with status of **TESTED** (Params still not ordered or desc not set)
- **13** methods with status of **ERROR** (Returns an error)


### 4 *Setter* methods (Writing or performing an action)

- **2** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **2** methods with status of **TESTED** (Params still not ordered or desc not set)



## All Methods available

*The following methods are currently available:*

## standardised API Methods

| Method |
| ------ |
| **ApiCellStatus** |
| **ApiIsLoggedIn** |
| **ApiLogin** |
| **ApiLogout** |
| **ApiReboot** |
| **ApiSmsDelete** |
| **ApiSmsListReceived** |
| **ApiSmsListSent** |
| **ApiSmsSend** |
| **ApiWanConnect** |
| **ApiWanDisconnect** |
| **ApiWanStatus** |
| **ApiWifiListClients** |
| **ApiWifiListSsids** |

## Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **ApiGetAppPrivacypolicy** | Privacy Policy | FINAL |
| **ApiGetCradleBasicInfo** | WAN Network Information | TESTED |
| **ApiGetCradleFactoryMac** | Hardware MAC Address | FINAL |
| **ApiGetCradleFeatureSwitch** |  | ERROR |
| **ApiGetCradleMacInfo** | MAC Adresses | FINAL |
| **ApiGetCradleStatusInfo** | WAN Network Information 2 | TESTED |
| **ApiGetDdnsDdnsList** | DynDNS Information | TESTED |
| **ApiGetDdnsServerlist** | DynDNS Servers | TESTED |
| **ApiGetDdnsStatus** | DynDNS Status | TESTED |
| **ApiGetDeviceAntennaType** | Antennas Types | FINAL |
| **ApiGetDeviceBasicInformation** | Device (Basic) Information | FINAL |
| **ApiGetDeviceConfigXml** | Device Configuration | FINAL |
| **ApiGetDeviceDeviceFeatureSwitch** | Device Features | FINAL |
| **ApiGetDeviceInformation** | Device (Full) Information | FINAL |
| **ApiGetDeviceSignal** | Cellular Signal Information | FINAL |
| **ApiGetDeviceUsbTetheringSwitch** |  | ERROR |
| **ApiGetDeviceVendorname** |  | ERROR |
| **ApiGetDeviceinformationConfigXml** | Device Information Switches | FINAL |
| **ApiGetDhcpFeatureSwitch** | DHCP Features | FINAL |
| **ApiGetDhcpSettings** | DHCP Settings | FINAL |
| **ApiGetDhcpStaticAddrInfo** | DHCP (Static?) Leases | TESTED |
| **ApiGetDiagnosisGetWanServiceName** | WAN Service Name | FINAL |
| **ApiGetDiagnosisTimeReboot** | WatchDog ? | TESTED |
| **ApiGetDialupConfigXml** | Dialup Information Switches | FINAL |
| **ApiGetDialupConnection** | Dialup Connection Information | FINAL |
| **ApiGetDialupConnectmodeXml** | Dialup Connect Mode | FINAL |
| **ApiGetDialupDialupFeatureSwitch** | Dialup Features | FINAL |
| **ApiGetDialupMobileDataswitch** | Cellular Data Switch | TESTED |
| **ApiGetDialupMultiWanProfiles** |  | ERROR |
| **ApiGetDialupProfiles** | Cellular Connection Profiles | FINAL |
| **ApiGetGlobalConfigXml** | Global Configuration | FINAL |
| **ApiGetGlobalLanguagelistXml** | Languages list | FINAL |
| **ApiGetGlobalModuleSwitch** | Global Modules Switches ? | TESTED |
| **ApiGetGlobalNetTypeXml** | Network Types? | FINAL |
| **ApiGetLanConfigXml** | LAN Configuration | FINAL |
| **ApiGetLedAppctrlled** | Leds Information ? | TESTED |
| **ApiGetLogLoginfo** | Logs | FINAL |
| **ApiGetMonitoringCheckNotifications** | Notifications | FINAL |
| **ApiGetMonitoringConvergedStatus** | SIM states & current language | FINAL |
| **ApiGetMonitoringDailyDataLimit** |  | ERROR |
| **ApiGetMonitoringMonthStatistics** | Month Statistics | FINAL |
| **ApiGetMonitoringStartDate** | Start Date ? | TESTED |
| **ApiGetMonitoringStatisticFeatureSwitch** | Statistic Features | FINAL |
| **ApiGetMonitoringStatus** | Gerenal (Wan,Wifi,Cellular) Information | FINAL |
| **ApiGetMonitoringTrafficStatistics** | Traffic Statistics | FINAL |
| **ApiGetNetCellInfo** | Cellular Cell Information | FINAL |
| **ApiGetNetCspsState** | Csps State? | TESTED |
| **ApiGetNetCurrentPlmn** | Current Cellular Provider Information | FINAL |
| **ApiGetNetNetFeatureSwitch** | Network Features Switches | FINAL |
| **ApiGetNetNetMode** | ? | TESTED |
| **ApiGetNetNetModeList** | Cellulars Bands ? | TESTED |
| **ApiGetNetNetwork** | ? | TESTED |
| **ApiGetNetRegister** | ? | TESTED |
| **ApiGetNetworkNetModeXml** | Network Net Modes? | TESTED |
| **ApiGetNetworkNetworkbandNullXml** |  | ERROR |
| **ApiGetNetworkNetworkmodeXml** | Net Modes? | TESTED |
| **ApiGetNtwkCelllock** |  | ERROR |
| **ApiGetNtwkDualwaninfo** |  | ERROR |
| **ApiGetNtwkLanUpnpPortmapping** | UPNP Ports? | TESTED |
| **ApiGetNtwkLanWanConfig** |  | ERROR |
| **ApiGetOnlineUpdateAutoupdateConfig** | Online Auto Update Configuration | FINAL |
| **ApiGetOnlineUpdateConfiguration** | Online Update Configuration | FINAL |
| **ApiGetOnlineUpdateStatus** | Online Update Status | FINAL |
| **ApiGetPinSavePin** | SIM Pin Save? | TESTED |
| **ApiGetPinSimlock** | SIM Pin Lock Information | FINAL |
| **ApiGetPinStatus** | SIM Pin Status | FINAL |
| **ApiGetPincodeConfigXml** | PIN code Configuration | FINAL |
| **ApiGetSecurityBridgemode** |  | ERROR |
| **ApiGetSecurityDmz** | DMZ Information | FINAL |
| **ApiGetSecurityFeatureSwitch** | Security Features Switches | FINAL |
| **ApiGetSecurityFirewallSwitch** | Firewall Features Switches | FINAL |
| **ApiGetSecurityLanIpFilter** | LAN Ip Filters? | TESTED |
| **ApiGetSecurityNat** | NAT Features ? | TESTED |
| **ApiGetSecuritySip** | SIP Information | FINAL |
| **ApiGetSecuritySpecialApplications** | Ports Information? | TESTED |
| **ApiGetSecurityUpnp** | Upnp Status | FINAL |
| **ApiGetSecurityUrlFilter** | Url Filters | FINAL |
| **ApiGetSecurityVirtualServers** | Virtual Servers | FINAL |
| **ApiGetSecurityWhiteLanIpFilter** | White LAN Ip Filter | FINAL |
| **ApiGetSecurityWhiteUrlFilter** | White Url Filter | FINAL |
| **ApiGetSmsConfig** | SMS Configuration | FINAL |
| **ApiGetSmsSmsCount** | SMS Counts | FINAL |
| **ApiGetSmsSmsCountContact** | SMS Contacts Count | FINAL |
| **ApiGetSmsSmsFeatureSwitch** | SMS Features | FINAL |
| **ApiGetSmsSmsList** | Get SMS List | TESTED |
| **ApiGetSmsSmsListContact** |  | ERROR |
| **ApiGetSmsSplitinfoSms** | SMS Split Info? | TESTED |
| **ApiGetSntpServerinfo** | SNTP Servers list | FINAL |
| **ApiGetSntpSntpswitch** | SNTP switch | FINAL |
| **ApiGetSntpTimeinfo** | SNTP Time Information | FINAL |
| **ApiGetStatisticFeatureRoamStatistic** |  | ERROR |
| **ApiGetSystemDeviceinfoex** | Device Information (Ex?) | TESTED |
| **ApiGetSystemHostInfo** | ARP Hosts Information | FINAL |
| **ApiGetSystemOnlinestate** | Device and Sytem Information | FINAL |
| **ApiGetSystemOnlineupg** |  | ERROR |
| **ApiGetTimeTimeout** | Login Timeout (min) | FINAL |
| **ApiGetTimeruleTimerule** | Time Rules | FINAL |
| **ApiGetUserHilinkLogin** | Hilink Login | FINAL |
| **ApiGetUserPwd** | User Pwd ? | TESTED |
| **ApiGetUserRule** | User Rules | FINAL |
| **ApiGetUserStateLogin** | Login State | FINAL |
| **ApiGetUserWebFeatureSwitch** | Web Features Switches | FINAL |
| **ApiGetVpnFeatureSwitch** | VPN Features Switches | FINAL |
| **ApiGetVpnL2tpSettings** | VPN L2tp Settings | FINAL |
| **ApiGetVpnPptpSettings** | VPN PPTP Settings | FINAL |
| **ApiGetWebserverToken** | Webserver Token | FINAL |
| **ApiGetWebuicfgConfigXml** | Web UI Configuration | FINAL |
| **ApiGetWlanGuesttimeSetting** | Wifi Guest Time Settings | FINAL |
| **ApiGetWlanHostList** | Wifi Hosts List | TESTED |
| **ApiGetWlanMultiBasicSettings** | Wifi Settings | FINAL |
| **ApiGetWlanMultiMacfilterSettingsEx** | Wifi MAC filter settings (Ex?) | FINAL |
| **ApiGetWlanStatusSwitchSettings** | Wifi Switch Settings | FINAL |
| **ApiGetWlanWifiFeatureSwitch** | Wifi Features Switches | FINAL |
| **ApiGetWlanWlandbho** | Wifi dbho? | TESTED |
| **ApiSetDeviceControl** | Reboot | TESTED |
| **ApiSetDialupMobileDataswitch** | Cellular Connect/Disconnect | FINAL |
| **ApiSetSmsDeleteSms** | Delete a SMS from the InBox | FINAL |
| **ApiSetSmsSendSms** | Send a SMS to one or multiple phone number(s) | TESTED |
