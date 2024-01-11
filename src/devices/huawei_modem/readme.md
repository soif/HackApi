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

### Standardised API Methods

| Method |
| ------ |
| **:star: ApiCellStatus** |
| **:star: ApiIsLoggedIn** |
| **:star: ApiLogin** |
| **:star: ApiLogout** |
| **:star: ApiReboot** |
| **:star: ApiSmsDelete** |
| **:star: ApiSmsListReceived** |
| **:star: ApiSmsListSent** |
| **:star: ApiSmsSend** |
| **:star: ApiWanConnect** |
| **:star: ApiWanDisconnect** |
| **:star: ApiWanStatus** |
| **:star: ApiWifiListClients** |
| **:star: ApiWifiListSsids** |

### Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **:star: ApiGetAppPrivacypolicy** | Privacy Policy | FINAL |
| **:white_check_mark: ApiGetCradleBasicInfo** | WAN Network Information | TESTED |
| **:star: ApiGetCradleFactoryMac** | Hardware MAC Address | FINAL |
| **:warning: ApiGetCradleFeatureSwitch** |  | ERROR |
| **:star: ApiGetCradleMacInfo** | MAC Adresses | FINAL |
| **:white_check_mark: ApiGetCradleStatusInfo** | WAN Network Information 2 | TESTED |
| **:white_check_mark: ApiGetDdnsDdnsList** | DynDNS Information | TESTED |
| **:white_check_mark: ApiGetDdnsServerlist** | DynDNS Servers | TESTED |
| **:white_check_mark: ApiGetDdnsStatus** | DynDNS Status | TESTED |
| **:star: ApiGetDeviceAntennaType** | Antennas Types | FINAL |
| **:star: ApiGetDeviceBasicInformation** | Device (Basic) Information | FINAL |
| **:star: ApiGetDeviceConfigXml** | Device Configuration | FINAL |
| **:star: ApiGetDeviceDeviceFeatureSwitch** | Device Features | FINAL |
| **:star: ApiGetDeviceInformation** | Device (Full) Information | FINAL |
| **:star: ApiGetDeviceSignal** | Cellular Signal Information | FINAL |
| **:warning: ApiGetDeviceUsbTetheringSwitch** |  | ERROR |
| **:warning: ApiGetDeviceVendorname** |  | ERROR |
| **:star: ApiGetDeviceinformationConfigXml** | Device Information Switches | FINAL |
| **:star: ApiGetDhcpFeatureSwitch** | DHCP Features | FINAL |
| **:star: ApiGetDhcpSettings** | DHCP Settings | FINAL |
| **:white_check_mark: ApiGetDhcpStaticAddrInfo** | DHCP (Static?) Leases | TESTED |
| **:star: ApiGetDiagnosisGetWanServiceName** | WAN Service Name | FINAL |
| **:white_check_mark: ApiGetDiagnosisTimeReboot** | WatchDog ? | TESTED |
| **:star: ApiGetDialupConfigXml** | Dialup Information Switches | FINAL |
| **:star: ApiGetDialupConnection** | Dialup Connection Information | FINAL |
| **:star: ApiGetDialupConnectmodeXml** | Dialup Connect Mode | FINAL |
| **:star: ApiGetDialupDialupFeatureSwitch** | Dialup Features | FINAL |
| **:white_check_mark: ApiGetDialupMobileDataswitch** | Cellular Data Switch | TESTED |
| **:warning: ApiGetDialupMultiWanProfiles** |  | ERROR |
| **:star: ApiGetDialupProfiles** | Cellular Connection Profiles | FINAL |
| **:star: ApiGetGlobalConfigXml** | Global Configuration | FINAL |
| **:star: ApiGetGlobalLanguagelistXml** | Languages list | FINAL |
| **:white_check_mark: ApiGetGlobalModuleSwitch** | Global Modules Switches ? | TESTED |
| **:star: ApiGetGlobalNetTypeXml** | Network Types? | FINAL |
| **:star: ApiGetLanConfigXml** | LAN Configuration | FINAL |
| **:white_check_mark: ApiGetLedAppctrlled** | Leds Information ? | TESTED |
| **:star: ApiGetLogLoginfo** | Logs | FINAL |
| **:star: ApiGetMonitoringCheckNotifications** | Notifications | FINAL |
| **:star: ApiGetMonitoringConvergedStatus** | SIM states & current language | FINAL |
| **:warning: ApiGetMonitoringDailyDataLimit** |  | ERROR |
| **:star: ApiGetMonitoringMonthStatistics** | Month Statistics | FINAL |
| **:white_check_mark: ApiGetMonitoringStartDate** | Start Date ? | TESTED |
| **:star: ApiGetMonitoringStatisticFeatureSwitch** | Statistic Features | FINAL |
| **:star: ApiGetMonitoringStatus** | Gerenal (Wan,Wifi,Cellular) Information | FINAL |
| **:star: ApiGetMonitoringTrafficStatistics** | Traffic Statistics | FINAL |
| **:star: ApiGetNetCellInfo** | Cellular Cell Information | FINAL |
| **:white_check_mark: ApiGetNetCspsState** | Csps State? | TESTED |
| **:star: ApiGetNetCurrentPlmn** | Current Cellular Provider Information | FINAL |
| **:star: ApiGetNetNetFeatureSwitch** | Network Features Switches | FINAL |
| **:white_check_mark: ApiGetNetNetMode** | ? | TESTED |
| **:white_check_mark: ApiGetNetNetModeList** | Cellulars Bands ? | TESTED |
| **:white_check_mark: ApiGetNetNetwork** | ? | TESTED |
| **:white_check_mark: ApiGetNetRegister** | ? | TESTED |
| **:white_check_mark: ApiGetNetworkNetModeXml** | Network Net Modes? | TESTED |
| **:warning: ApiGetNetworkNetworkbandNullXml** |  | ERROR |
| **:white_check_mark: ApiGetNetworkNetworkmodeXml** | Net Modes? | TESTED |
| **:warning: ApiGetNtwkCelllock** |  | ERROR |
| **:warning: ApiGetNtwkDualwaninfo** |  | ERROR |
| **:white_check_mark: ApiGetNtwkLanUpnpPortmapping** | UPNP Ports? | TESTED |
| **:warning: ApiGetNtwkLanWanConfig** |  | ERROR |
| **:star: ApiGetOnlineUpdateAutoupdateConfig** | Online Auto Update Configuration | FINAL |
| **:star: ApiGetOnlineUpdateConfiguration** | Online Update Configuration | FINAL |
| **:star: ApiGetOnlineUpdateStatus** | Online Update Status | FINAL |
| **:white_check_mark: ApiGetPinSavePin** | SIM Pin Save? | TESTED |
| **:star: ApiGetPinSimlock** | SIM Pin Lock Information | FINAL |
| **:star: ApiGetPinStatus** | SIM Pin Status | FINAL |
| **:star: ApiGetPincodeConfigXml** | PIN code Configuration | FINAL |
| **:warning: ApiGetSecurityBridgemode** |  | ERROR |
| **:star: ApiGetSecurityDmz** | DMZ Information | FINAL |
| **:star: ApiGetSecurityFeatureSwitch** | Security Features Switches | FINAL |
| **:star: ApiGetSecurityFirewallSwitch** | Firewall Features Switches | FINAL |
| **:white_check_mark: ApiGetSecurityLanIpFilter** | LAN Ip Filters? | TESTED |
| **:white_check_mark: ApiGetSecurityNat** | NAT Features ? | TESTED |
| **:star: ApiGetSecuritySip** | SIP Information | FINAL |
| **:white_check_mark: ApiGetSecuritySpecialApplications** | Ports Information? | TESTED |
| **:star: ApiGetSecurityUpnp** | Upnp Status | FINAL |
| **:star: ApiGetSecurityUrlFilter** | Url Filters | FINAL |
| **:star: ApiGetSecurityVirtualServers** | Virtual Servers | FINAL |
| **:star: ApiGetSecurityWhiteLanIpFilter** | White LAN Ip Filter | FINAL |
| **:star: ApiGetSecurityWhiteUrlFilter** | White Url Filter | FINAL |
| **:star: ApiGetSmsConfig** | SMS Configuration | FINAL |
| **:star: ApiGetSmsSmsCount** | SMS Counts | FINAL |
| **:star: ApiGetSmsSmsCountContact** | SMS Contacts Count | FINAL |
| **:star: ApiGetSmsSmsFeatureSwitch** | SMS Features | FINAL |
| **:white_check_mark: ApiGetSmsSmsList** | Get SMS List | TESTED |
| **:warning: ApiGetSmsSmsListContact** |  | ERROR |
| **:white_check_mark: ApiGetSmsSplitinfoSms** | SMS Split Info? | TESTED |
| **:star: ApiGetSntpServerinfo** | SNTP Servers list | FINAL |
| **:star: ApiGetSntpSntpswitch** | SNTP switch | FINAL |
| **:star: ApiGetSntpTimeinfo** | SNTP Time Information | FINAL |
| **:warning: ApiGetStatisticFeatureRoamStatistic** |  | ERROR |
| **:white_check_mark: ApiGetSystemDeviceinfoex** | Device Information (Ex?) | TESTED |
| **:star: ApiGetSystemHostInfo** | ARP Hosts Information | FINAL |
| **:star: ApiGetSystemOnlinestate** | Device and Sytem Information | FINAL |
| **:warning: ApiGetSystemOnlineupg** |  | ERROR |
| **:star: ApiGetTimeTimeout** | Login Timeout (min) | FINAL |
| **:star: ApiGetTimeruleTimerule** | Time Rules | FINAL |
| **:star: ApiGetUserHilinkLogin** | Hilink Login | FINAL |
| **:white_check_mark: ApiGetUserPwd** | User Pwd ? | TESTED |
| **:star: ApiGetUserRule** | User Rules | FINAL |
| **:star: ApiGetUserStateLogin** | Login State | FINAL |
| **:star: ApiGetUserWebFeatureSwitch** | Web Features Switches | FINAL |
| **:star: ApiGetVpnFeatureSwitch** | VPN Features Switches | FINAL |
| **:star: ApiGetVpnL2tpSettings** | VPN L2tp Settings | FINAL |
| **:star: ApiGetVpnPptpSettings** | VPN PPTP Settings | FINAL |
| **:star: ApiGetWebserverToken** | Webserver Token | FINAL |
| **:star: ApiGetWebuicfgConfigXml** | Web UI Configuration | FINAL |
| **:star: ApiGetWlanGuesttimeSetting** | Wifi Guest Time Settings | FINAL |
| **:white_check_mark: ApiGetWlanHostList** | Wifi Hosts List | TESTED |
| **:star: ApiGetWlanMultiBasicSettings** | Wifi Settings | FINAL |
| **:star: ApiGetWlanMultiMacfilterSettingsEx** | Wifi MAC filter settings (Ex?) | FINAL |
| **:star: ApiGetWlanStatusSwitchSettings** | Wifi Switch Settings | FINAL |
| **:star: ApiGetWlanWifiFeatureSwitch** | Wifi Features Switches | FINAL |
| **:white_check_mark: ApiGetWlanWlandbho** | Wifi dbho? | TESTED |
| **:white_check_mark: ApiSetDeviceControl** | Reboot | TESTED |
| **:star: ApiSetDialupMobileDataswitch** | Cellular Connect/Disconnect | FINAL |
| **:star: ApiSetSmsDeleteSms** | Delete a SMS from the InBox | FINAL |
| **:white_check_mark: ApiSetSmsSendSms** | Send a SMS to one or multiple phone number(s) | TESTED |
