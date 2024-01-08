# Hackapi_Zte_modem

Writen in php, this API client aims to provide a nice interface with **ZTE**'s Modems.

This API client has been tested on the ZTE mf920u modem.
It should also work on many other ZTE modems..




## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| mf920u | BD_MF920UV1.0.1B05 | December 19th, 2023 | @soif | Most current methods have been tested |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 25 methods are currently implemented

- **14** standardized methods
- **6** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **2** methods with status of **TESTED** (Params still not ordered or desc not set)
- **3** methods with status of **DRAFT** (Not tested)



### 3 *Getter* methods (ReadOnly)

- **1** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **1** methods with status of **TESTED** (Params still not ordered or desc not set)
- **1** methods with status of **DRAFT** (Not tested)


### 8 *Setter* methods (Writing or performing an action)

- **5** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **1** methods with status of **TESTED** (Params still not ordered or desc not set)
- **2** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

## Standardized API Methods

| Method |
| ------ |
| **ApiCellStatus** |
| **ApiLogin** |
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
| **ApiWifiStart** |
| **ApiWifiStop** |

## Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **ApiGetHostNameList** | List Host names | DRAFT |
| **ApiGetSmsDataTotal** | SMS List | TESTED |
| **ApiGetStationList** | List Wifi Clients | FINAL |
| **ApiSetChangeMode** | Enable Factory Backdoor? | DRAFT |
| **ApiSetConnectNetwork** | WAN Connect | FINAL |
| **ApiSetDeleteSms** | Delete SMS | FINAL |
| **ApiSetDisconnectNetwork** | WAN Disconnect | FINAL |
| **ApiSetRebootDevice** | Reboot | FINAL |
| **ApiSetSendSms** | Send SMS | TESTED |
| **ApiSetSetWifiInfo** | Wifi Switches | FINAL |
| **ApiSetUrlFilterAdd** | Exploits Nvram (url encoded as "http%3A%2F%2F_L33T_H4X0R_%2F%26%26telnetd%26%26"?)  | DRAFT |
