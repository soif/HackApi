# Hackapi_OpnSense v0.90

Writen in php, this API client aims to provide a nice interface with **OPNSENSE**'s Routers.


This API client exposes all OPNSense API endoints.



## Compatibility

Here are the models and version currently tested an reported by our fellow users:

| Model | Version | Date | Tester | Comment |
| ----- | ------- | ---- | ------ | ------- |
| opnsense | 23.7.11 | January 12th, 2024 | @soif | Most Get methods have been tested |


### Contribute !

Please tell us which models you've tested by adding your line in the [template.php](template.php) file and submit a Pull-Request.
*You just have to edit the file directly from github!*


## 658 methods are currently implemented

- **2** standardised methods
- **12** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **240** methods with status of **TESTED** (Params still not ordered or desc not set)
- **20** methods with status of **UNDER DEV** (Work in propress)
- **6** methods with status of **ERROR** (Returns an error)
- **378** methods with status of **DRAFT** (Not tested)



### 266 *Getter* methods (ReadOnly)

- **2** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **238** methods with status of **TESTED** (Params still not ordered or desc not set)
- **20** methods with status of **UNDER DEV** (Work in propress)
- **6** methods with status of **ERROR** (Returns an error)


### 390 *Setter* methods (Writing or performing an action)

- **10** methods with status of **FINAL** (Fully tested: Params ordered, desc set)
- **2** methods with status of **TESTED** (Params still not ordered or desc not set)
- **378** methods with status of **DRAFT** (Not tested)



## All Methods available

*The following methods are currently available:*

### Standardised API Methods

| Method |
| ------ |
| **:star: ApiLogin** |
| **:star: ApiReboot** |

### Raw API Methods

