# Hackapi_Sfr_box

Writen in php, this API client aims to provide a nice interface with **SFR**'s Boxes.

This API client works for SFR boxes.
It should work on all Boxes < v8



## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| NB6VAC | NB6VAC-MAIN-R4.0.45d |December 13th, 2023 |@soif | Most ApiGet methods have been tested |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 41 methods are currently implemented

- **1** standardized methods
- **12** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **14** methods with status of **TESTED** (Params still not ordered or desc not set)
- **8** methods with status of **UNDER DEV** (Work in propress)
- **2** methods with status of **ERROR** (Returns an error)
- **4** methods with status of **DRAFT** (Not tested)



### 26 *Getter* methods (ReadOnly)

- **8** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **14** methods with status of **TESTED** (Params still not ordered or desc not set)
- **2** methods with status of **UNDER DEV** (Work in propress)
- **2** methods with status of **ERROR** (Returns an error)


### 14 *Setter* methods (Writing or performing an action)

- **4** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **6** methods with status of **UNDER DEV** (Work in propress)
- **4** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

## Standardized API Methods

| Method |
| ------ |
| **ApiLogin** |

## Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **ApiGetAuthCheckToken** | Activate the Authentication Token Session (aka Login) | UNDER DEV |
| **ApiGetAuthGetToken** | Authentication Token | FINAL |
| **ApiGetBackup3gGetPinCode** | Get Cellular PIN code | ERROR |
| **ApiGetDdnsGetInfo** | DynDNS information | FINAL |
| **ApiGetDslGetInfo** | DSL Information | FINAL |
| **ApiGetFirewallGetInfo** | Firewall Information | FINAL |
| **ApiGetFtthGetInfo** | FiberToTheHome Information  | FINAL |
| **ApiGetHotspotGetClientList** | List Wifi Clients | UNDER DEV |
| **ApiGetHotspotGetInfo** | Wifi Information | TESTED |
| **ApiGetLanGetDnsHostList** | List DNS host entries | FINAL |
| **ApiGetLanGetHostsList** | List connected hosts | FINAL |
| **ApiGetLanGetInfo** | LAN Information | FINAL |
| **ApiGetOntGetInfo** | ONT Information | TESTED |
| **ApiGetP910ndGetInfo** |  Information | TESTED |
| **ApiGetPppGetInfo** | PPP Information | TESTED |
| **ApiGetSmbGetInfo** | SMB Sharing Information | TESTED |
| **ApiGetTvGetInfo** | TV Information | TESTED |
| **ApiGetUsbGetInfo** | USB Information | TESTED |
| **ApiGetVoipGetCallhistoryList** | VOIP (phone) Call History | ERROR |
| **ApiGetVoipGetInfo** | VOIP (phone) Information | TESTED |
| **ApiGetWanGetInfo** | WAN Information | TESTED |
| **ApiGetWlan5GetClientList** | Wifi (5GHz) Client List | TESTED |
| **ApiGetWlan5GetInfo** | Wifi (5GHz) Information | TESTED |
| **ApiGetWlanGetClientList** | Wifi (2.4GHz) Client List | TESTED |
| **ApiGetWlanGetInfo** | Wifi (2.4GHz) Information | TESTED |
| **ApiGetWlanGetScanList** | Wifi (2.4GHz) Scan List | TESTED |
| **ApiSetBackup3gForceDataLink** | Set (backup) Cellullar Mode | DRAFT |
| **ApiSetBackup3gForceVoipLink** | Set (backup) Cellullar policy for VOIP | DRAFT |
| **ApiSetBackup3gSetPinCode** | Set Cellular PIN code | DRAFT |
| **ApiSetDdnsDisable** | Disable DynDNS service | FINAL |
| **ApiSetDdnsEnable** | Enable DynDNS service | FINAL |
| **ApiSetDdnsForceUpdate** | Force DynDNS update | UNDER DEV |
| **ApiSetDdnsSetService** | Set DynDns Account | DRAFT |
| **ApiSetHotspotDisable** | Disable Wifi | UNDER DEV |
| **ApiSetHotspotEnable** | Enable Wifi | UNDER DEV |
| **ApiSetHotspotRestart** | Restart Wifi | UNDER DEV |
| **ApiSetHotspotStart** | Start Wifi | UNDER DEV |
| **ApiSetHotspotStop** | Stop Wifi | UNDER DEV |
| **ApiSetLanAddDnsHost** | Add DNS host entry | FINAL |
| **ApiSetLanDeleteDnsHost** | Delete DNS host entry | FINAL |
