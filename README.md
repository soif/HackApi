# HackApi

Talk to the weird, undocumented APIs hiding in routers, modems, and ISP boxes — from plain PHP, without a 50-dependency SDK.

## Why

Most API clients assume a clean public REST surface with nice docs and badges. Your home router usually offers the opposite: internal endpoints, odd XML/JSON, and a login flow that was never meant for you.

**HackApi** stays thin on purpose: one base class ([`Hackapi.php`](src/lib/Hackapi.php)), a small device [`main.php`](src/devices/openwrt/main.php), and a flat [`template.php`](src/devices/openwrt/template.php) of endpoints. Run the build tool → a [`trait.php`](src/devices/openwrt/trait.php) full of `Api*` methods appears. When the box lies, dump every request.

## Who it is for

- Home-labbers and ISP-box / modem hackers who want login → call → debug in PHP
- People turning a scraped endpoint list into a real client before the weekend is over

## Features

- Standardised `Api*` methods per device (same shape, less guessing)
- Full request/response debug for when "it worked in the browser"
- Template → trait codegen (methods + device readme) in one CLI pass
- CLI helpers to build, list, and poke endpoints
- JSON by default; CSV / images / raw via `CallApiGetRaw` / `CallApiGetCsv` (+ `ParseCsvBody`) — see [`src/devices/_example/readme.md`](src/devices/_example/readme.md)

## Supported devices

- **[Huawei](src/devices/huawei_modem)** modems
- **[OpenWrt](src/devices/openwrt)** routers
- **[OPNsense](src/devices/opnsense)** firewalls
- **[SFR](src/devices/sfr_box)** boxes (SFR / Red-by-SFR)
- **[ZTE](src/devices/zte_modem)** modems

Got another box? That is the whole point — see **Contribute**. Tested models live in each device `readme.md` under `src/devices/`.

## Requirements

- PHP >= 5.4
- PHP `curl` extension

That is it. No framework tax.

## Quick start

```php
require 'src/devices/huawei_modem/main.php';
$client = new HackApi_Huawei_modem();

// Or set host/login here if you skip defaults.php
// $client->SetHost('192.168.0.1');
// $client->SetLogin('admin', 'password');

$messages = $client->ApiSmsListReceived();
print_r($messages);

$client->ApiSmsSend('0612345678', 'Hello world');
$client->ApiReboot();
```

*Very simple, isn't it?*

More patterns: [`src/devices/_example/`](src/devices/_example/).

## Breaking (v1.30)

From **1.30**, device `trait.php` files no longer ship `ListMethodsDefinitions()`. Traits are **callable `Api*` methods only**. Endpoint metadata lives in each device `template.php`.

For maintainer / debug listing, use Tools:

```php
require 'src/lib/HackapiTools.php';
$tools = new HackapiTools();
$tools->SetDevice('opnsense');
$defs = $tools->ListMethodsDefinitions();
```

## Contribute

**Bring your own box** — new device clients are the best PRs:

1. Copy [`src/devices/_example/`](src/devices/_example/) to a new folder (`brand`, `brand_family`, or `brand_model`)
2. Implement login (and any `CallApi*` helpers) in `main.php`
3. Fill `template.php` with the endpoints you care about
4. Run `php src/tools/build_api_methods.php your_device` → `trait.php` + device `readme.md`
5. Open a Pull Request

Also welcome: tell us which models you actually tested. Serious or slightly chaotic — both OK if the code works.

Enjoy!

Repo: [https://github.com/soif/HackApi](https://github.com/soif/HackApi)
