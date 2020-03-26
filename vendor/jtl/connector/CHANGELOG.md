2.7.0
-----
- Removed log level and display errors calls in error handler
- Removed deprecated get_magic_quotes_gpc call
- Switched order in dispatch (symfony event) calls to prevent deprecated messages
- Updated composer dependencies to establish symfony 5 compatiblity
- Changed doctrine array collection to array
- Updated minimum PHP Version to 7.1.3

2.6.11
-----
- Added locale irish in Ireland

2.6.10
-----
- Removed infinity loop in session class to avoid warning

2.6.9
-----
- Delete old Linking before saving the new on 

2.6.8
-----
- Exception handling while encode or decode json revised.

2.6.5
-----
- Default logging channel switched to global
- Logging channel constants defined

2.6.4
-----
- Avoid warning in switch statement

2.6.0
-----
- CO-204 Connector linkings extended
- Skip unknown entity ack's
- Token loader is not needed in case a token validator is implemented

2.5.2
-----
- Dependencies updated
- Use variable as second parameter to suppress deprecated warning

2.4.17
-----
- Minimum requirements changed to PHP 5.6.4

2.4.16
-----
- ShippingClass identity mapping added to product

2.4.15
-----
- Cross selling events added

2.4.14
-----
- ShippingClass mappings added

2.4.13
------
- Payment types added

2.4.12
------
- CO-200 Remove session.save_handler from php settings

2.4.11
------
- Added license data (LGPL-3.0-or-later)

2.4.10
------
- Added throwable and exception switching for php version compatibility
- Changed monolog/monolog dependency to 1.*

2.4.9
-----
- CO-122 Added new connector finish event
- CO-154 Added new CustomerOrderItem note property

2.4.8
-----
- Fixed minor syntax bug

2.4.7
-----
- Added customer note

2.4.6
-----
- Fixed connector server info annotation bug
- Changed vendor versions to < PHP 7 requirements

2.4.5
-----
- Added connector core debug and log call

2.4.4
-----
- Fixed minor Checksum Linker bug
- Fixed Serializer Annotation bug

2.4.3
-----
- Fixed exception error handler

2.4.2
-----
- Added manufacturer property to product model
- Changed exception message in error handler
- Fixed identity linker is type bug

2.4.1
-----
- Added compatibility method to config class
- Added sys_get_temp_dir fallback

2.4.0
-----
- Major config system refactoring

2.3.0
-----
- Casting endpoint id on identity model to string

2.2.25
------
- Changed some method comments
- Added Datamodel setIdentity method
- Identitylinker refactoring

2.2.24
------
- Changed language core utility to intercept empty strings

2.2.23
------
- Changed position of incoming request packet logging
- Fixed after statistic event parameters

2.2.22
------
- Added product property 'newReleaseDate'

2.2.21
------
- Added more locales in our language utility

2.2.20
------
- Changed session lifetime to session.gc_maxlifetime

2.2.19
------
- Downgrading Monolog to version 1.17.2

2.2.18
------
- Changed Monolog to version 1.19.x
- Added php 7 compatibility

2.2.17
------
- Added imagei18n to identity linker

2.2.16
------
- Fixed event property names

2.2.15
------
- Fixed imagei18n type classname

2.2.14
------
- Added property name to image
- Added entity ImageI18n
- Changed and fixed Event parameter

2.2.13
------
- Added 2 new customer order item types

2.2.12
------
- Added heidelpay payment type

2.2.11
------
- Added productId to delivernoteitem

2.2.10
------
- Added new payment types for skrill and paymorrow

2.2.9
-----
- Addded customer order and customer order item gross prices

2.2.8
-----
- Added token validator

2.2.7
-----
- Fixed php 7 error handling support

2.2.6
-----
- Added specific value type mapping to the identitylinker
- Added connector statistic event
- Added core connector features event
- Correct model namespaces in PHPDoc

2.2.5
-----
- Fixed ics zip file bug

2.2.4
-----
- Added billsafe to payment types

2.2.3
-----
- Added customer order pui property

2.2.2
-----
- Added paypal plus and amazon payments payment types

2.2.1
-----
- Improve HHVM compatibility by add @ReadOnly annotation to the core DataModel class

2.2.0
-----
- Introduce new constant LOG_DIR that controls the log directory used by Monolog

2.1.1
-----
- Added id to crossselling entity
- Added identity linker crossselling id mapping

2.1.0
-----
- Changed protocol version to 7 due to product image masterkill sorting
- Use stable version of doctrine/collections

2.0.1
-----
- Removed class controller helper
- Changed seo method noDiacritics to replaceDiacritics and makes it public
- Fixed logger force writing flag

2.0.0
-----
- Added initial config "developer_logging" flag
- Removed base connector get and set config

1.0.1
-----
- Changed monolog stream handler to rotate handler

1.0.0
-----
- Added property ean to product variation value
- Change jms serializer version to 1.0
