# HackApi

A fast, lighweight  and solid API client written in PHP, to interact with various devices (mainly Routers, Modems or Smart Home hardware). 

You can use it to interface with the [currently implemented devices](src/devices/), or use it as a base to **quickly** develop your own client.


## Why HackApi ?

While there is tons of great API clients or frameworks available, most are designed to be used with well-educated, documented APIs, aka public APIs.

When you want to interact with hardware devices such as routers, modems, ISP boxes, smart home device, etc..  and you want to extract some great information, or maybe remotely reboot it, turn off Wifi, list connected Wifi clients, interact with your ISP box... you need to discover if they have an internal (mostly undocumented and not meant to be public) API. In such cases, these tools are overkill, they need a high learning curve, and they are not very well suitable for such tasks.

On the other hand, when you find someone who already have made a basic API client script for your device, it is often not very solid, not cleanly coded or maybe in another language (ie: Python...). Then if you need to makes your own device API client, you have to reinvent the wheel most of the time, by coding a full client from scratch.

Here comes **HackApi**, that aims to be very simple to learn, provides basic tools to debug, and is very light to run. *You ends up with only the [HackApi main class](src/HackApi.php) file + the *small* device specific class file (ie [openwrt](src/devices/openwrt/main.php)) and its associated [trait.php file](src/devices/openwrt/trait.php) auto generated  from a [template.php file](src/devices/openwrt.php) (basically a definition of all API endpoints).*

## Features

- Standardized API methods
- Full debug to ease API client development
- Template based for building API endpoints methods & documentation very quickly
- CLI commands to build, test, and debug API methods

## Currently Supported Devices

- **Huawei** modems
- **OpenWRT** based routers
- **OPNSense** routers
- **SFR** internet boxes provided by french "SFR" (or "Red-by-SFR") ISP
- **ZTE** modems

*All tested models are listed in:* `/src/devices/(BRAND)/Readme.md`


## Requirements

- php >= 5.4
- curl php extension


## How to use

Example:

```php
require('src/devices/huawei_modem/main.php');
$client= new HackApi_Huawei_modem();

//Set Credentials (if not set in default.php) file
//$client->SetHost('192.168.0.1');
//$client->SetLogin('admin','password');

// List messages from the SMS Inbox
$messages = $client->ApiSmsListReceived();
print_r($messages);

// Send an SMS
$done = $client->ApiSmsSend('0612345678','Hello world');

// Reboot modem
$done = $client->ApiReboot();
```

*Very Simple, isn't it?*


## Contribute

- Please submit the products models that you have tested
- Write new device specifics clients and submit them back
- Enhance the documentation : *yes, I know, my english writing sucks!*
- Pull Requests are always **welcome**!

Enjoy!