| Method | Description | Dev. State |
| ------ | ----------- | ----------------- |
| **:white_check_mark: ApiGetBindAclGet** |  | TESTED |
| **:white_check_mark: ApiGetBindAclGetAcl** |  | TESTED |
| **:white_check_mark: ApiGetBindAclSearchAcl** |  | TESTED |
| **:white_check_mark: ApiGetBindDnsblGet** |  | TESTED |
| **:white_check_mark: ApiGetBindDomainGet** |  | TESTED |
| **:white_check_mark: ApiGetBindDomainGetDomain** |  | TESTED |
| **:white_check_mark: ApiGetBindDomainSearchMasterDomain** |  | TESTED |
| **:white_check_mark: ApiGetBindDomainSearchPrimaryDomain** |  | TESTED |
| **:white_check_mark: ApiGetBindDomainSearchSecondaryDomain** |  | TESTED |
| **:white_check_mark: ApiGetBindDomainSearchSlaveDomain** |  | TESTED |
| **:white_check_mark: ApiGetBindGeneralGet** |  | TESTED |
| **:white_check_mark: ApiGetBindRecordGet** |  | TESTED |
| **:white_check_mark: ApiGetBindRecordGetRecord** |  | TESTED |
| **:white_check_mark: ApiGetBindRecordSearchRecord** |  | TESTED |
| **:white_check_mark: ApiGetBindServiceDnsbl** |  | TESTED |
| **:white_check_mark: ApiGetBindServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetCoreBackupProviders** |  | TESTED |
| **:white_check_mark: ApiGetCoreFirmwareGet** |  | TESTED |
| **:white_check_mark: ApiGetCoreFirmwareGetOptions** |  | TESTED |
| **:white_check_mark: ApiGetCoreFirmwareHealth** |  | TESTED |
| **:white_check_mark: ApiGetCoreFirmwareInfo** |  | TESTED |
| **:white_check_mark: ApiGetCoreFirmwareRunning** |  | TESTED |
| **:white_check_mark: ApiGetCoreFirmwareUpgradestatus** |  | TESTED |
| **:white_check_mark: ApiGetCoreMenuSearch** |  | TESTED |
| **:white_check_mark: ApiGetCoreMenuTree** |  | TESTED |
| **:white_check_mark: ApiGetCoreServiceSearch** |  | TESTED |
| **:white_check_mark: ApiGetCoreSystemStatus** |  | TESTED |
| **:white_check_mark: ApiGetCronSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetCronSettingsGetJob** |  | TESTED |
| **:white_check_mark: ApiGetCronSettingsSearchJobs** |  | TESTED |
| **:white_check_mark: ApiGetDhcpLeases4SearchLease** |  | TESTED |
| **:white_check_mark: ApiGetDhcpServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetDhcpv4LeasesSearchLease** |  | TESTED |
| **:white_check_mark: ApiGetDhcpv4ServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetDhcpv6LeasesSearchLease** |  | TESTED |
| **:white_check_mark: ApiGetDhcpv6LeasesSearchPrefix** |  | TESTED |
| **:white_check_mark: ApiGetDhcpv6ServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsActivityGetActivity** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsDnsDiagnosticsGet** |  | TESTED |
| **:wrench: ApiGetDiagnosticsDnsReverseLookup** |  | UNDER DEV |
| **:white_check_mark: ApiGetDiagnosticsFirewallListRuleIds** |  | TESTED |
| **:wrench: ApiGetDiagnosticsFirewallLog** |  | UNDER DEV |
| **:white_check_mark: ApiGetDiagnosticsFirewallLogFilters** |  | TESTED |
| **:wrench: ApiGetDiagnosticsFirewallPfStatistics** |  | UNDER DEV |
| **:wrench: ApiGetDiagnosticsFirewallStats** |  | UNDER DEV |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetArp** | ARP table | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetBpfStatistics** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetInterfaceConfig** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetInterfaceNames** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetInterfaceStatistics** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetMemoryStatistics** |  | TESTED |
| **:wrench: ApiGetDiagnosticsInterfaceGetNdp** |  | UNDER DEV |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetNetisrStatistics** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetPfSyncNodes** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetProtocolStatistics** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetRoutes** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetSocketStatistics** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceGetVipStatus** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceSearchArp** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsInterfaceSearchNdp** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsLvtemplateGet** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsLvtemplateGetItem** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsLvtemplateSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsNetflowCacheStats** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsNetflowGetconfig** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsNetflowIsEnabled** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsNetflowStatus** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsNetworkinsightGetInterfaces** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsNetworkinsightGetMetadata** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsNetworkinsightGetProtocols** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsNetworkinsightGetServices** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsPacketCaptureGet** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsPacketCaptureSearchJobs** |  | TESTED |
| **:wrench: ApiGetDiagnosticsPacketCaptureSet** |  | UNDER DEV |
| **:white_check_mark: ApiGetDiagnosticsPingGet** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsPingSearchJobs** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsPortprobeGet** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsSystemMemory** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsSystemhealthGetInterfaces** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsSystemhealthGetRRDlist** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsSystemhealthGetSystemHealth** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsTracerouteGet** |  | TESTED |
| **:white_check_mark: ApiGetDiagnosticsTrafficInterface** |  | TESTED |
| **:white_check_mark: ApiGetDyndnsAccountsGet** |  | TESTED |
| **:white_check_mark: ApiGetDyndnsAccountsGetItem** |  | TESTED |
| **:white_check_mark: ApiGetDyndnsAccountsSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetDyndnsServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetDyndnsSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasExport** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasGet** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasGetGeoIP** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasGetItem** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasGetTableSize** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasListCategories** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasListCountries** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasListNetworkAliases** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasListUserGroups** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetFirewallAliasUtilAliases** |  | TESTED |
| **:white_check_mark: ApiGetFirewallCategoryGet** |  | TESTED |
| **:white_check_mark: ApiGetFirewallCategoryGetItem** |  | TESTED |
| **:white_check_mark: ApiGetFirewallCategorySearchItem** |  | TESTED |
| **:white_check_mark: ApiGetFirewallCategorySearchNoCategoryItem** |  | TESTED |
| **:warning: ApiGetFirewallFilterBaseGet** |  | ERROR |
| **:warning: ApiGetFirewallFilterGetRule** |  | ERROR |
| **:warning: ApiGetFirewallFilterSearchRule** |  | ERROR |
| **:white_check_mark: ApiGetFirewallFilterUtilRuleStats** |  | TESTED |
| **:white_check_mark: ApiGetFirewallGroupGet** |  | TESTED |
| **:white_check_mark: ApiGetFirewallGroupGetItem** |  | TESTED |
| **:white_check_mark: ApiGetFirewallGroupSearchItem** |  | TESTED |
| **:warning: ApiGetFirewallSourceNatGetRule** |  | ERROR |
| **:warning: ApiGetFirewallSourceNatSearchRule** |  | ERROR |
| **:wrench: ApiGetIdsServiceGetAlertLogs** |  | UNDER DEV |
| **:white_check_mark: ApiGetIdsServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsCheckPolicyRule** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsGetPolicy** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsGetPolicyRule** |  | TESTED |
| **:wrench: ApiGetIdsSettingsGetRuleInfo** |  | UNDER DEV |
| **:white_check_mark: ApiGetIdsSettingsGetRulesetproperties** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsGetUserRule** |  | TESTED |
| **:wrench: ApiGetIdsSettingsListRuleMetadata** |  | UNDER DEV |
| **:white_check_mark: ApiGetIdsSettingsListRulesets** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsSearchPolicy** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsSearchPolicyRule** |  | TESTED |
| **:white_check_mark: ApiGetIdsSettingsSearchUserRule** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesLaggSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesLaggSettingsGetItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesLaggSettingsSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesLoopbackSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesLoopbackSettingsGetItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesLoopbackSettingsSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVipSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVipSettingsGetItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVipSettingsGetUnusedVhid** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVipSettingsSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVlanSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVlanSettingsGetItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVlanSettingsSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVxlanSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVxlanSettingsGetItem** |  | TESTED |
| **:white_check_mark: ApiGetInterfacesVxlanSettingsSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetIperfInstanceGet** |  | TESTED |
| **:warning: ApiGetIperfInstanceQuery** |  | ERROR |
| **:star: ApiGetIperfServiceStatus** | Iperf Service Status | FINAL |
| **:white_check_mark: ApiGetIpsecConnectionsGet** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsGetChild** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsGetConnection** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsGetLocal** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsGetRemote** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsIsEnabled** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsSearchChild** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsSearchConnection** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsSearchLocal** |  | TESTED |
| **:white_check_mark: ApiGetIpsecConnectionsSearchRemote** |  | TESTED |
| **:white_check_mark: ApiGetIpsecKeyPairsGet** |  | TESTED |
| **:white_check_mark: ApiGetIpsecKeyPairsGetItem** |  | TESTED |
| **:white_check_mark: ApiGetIpsecKeyPairsSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetIpsecLeasesPools** |  | TESTED |
| **:white_check_mark: ApiGetIpsecLeasesSearch** |  | TESTED |
| **:white_check_mark: ApiGetIpsecLegacySubsystemStatus** |  | TESTED |
| **:white_check_mark: ApiGetIpsecManualSpdGet** |  | TESTED |
| **:white_check_mark: ApiGetIpsecManualSpdSearch** |  | TESTED |
| **:white_check_mark: ApiGetIpsecPoolsGet** |  | TESTED |
| **:white_check_mark: ApiGetIpsecPoolsSearch** |  | TESTED |
| **:white_check_mark: ApiGetIpsecPreSharedKeysGet** |  | TESTED |
| **:white_check_mark: ApiGetIpsecPreSharedKeysGetItem** |  | TESTED |
| **:white_check_mark: ApiGetIpsecPreSharedKeysSearchItem** |  | TESTED |
| **:white_check_mark: ApiGetIpsecSadSearch** |  | TESTED |
| **:white_check_mark: ApiGetIpsecServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetIpsecSessionsSearchPhase1** |  | TESTED |
| **:white_check_mark: ApiGetIpsecSessionsSearchPhase2** |  | TESTED |
| **:white_check_mark: ApiGetIpsecSpdSearch** |  | TESTED |
| **:white_check_mark: ApiGetIpsecTunnelSearchPhase1** |  | TESTED |
| **:white_check_mark: ApiGetIpsecTunnelSearchPhase2** |  | TESTED |
| **:white_check_mark: ApiGetIpsecVtiGet** |  | TESTED |
| **:white_check_mark: ApiGetIpsecVtiSearch** |  | TESTED |
| **:white_check_mark: ApiGetMonitServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsDirty** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsGetAlert** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsGetGeneral** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsGetService** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsGetTest** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsSearchAlert** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsSearchService** |  | TESTED |
| **:white_check_mark: ApiGetMonitSettingsSearchTest** |  | TESTED |
| **:white_check_mark: ApiGetMonitStatusGet** |  | TESTED |
| **:white_check_mark: ApiGetMuninnodeGeneralGet** |  | TESTED |
| **:white_check_mark: ApiGetMuninnodeServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetNetdataGeneralGet** |  | TESTED |
| **:white_check_mark: ApiGetNetdataServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetNtopngGeneralGet** |  | TESTED |
| **:wrench: ApiGetNtopngServiceCheckredis** |  | UNDER DEV |
| **:white_check_mark: ApiGetNtopngServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnClientOverwritesGet** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnClientOverwritesSearch** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnExportAccounts** |  | TESTED |
| **:wrench: ApiGetOpenvpnExportProviders** |  | UNDER DEV |
| **:white_check_mark: ApiGetOpenvpnExportTemplates** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnInstancesGet** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnInstancesGetStaticKey** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnInstancesSearch** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnInstancesSearchStaticKey** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnServiceSearchRoutes** |  | TESTED |
| **:white_check_mark: ApiGetOpenvpnServiceSearchSessions** |  | TESTED |
| **:white_check_mark: ApiGetProxyServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsGetPACMatch** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsGetPACProxy** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsGetPACRule** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsGetRemoteBlacklist** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsSearchPACMatch** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsSearchPACProxy** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsSearchPACRule** |  | TESTED |
| **:white_check_mark: ApiGetProxySettingsSearchRemoteBlacklists** |  | TESTED |
| **:wrench: ApiGetProxyTemplateGet** |  | UNDER DEV |
| **:white_check_mark: ApiGetRedisServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetRedisSettingsGet** |  | TESTED |
| **:star: ApiGetRoutesGatewayStatus** | Gateways Status | FINAL |
| **:white_check_mark: ApiGetRoutesRoutesGet** |  | TESTED |
| **:white_check_mark: ApiGetRoutesRoutesGetroute** |  | TESTED |
| **:white_check_mark: ApiGetRoutesRoutesSearchroute** |  | TESTED |
| **:white_check_mark: ApiGetSyslogServiceStats** |  | TESTED |
| **:white_check_mark: ApiGetSyslogServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetSyslogSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetSyslogSettingsGetDestination** |  | TESTED |
| **:white_check_mark: ApiGetSyslogSettingsSearchDestinations** |  | TESTED |
| **:white_check_mark: ApiGetTrafficshaperServiceStatistics** |  | TESTED |
| **:white_check_mark: ApiGetTrafficshaperSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetTrafficshaperSettingsGetPipe** |  | TESTED |
| **:white_check_mark: ApiGetTrafficshaperSettingsGetQueue** |  | TESTED |
| **:white_check_mark: ApiGetTrafficshaperSettingsGetRule** |  | TESTED |
| **:white_check_mark: ApiGetTrafficshaperSettingsSearchPipes** |  | TESTED |
| **:white_check_mark: ApiGetTrafficshaperSettingsSearchQueues** |  | TESTED |
| **:white_check_mark: ApiGetTrafficshaperSettingsSearchRules** |  | TESTED |
| **:wrench: ApiGetUnboundDiagnosticsDumpcache** |  | UNDER DEV |
| **:wrench: ApiGetUnboundDiagnosticsDumpinfra** |  | UNDER DEV |
| **:wrench: ApiGetUnboundDiagnosticsListinsecure** |  | UNDER DEV |
| **:wrench: ApiGetUnboundDiagnosticsListlocaldata** |  | UNDER DEV |
| **:wrench: ApiGetUnboundDiagnosticsListlocalzones** |  | UNDER DEV |
| **:wrench: ApiGetUnboundDiagnosticsStats** |  | UNDER DEV |
| **:white_check_mark: ApiGetUnboundOverviewIsBlockListEnabled** |  | TESTED |
| **:white_check_mark: ApiGetUnboundOverviewIsEnabled** |  | TESTED |
| **:white_check_mark: ApiGetUnboundOverviewSearchQueries** |  | TESTED |
| **:wrench: ApiGetUnboundServiceDnsbl** |  | UNDER DEV |
| **:wrench: ApiGetUnboundServiceReconfigureGeneral** |  | UNDER DEV |
| **:white_check_mark: ApiGetUnboundServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsGet** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsGetAcl** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsGetDomainOverride** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsGetForward** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsGetHostAlias** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsGetHostOverride** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsGetNameservers** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsSearchAcl** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsSearchDomainOverride** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsSearchForward** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsSearchHostAlias** |  | TESTED |
| **:white_check_mark: ApiGetUnboundSettingsSearchHostOverride** |  | TESTED |
| **:white_check_mark: ApiGetVnstatGeneralGet** |  | TESTED |
| **:white_check_mark: ApiGetVnstatServiceDaily** |  | TESTED |
| **:white_check_mark: ApiGetVnstatServiceHourly** |  | TESTED |
| **:white_check_mark: ApiGetVnstatServiceMonthly** |  | TESTED |
| **:white_check_mark: ApiGetVnstatServiceStatus** |  | TESTED |
| **:white_check_mark: ApiGetVnstatServiceYearly** |  | TESTED |
| **:alien: ApiSetBindAclAddAcl** |  | DRAFT |
| **:alien: ApiSetBindAclDelAcl** |  | DRAFT |
| **:alien: ApiSetBindAclSet** |  | DRAFT |
| **:alien: ApiSetBindAclSetAcl** |  | DRAFT |
| **:alien: ApiSetBindAclToggleAcl** |  | DRAFT |
| **:alien: ApiSetBindDnsblSet** |  | DRAFT |
| **:alien: ApiSetBindDomainAddPrimaryDomain** |  | DRAFT |
| **:alien: ApiSetBindDomainAddSecondaryDomain** |  | DRAFT |
| **:alien: ApiSetBindDomainDelDomain** |  | DRAFT |
| **:alien: ApiSetBindDomainSet** |  | DRAFT |
| **:alien: ApiSetBindDomainSetDomain** |  | DRAFT |
| **:alien: ApiSetBindDomainToggleDomain** |  | DRAFT |
| **:alien: ApiSetBindGeneralSet** |  | DRAFT |
| **:alien: ApiSetBindRecordAddRecord** |  | DRAFT |
| **:alien: ApiSetBindRecordDelRecord** |  | DRAFT |
| **:alien: ApiSetBindRecordSet** |  | DRAFT |
| **:alien: ApiSetBindRecordSetRecord** |  | DRAFT |
| **:alien: ApiSetBindRecordToggleRecord** |  | DRAFT |
| **:alien: ApiSetBindServiceReconfigure** |  | DRAFT |
| **:star: ApiSetBindServiceRestart** | Bind Service Restart | FINAL |
| **:star: ApiSetBindServiceStart** | Bind Service Start | FINAL |
| **:star: ApiSetBindServiceStop** | Bind Service Stop | FINAL |
| **:alien: ApiSetCoreFirmwareAudit** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareChangelog** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareCheck** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareConnection** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareDetails** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareInstall** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareLicense** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareLock** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareLog** |  | DRAFT |
| **:alien: ApiSetCoreFirmwarePoweroff** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareReboot** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareReinstall** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareRemove** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareResyncPlugins** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareSet** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareStatus** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareSyncPlugins** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareUnlock** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareUpdate** |  | DRAFT |
| **:alien: ApiSetCoreFirmwareUpgrade** |  | DRAFT |
| **:alien: ApiSetCoreServiceRestart** |  | DRAFT |
| **:alien: ApiSetCoreServiceStart** |  | DRAFT |
| **:alien: ApiSetCoreServiceStop** |  | DRAFT |
| **:alien: ApiSetCoreSystemDismissStatus** |  | DRAFT |
| **:alien: ApiSetCoreSystemHalt** |  | DRAFT |
| **:star: ApiSetCoreSystemReboot** | Reboot | FINAL |
| **:alien: ApiSetCronServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetCronSettingsAddJob** |  | DRAFT |
| **:alien: ApiSetCronSettingsDelJob** |  | DRAFT |
| **:alien: ApiSetCronSettingsSet** |  | DRAFT |
| **:alien: ApiSetCronSettingsSetJob** |  | DRAFT |
| **:alien: ApiSetCronSettingsToggleJob** |  | DRAFT |
| **:alien: ApiSetDhcpLeases4DelLease** |  | DRAFT |
| **:alien: ApiSetDhcpServiceRestart** |  | DRAFT |
| **:alien: ApiSetDhcpServiceStart** |  | DRAFT |
| **:alien: ApiSetDhcpServiceStop** |  | DRAFT |
| **:alien: ApiSetDhcpv4LeasesDelLease** |  | DRAFT |
| **:alien: ApiSetDhcpv4ServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetDhcpv4ServiceRestart** |  | DRAFT |
| **:alien: ApiSetDhcpv4ServiceStart** |  | DRAFT |
| **:alien: ApiSetDhcpv4ServiceStop** |  | DRAFT |
| **:alien: ApiSetDhcpv6LeasesDelLease** |  | DRAFT |
| **:alien: ApiSetDhcpv6ServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetDhcpv6ServiceRestart** |  | DRAFT |
| **:alien: ApiSetDhcpv6ServiceStart** |  | DRAFT |
| **:alien: ApiSetDhcpv6ServiceStop** |  | DRAFT |
| **:alien: ApiSetDiagnosticsDnsDiagnosticsSet** |  | DRAFT |
| **:alien: ApiSetDiagnosticsFirewallDelState** |  | DRAFT |
| **:alien: ApiSetDiagnosticsFirewallFlushSources** |  | DRAFT |
| **:alien: ApiSetDiagnosticsFirewallFlushStates** |  | DRAFT |
| **:alien: ApiSetDiagnosticsFirewallKillStates** |  | DRAFT |
| **:alien: ApiSetDiagnosticsFirewallQueryPfTop** |  | DRAFT |
| **:alien: ApiSetDiagnosticsFirewallQueryStates** |  | DRAFT |
| **:alien: ApiSetDiagnosticsInterfaceCarpStatus** |  | DRAFT |
| **:alien: ApiSetDiagnosticsInterfaceDelRoute** |  | DRAFT |
| **:alien: ApiSetDiagnosticsInterfaceFlushArp** |  | DRAFT |
| **:alien: ApiSetDiagnosticsLvtemplateAddItem** |  | DRAFT |
| **:alien: ApiSetDiagnosticsLvtemplateDelItem** |  | DRAFT |
| **:alien: ApiSetDiagnosticsLvtemplateSet** |  | DRAFT |
| **:alien: ApiSetDiagnosticsLvtemplateSetItem** |  | DRAFT |
| **:alien: ApiSetDiagnosticsNetflowReconfigure** |  | DRAFT |
| **:alien: ApiSetDiagnosticsNetflowSetconfig** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPacketCaptureRemove** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPacketCaptureSet** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPacketCaptureStart** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPacketCaptureStop** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPingRemove** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPingSet** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPingStart** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPingStop** |  | DRAFT |
| **:alien: ApiSetDiagnosticsPortprobeSet** |  | DRAFT |
| **:alien: ApiSetDiagnosticsTracerouteSet** |  | DRAFT |
| **:alien: ApiSetDyndnsAccountsAddItem** |  | DRAFT |
| **:alien: ApiSetDyndnsAccountsDelItem** |  | DRAFT |
| **:alien: ApiSetDyndnsAccountsSet** |  | DRAFT |
| **:alien: ApiSetDyndnsAccountsSetItem** |  | DRAFT |
| **:alien: ApiSetDyndnsAccountsToggleItem** |  | DRAFT |
| **:alien: ApiSetDyndnsServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetDyndnsServiceRestart** |  | DRAFT |
| **:alien: ApiSetDyndnsServiceStart** |  | DRAFT |
| **:alien: ApiSetDyndnsServiceStop** |  | DRAFT |
| **:alien: ApiSetDyndnsSettingsSet** |  | DRAFT |
| **:alien: ApiSetFirewallAliasAddItem** |  | DRAFT |
| **:alien: ApiSetFirewallAliasDelItem** |  | DRAFT |
| **:alien: ApiSetFirewallAliasImport** |  | DRAFT |
| **:alien: ApiSetFirewallAliasReconfigure** |  | DRAFT |
| **:alien: ApiSetFirewallAliasSet** |  | DRAFT |
| **:alien: ApiSetFirewallAliasSetItem** |  | DRAFT |
| **:alien: ApiSetFirewallAliasToggleItem** |  | DRAFT |
| **:alien: ApiSetFirewallAliasUtilAdd** |  | DRAFT |
| **:alien: ApiSetFirewallAliasUtilDelete** |  | DRAFT |
| **:alien: ApiSetFirewallAliasUtilFindReferences** |  | DRAFT |
| **:alien: ApiSetFirewallAliasUtilFlush** |  | DRAFT |
| **:white_check_mark: ApiSetFirewallAliasUtilUpdateBogons** |  | TESTED |
| **:alien: ApiSetFirewallCategoryAddItem** |  | DRAFT |
| **:alien: ApiSetFirewallCategoryDelItem** |  | DRAFT |
| **:alien: ApiSetFirewallCategorySet** |  | DRAFT |
| **:alien: ApiSetFirewallCategorySetItem** |  | DRAFT |
| **:alien: ApiSetFirewallFilterAddRule** |  | DRAFT |
| **:alien: ApiSetFirewallFilterBaseApply** |  | DRAFT |
| **:alien: ApiSetFirewallFilterBaseCancelRollback** |  | DRAFT |
| **:alien: ApiSetFirewallFilterBaseRevert** |  | DRAFT |
| **:alien: ApiSetFirewallFilterBaseSavepoint** |  | DRAFT |
| **:alien: ApiSetFirewallFilterBaseSet** |  | DRAFT |
| **:alien: ApiSetFirewallFilterDelRule** |  | DRAFT |
| **:alien: ApiSetFirewallFilterSetRule** |  | DRAFT |
| **:alien: ApiSetFirewallFilterToggleRule** |  | DRAFT |
| **:alien: ApiSetFirewallGroupAddItem** |  | DRAFT |
| **:alien: ApiSetFirewallGroupDelItem** |  | DRAFT |
| **:alien: ApiSetFirewallGroupReconfigure** |  | DRAFT |
| **:alien: ApiSetFirewallGroupSet** |  | DRAFT |
| **:alien: ApiSetFirewallGroupSetItem** |  | DRAFT |
| **:alien: ApiSetFirewallSourceNatAddRule** |  | DRAFT |
| **:alien: ApiSetFirewallSourceNatDelRule** |  | DRAFT |
| **:alien: ApiSetFirewallSourceNatSetRule** |  | DRAFT |
| **:alien: ApiSetFirewallSourceNatToggleRule** |  | DRAFT |
| **:alien: ApiSetIdsServiceDropAlertLog** |  | DRAFT |
| **:alien: ApiSetIdsServiceQueryAlerts** |  | DRAFT |
| **:alien: ApiSetIdsServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetIdsServiceReloadRules** |  | DRAFT |
| **:alien: ApiSetIdsServiceRestart** |  | DRAFT |
| **:alien: ApiSetIdsServiceStart** |  | DRAFT |
| **:alien: ApiSetIdsServiceStop** |  | DRAFT |
| **:alien: ApiSetIdsServiceUpdateRules** |  | DRAFT |
| **:alien: ApiSetIdsSettingsAddPolicy** |  | DRAFT |
| **:alien: ApiSetIdsSettingsAddPolicyRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsAddUserRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsDelPolicy** |  | DRAFT |
| **:alien: ApiSetIdsSettingsDelPolicyRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsDelUserRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSearchInstalledRules** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSet** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetPolicy** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetPolicyRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetRuleset** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetRulesetproperties** |  | DRAFT |
| **:alien: ApiSetIdsSettingsSetUserRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsTogglePolicy** |  | DRAFT |
| **:alien: ApiSetIdsSettingsTogglePolicyRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsToggleRule** |  | DRAFT |
| **:alien: ApiSetIdsSettingsToggleRuleset** |  | DRAFT |
| **:alien: ApiSetIdsSettingsToggleUserRule** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesLaggSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesLoopbackSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesVipSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesVlanSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsAddItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsDelItem** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsReconfigure** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsSet** |  | DRAFT |
| **:alien: ApiSetInterfacesVxlanSettingsSetItem** |  | DRAFT |
| **:alien: ApiSetIperfInstanceSet** |  | DRAFT |
| **:star: ApiSetIperfServiceRestart** | Iperf Service Restart | FINAL |
| **:star: ApiSetIperfServiceStart** | Iperf Service Start | FINAL |
| **:star: ApiSetIperfServiceStop** | Iperf Service Stop | FINAL |
| **:alien: ApiSetIpsecConnectionsAddChild** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsAddConnection** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsAddLocal** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsAddRemote** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsDelChild** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsDelConnection** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsDelLocal** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsDelRemote** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsSet** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsSetChild** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsSetConnection** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsSetLocal** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsSetRemote** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsToggle** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsToggleChild** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsToggleConnection** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsToggleLocal** |  | DRAFT |
| **:alien: ApiSetIpsecConnectionsToggleRemote** |  | DRAFT |
| **:alien: ApiSetIpsecKeyPairsAddItem** |  | DRAFT |
| **:alien: ApiSetIpsecKeyPairsDelItem** |  | DRAFT |
| **:alien: ApiSetIpsecKeyPairsSet** |  | DRAFT |
| **:alien: ApiSetIpsecKeyPairsSetItem** |  | DRAFT |
| **:alien: ApiSetIpsecLegacySubsystemApplyConfig** |  | DRAFT |
| **:alien: ApiSetIpsecManualSpdAdd** |  | DRAFT |
| **:alien: ApiSetIpsecManualSpdDel** |  | DRAFT |
| **:alien: ApiSetIpsecManualSpdSet** |  | DRAFT |
| **:alien: ApiSetIpsecManualSpdToggle** |  | DRAFT |
| **:alien: ApiSetIpsecPoolsAdd** |  | DRAFT |
| **:alien: ApiSetIpsecPoolsDel** |  | DRAFT |
| **:alien: ApiSetIpsecPoolsSet** |  | DRAFT |
| **:alien: ApiSetIpsecPoolsToggle** |  | DRAFT |
| **:alien: ApiSetIpsecPreSharedKeysAddItem** |  | DRAFT |
| **:alien: ApiSetIpsecPreSharedKeysDelItem** |  | DRAFT |
| **:alien: ApiSetIpsecPreSharedKeysSet** |  | DRAFT |
| **:alien: ApiSetIpsecPreSharedKeysSetItem** |  | DRAFT |
| **:alien: ApiSetIpsecSadDelete** |  | DRAFT |
| **:alien: ApiSetIpsecServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetIpsecServiceRestart** |  | DRAFT |
| **:alien: ApiSetIpsecServiceStart** |  | DRAFT |
| **:alien: ApiSetIpsecServiceStop** |  | DRAFT |
| **:alien: ApiSetIpsecSessionsConnect** |  | DRAFT |
| **:alien: ApiSetIpsecSessionsDisconnect** |  | DRAFT |
| **:alien: ApiSetIpsecSpdDelete** |  | DRAFT |
| **:alien: ApiSetIpsecTunnelDelPhase1** |  | DRAFT |
| **:alien: ApiSetIpsecTunnelDelPhase2** |  | DRAFT |
| **:alien: ApiSetIpsecTunnelToggle** |  | DRAFT |
| **:alien: ApiSetIpsecTunnelTogglePhase1** |  | DRAFT |
| **:alien: ApiSetIpsecTunnelTogglePhase2** |  | DRAFT |
| **:alien: ApiSetIpsecVtiAdd** |  | DRAFT |
| **:alien: ApiSetIpsecVtiDel** |  | DRAFT |
| **:alien: ApiSetIpsecVtiSet** |  | DRAFT |
| **:alien: ApiSetIpsecVtiToggle** |  | DRAFT |
| **:alien: ApiSetMonitServiceCheck** |  | DRAFT |
| **:alien: ApiSetMonitServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetMonitServiceRestart** |  | DRAFT |
| **:alien: ApiSetMonitServiceStart** |  | DRAFT |
| **:alien: ApiSetMonitServiceStop** |  | DRAFT |
| **:alien: ApiSetMonitSettingsAddAlert** |  | DRAFT |
| **:alien: ApiSetMonitSettingsAddService** |  | DRAFT |
| **:alien: ApiSetMonitSettingsAddTest** |  | DRAFT |
| **:alien: ApiSetMonitSettingsDelAlert** |  | DRAFT |
| **:alien: ApiSetMonitSettingsDelService** |  | DRAFT |
| **:alien: ApiSetMonitSettingsDelTest** |  | DRAFT |
| **:alien: ApiSetMonitSettingsSet** |  | DRAFT |
| **:alien: ApiSetMonitSettingsSetAlert** |  | DRAFT |
| **:alien: ApiSetMonitSettingsSetService** |  | DRAFT |
| **:alien: ApiSetMonitSettingsSetTest** |  | DRAFT |
| **:alien: ApiSetMonitSettingsToggleAlert** |  | DRAFT |
| **:alien: ApiSetMonitSettingsToggleService** |  | DRAFT |
| **:alien: ApiSetMuninnodeGeneralSet** |  | DRAFT |
| **:alien: ApiSetMuninnodeServiceReconfigure** |  | DRAFT |
| **:star: ApiSetMuninnodeServiceRestart** | Munin-node Service Restart | FINAL |
| **:star: ApiSetMuninnodeServiceStart** | Munin-node Service Start | FINAL |
| **:star: ApiSetMuninnodeServiceStop** | Munin-node Service Stop | FINAL |
| **:alien: ApiSetNetdataGeneralSet** |  | DRAFT |
| **:alien: ApiSetNetdataServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetNetdataServiceRestart** |  | DRAFT |
| **:alien: ApiSetNetdataServiceStart** |  | DRAFT |
| **:alien: ApiSetNetdataServiceStop** |  | DRAFT |
| **:alien: ApiSetNtopngGeneralSet** |  | DRAFT |
| **:alien: ApiSetNtopngServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetNtopngServiceRestart** |  | DRAFT |
| **:alien: ApiSetNtopngServiceStart** |  | DRAFT |
| **:alien: ApiSetNtopngServiceStop** |  | DRAFT |
| **:alien: ApiSetOpenvpnClientOverwritesAdd** |  | DRAFT |
| **:alien: ApiSetOpenvpnClientOverwritesDel** |  | DRAFT |
| **:alien: ApiSetOpenvpnClientOverwritesSet** |  | DRAFT |
| **:alien: ApiSetOpenvpnClientOverwritesToggle** |  | DRAFT |
| **:alien: ApiSetOpenvpnExportDownload** |  | DRAFT |
| **:alien: ApiSetOpenvpnExportStorePresets** |  | DRAFT |
| **:alien: ApiSetOpenvpnExportValidatePresets** |  | DRAFT |
| **:alien: ApiSetOpenvpnInstancesAdd** |  | DRAFT |
| **:alien: ApiSetOpenvpnInstancesAddStaticKey** |  | DRAFT |
| **:alien: ApiSetOpenvpnInstancesDel** |  | DRAFT |
| **:alien: ApiSetOpenvpnInstancesDelStaticKey** |  | DRAFT |
| **:white_check_mark: ApiSetOpenvpnInstancesGenKey** |  | TESTED |
| **:alien: ApiSetOpenvpnInstancesSet** |  | DRAFT |
| **:alien: ApiSetOpenvpnInstancesSetStaticKey** |  | DRAFT |
| **:alien: ApiSetOpenvpnInstancesToggle** |  | DRAFT |
| **:alien: ApiSetOpenvpnServiceKillSession** |  | DRAFT |
| **:alien: ApiSetOpenvpnServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetOpenvpnServiceRestartService** |  | DRAFT |
| **:alien: ApiSetOpenvpnServiceStartService** |  | DRAFT |
| **:alien: ApiSetOpenvpnServiceStopService** |  | DRAFT |
| **:alien: ApiSetProxyServiceDownloadacls** |  | DRAFT |
| **:alien: ApiSetProxyServiceFetchacls** |  | DRAFT |
| **:alien: ApiSetProxyServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetProxyServiceRefreshTemplate** |  | DRAFT |
| **:alien: ApiSetProxyServiceReset** |  | DRAFT |
| **:alien: ApiSetProxyServiceRestart** |  | DRAFT |
| **:alien: ApiSetProxyServiceStart** |  | DRAFT |
| **:alien: ApiSetProxyServiceStop** |  | DRAFT |
| **:alien: ApiSetProxySettingsAddPACMatch** |  | DRAFT |
| **:alien: ApiSetProxySettingsAddPACProxy** |  | DRAFT |
| **:alien: ApiSetProxySettingsAddPACRule** |  | DRAFT |
| **:alien: ApiSetProxySettingsAddRemoteBlacklist** |  | DRAFT |
| **:alien: ApiSetProxySettingsDelPACMatch** |  | DRAFT |
| **:alien: ApiSetProxySettingsDelPACProxy** |  | DRAFT |
| **:alien: ApiSetProxySettingsDelPACRule** |  | DRAFT |
| **:alien: ApiSetProxySettingsDelRemoteBlacklist** |  | DRAFT |
| **:alien: ApiSetProxySettingsFetchRBCron** |  | DRAFT |
| **:alien: ApiSetProxySettingsSet** |  | DRAFT |
| **:alien: ApiSetProxySettingsSetPACMatch** |  | DRAFT |
| **:alien: ApiSetProxySettingsSetPACProxy** |  | DRAFT |
| **:alien: ApiSetProxySettingsSetPACRule** |  | DRAFT |
| **:alien: ApiSetProxySettingsSetRemoteBlacklist** |  | DRAFT |
| **:alien: ApiSetProxySettingsTogglePACRule** |  | DRAFT |
| **:alien: ApiSetProxySettingsToggleRemoteBlacklist** |  | DRAFT |
| **:alien: ApiSetProxyTemplateReset** |  | DRAFT |
| **:alien: ApiSetProxyTemplateSet** |  | DRAFT |
| **:alien: ApiSetRedisServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetRedisServiceRestart** |  | DRAFT |
| **:alien: ApiSetRedisServiceStart** |  | DRAFT |
| **:alien: ApiSetRedisServiceStop** |  | DRAFT |
| **:alien: ApiSetRedisSettingsSet** |  | DRAFT |
| **:alien: ApiSetRoutesRoutesAddroute** |  | DRAFT |
| **:alien: ApiSetRoutesRoutesDelroute** |  | DRAFT |
| **:alien: ApiSetRoutesRoutesReconfigure** |  | DRAFT |
| **:alien: ApiSetRoutesRoutesSet** |  | DRAFT |
| **:alien: ApiSetRoutesRoutesSetroute** |  | DRAFT |
| **:alien: ApiSetRoutesRoutesToggleroute** |  | DRAFT |
| **:alien: ApiSetSyslogServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetSyslogServiceRestart** |  | DRAFT |
| **:alien: ApiSetSyslogServiceStart** |  | DRAFT |
| **:alien: ApiSetSyslogServiceStop** |  | DRAFT |
| **:alien: ApiSetSyslogSettingsAddDestination** |  | DRAFT |
| **:alien: ApiSetSyslogSettingsDelDestination** |  | DRAFT |
| **:alien: ApiSetSyslogSettingsSet** |  | DRAFT |
| **:alien: ApiSetSyslogSettingsSetDestination** |  | DRAFT |
| **:alien: ApiSetSyslogSettingsToggleDestination** |  | DRAFT |
| **:alien: ApiSetTrafficshaperServiceFlushreload** |  | DRAFT |
| **:alien: ApiSetTrafficshaperServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsAddPipe** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsAddQueue** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsAddRule** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsDelPipe** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsDelQueue** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsDelRule** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsSet** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsSetPipe** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsSetQueue** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsSetRule** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsTogglePipe** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsToggleQueue** |  | DRAFT |
| **:alien: ApiSetTrafficshaperSettingsToggleRule** |  | DRAFT |
| **:alien: ApiSetUnboundServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetUnboundServiceRestart** |  | DRAFT |
| **:alien: ApiSetUnboundServiceStart** |  | DRAFT |
| **:alien: ApiSetUnboundServiceStop** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsAddAcl** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsAddDomainOverride** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsAddForward** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsAddHostAlias** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsAddHostOverride** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsDelAcl** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsDelDomainOverride** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsDelForward** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsDelHostAlias** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsDelHostOverride** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsSet** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsSetAcl** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsSetDomainOverride** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsSetForward** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsSetHostAlias** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsSetHostOverride** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsToggleAcl** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsToggleDomainOverride** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsToggleForward** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsToggleHostAlias** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsToggleHostOverride** |  | DRAFT |
| **:alien: ApiSetUnboundSettingsUpdateBlocklist** |  | DRAFT |
| **:alien: ApiSetVnstatGeneralSet** |  | DRAFT |
| **:alien: ApiSetVnstatServiceReconfigure** |  | DRAFT |
| **:alien: ApiSetVnstatServiceRestart** |  | DRAFT |
| **:alien: ApiSetVnstatServiceStart** |  | DRAFT |
| **:alien: ApiSetVnstatServiceStop** |  | DRAFT |
