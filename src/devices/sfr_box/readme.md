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

- **7** standardized methods
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

## Standardized API Methods

| Method |
| ------ |
| **ApiLogin** |
| **ApiReboot** |
| **ApiWanStatus** |
| **ApiWifiListClients** |
| **ApiWifiListSsids** |
| **ApiWifiStart** |
| **ApiWifiStop** |

## Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **ApiGetAuthCheckToken** | Activate the Authentication Token Session (aka Login) | FINAL |
| **ApiGetAuthGetToken** | Authentication Token | FINAL |
| **ApiGetBackup3gGetPinCode** | Get Cellular PIN code | ERROR |
| **ApiGetDdnsGetInfo** | DynDNS information | FINAL |
| **ApiGetDslGetInfo** | DSL Information | FINAL |
| **ApiGetFirewallGetInfo** | Firewall Information | FINAL |
| **ApiGetFtthGetInfo** | FiberToTheHome Information  | FINAL |
| **ApiGetGuestGetClientList** | List Guests Wifi (2.4GHz) Clients | FINAL |
| **ApiGetGuestGetInfo** | Wifi (2.4GHz) Guests Information | FINAL |
| **ApiGetHotspotGetClientList** | List Hotspot Clients | UNDER DEV |
| **ApiGetHotspotGetInfo** | Hotspot Information | UNDER DEV |
| **ApiGetLanGetDnsHostList** | List DNS host entries | FINAL |
| **ApiGetLanGetHostsList** | List connected hosts | FINAL |
| **ApiGetLanGetInfo** | LAN Information | FINAL |
| **ApiGetOntGetInfo** | ONT Information | FINAL |
| **ApiGetOntPull** | Get exec status about the latest push. (See API doc for returned codes) | TESTED |
| **ApiGetP910ndGetInfo** | Information | FINAL |
| **ApiGetPppGetCredentials** | PPP Credentials | FINAL |
| **ApiGetPppGetInfo** | PPP Information | FINAL |
| **ApiGetSmbGetInfo** | SMB Sharing Information | TESTED |
| **ApiGetSystemGetIfList** | System Interface List | ERROR |
| **ApiGetSystemGetInfo** | System Information | FINAL |
| **ApiGetSystemGetWpaKey** | Default Wpa Key | FINAL |
| **ApiGetTvGetInfo** | TV Information | TESTED |
| **ApiGetUsbGetInfo** | USB Information | TESTED |
| **ApiGetVoipGetCallhistoryList** | VOIP (phone) Call History | ERROR |
| **ApiGetVoipGetInfo** | VOIP (phone) Information | TESTED |
| **ApiGetWanGetInfo** | WAN Information | FINAL |
| **ApiGetWlan5GetClientList** | Wifi (5Hz) Client List | FINAL |
| **ApiGetWlan5GetInfo** | Wifi (5GHz) Information | FINAL |
| **ApiGetWlanGetClientList** | Wifi (2.4GHz) Client List | FINAL |
| **ApiGetWlanGetInfo** | Wifi (2.4GHz) Information | FINAL |
| **ApiGetWlanGetScanList** | List of neighbour ssid found (both 2.4GHz and 5Ghz) | FINAL |
| **ApiSetBackup3gForceDataLink** | Set (backup) Cellullar Mode | DRAFT |
| **ApiSetBackup3gForceVoipLink** | Set (backup) Cellullar policy for VOIP | DRAFT |
| **ApiSetBackup3gSetPinCode** | Set Cellular PIN code | DRAFT |
| **ApiSetDdnsDisable** | Disable DynDNS service | FINAL |
| **ApiSetDdnsEnable** | Enable DynDNS service | FINAL |
| **ApiSetDdnsForceUpdate** | Force DynDNS update | UNDER DEV |
| **ApiSetDdnsSetService** | Set DynDns Account | DRAFT |
| **ApiSetGuestDisable** | Disable Guests Wifi (2.4GHz) | FINAL |
| **ApiSetGuestEnable** | Enable Guests Wifi (2.4GHz) | FINAL |
| **ApiSetGuestSetSsid** | Set Guest SSID | DRAFT |
| **ApiSetGuestSetWpakey** | Set Guest WPA Key | DRAFT |
| **ApiSetLanAddDnsHost** | Add DNS host entry | FINAL |
| **ApiSetLanDeleteDnsHost** | Delete DNS host entry | FINAL |
| **ApiSetOntPush** | Change ONT parameters | DRAFT |
| **ApiSetOntSync** | Synchronize ONT Information with Box | DRAFT |
| **ApiSetPppSetCredentials** | Set PPP Credentials | DRAFT |
| **ApiSetSystemReboot** | Reboot | FINAL |
| **ApiSetSystemSetNetMode** | Set Box Routing Mode | DRAFT |
| **ApiSetSystemSetRefClient** | Set Client Reference | DRAFT |
| **ApiSetVoipRestart** | Restart VOIP Service | DRAFT |
| **ApiSetVoipStart** | Start VOIP Service | DRAFT |
| **ApiSetVoipStop** | Stop VOIP Service | DRAFT |
| **ApiSetWlan5SetChannel** | Set Wifi (5GHz) channel | DRAFT |
| **ApiSetWlan5SetWl0Enc** | Set Wifi (5GHz) Security Type | DRAFT |
| **ApiSetWlan5SetWl0Enctype** | Set Wifi (5Hz) Encryption Type | DRAFT |
| **ApiSetWlan5SetWl0Keytype** | Set Wifi (5GHz) Key Type | DRAFT |
| **ApiSetWlan5SetWl0Ssid** | Set Wifi (5GHz) SSID | DRAFT |
| **ApiSetWlan5SetWl0Wepkey** | Set Wifi (5GHz) WEP Key | DRAFT |
| **ApiSetWlan5SetWl0Wpakey** | Set Wifi (5GHz) WPA Key | DRAFT |
| **ApiSetWlan5SetWlanMode** | Set Wifi (5GHz) Radio Mode. For NB5/NB6: (11n,11ng,11g). For NB4/CIBOX: (11b,11g,auto) | DRAFT |
| **ApiSetWlanDisable** | Disable Wifi (2.4GHz) | FINAL |
| **ApiSetWlanEnable** | Enable Wifi (2.4GHz) | FINAL |
| **ApiSetWlanSetChannel** | Set Wifi (2.4GHz) channel | DRAFT |
| **ApiSetWlanSetWl0Enc** | Set Wifi (2.4GHz) Security Type | DRAFT |
| **ApiSetWlanSetWl0Enctype** | Set Wifi (2.4GHz) Encryption Type | DRAFT |
| **ApiSetWlanSetWl0Keytype** | Set Wifi (2.4GHz) Key Type | DRAFT |
| **ApiSetWlanSetWl0Ssid** | Set Wifi (2.4GHz) SSID | DRAFT |
| **ApiSetWlanSetWl0Wepkey** | Set Wifi (2.4GHz) WEP Key | DRAFT |
| **ApiSetWlanSetWl0Wpakey** | Set Wifi (2.4GHz) WPA Key | DRAFT |
| **ApiSetWlanSetWlanMode** | Set Wifi (2.4GHz) Radio Mode. For NB5/NB6: (11n,11ng,11g). For NB4/CIBOX: (11b,11g,auto) | DRAFT |
