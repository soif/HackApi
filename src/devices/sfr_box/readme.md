# Hackapi_Sfr_box v0.70

Writen in php, this API client aims to provide a nice interface with **SFR**'s Boxes.


(WORK IN PROGRESS)

This API client works for SFR (or Red-by-SFR) boxes. *SFR is a popular french Internet Service Provider.*
It should work on all Boxes < v8



## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| NB6VAC | NB6VAC-MAIN-R4.0.45d | December 20th, 2023 | @soif | Most methods have been tested |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 80 methods are currently implemented

- **7** standardised methods
- **32** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **5** methods with status of **TESTED** (Params still not ordered or desc not set)
- **3** methods with status of **UNDER DEV** (Work in propress)
- **3** methods with status of **ERROR** (Returns an error)
- **30** methods with status of **DRAFT** (Not tested)



### 33 *Getter* methods (ReadOnly)

- **23** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **5** methods with status of **TESTED** (Params still not ordered or desc not set)
- **2** methods with status of **UNDER DEV** (Work in propress)
- **3** methods with status of **ERROR** (Returns an error)


### 40 *Setter* methods (Writing or performing an action)

- **9** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **1** methods with status of **UNDER DEV** (Work in propress)
- **30** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

### Standardised API Methods

| Method |
| ------ |
| **:star: ApiLogin** |
| **:star: ApiReboot** |
| **:star: ApiWanStatus** |
| **:star: ApiWifiListClients** |
| **:star: ApiWifiListSsids** |
| **:star: ApiWifiStart** |
| **:star: ApiWifiStop** |

### Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **:star: ApiGetAuthCheckToken** | Activate the Authentication Token Session (aka Login) | FINAL |
| **:star: ApiGetAuthGetToken** | Authentication Token | FINAL |
| **:warning: ApiGetBackup3gGetPinCode** | Get Cellular PIN code | ERROR |
| **:star: ApiGetDdnsGetInfo** | DynDNS information | FINAL |
| **:star: ApiGetDslGetInfo** | DSL Information | FINAL |
| **:star: ApiGetFirewallGetInfo** | Firewall Information | FINAL |
| **:star: ApiGetFtthGetInfo** | FiberToTheHome Information  | FINAL |
| **:star: ApiGetGuestGetClientList** | List Guests Wifi (2.4GHz) Clients | FINAL |
| **:star: ApiGetGuestGetInfo** | Wifi (2.4GHz) Guests Information | FINAL |
| **:wrench: ApiGetHotspotGetClientList** | List Hotspot Clients | UNDER DEV |
| **:wrench: ApiGetHotspotGetInfo** | Hotspot Information | UNDER DEV |
| **:star: ApiGetLanGetDnsHostList** | List DNS host entries | FINAL |
| **:star: ApiGetLanGetHostsList** | List connected hosts | FINAL |
| **:star: ApiGetLanGetInfo** | LAN Information | FINAL |
| **:star: ApiGetOntGetInfo** | ONT Information | FINAL |
| **:white_check_mark: ApiGetOntPull** | Get exec status about the latest push. (See API doc for returned codes) | TESTED |
| **:star: ApiGetP910ndGetInfo** | Information | FINAL |
| **:star: ApiGetPppGetCredentials** | PPP Credentials | FINAL |
| **:star: ApiGetPppGetInfo** | PPP Information | FINAL |
| **:white_check_mark: ApiGetSmbGetInfo** | SMB Sharing Information | TESTED |
| **:warning: ApiGetSystemGetIfList** | System Interface List | ERROR |
| **:star: ApiGetSystemGetInfo** | System Information | FINAL |
| **:star: ApiGetSystemGetWpaKey** | Default Wpa Key | FINAL |
| **:white_check_mark: ApiGetTvGetInfo** | TV Information | TESTED |
| **:white_check_mark: ApiGetUsbGetInfo** | USB Information | TESTED |
| **:warning: ApiGetVoipGetCallhistoryList** | VOIP (phone) Call History | ERROR |
| **:white_check_mark: ApiGetVoipGetInfo** | VOIP (phone) Information | TESTED |
| **:star: ApiGetWanGetInfo** | WAN Information | FINAL |
| **:star: ApiGetWlan5GetClientList** | Wifi (5Hz) Client List | FINAL |
| **:star: ApiGetWlan5GetInfo** | Wifi (5GHz) Information | FINAL |
| **:star: ApiGetWlanGetClientList** | Wifi (2.4GHz) Client List | FINAL |
| **:star: ApiGetWlanGetInfo** | Wifi (2.4GHz) Information | FINAL |
| **:star: ApiGetWlanGetScanList** | List of neighbour ssid found (both 2.4GHz and 5Ghz) | FINAL |
| **:alien: ApiSetBackup3gForceDataLink** | Set (backup) Cellullar Mode | DRAFT |
| **:alien: ApiSetBackup3gForceVoipLink** | Set (backup) Cellullar policy for VOIP | DRAFT |
| **:alien: ApiSetBackup3gSetPinCode** | Set Cellular PIN code | DRAFT |
| **:star: ApiSetDdnsDisable** | Disable DynDNS service | FINAL |
| **:star: ApiSetDdnsEnable** | Enable DynDNS service | FINAL |
| **:wrench: ApiSetDdnsForceUpdate** | Force DynDNS update | UNDER DEV |
| **:alien: ApiSetDdnsSetService** | Set DynDns Account | DRAFT |
| **:star: ApiSetGuestDisable** | Disable Guests Wifi (2.4GHz) | FINAL |
| **:star: ApiSetGuestEnable** | Enable Guests Wifi (2.4GHz) | FINAL |
| **:alien: ApiSetGuestSetSsid** | Set Guest SSID | DRAFT |
| **:alien: ApiSetGuestSetWpakey** | Set Guest WPA Key | DRAFT |
| **:star: ApiSetLanAddDnsHost** | Add DNS host entry | FINAL |
| **:star: ApiSetLanDeleteDnsHost** | Delete DNS host entry | FINAL |
| **:alien: ApiSetOntPush** | Change ONT parameters | DRAFT |
| **:alien: ApiSetOntSync** | Synchronize ONT Information with Box | DRAFT |
| **:alien: ApiSetPppSetCredentials** | Set PPP Credentials | DRAFT |
| **:star: ApiSetSystemReboot** | Reboot | FINAL |
| **:alien: ApiSetSystemSetNetMode** | Set Box Routing Mode | DRAFT |
| **:alien: ApiSetSystemSetRefClient** | Set Client Reference | DRAFT |
| **:alien: ApiSetVoipRestart** | Restart VOIP Service | DRAFT |
| **:alien: ApiSetVoipStart** | Start VOIP Service | DRAFT |
| **:alien: ApiSetVoipStop** | Stop VOIP Service | DRAFT |
| **:alien: ApiSetWlan5SetChannel** | Set Wifi (5GHz) channel | DRAFT |
| **:alien: ApiSetWlan5SetWl0Enc** | Set Wifi (5GHz) Security Type | DRAFT |
| **:alien: ApiSetWlan5SetWl0Enctype** | Set Wifi (5Hz) Encryption Type | DRAFT |
| **:alien: ApiSetWlan5SetWl0Keytype** | Set Wifi (5GHz) Key Type | DRAFT |
| **:alien: ApiSetWlan5SetWl0Ssid** | Set Wifi (5GHz) SSID | DRAFT |
| **:alien: ApiSetWlan5SetWl0Wepkey** | Set Wifi (5GHz) WEP Key | DRAFT |
| **:alien: ApiSetWlan5SetWl0Wpakey** | Set Wifi (5GHz) WPA Key | DRAFT |
| **:alien: ApiSetWlan5SetWlanMode** | Set Wifi (5GHz) Radio Mode. For NB5/NB6: (11n,11ng,11g). For NB4/CIBOX: (11b,11g,auto) | DRAFT |
| **:star: ApiSetWlanDisable** | Disable Wifi (2.4GHz) | FINAL |
| **:star: ApiSetWlanEnable** | Enable Wifi (2.4GHz) | FINAL |
| **:alien: ApiSetWlanSetChannel** | Set Wifi (2.4GHz) channel | DRAFT |
| **:alien: ApiSetWlanSetWl0Enc** | Set Wifi (2.4GHz) Security Type | DRAFT |
| **:alien: ApiSetWlanSetWl0Enctype** | Set Wifi (2.4GHz) Encryption Type | DRAFT |
| **:alien: ApiSetWlanSetWl0Keytype** | Set Wifi (2.4GHz) Key Type | DRAFT |
| **:alien: ApiSetWlanSetWl0Ssid** | Set Wifi (2.4GHz) SSID | DRAFT |
| **:alien: ApiSetWlanSetWl0Wepkey** | Set Wifi (2.4GHz) WEP Key | DRAFT |
| **:alien: ApiSetWlanSetWl0Wpakey** | Set Wifi (2.4GHz) WPA Key | DRAFT |
| **:alien: ApiSetWlanSetWlanMode** | Set Wifi (2.4GHz) Radio Mode. For NB5/NB6: (11n,11ng,11g). For NB4/CIBOX: (11b,11g,auto) | DRAFT |
