# Changelog

All notable changes to [HackApi](https://github.com/soif/HackApi) are documented here.

## v1.33 (2026-11-01)

- **`EnsureLogin()`:** public entry for login + durable auth cache (load / `ApiLogin` / save). Prefer this over bare `ApiLogin()` whenever `SetAuthCachePath` is used — `ApiLogin` alone does not read or write the auth cache.

---

## v1.32 (2026-11-01)

- **Auth file cache:** `SetAuthCachePath($dir, $ttl=null)` persists driver sessions across PHP processes (JSON + cookie jar when `use_cookies`). Master TTL default **1800** s. `SetCookiePath` is deprecated and forwards to `SetAuthCachePath`. Without a cache path, cookie drivers still get an ephemeral per-host jar under `sys_get_temp_dir()` (no shared `/tmp/cookies_Hackapi`).
- **SFR Box client 0.93:** public GET transports (`get_pub` / `getlist_pub` / `getfix_pub`); auth cache export/import for API tokens (TTL **3600** s); `ApiLogin` accepts cleaned `token` at root after `ErrorFreeResult`.

---

## v1.31 (2026-10-30)

### Breaking

- Huawei `ApiSetSmsSendSms` argument order changed (`Date` before the optional args; `Reserved` last). The normalized `ApiSmsSend` wrapper is unchanged. Detail: [`src/devices/huawei_modem/readme.md`](src/devices/huawei_modem/readme.md).

---

## v1.30 (2026-10-29)

### Breaking

- Device `trait.php` files no longer ship `ListMethodsDefinitions()`. Traits are **callable `Api*` methods only**. Endpoint metadata lives in each device `template.php`.
- For maintainer / debug listing, use Tools:

```php
require 'src/lib/HackapiTools.php';
$tools = new HackapiTools();
$tools->SetDevice('opnsense');
$defs = $tools->ListMethodsDefinitions();
```

### Also

- Compact trait body when a device has 500+ methods.
- OPNsense catalog expansion; Raw/CSV body handling (`get_csv` / `get_raw`).
- PHP 8 CallApi offset fixes; quieter engine notices; English/phpdoc polish on core and device mains.

---

## v1.23 (2026-10-28)

- OPNsense Dnsmasq / Kea **GET** endpoints (read-only) for backend detect and reservation/lease pull.
- OPNsense client **0.92**. No config-changing POST in this release.

---

## v1.22 (2026-10-28)

- OPNsense: document real API errors returned by the box on failing endpoints (e.g. firewall filter / source-NAT GETs → `400: Controller not found` in the method tables).
- Refresh OPNsense `template.php` / `trait.php` / `readme.md` status counts after those notes (ERROR → UNDER DEV where appropriate).

---

## v1.21 (2024-01-13)

- OPNsense client **0.91**: test and document **all** service `status` / `start` / `stop` / `restart` methods.
- Endpoint definitions: optional **`return`** column; richer phpdoc `@return` on generated traits (Huawei, OpenWrt, OPNsense, SFR, ZTE regenerated).
- Core: clients can override `$timeout_connect` and `$timeout_request`.
- Tools: safer first-time `trait.php` creation; debug fix for automatic boolean answers.

---

## v1.20 (2024-01-12)

- Large OPNsense catalog expansion (template + trait + readme) — many more endpoints implemented and live-tested.
- Standard **`ApiReboot`** on the OPNsense client; stronger `ErrorFreeResult` handling.
- SFR Box: more endpoints tested; device readmes refreshed (method titles, state icons, non-breaking space after icons).
- Tools: rename `test_api_methods` → `test_api_get_methods`; sort methods by state (desc); drop unused `error_level`; default debug level **4**.
- README: link devices more clearly.

---

## v1.10 (2024-01-11)

- OpenWrt client **0.90**: more endpoints, better descriptions from OpenWrt docs, and notes for methods that need **ACL**.
- Standard **`ApiWifiStart`** / **`ApiWifiStop`** helpers.
- Error mapping: API error **4** → main error **7**; map errors without an API code; document error **32700** (alternate endpoint noted in comments).
- Boolean value fixes; quieter verbose logs; small HackApi / HackapiTools cleanups.

---

## v1.02 (2024-01-09)

- OpenWrt: fix **`ApiWifiListSsids`**; implement **`ApiWifiListClients`**; map **`UBUS_STATUS_NOT_FOUND`** into the main error path.
- More OpenWrt (and related) API methods tested and wired in template/trait/readme.
- Core: **`GetClientVersion`**; show client version in device readmes; `total_state` reporting; clearer `_CallInstanceMethod` result separators; `last_error` fixes.

---

## v1.00 (2024-01-08)

- First public release of HackApi: thin PHP client for undocumented device APIs (curl, no heavy SDK).
- Devices shipped: **Huawei** modem, **OpenWrt**, **OPNsense**, **SFR Box**, **ZTE** modem, plus `_example` scaffold.
- Template → trait codegen, CLI build/test helpers, per-device readmes with tested-model notes.
- Project license and credits in tree.
