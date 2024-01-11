# Hackapi_OpnSense v0.50

Writen in php, this API client aims to provide a nice interface with **OPNSENSE**'s Routers.


(WORK IN PROGRESS)

This API client exposes all OPNSense API endoints.



## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| opnsense | 23.1.5_4 | December 25th, 2023 | @soif | Work in progess |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 78 methods are currently implemented

- **1** standardised methods
- **14** methods with status of **TESTED** (Params still not ordered or desc not set)
- **4** methods with status of **UNDER DEV** (Work in propress)
- **59** methods with status of **DRAFT** (Not tested)



### 25 *Getter* methods (ReadOnly)

- **14** methods with status of **TESTED** (Params still not ordered or desc not set)
- **4** methods with status of **UNDER DEV** (Work in propress)
- **7** methods with status of **DRAFT** (Not tested)


### 52 *Setter* methods (Writing or performing an action)

- **52** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

### Standardised API Methods

| Method |
| ------ |
| **:star: ApiLogin** |

### Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **:white_check_mark: ApiGetCoreMenuSearch** |  | TESTED |
| **:alien: ApiGetIdsServiceGetAlertInfo** |  | DRAFT |
| **:alien: ApiGetIdsServiceGetAlertLogs** |  | DRAFT |
| **:white_check_mark: ApiGetIdsServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsCheckPolicyRule** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsGetPolicy** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsGetPolicyRule** |  | TESTED |
| **:alien: ApiGetIdsSettingsGetRuleInfo** |  | DRAFT |
| **:alien: ApiGetIdsSettingsGetRuleset** |  | DRAFT |
| **:white_check_mark: ApiGetIdsSettingsGetRulesetproperties** |  | TESTED |
| **:wrench: ApiGetIdsSettingsGetUserRule** |  | UNDER DEV |
| **:alien: ApiGetIdsSettingsListRuleMetadata** |  | DRAFT |
| **:white_check_mark: ApiGetIdsSettingsListRulesets** |  | TESTED |
| **:alien: ApiGetInterfacesLaggSettingsGet** |  | DRAFT |
| **:alien: ApiGetInterfacesLaggSettingsGetItem** |  | DRAFT |
| **:white_check_mark: ApiGetInterfacesLoopbackSettingsGet** |  | TESTED |
| **:wrench: ApiGetInterfacesLoopbackSettingsGetItem** |  | UNDER DEV |
| **:white_check_mark: ApiGetInterfacesVipSettingsGet** |  | TESTED |
| **:wrench: ApiGetInterfacesVipSettingsGetItem** |  | UNDER DEV |
| **:white_check_mark: ApiGetInterfacesVipSettingsGetUnusedVhid** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVlanSettingsGet** |  | TESTED |
| **:wrench: ApiGetInterfacesVlanSettingsGetItem** |  | UNDER DEV |
| **:white_check_mark: ApiGetInterfacesVxlanSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVxlanSettingsGetItem** |  | TESTED |
| **:alien: ApiSetIdsServiceDropAlertLog** |  | DRAFT |
| **:alien: ApiSetIdsServiceQueryAlerts** |  | DRAFT |
| **:alien: ApiSetIdsServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetIdsServiceReloadRules** |  | DRAFT |
| **:alien: ApiSetIdsServiceRestart** |  | DRAFT |
| **:alien: ApiSetIdsServiceStart** |  | DRAFT |
| **:alien: ApiSetIdsServiceStop** |  | DRAFT |
| **:alien: ApiSetIdsServiceUpdateRules** |  | DRAFT |
| **:alien: ApiSetIdsSettingsAddPolicy** |  | DRAFT |
| **:alien: ApiSetIdsSettingsAddPolicyRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsAddUserRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsDelPolicy** |  | DRAFT |
| **:alien: ApiSetIdsSettingsDelPolicyRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsDelUserRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSearchInstalledRules** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSet** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetPolicy** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetPolicyRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetRuleset** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetRulesetproperties** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetUserRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsTogglePolicy** |  | DRAFT |
| **:alien: ApiSetIdsSettingsTogglePolicyRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsToggleRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsToggleRuleset** |  | DRAFT |
| **:alien: ApiSetIdsSettingsToggleUserRule** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsSetItem** |  | DRAFT |
