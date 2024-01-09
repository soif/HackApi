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

- **1** standardized methods
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

## Standardized API Methods

| Method |
| ------ |
| **ApiLogin** |

## Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **ApiGetCoreMenuSearch** |  | TESTED |
| **ApiGetIdsServiceGetAlertInfo** |  | DRAFT |
| **ApiGetIdsServiceGetAlertLogs** |  | DRAFT |
| **ApiGetIdsServiceStatus** |  | TESTED |
| **ApiGetIdsSettingsCheckPolicyRule** |  | TESTED |
| **ApiGetIdsSettingsGet** |  | TESTED |
| **ApiGetIdsSettingsGetPolicy** |  | TESTED |
| **ApiGetIdsSettingsGetPolicyRule** |  | TESTED |
| **ApiGetIdsSettingsGetRuleInfo** |  | DRAFT |
| **ApiGetIdsSettingsGetRuleset** |  | DRAFT |
| **ApiGetIdsSettingsGetRulesetproperties** |  | TESTED |
| **ApiGetIdsSettingsGetUserRule** |  | UNDER DEV |
| **ApiGetIdsSettingsListRuleMetadata** |  | DRAFT |
| **ApiGetIdsSettingsListRulesets** |  | TESTED |
| **ApiGetInterfacesLaggSettingsGet** |  | DRAFT |
| **ApiGetInterfacesLaggSettingsGetItem** |  | DRAFT |
| **ApiGetInterfacesLoopbackSettingsGet** |  | TESTED |
| **ApiGetInterfacesLoopbackSettingsGetItem** |  | UNDER DEV |
| **ApiGetInterfacesVipSettingsGet** |  | TESTED |
| **ApiGetInterfacesVipSettingsGetItem** |  | UNDER DEV |
| **ApiGetInterfacesVipSettingsGetUnusedVhid** |  | TESTED |
| **ApiGetInterfacesVlanSettingsGet** |  | TESTED |
| **ApiGetInterfacesVlanSettingsGetItem** |  | UNDER DEV |
| **ApiGetInterfacesVxlanSettingsGet** |  | TESTED |
| **ApiGetInterfacesVxlanSettingsGetItem** |  | TESTED |
| **ApiSetIdsServiceDropAlertLog** |  | DRAFT |
| **ApiSetIdsServiceQueryAlerts** |  | DRAFT |
| **ApiSetIdsServiceReconfigure** |  | DRAFT |
| **ApiSetIdsServiceReloadRules** |  | DRAFT |
| **ApiSetIdsServiceRestart** |  | DRAFT |
| **ApiSetIdsServiceStart** |  | DRAFT |
| **ApiSetIdsServiceStop** |  | DRAFT |
| **ApiSetIdsServiceUpdateRules** |  | DRAFT |
| **ApiSetIdsSettingsAddPolicy** |  | DRAFT |
| **ApiSetIdsSettingsAddPolicyRule** |  | DRAFT |
| **ApiSetIdsSettingsAddUserRule** |  | DRAFT |
| **ApiSetIdsSettingsDelPolicy** |  | DRAFT |
| **ApiSetIdsSettingsDelPolicyRule** |  | DRAFT |
| **ApiSetIdsSettingsDelUserRule** |  | DRAFT |
| **ApiSetIdsSettingsSearchInstalledRules** |  | DRAFT |
| **ApiSetIdsSettingsSet** |  | DRAFT |
| **ApiSetIdsSettingsSetPolicy** |  | DRAFT |
| **ApiSetIdsSettingsSetPolicyRule** |  | DRAFT |
| **ApiSetIdsSettingsSetRule** |  | DRAFT |
| **ApiSetIdsSettingsSetRuleset** |  | DRAFT |
| **ApiSetIdsSettingsSetRulesetproperties** |  | DRAFT |
| **ApiSetIdsSettingsSetUserRule** |  | DRAFT |
| **ApiSetIdsSettingsTogglePolicy** |  | DRAFT |
| **ApiSetIdsSettingsTogglePolicyRule** |  | DRAFT |
| **ApiSetIdsSettingsToggleRule** |  | DRAFT |
| **ApiSetIdsSettingsToggleRuleset** |  | DRAFT |
| **ApiSetIdsSettingsToggleUserRule** |  | DRAFT |
| **ApiSetInterfacesLaggSettingsAddItem** |  | DRAFT |
| **ApiSetInterfacesLaggSettingsDelItem** |  | DRAFT |
| **ApiSetInterfacesLaggSettingsReconfigure** |  | DRAFT |
| **ApiSetInterfacesLaggSettingsSet** |  | DRAFT |
| **ApiSetInterfacesLaggSettingsSetItem** |  | DRAFT |
| **ApiSetInterfacesLoopbackSettingsAddItem** |  | DRAFT |
| **ApiSetInterfacesLoopbackSettingsDelItem** |  | DRAFT |
| **ApiSetInterfacesLoopbackSettingsReconfigure** |  | DRAFT |
| **ApiSetInterfacesLoopbackSettingsSet** |  | DRAFT |
| **ApiSetInterfacesLoopbackSettingsSetItem** |  | DRAFT |
| **ApiSetInterfacesVipSettingsAddItem** |  | DRAFT |
| **ApiSetInterfacesVipSettingsDelItem** |  | DRAFT |
| **ApiSetInterfacesVipSettingsReconfigure** |  | DRAFT |
| **ApiSetInterfacesVipSettingsSet** |  | DRAFT |
| **ApiSetInterfacesVipSettingsSetItem** |  | DRAFT |
| **ApiSetInterfacesVlanSettingsAddItem** |  | DRAFT |
| **ApiSetInterfacesVlanSettingsDelItem** |  | DRAFT |
| **ApiSetInterfacesVlanSettingsReconfigure** |  | DRAFT |
| **ApiSetInterfacesVlanSettingsSet** |  | DRAFT |
| **ApiSetInterfacesVlanSettingsSetItem** |  | DRAFT |
| **ApiSetInterfacesVxlanSettingsAddItem** |  | DRAFT |
| **ApiSetInterfacesVxlanSettingsDelItem** |  | DRAFT |
| **ApiSetInterfacesVxlanSettingsReconfigure** |  | DRAFT |
| **ApiSetInterfacesVxlanSettingsSet** |  | DRAFT |
| **ApiSetInterfacesVxlanSettingsSetItem** |  | DRAFT |
